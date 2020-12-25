import time
import pymysql
import multiprocessing

from pymysql.cursors import DictCursor
from multiprocessing import Process, Pool

db1 = pymysql.connect("localhost", "root", "", "bidscore")
db2 = pymysql.connect("localhost", "root", "", "miraihyoka")

cursor_b = db1.cursor(DictCursor)
cursor_m = db2.cursor(DictCursor)


def getbangumiid(animate_id, bangumi_id, m):
    sql2 = "select * from bidscore.episode where id=" + bangumi_id
    cursor_b.execute(sql2)
    items_b = cursor_b.fetchall()
    for item_b in items_b:
        no = item_b["no"]
        title=item_b["title"]
        sql1 = "insert into miraihyoka.episode(animate_id, name,no) value (%s,%s,%s)"
        args = (animate_id, title,no)
        cursor_m.execute(sql1, args)
        db2.commit()
    print("-----------------已插入" + str(m) + "条-----------------")


if __name__ == '__main__':
    sql1 = "select * from animate"
    db2.ping(reconnect=True)
    cursor_m.execute(sql1)
    items_m = cursor_m.fetchall()
    nnn = 0
    aa=Pool(30)
    for item_m in items_m:
        an = item_m["animate_id"]
        bid = item_m["bangumi_idid"]
        if bid is not None:
            nnn += 1
            aa.apply_async(getbangumiid, args=(an, bid, nnn))
            # p = Process(target=getbangumiid, args=(an, bid, nnn))
            # p.start()
    aa.close()
    aa.join()

    

