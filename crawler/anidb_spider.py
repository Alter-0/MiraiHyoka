import time

import requests
import re
import pymysql
import urllib3
from lxml import etree
from fake_useragent import UserAgent

# from scrapy import Selector
from requests.adapters import HTTPAdapter

urllib3.disable_warnings()

db = pymysql.connect("localhost", "root", "", "miraihyoka")
cursor = db.cursor()


def spider():
    domain = "https://anidb.net/anime/?h=1&noalias=1&orderby.name=1.1&orderby.rating=0.2"
    # result = requests.get(domain, headers=headers).text
    # print(result)

    i = 59
    headers = get_header()
    url = domain + '&page=' + str(i) + '&view=list'

    result = get_index(url)
    # result = s.get(domain + '&page=' + str(i) + '&view=list', headers=headers, verify=False).text

    # try:
    while 1:
        # sel = Selector(text=result)
        # results = sel.xpath("//td[@data-label='Title']/a/@href").extract()
        # url=sel.xpath("//*[@id='#area5114']").extract()

        tree = etree.HTML(result)
        results = tree.xpath("//td[@data-label='Title']/a/@href")

        print(results)
        headers = get_header()

        for url in results:
            headers = get_header()
            url = 'https://anidb.net' + url
            details_page = get_web(url)
            try:
                # details_page = s.get('https://anidb.net' + url, headers=headers, verify=False).text
                tree = etree.HTML(details_page)
                # print(details_page)
                # sel = Selector(text=details_page)
                # rate = sel.xpath("//span[@itemprop='ratingValue']/text()").extract()[0]
                rate = tree.xpath("//span[@itemprop='ratingValue']/text()")[0]
                # print(type(rate))
                # float(rate)
                print(rate)
            except:
                rate=''

            try:
                # judge=
                # judge = sel.xpath('//div[@id="tab_1_pane"]//span[@class="i_icon i_flag i_audio_en"][1]').extract()
                judge = tree.xpath('//div[@id="tab_1_pane"]//span[@class="i_icon i_flag i_audio_en"][1]')
                if len(judge):
                    # name_en = sel.xpath('//span[@class="i_icon i_flag i_audio_en"][1]/../../label/text()').extract()[0]
                    name_en = tree.xpath('//span[@class="i_icon i_flag i_audio_en"][1]/../../label/text()')[0]
                else:
                    # name_en = sel.xpath('//*[@id="tab_1_pane"]/div/table/tbody/tr[1]/td/span/text()').extract()[0]
                    name_en = tree.xpath('//*[@id="tab_1_pane"]/div/table/tbody/tr[1]/td/span/text()')[0]
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
                is_card = re.search('Title Card', details_page)
                if is_card is None:
                    # print('没有title card')
                    # name_jp = sel.xpath('//span[@class="i_icon i_flag i_audio_ja"][1]/../../label/text()').extract()[0]
                    name_jp = tree.xpath('//span[@class="i_icon i_flag i_audio_ja"][1]/../../label/text()')[0]
                else:
                    # print('有title card')
                    # name_jp = sel.xpath("//th[text()='Title Card'][1]/following-sibling::td[1]/label/text()").extract()[
                    name_jp = tree.xpath("//th[text()='Title Card'][1]/following-sibling::td[1]/label/text()")[0]
                pat = '(.*)\s\\('
                try:
                    name_jp = re.compile(pat).findall(name_jp)[0]
                except:
                    pass
                name_jp = name_jp.replace('`', '\'')
                print(name_jp)
            except:
                name_jp = ''

            sql = "insert into anidb(name_en,name_jp,rate) value (%s,%s,%s)"
            args = (name_en, name_jp, rate)
            db.ping(reconnect=True)
            cursor.execute(sql, args)
            db.commit()
            time.sleep(5)

        i += 1
        url = domain + '&page=' + str(i) + '&view=list'
        print(url)
        result = get_index(url)

    # except:
    #     print('出错，执行结束')


def get_header():
    headers = {
        'sec-ch-ua': '"Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
        'accept': 'application/json, text/plain, */*',
        # 'user-agent': str(UserAgent().random),
        'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) '
                      'Chrome/87.0.4280.88 Safari/537.36',
        'sec-fetch-site': 'same-site',
        'sec-fetch-mode': 'cors',
        'sec-fetch-dest': 'empty',
        'accept-language': 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
        'keep-live': 'false',
    }
    return headers


def get_web(url):
    for i in range(0, 3):
        print(time.strftime('%Y-%m-%d %H:%M:%S'))
        try:
            s = requests.session()
            s.keep_alive = False
            s.DEFAULT_RETRIES = 5
            s.mount('http://', HTTPAdapter(max_retries=3))
            s.mount('https://', HTTPAdapter(max_retries=3))
            headers = get_header()
            result = s.get(url, headers=headers, verify=False, timeout=60).text
            return result
        except:
            print('正尝试重新连接...')
            pass
    return None


def get_index(url):
    while True:
        print(time.strftime('%Y-%m-%d %H:%M:%S'))
        try:
            s = requests.session()
            s.keep_alive = False
            s.DEFAULT_RETRIES = 5
            s.mount('http://', HTTPAdapter(max_retries=3))
            s.mount('https://', HTTPAdapter(max_retries=3))
            headers = get_header()
            result = s.get(url, headers=headers, verify=False, timeout=60).text
            return result
        except:
            print('正尝试重新连接...')
            pass


if __name__ == '__main__':
    spider()
    db.close()
