import time
from bs4 import BeautifulSoup
import pymysql
# from langdetect import DetectorFactory
import socket
# from fake_useragent import UserAgent
import requests
import json


requests.adapters.DEFAULT_RETRIES = 5
s = requests.session()
s.keep_alive = False
socket.setdefaulttimeout(20)

id = 205710
# DetectorFactory.seed = 0
# {"data":[]}
# https://movie.douban.com/j/new_search_subjects?sort=S&range=0,10&tags=%E5%8A%A8%E6%BC%AB&start=0

db = pymysql.connect("152.136.123.96", "gaibian", "y2r2V6trxukYr9Gg", "bidscore")
cursor = db.cursor()
headers = {
    'Connection': 'keep-alive',
    'Cache-Control': 'max-age=0',
    'sec-ch-ua': '"Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
    'sec-ch-ua-mobile': '?0',
    'DNT': '1',
    'Upgrade-Insecure-Requests': '1',
    'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.517 Safari/537.36',
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Sec-Fetch-Site': 'none',
    'Sec-Fetch-Mode': 'navigate',
    'Sec-Fetch-User': '?1',
    'Sec-Fetch-Dest': 'document',
    'Accept-Language': 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',

}
cookies = {
    '_vwo_uuid_v2': 'DF2CAE5CAC8D83B1A9101890CF0317D61^|f6d34970f27cb55cabcebe4ff697ed75',
    '__utmv': '30149280.21751',
    'douban-profile-remind': '1',
    'viewed': '^\\^2289661^\\^',
    'll': '^\\^128481^\\^',
    'bid': 'CvGMhpMKofk',
    '_ga': 'GA1.2.1244704917.1564382740',
    '__utmz': '30149280.1607163693.58.47.utmcsr=baidu^|utmccn=(organic)^|utmcmd=organic',
    '__utma': '30149280.1244704917.1564382740.1608353173.1608525612.60',
    '__utmc': '30149280',
    'dbcl2': '^\\^217516935:2IYm8LvUpwk^\\^',
    'ck': '19EO',
    '_pk_ref.100001.8cb4': '^%^5B^%^22^%^22^%^2C^%^22^%^22^%^2C1608525891^%^2C^%^22https^%^3A^%^2F^%^2Faccounts.douban.com^%^2F^%^22^%^5D',
    '_pk_id.100001.8cb4': 'dd4b540dc1103471.1587457323.13.1608525891.1608353173.',
    '_pk_ses.100001.8cb4': '*',
    'push_noty_num': '0',
    'push_doumail_num': '0',
    '__utmt': '1',
    '__utmb': '30149280.2.10.1608525612',
}



def getheaders():
    headers = {
        'Upgrade-Insecure-Requests': '1',
        'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.517 Safari/537.36',
        'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'Sec-Fetch-Site': 'none',
        'Sec-Fetch-Mode': 'navigate',
        'Sec-Fetch-User': '?1',
        'Sec-Fetch-Dest': 'document',
        'Accept-Language': 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
    }
    return headers


def getdouban(doubans):
    global id
    url = "https://movie.douban.com/j/new_search_subjects?sort=S&range=0,10&tags=%E5%8A%A8%E6%BC%AB&start={}".format(
        doubans)

    ads = requests.Session()
    ads.headers = getheaders()
    videolie = ads.get(url, headers=getheaders())
    jiema = videolie.json()
    jsvideo = json.dumps(jiema, ensure_ascii=False)
    pyvideo = json.loads(jsvideo)
    a = pyvideo["data"]
    c = len(a)
    if c == 0:
        return "停止"
    for d in a:
        chname = d["title"]
        douscore = d["rate"]
        doubanurl = d["url"]
        s = requests.Session()
        s.headers=getheaders()
        doude = s.get(doubanurl, headers=getheaders())
        doude.encoding = "utf-8"
        douban = doude.text

        dousoup = BeautifulSoup(douban, 'html.parser')

        doutags = dousoup.find_all("span", property="v:genre")

        for doutag in doutags:
            tag = doutag.string

            tagsql = "insert into tags(tag,doubanid) value (%s,%s)"
            args = (tag, id)
            # db.ping(reconnect=True)
            cursor.execute(tagsql, args)
            db.commit()
        diqu=""
        info=dousoup.find(id="info")
        maydi = info.find_all("span")

        for maydie in maydi:

            if maydie.string=="制片国家/地区:":

                diqu=str(maydie.next_sibling).replace(" ","")

        mayiurl = dousoup.find_all("a", target="_blank", rel="nofollow")
        isimdb = 0
        imdbscore = ""
        for ce in mayiurl:
            if "www.imdb.com" in ce.get("href"):
                imdburl = ce.get("href")
                isimdb = 1
                imdbscore=getimdbscore(imdburl,0)

                break
        if isimdb == 0:
            print("无imdb评分")
        scoresql = "insert into douban(doubanid,doubanscore,imdbscore,douname,diqu) value (%s,%s,%s,%s,%s)"
        args = (id, douscore, imdbscore, chname,diqu)
        # db.ping(reconnect=True)
        cursor.execute(scoresql, args)
        db.commit()
        time.sleep(1)
        print("已爬取" + chname+"id："+str(id))
        s.close()
        id += 1
    return "ok"
def getimdbscore(imdburl,ce):

    try:
        imdbye = requests.get(imdburl, headers=getheaders())
        imdbye.encoding = "utf-8"
        imdb = imdbye.text
        imdbsoup = BeautifulSoup(imdb, 'html.parser')
        imdbscore = imdbsoup.find("span", itemprop="ratingValue").string
    except :
        print()
        if ce>5:
            imdbscore=""
            return imdbscore
        imdbscore = getimdbscore(imdburl,ce+1)
    return imdbscore



def doubanlie():
    doubans = 5709
    re = ""
    while (re != "停止"):
        re = getdouban(doubans)
        print("已爬取由" + str(doubans) + "开头的连接")
        time.sleep(10)
        doubans += 20


doubanlie()
