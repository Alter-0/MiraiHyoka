
import time
from bs4 import BeautifulSoup
import pymysql
import requests
from langdetect import detect
from langdetect import DetectorFactory
import socket
from fake_useragent import UserAgent
import requests
import js2xml
import lxml
import json
ua = UserAgent()
requests.adapters.DEFAULT_RETRIES = 5

socket.setdefaulttimeout(20)

id = 300001
DetectorFactory.seed = 0
# {"data":[]}
# https://movie.douban.com/j/new_search_subjects?sort=S&range=0,10&tags=%E5%8A%A8%E6%BC%AB&start=0

db = pymysql.connect("localhost", "root", "", "bidscore")
cursor = db.cursor()
cookies = {
    '_ga': 'GA1.2.1219721681.1608304482',
    '_gid': 'GA1.2.1946781450.1608430322',
    '_gat': '1',
    'anikore': 'pngq1al8847rm72r0k92uiih01',
    'Cookie[refresh_token]': 'Q2FrZQ%3D%3D.7OkLOQu2Tx6oNWGAAyV8gzHKrDXwqXlrHQEEQQwcVSN31FqmJnrFE3c9dQ%3D%3D',
    '_gali': 'page-top',
}


def getheaders():
    headers = {
        'user-agent':  ua.random,
        'accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'sec-fetch-site': 'same-origin',
        'sec-fetch-mode': 'navigate',
        'sec-fetch-user': '?1',
        'sec-fetch-dest': 'document',
        'referer': 'https://www.anikore.jp/pop_ranking/',
        'accept-language': 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
    }
    return headers

page=2

url='https://www.anikore.jp/pop_ranking/page:{}'.format(page)
s=requests.Session()
s.headers=getheaders()

response = s.get(url,cookies=cookies)
an=response.text
print(an)
ansoup=BeautifulSoup(an, 'html.parser')
anlist=ansoup.find_all("div",class_="l-searchPageRanking_unit")
for anone in anlist:
    print(anone)
    scorespan=anone.find("span",class_="l-searchPageRanking_unit_score ").string
    print(scorespan)


