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

def get_rank(db):
    rank = 1
    rating = db + "_rating"
    ranking = db + "_rank"
    sql2 = "select * from animate where {}!='0' order by {} desc ".format(rating,rating)
    # args = (rating, rating)
    cursor_b.execute(sql2)
    items_b = cursor_b.fetchall()
    for item_b in items_b:
        animate_id = item_b['animate_id']
        # title = item_b["title"]
        # print(item_b)
        sql1 = "update animate set {}='{}' where animate_id='{}'".format(ranking, rank, animate_id)
        cursor_m.execute(sql1)
        db2.commit()
        rank += 1
        print("-----------------已插入" + str(rank) + "条-----------------")


if __name__ == '__main__':
    get_rank('anikore')

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
