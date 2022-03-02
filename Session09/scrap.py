from bs4 import BeautifulSoup
import requests
from requests.models import Response


URL = "http://localhost/pentest/Session09/09/09-web/index.php"


def main():
    # reponse = requests.get(URL)
    reponse = requests.get(URL, headers={
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36"})
    soup = BeautifulSoup(reponse.text, "html.parser")
    # print(soup.prettify())
    # disini h1 karena nama dari prod nya itu dimunculkan di tag h1 dan h1 ini tidak dipakai apa" jadi hanya untuk prod saja
    # all_product_name = soup.find_all("h1", attrs={"class": "text-4xl"})
    all_product_name = soup.find_all("h1")
    # print(all_product_name[1].decode_contents())
    # # untuk tag image
    # all_product_name = soup.find_all("img")
    # # agar bisa melihat src dari tag image
    # print(all_product_name[1].get("src"))
    # untuk price menggunakan tag pre
    all_product_price = soup.find_all("pre")

    count_data = 0
    sum_data = 0

    # menggunakan 1, karena kita tidak mau mengambil product, price nya jadi loop dimulai dari yang isinya beneran ada datanya
    for i in range(1, len(all_product_name)):
        try:
            # bila data rusak maka akan jumbled maka disini bila price tidak bisa di convert jadi integer maka data akan di ignore
            price = int(all_product_price[i].decode_contents()[2:])
            name = all_product_name[i].decode_contents()
            print(name + "-" + str(price))
            count_data += 1
            sum_data += price
        except:
            continue

    average = sum_data / count_data
    print(count_data, sum_data, average)


if __name__ == "__main__":
    main()
