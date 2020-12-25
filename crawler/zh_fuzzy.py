import pymysql
from fuzzywuzzy import process
from pymysql.cursors import DictCursor
from multiprocessing import Process
db = pymysql.connect("localhost", "root", "", "bidscore")

cursor_bangumi = db.cursor(DictCursor)
cursor_douban = db.cursor(DictCursor)
cursor = db.cursor()

bangumi_sql = "select * from bidscore"
douban_sql = "select * from douban"

cursor_bangumi.execute(bangumi_sql)
cursor_douban.execute(douban_sql)

items_bangumi = cursor_bangumi.fetchall()
items_douban = cursor_douban.fetchall()

douban_id=[]
douban_list = []
douban_rate = []
douban_diqu=[]
imdb_rate=[]
for item_douban in items_douban:
    douban_id.append(item_douban['doubanid'])
    douban_list.append(item_douban['douname'])
    douban_rate.append(item_douban['doubanscore'])
    douban_diqu.append(item_douban['diqu'])
    imdb_rate.append(item_douban['imdbscore'])

i = 0
for item_bangumi in items_bangumi:
    i += 1
    name_en = item_bangumi['eg_name']
    name_jp = item_bangumi['jp_name']
    name_ch = item_bangumi['ch_name']
    bangumi_id=item_bangumi['id']
    print("中文：" + name_ch)
    result = process.extractOne(name_ch, douban_list, score_cutoff=95)
    if result is None:
        print("中文匹配失败，即将匹配英文")
        result = process.extractOne(name_en, douban_list, score_cutoff=90)
        if result is None:
            print("英文匹配失败，即将匹配日文")

            result = process.extractOne(name_jp, douban_list, score_cutoff=90)
            if result is None:
                print("日文匹配失败，即将强制匹配中文")
                result = process.extractOne(name_en, douban_list, score_cutoff=80)
                if result is None:
                    douban_score = 0
                    imdb_score = 0
                    area = "暂无"
                else:
                    douban_score = douban_rate[douban_list.index(result[0])]
                    imdb_score = imdb_rate[douban_list.index(result[0])]
                    area = douban_diqu[douban_list.index(result[0])]

            else:
                douban_score = douban_rate[douban_list.index(result[0])]
                imdb_score = imdb_rate[douban_list.index(result[0])]
                area = douban_diqu[douban_list.index(result[0])]
        else:
            douban_score = douban_rate[douban_list.index(result[0])]
            imdb_score = imdb_rate[douban_list.index(result[0])]
            area = douban_diqu[douban_list.index(result[0])]
    else:
        douban_score = douban_rate[douban_list.index(result[0])]
        imdb_score = imdb_rate[douban_list.index(result[0])]
        area = douban_diqu[douban_list.index(result[0])]

    print(result)

    print(douban_score, imdb_score, area, bangumi_id)

    sql = "update bidscore set D_score=%s,I_score=%s,area=%s where id=%s"
    args = (douban_score, imdb_score, area, bangumi_id)
    db.ping(reconnect=True)
    cursor.execute(sql, args)
    db.commit()
    print("-----------------已插入" + str(i) + "条-----------------")

db.close()
