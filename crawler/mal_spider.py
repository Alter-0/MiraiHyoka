import time

import requests
import re
import pymysql
import urllib3

from scrapy import Selector

urllib3.disable_warnings()

headers = {
    # 'authority': 'api.bilibili.com',
    'sec-ch-ua': '"Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
    'accept': 'application/json, text/plain, */*',
    'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) '
                  'Chrome/87.0.4280.88 Safari/537.36',
    'sec-fetch-site': 'same-site',
    'sec-fetch-mode': 'cors',
    'sec-fetch-dest': 'empty',
    # 'referer': 'https://www.bilibili.com/',
    'accept-language': 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
    'keep-live': 'false',
}

# proxies = {'https': 'localhost'}

db = pymysql.connect("localhost", "root", "", "miraihyoka")
cursor = db.cursor()


def spider():
    limit = 11650
    domain = "https://myanimelist.net/topanime.php?limit="
    s = requests.session()
    s.keep_alive = False
    s.DEFAULT_RETRIES = 5
    # try:
    result = s.get(domain + str(limit), headers=headers, verify=False).text
    while 1:
        try:
            sel = Selector(text=result)
            results = sel.xpath("//h3[@class='hoverinfo_trigger fl-l fs14 fw-b anime_ranking_h3']/a/@href").extract()
        except:
            print('GG')
            results = ''
            # proxies = ip_poll()
            # result = requests.get(domain, headers=headers).text
            # sel = Selector(text=result)
            # results = sel.xpath("//h3[@class='hoverinfo_trigger fl-l fs14 fw-b anime_ranking_h3']/a/@href").extract()

        print(results)

        for url in results:
            details_page = s.get(url, headers=headers, verify=False).text
            # print(details_page)

            try:
                sel = Selector(text=details_page)
                rate = sel.xpath("//span[@itemprop='ratingValue']/text()").extract()[0]
            except:
                print('GG')
                rate = '0'
                # ip = ip_poll()
                # details_page = requests.get(url, headers=headers).text
                # sel = Selector(text=details_page)
                # rate = sel.xpath("//span[@itemprop='ratingValue']/text()").extract()[0]

            print(rate)
            # float(rate)

            try:
                pat = 'English:</span> (.*)\s'
                name_en = re.compile(pat).findall(details_page)[0]
                name_en = name_en.replace('&#039;', '\'')
                print(name_en)
            except:
                try:
                    pat = 'Synonyms:</span> (.*)\s'
                    name_en = re.compile(pat).findall(details_page)[0]
                    name_en = name_en.replace('&#039;', '\'')
                    print(name_en)
                except:
                    name_en = ''

            try:
                pat = 'Japanese:</span> (.*)\s'
                name_jp = re.compile(pat).findall(details_page)[0]
                name_jp = name_jp.replace('&#039;', '\'')
                print(name_jp)
            except:
                name_jp = ''

            try:
                members = sel.xpath("//span[@class='numbers members']/strong/text()").extract()[0]
                member = ''
                for i in members.split(','):
                    member += str(i)
                int(member)
            except:
                member = '0'
            print(member)

            sql = "insert into mal(name_en,name_jp,rate,members) value (%s,%s,%s,%s)"
            args = (name_en, name_jp, rate, member)
            db.ping(reconnect=True)
            cursor.execute(sql, args)
            db.commit()
            time.sleep(5)

        limit += 50
        url = domain + str(limit)
        print(url)
        result = s.get(url, headers=headers, verify=False).text

    # except:
    #     print('出错，执行结束')


def ip_poll():
    i = True
    while i:
        api = 'http://ip.ipjldl.com/index.php/api/entry?method=proxyServer.generate_api_url&packid=1&fa=0&fetch_key' \
              '=&groupid=0&qty=1&time=1&pro=&city=&port=1&format=html&ss=5&css=&dt=1&specialTxt=3&specialJson' \
              '=&usertype=2 '
        ip = requests.get(api).text
        print(ip)
        proxies = {'https': ip}
        # proxies = {'https': 'localhost'}
        url = "https://www.baidu.com/"
        baidu = requests.get(url, headers=headers, proxies=proxies, verify=False).text
        sel = Selector(text=baidu)
        try:
            res = sel.xpath("//*[@id='s-top-left']/a[1]").extract[0]
            print(res)
            print('使用了代理ip')
            i = False
        except:
            print('ip无效')
        i = False

    return proxies


if __name__ == '__main__':
    spider()
    # ip_poll()
    db.close()
