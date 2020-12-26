import pymysql
from fuzzywuzzy import process
from pymysql.cursors import DictCursor

db = pymysql.connect("localhost", "root", "", "miraihyoka")

cursor_mal = db.cursor(DictCursor)
cursor_anidb = db.cursor(DictCursor)
cursor = db.cursor()

mal_sql = "select * from mal"
anidb_sql = "select * from anidb"

cursor_mal.execute(mal_sql)
cursor_anidb.execute(anidb_sql)

items_mal = cursor_mal.fetchall()
items_anidb = cursor_anidb.fetchall()

anidb_list = []
anidb_jp_list = []
anidb_rate = []
for item_anidb in items_anidb:
    anidb_list.append(item_anidb['name_en'])
    anidb_rate.append(item_anidb['rate'])
    anidb_jp_list.append(item_anidb['name_jp'])

i = 0
for item_mal in items_mal:
    i += 1
    name_en = item_mal['name_en']
    name_jp = item_mal['name_jp']
    mal_score = item_mal['rate']
    en_id=item_mal['id']
    if name_en is None:
        print("日文：" + name_jp)
        result = process.extractOne(name_jp, anidb_jp_list, score_cutoff=90)
        if result is None:
            anidb_score=0
        else:
            anidb_score = anidb_rate[anidb_jp_list.index(result[0])]
    else:
        print("英文：" + name_en)
        result = process.extractOne(name_en, anidb_list, score_cutoff=95)
        if result is None:
            print("英文匹配失败，即将匹配日文")
            result = process.extractOne(name_jp, anidb_jp_list, score_cutoff=90)
            if result is None:
                anidb_score = 0
            else:
                anidb_score = anidb_rate[anidb_jp_list.index(result[0])]
        else:
            anidb_score = anidb_rate[anidb_list.index(result[0])]

    print(result)

    sql = "update en_db set anidb_rating=%s where en_id=%s"
    args = (anidb_score, en_id)
    db.ping(reconnect=True)
    cursor.execute(sql, args)
    db.commit()
    print("-----------------已插入" + str(i) + "条-----------------")

db.close()
