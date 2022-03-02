from pynput import mouse


def mouse_move(x, y):
    print(f"mouse is on coordinate {x}, {y}")


def mouse_click(x, y, button, clicked):
    c = ""
    if button == mouse.Button.left:
        c = "Left button"
    if button == mouse.Button.left:
        c = "Right button"
    if button == mouse.Button.left:
        c = "Middle button"
    print("{0} {1} at {2}".format(
        'Left Button' if button is mouse.Button.left else 'Right button',
        "Pressed" if clicked else "release",
        {x, y}
    ))
    pass


def mouse_scroll(x, y, dx, dy):
    print(f"Scrolled at {x,y}")

    if dy < 0:
        print(f"Scrolled down {x,y}")
    else:
        print(f"Scrolled up {x,y}")


def main():
    # move click scroll
    listener = mouse.Listener(
        on_move=mouse_move, on_click=mouse_click, on_scroll=mouse_scroll)
    listener.start()
    listener.join()


if __name__ == "__main__":
    main()
