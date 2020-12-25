import langid
import pymysql
from langdetect import detect
from langdetect import DetectorFactory
from pymysql.cursors import DictCursor
db = pymysql.connect("localhost", "root", "", "bidscore")
DetectorFactory.seed = 0
cursor = db.cursor(DictCursor)

sql="select * from bidscore where ch_name=''"
cursor.execute(sql)
no_cn_items = cursor.fetchall()

for item in no_cn_items:
    # print(item["eg_name"])
    # awa=detect(item["eg_name"])
    # print(awa)

    sql="update bidscore set ch_name=%s where id=%s"
    args = (item["jp_name"],item["id"])
    cursor.execute(sql, args)
    db.commit()




