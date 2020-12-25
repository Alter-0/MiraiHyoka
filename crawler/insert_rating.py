import time
import pymysql
import mysql.connector
import multiprocessing

from pymysql.cursors import DictCursor
from multiprocessing import Process, Pool

db1 = pymysql.connect("localhost", "root", "", "miraihyoka")
db2 = pymysql.connect("localhost", "root", "", "miraihyoka")

cursor_b = db1.cursor(DictCursor)
cursor_m = db2.cursor(DictCursor)


# 7个评分
# mal_rating anidb_rating ann_rating anikore_rating bangumi_rating imdb_rating douban_rating

def get_rating():
    i = 1
    sql2 = "select * from animate "
    # args = (rating, rating)
    cursor_b.execute(sql2)
    items_b = cursor_b.fetchall()
    for item_b in items_b:
        animate_id = item_b['animate_id']

        # 各个网站的权重
        mal_p = 50
        anidb_p = 30
        ann_p = 30

        anikore_p = 100

        bangumi_p = 60
        douban_p = 40
        imdb_p = 30

        mal_rating = item_b['mal_rating']
        anidb_rating = item_b['anidb_rating']
        ann_rating = item_b['ann_rating']

        anikore_rating = item_b['anikore_rating']

        bangumi_rating = item_b['bangumi_rating']
        imdb_rating = item_b['imdb_rating']
        douban_rating = item_b['douban_rating']

        anikore_rating /= 10

        if mal_rating == 0:
            mal_p = 0
        if anidb_rating == 0:
            anidb_p = 0
        if anidb_rating is None:
            anidb_rating=0
        if ann_rating == 0:
            ann_p = 0
        if anikore_rating == 0:
            anikore_p = 0
        if bangumi_rating == 0:
            bangumi_p = 0
        if imdb_rating == 0:
            imdb_p = 0
        if douban_rating == 0:
            douban_p = 0

        rating = (
                         mal_rating * mal_p + anidb_rating * anidb_p + ann_rating * ann_p + anikore_rating * anikore_p + bangumi_rating * bangumi_p + imdb_rating * imdb_p + douban_rating * douban_p) / (
                         mal_p + anidb_p + ann_p + anikore_p + bangumi_p + douban_p + imdb_p)

        sql1 = "update animate set media_rating='{}' where animate_id='{}'".format(rating, animate_id)
        cursor_m.execute(sql1)
        db2.commit()
        print("-----------------已插入" + str(i) + "条-----------------")
        i += 1


if __name__ == '__main__':
    get_rating()

    # sql1 = "select * from animate"
    # db2.ping(reconnect=True)
    # cursor_m.execute(sql1)
    # items_m = cursor_m.fetchall()
    # nnn = 0
    # aa = Pool(30)
    # for item_m in items_m:
    #     an = item_m["animate_id"]
    #     bid = item_m["bangumi_idid"]
    #     if bid is not None:
    #         nnn += 1
    #         aa.apply_async(get_rank, args=(an, bid, nnn))
    #         # p = Process(target=getbangumiid, args=(an, bid, nnn))
    #         # p.start()
    # aa.close()
    # aa.join()
