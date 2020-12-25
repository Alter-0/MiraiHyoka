import time
from bs4 import BeautifulSoup
import pymysql
import socket
import requests
import json
requests.adapters.DEFAULT_RETRIES = 5
s = requests.session()
s.keep_alive = False
socket.setdefaulttimeout(20)

id = 208994
# 豆瓣评分 5227个
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
    'll': '118090',
    'bid': 'FaMknu8TG04',
    '_vwo_uuid_v2': 'D56E9B79DD30CC4C277E52C3ECE1DE255|42a01d326b4253cc1a41e725f93914ae',
    '_ga': 'GA1.2.521547030.1608304618',
    '_gid': 'GA1.2.177347505.1608427035',
    '__utmz': '223695111.1608430347.6.4.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided)',
    'push_doumail_num': '0',
    'push_noty_num': '0',
    '__utmv': '30149280.22869',
    '_pk_ref.100001.4cf6': '%5B%22%22%2C%22%22%2C1608466274%2C%22https%3A%2F%2Fwww.douban.com%2F%22%5D',
    '_pk_ses.100001.4cf6': '*',
    '__utma': '30149280.521547030.1608304618.1608460377.1608466275.9',
    '__utmb': '223695111.0.10.1608466275',
    '__utmc': '30149280',
    '__utmt': '1',
    '_pk_id.100001.4cf6': 'd42f44961b50295c.1608304630.10.1608468439.1608461030.',
    'dbcl2': '228692158:s5r8/AYEKqE',
    'ck': 'z6Zf',
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
    doubans = 8996
    re = ""
    while (re != "停止"):
        re = getdouban(doubans)
        print("已爬取由" + str(doubans) + "开头的连接")
        time.sleep(10)
        doubans += 20


doubanlie()
