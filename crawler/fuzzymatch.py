import pymysql
from fuzzywuzzy import process
from pymysql.cursors import DictCursor

db = pymysql.connect("localhost", "root", "", "miraihyoka")

cursor_mal = db.cursor(DictCursor)
cursor_ann = db.cursor(DictCursor)
cursor = db.cursor()

mal_sql = "select * from mal"
ann_sql = "select * from ann"

cursor_mal.execute(mal_sql)
cursor_ann.execute(ann_sql)

items_mal = cursor_mal.fetchall()
items_ann = cursor_ann.fetchall()

ann_list = []
ann_jp_list = []
ann_rate = []
for item_ann in items_ann:
    ann_list.append(item_ann['name_en'])
    ann_rate.append(item_ann['rate'])
    ann_jp_list.append(item_ann['name_jp'])

i = 0
for item_mal in items_mal:
    i += 1
    name_en = item_mal['name_en']
    name_jp = item_mal['name_jp']
    mal_score = item_mal['rate']
    if name_en is None:
        print("日文：" + name_jp)
        result = process.extractOne(name_jp, ann_jp_list, score_cutoff=90)
        if result is None:
            ann_score=0
        else:
            ann_score = ann_rate[ann_jp_list.index(result[0])]
    else:
        print("英文：" + name_en)
        result = process.extractOne(name_en, ann_list, score_cutoff=95)
        if result is None:
            print("英文匹配失败，即将匹配日文")
            result = process.extractOne(name_jp, ann_jp_list, score_cutoff=90)
            if result is None:
                ann_score = 0
            else:
                ann_score = ann_rate[ann_jp_list.index(result[0])]
        else:
            ann_score = ann_rate[ann_list.index(result[0])]

    print(result)

    sql = "insert into en_db(name_en,name_jp,mal_rating,ann_rating,member) value (%s,%s,%s,%s,%s)"
    args = (name_en, name_jp, mal_score, ann_score, item_mal['members'])
    db.ping(reconnect=True)
    cursor.execute(sql, args)
    db.commit()
    print("-----------------已插入" + str(i) + "条-----------------")

db.close()
