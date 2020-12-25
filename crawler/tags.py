import time
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



def up(name_en,name_jp,name_ch,bangumi_id,nm):

    result = process.extractOne(name_ch, douban_list, score_cutoff=95)
    if result is None:

        result = process.extractOne(name_en, douban_list, score_cutoff=90)
        if result is None:


            result = process.extractOne(name_jp, douban_list, score_cutoff=90)
            if result is None:

                result = process.extractOne(name_en, douban_list, score_cutoff=80)
                if result is None:
                    doubanid=0
                else:

                    doubanid=douban_id[douban_list.index(result[0])]

            else:

                doubanid = douban_id[douban_list.index(result[0])]
        else:

            doubanid = douban_id[douban_list.index(result[0])]
    else:
        doubanid = douban_id[douban_list.index(result[0])]




    sql = "update tags set id=%s where doubanid=%s"
    args = (bangumi_id, doubanid)
    db.ping(reconnect=True)
    cursor.execute(sql, args)
    db.commit()
    print("-----------------已插入" + str(nm) + "条-----------------")


if __name__ == '__main__':
    n=0
    for item_bangumi in items_bangumi:
        n +=1
        name_en = item_bangumi['eg_name']
        name_jp = item_bangumi['jp_name']
        name_ch = item_bangumi['ch_name']
        bangumi_id = item_bangumi['id']

        p = Process(target=up, args=(name_en,name_jp,name_ch,bangumi_id,n))

        p.start()
        time.sleep(0.5)
        # match(anikore_name_jp, anikore_score, anikore_src, animate_id)

    print("已完成！！！！！！！！！！！！！")





    db.close()
