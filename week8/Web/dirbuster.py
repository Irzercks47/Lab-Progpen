from os import linesep
import sys
import getopt
from queue import Queue
from threading import Thread
import requests


# variabel global
URL = ""
WORD_FILENAME = ""
EXTENSION_FILENAME = ""
WORD_LIST = []
EXTENSION_LIST = []
# kegunakan queue untuk antri
# buat nampung setiap path dari path yang ditemuin
COMBINATION_QUEUE = Queue()


def check_path(path):
    response = requests.get(f'http://{URL}/{path}')
    status_code = response.status_code

    # print(status_code)

    if status_code == 200:
        print(f'File/path is found: {path}')
        return True
    elif status_code == 403:
        print(f'Forbidden file/path is found: {path}')
        return True
    elif status_code == 404:
        # print(f'not found: {path}')
        return False

    return False


def get_queue():
    while not COMBINATION_QUEUE.empty():
        path = COMBINATION_QUEUE.get()

        if check_path(path):
            add_brute_list(path)


def run_thread():
    thread_list = []

    for _ in range(10):
        t = Thread(target=get_queue)
        t.start()
        thread_list.append(t)

    for t in thread_list:
        t.join()

# mau nyari sebuah file


def add_brute_list(path):
    # /image.jpg
    for word in WORD_LIST:
        path_combination = f'{path}/{word}'
        COMBINATION_QUEUE.put(path_combination)

        for extension in EXTENSION_LIST:
            COMBINATION_QUEUE.put(f'{path_combination}.{extension}')


def read_file(filename):
    open_file = open(filename, "r")

    temp_list = []

    for line in open_file:
        temp_list.append(line.strip())

    open_file.close()

    return temp_list


# inisialisasi apakah file yang didapat dari getopt itu ada
def initialize():
    global WORD_LIST, EXTENSION_LIST

    WORD_LIST = read_file(WORD_FILENAME)
    EXTENSION_LIST = read_file(EXTENSION_FILENAME)

    add_brute_list("")

    # while not COMBINATION_QUEUE.empty():
    #     print(COMBINATION_QUEUE.get())

    run_thread()


def main():
    global URL, WORD_FILENAME, EXTENSION_FILENAME
    # untuk getopt nya
    # u untuk url
    # w untuk word
    # e untuk extension

    try:
        args, _ = getopt.getopt(sys.argv[1:], "u:w:e:")
    except:
        print("failed")
        return

    for key, value in args:
        if key == "-u":
            URL = value
        elif key == "-w":
            WORD_FILENAME = value
        elif key == "-e":
            EXTENSION_FILENAME = value

    if WORD_FILENAME and EXTENSION_FILENAME:
        initialize()


if __name__ == "__main__":
    main()
