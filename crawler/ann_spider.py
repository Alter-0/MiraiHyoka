import time

import requests
import re
import pymysql
import urllib3
from fake_useragent import UserAgent

from scrapy import Selector

urllib3.disable_warnings()

db = pymysql.connect("localhost", "root", "", "miraihyoka")
cursor = db.cursor()


def spider():
    domain = "https://www.animenewsnetwork.com/encyclopedia/ratings-anime.php?top50=best_bayesian&n=7000"
    s = requests.session()
    s.keep_alive = False
    s.DEFAULT_RETRIES = 5

    headers=get_header()

    result = s.get(domain, headers=headers, verify=False).text
    sel = Selector(text=result)
    # print(result)

    results = sel.xpath('//tr[@bgcolor="#EEEEEE"]/td[@class="t"]/a/@href').extract()
    # url=sel.xpath("//*[@id='#area5114']").extract()
    print(results)

    for url in results[2772:]:
        headers = get_header()
        url='https://www.animenewsnetwork.com' + url
        print(url)
        details_page = s.get(url, headers=headers, verify=False).text
        # print(details_page)
        sel = Selector(text=details_page)
        pat = 'Bayesian estimate:</b> (.*) \\(.*\\),'
        rate=re.compile(pat).findall(details_page)[0]
        # rate = sel.xpath("//span[@itemprop='ratingValue']/text()").extract()[0]
        # float(rate)
        print(rate)

        try:
            name_en = sel.xpath('//*[@id="page_header"]/text()').extract()[0]
            pat = '(.*)\s\\('
            try:
                name_en = re.compile(pat).findall(name_en)[0]
            except:
                pass
            name_en = name_en.replace('`', '\'')
            print(name_en)
        except:
            name_en = ''

        try:
            name_jp = sel.xpath('//div[@id="infotype-2"]/div[contains(text(),"(Japanese)")][last()]/text()').extract()[0]
            pat = '(.*)\s\\('
            try:
                name_jp = re.compile(pat).findall(name_jp)[0]
            except:
                pass
            name_jp = name_jp.replace('`', '\'')
            print(name_jp)
        except:
            name_jp = ''

        sql = 'insert into ann(name_en,name_jp,rate,url) value (%s,%s,%s,%s)'
        args = (name_en, name_jp, rate, url)
        db.ping(reconnect=True)
        cursor.execute(sql, args)
        db.commit()
        time.sleep(1)


def get_header():
    headers = {
        'sec-ch-ua': '"Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
        'accept': 'application/json, text/plain, */*',
        'user-agent': str(UserAgent().random),
        'sec-fetch-site': 'same-site',
        'sec-fetch-mode': 'cors',
        'sec-fetch-dest': 'empty',
        'accept-language': 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
        'keep-live': 'false',
    }
    return headers


if __name__ == '__main__':
    spider()
    db.close()
