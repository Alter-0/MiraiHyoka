import time
from bs4 import BeautifulSoup
import pymysql
import requests
from langdetect import detect
from langdetect import DetectorFactory
import socket
from fake_useragent import UserAgent
ua=UserAgent()
requests.adapters.DEFAULT_RETRIES = 5

socket.setdefaulttimeout(20)

id = 104702
DetectorFactory.seed = 0
def getheaders():
    headers = {
    'keep-live': 'false',
    'Cache-Control': 'max-age=0',
    'Upgrade-Insecure-Requests': '1',
    'DNT': '1',
    'User-Agent': ua.random,
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Sec-Fetch-Site': 'same-origin',
    'Sec-Fetch-Mode': 'navigate',
    'Sec-Fetch-User': '?1',
    'Sec-Fetch-Dest': 'document',
    'Accept-Language': 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
    }
    return headers
cookies = {
    'll': '118090',
    'bid': 'FaMknu8TG04',
    '_vwo_uuid_v2': 'D56E9B79DD30CC4C277E52C3ECE1DE255|42a01d326b4253cc1a41e725f93914ae',
    '_ga': 'GA1.2.521547030.1608304618',
    '_gid': 'GA1.2.177347505.1608427035',
    '__utmz': '223695111.1608430347.6.4.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided)',
    '__utma': '30149280.521547030.1608304618.1608440091.1608460377.8',
    '__utmc': '30149280',
    '__utmt': '1',
    'dbcl2': '228692158:xHRQOzFh/QE',
    'ck': 'eusO',
    'push_noty_num': '0',
    'push_doumail_num': '0',
    '__utmv': '30149280.22869',
    '__utmb': '30149280.3.10.1608460377',
    '_pk_ref.100001.4cf6': '%5B%22%22%2C%22%22%2C1608460514%2C%22https%3A%2F%2Fwww.douban.com%2F%22%5D',
    '_pk_ses.100001.4cf6': '*',
    '_pk_id.100001.4cf6': 'd42f44961b50295c.1608304630.9.1608460592.1608440201.',
}

# page== 150-253
db = pymysql.connect("localhost", "root", "", "bidscore")
cursor = db.cursor()

print(cursor)


def getdizhi(page):

    params = (
        ('sort', 'rank'),
        ('page', page),
    )
    response = requests.get('https://bangumi.tv/anime/browser', headers=getheaders(), params=params,timeout=30)
    lie = response.text

    soup = BeautifulSoup(lie, 'html.parser')
    srcs = []
    for item in soup.find_all("h3"):
        src = item.find("a").get("href")
        srcs.append(src)

    return srcs


def getbagumiaaa(src,cen):

    try:
        cen+=1
        global id
        url = 'https://bangumi.tv' + src
        # print(url)
        # url = "https://bangumi.tv/subject/285666"
        # url = "https://bangumi.tv/subject/141530"
        response = requests.get(url, headers=getheaders())
        if response.status_code != 200:
            return "gg"
        response.encoding = "utf-8"
        bagumi = response.text

        soup = BeautifulSoup(bagumi, 'html.parser')
        # print(soup)

        name = soup.find(property="v:itemreviewed")
        # print("中文名"+name.get("title"))
        chname = name.get("title")
        wainame = name.string
        # print(detect(wainame))
        janame = ""
        egname = ""
        if detect(wainame) == "ja":
            # print("日文名"+wainame)
            janame = wainame
        else:
            # print("英文名"+wainame)
            egname = wainame
        detail = soup.find(id="infobox")
        infos = detail.find_all("li")
        startdata = ""
        week = ""
        is_finish = 0
        detailinfo = ""

        for info in infos:
            inname = info.find("span").string
            if inname == "中文名: ":
                continue
            elif inname == "话数: ":
                continue
            elif inname == "放送开始: ":
                startdata = info.text
                try:
                    struct_time = time.strptime(startdata, "放送开始: %Y年%m月%d日")
                except:
                    try:
                        struct_time = time.strptime(startdata, "放送开始: %Y-%m-%d")
                    except:
                        try:
                            struct_time = time.strptime(startdata, "放送开始: %Y年")
                        except:
                            try:
                                struct_time = time.strptime(startdata, "放送开始: %Y")
                            except:
                                print("日期再次失败！！！！！！！！！！" + startdata)
                                struct_time = time.strptime("2000-1-1", "%Y-%m-%d")
                startdata = str(struct_time.tm_year) + "-" + str(struct_time.tm_mon) + "-" + str(
                    struct_time.tm_mday)
            elif inname == "放送星期: ":
                week = info.text.replace("放送星期: ", "")
            elif inname == "放送结束: ":
                is_finish = 1
            elif inname == "播放结束: ":
                is_finish = 1
            elif inname == "开始: ":
                startdata = info.text
                try:
                    struct_time = time.strptime(startdata, "开始: %Y年%m月%d日")
                except:
                    try:
                        struct_time = time.strptime(startdata, "开始: %Y-%m-%d")
                    except:
                        try:
                            struct_time = time.strptime(startdata, "开始: %Y年")
                        except:
                            try:
                                struct_time = time.strptime(startdata, "开始: %Y")
                            except:
                                print("日期再次失败！！！！！！！！！！" + "startdata")
                                struct_time = time.strptime("2000-1-1", "%Y-%m-%d")
                startdata = str(struct_time.tm_year) + "-" + str(struct_time.tm_mon) + "-" + str(
                    struct_time.tm_mday)
            elif inname == "结束: ":
                is_finish = 1
            elif inname == "上映年度: ":
                startdata = info.text
                try:
                    struct_time = time.strptime(startdata, "上映年度: %Y年%m月%d日")
                except:
                    try:
                        struct_time = time.strptime(startdata, "上映年度: %Y-%m-%d")
                    except:
                        try:
                            struct_time = time.strptime(startdata, "上映年度: %Y年")
                        except:
                            try:
                                struct_time = time.strptime(startdata, "上映年度: %Y")
                            except:
                                print("日期再次失败！！！！！！！！！！" + "startdata")
                                struct_time = time.strptime("2000-1-1", "%Y-%m-%d")
                startdata = str(struct_time.tm_year) + "-" + str(struct_time.tm_mon) + "-" + str(
                    struct_time.tm_mday)
            elif inname == "别名: ":
                continue
            elif inname == "发售日: ":
                continue
            else:
                infos = info.find_all("a")
                if len(infos) == 0:
                    # print(inname)
                    detailinfo += info.text + "\n"
                elif len(infos) == 1:
                    detailinfo += inname + info.find("a").string + "\n"
                else:
                    poes = info.find_all("a")
                    poeli = []
                    for poe in poes:
                        poeli.append(poe.string)
                    poestr = "、".join(poeli)
                    detailinfo += inname + poestr + "\n"
        # print(detailinfo)
        cover = "http:" + soup.find("a", class_="thickbox cover").get("href")
        introduction=""
        if len(soup.find_all("div", id="subject_summary")) == 0:
            pass
        else:
            introduction = soup.find_all("div", id="subject_summary")[0].text
        # print(cover)
        # print(introduction)
        cvs = soup.find_all("a", rel="v:starring")
        strcv = ""
        for cv in cvs:
            cha = cv.previous_sibling.previous_sibling.previous_sibling

            if cha.name == "span":
                cha = cha.string
            else:
                continue

            cvname = cv.string
            strcv += cha + ":" + cvname + "\n"
        # print(strcv)

        bangumiscore = soup.find("span", property="v:average").string

        sql1 = 'insert into bidscore(id,jp_name,ch_name,eg_name,B_score,week,cv,info,start_data,introduction,' \
               'cover,is_finish) values ({},"{}","{}","{}","{}","{}","{}","{}","{}","{}","{}","{}")'.format(id,
                                                                                                            janame,
                                                                                                            chname,
                                                                                                            egname,
                                                                                                            bangumiscore,
                                                                                                            week,
                                                                                                            strcv.replace(
                                                                                                                "\"", "\'"),
                                                                                                            detailinfo.replace(
                                                                                                                "\"", "\'"),
                                                                                                            startdata,
                                                                                                            introduction.replace(
                                                                                                                "\"", "\'"),
                                                                                                            cover,
                                                                                                            is_finish)
        print(sql1)
        cursor = db.cursor()
        cursor.execute(sql1)
        db.commit()
        epno = ""
        epname = ""

        eplist = soup.find("ul", class_="prg_list")
        eps = eplist.find_all("li")
        if len(eps) == 0:
            pass
        else:
            for ep in eps:

                if ep.get("class") == ['subtitle']:
                    continue
                else:
                    ep = ep.find("a")
                    if ep.get("class") == ['load-epinfo', 'epBtnNA']:
                        continue
                    else:
                        epname = ep.get("title")
                        epno = ep.string
                        sql = "insert into episode(id,no,title) value (%s,%s,%s)"
                        args = (id, epno, epname)
                        db.ping(reconnect=True)
                        cursor.execute(sql, args)
                        db.commit()
        id += 1
        print("已爬取到" + url)
        time.sleep(5)
        response.close()
    except:
        print("已报错")
        time.sleep(2)
        if cen>5:
            return
        getbagumiaaa(src,cen)

def getbagumi():
    global id, cursor
    for page in range(225, 254):
        for src in getdizhi(page):
                getbagumiaaa(src,0)
        print("已爬取第"+str(page)+"页")
        time.sleep(60)

getbagumi()
