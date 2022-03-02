from threading import Thread
import threading
import time


def saySomething(word):
    count = 0
    while count < 5:
        print(word)
        count += 1


# bikin object
t1 = threading.Thread(target=saySomething, args=("hello"))
t2 = threading.Thread(target=saySomething, args=("hi"))

# jalanin thread
t1.start()
t2.start()

# tunggu sampe thread slese baru lanjut command bawahnya
t1.join()
t2.join()

print(f"program run for: {time.time() - start_time}")
