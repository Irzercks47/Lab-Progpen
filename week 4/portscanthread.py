import socket
import threading

target = "localhost"  # target menggunakan localhost

start_port = 0
end_port = 8080
thread_list = []


def portscanner():
    # loop sampai ketemu port yang open
    for port in range(start_port, end_port):
        mysocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        result = mysocket.connect_ex((target, port))
        if result == 0:
            try:
                print(
                    f"port {port} is open. service : {socket.getservbyport(port)}")
            except:
                print(f"port {port} is open with unknown service")


def main():
    for port in range(start_port, end_port+1):
        t = threading(target=portscanner, args=(port,))
        t.start()
        thread_list.append(t)

    for t in thread_list:
        t.join()


if __name__ == "__main__":
    main()

# beda thread dan yang biasa adalah thread lebih cepat dari yang tidak pakai thread
