import socket

target = "localhost"  # target menggunakan localhost

start_port = 0
end_port = 8080


def portscanner():
    # loop sampai ketemu port yang open
    for port in range(start_port, end_port):
        mysocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        result = mysocket.connect_ex((target, port))
        if result == 0:
            print(f"port {port} is open")
        else:
            print(f"port {port} is closed")


def main():
    pass


if __name__ == "__main__":
    main()
