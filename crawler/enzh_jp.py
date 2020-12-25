import time

import pymysql
from fuzzywuzzy import process
from pymysql.cursors import DictCursor

from multiprocessing import Process

n = 1
animate_id = 100000

db1 = pymysql.connect("localhost", "root", "", "bidscore")
db2 = pymysql.connect("localhost", "root", "", "miraihyoka")

cursor_en = db1.cursor(DictCursor)
cursor_zh = db1.cursor(DictCursor)
cursor_anikore = db1.cursor(DictCursor)

cursor = db2.cursor()

sql_en = "select * from en_db"
sql_zh = "select * from bidscore"
sql_anikore = "select * from anikore"

cursor_en.execute(sql_en)
cursor_zh.execute(sql_zh)
cursor_anikore.execute(sql_anikore)

items_en = cursor_en.fetchall()
items_zh = cursor_zh.fetchall()
items_anikore = cursor_anikore.fetchall()

zh_name_jp = []
zh_name_en = []
zh_name_zh = []
zh_score_douban = []
zh_score_imdb = []
zh_score_bangumi = []
zh_id = []
zh_starttime = []
zh_introduction = []
zh_area = []
zh_week = []
zh_cover = []
zh_cv = []
zh_info = []
zh_isfinish = []

for item_zh in items_zh:
    zh_name_jp.append(item_zh["jp_name"])
    zh_name_en.append(item_zh["eg_name"])
    zh_name_zh.append(item_zh["ch_name"])
    zh_score_douban.append(item_zh["D_score"])
    zh_score_imdb.append(item_zh["I_score"])
    zh_score_bangumi.append(item_zh["B_score"])
    zh_id.append(item_zh["id"])
    zh_starttime.append(item_zh["start_data"])
    zh_introduction.append(item_zh["introduction"])
    zh_area.append(item_zh["area"])
    zh_week.append(item_zh["week"])
    zh_cover.append(item_zh["cover"])
    zh_cv.append(item_zh["cv"])
    zh_info.append(item_zh["info"])
    zh_isfinish.append(item_zh["is_finish"])

en_id = []
en_name_en = []
en_name_jp = []
en_score_mal = []
en_score_ann = []
en_score_anidb = []
en_member = []

for item_en in items_en:
    en_id.append(item_en["en_id"])
    en_name_en.append(item_en["name_en"])
    en_name_jp.append(item_en["name_jp"])
    en_score_mal.append(item_en["mal_rating"])
    en_score_ann.append(item_en["ann_rating"])
    en_score_anidb.append(item_en["anidb_rating"])
    en_member.append(item_en["member"])


def match(anikore_name_jp, anikore_score, anikore_src, animate_id):
    # print("日文：" + anikore_name_jp)
    result = process.extractOne(anikore_name_jp, en_name_jp, score_cutoff=95)
    if result is None:
        result = process.extractOne(anikore_name_jp, en_name_en, score_cutoff=90)
        if result is None:
            result = process.extractOne(anikore_name_jp, en_name_jp)
            if result is None:


                en_name = "暂无"
                mal_score = 0
                ann_score = 0
                anidb_score = 0
                member = 0

            else:

                en_name = en_name_en[en_name_jp.index(result[0])]
                mal_score = en_score_mal[en_name_jp.index(result[0])]
                ann_score = en_score_ann[en_name_jp.index(result[0])]
                anidb_score = en_score_anidb[en_name_jp.index(result[0])]
                member = en_member[en_name_jp.index(result[0])]

        else:
            en_name = en_name_en[en_name_en.index(result[0])]
            mal_score = en_score_mal[en_name_en.index(result[0])]
            ann_score = en_score_ann[en_name_en.index(result[0])]
            anidb_score = en_score_anidb[en_name_en.index(result[0])]
            member = en_member[en_name_en.index(result[0])]

    else:
        en_name = en_name_en[en_name_jp.index(result[0])]
        mal_score = en_score_mal[en_name_jp.index(result[0])]
        ann_score = en_score_ann[en_name_jp.index(result[0])]
        anidb_score = en_score_anidb[en_name_jp.index(result[0])]
        member = en_member[en_name_jp.index(result[0])]

    # print(result)

    sql = "insert into animate(animate_id,name_jp,name_en,mal_rating,ann_rating,anidb_rating,anikore_rating,member) value (" \
          "%s,%s,%s,%s,%s,%s,%s,%s) "
    args = (animate_id, anikore_name_jp, en_name, mal_score, ann_score, anidb_score, anikore_score, member)
    db2.ping(reconnect=True)
    cursor.execute(sql, args)
    db2.commit()

    result = process.extractOne(anikore_name_jp, zh_name_jp, score_cutoff=95)
    if result is None:
        result = process.extractOne(anikore_name_jp, zh_name_en, score_cutoff=90)
        if result is None:
            result = process.extractOne(anikore_name_jp, zh_name_jp, score_cutoff=80)
            if result is None:
                cn_name = "暂无"
                douban_score = 0
                imdb_score = 0
                bangumi_score = 0
                bangumi_id = 0
                startting = "暂无"
                introduction = "暂无"
                area = "暂无"
                week = "暂无"
                cover = "https://bangumi.tv/img/no_icon_subject.png"
                cv = "暂无"
                info = "暂无"
                isfinish = 1
            else:
                cn_name = zh_name_zh[zh_name_jp.index(result[0])]
                douban_score = zh_score_douban[zh_name_jp.index(result[0])]
                imdb_score = zh_score_imdb[zh_name_jp.index(result[0])]
                bangumi_score = zh_score_bangumi[zh_name_jp.index(result[0])]
                bangumi_id = zh_id[zh_name_jp.index(result[0])]
                startting = zh_starttime[zh_name_jp.index(result[0])]
                introduction = zh_introduction[zh_name_jp.index(result[0])]
                area = zh_area[zh_name_jp.index(result[0])]
                week = zh_week[zh_name_jp.index(result[0])]
                cover = zh_cover[zh_name_jp.index(result[0])]
                cv = zh_cv[zh_name_jp.index(result[0])]
                info = zh_info[zh_name_jp.index(result[0])]
                isfinish = zh_isfinish[zh_name_jp.index(result[0])]


        else:
            cn_name = zh_name_zh[zh_name_en.index(result[0])]
            douban_score = zh_score_douban[zh_name_en.index(result[0])]
            imdb_score = zh_score_imdb[zh_name_en.index(result[0])]
            bangumi_score = zh_score_bangumi[zh_name_en.index(result[0])]
            bangumi_id = zh_id[zh_name_en.index(result[0])]
            startting = zh_starttime[zh_name_en.index(result[0])]
            introduction = zh_introduction[zh_name_en.index(result[0])]
            area = zh_area[zh_name_en.index(result[0])]
            week = zh_week[zh_name_en.index(result[0])]
            cover = zh_cover[zh_name_en.index(result[0])]
            cv = zh_cv[zh_name_en.index(result[0])]
            info = zh_info[zh_name_en.index(result[0])]
            isfinish = zh_isfinish[zh_name_en.index(result[0])]



    else:
        cn_name = zh_name_zh[zh_name_jp.index(result[0])]
        douban_score = zh_score_douban[zh_name_jp.index(result[0])]
        imdb_score = zh_score_imdb[zh_name_jp.index(result[0])]
        bangumi_score = zh_score_bangumi[zh_name_jp.index(result[0])]
        bangumi_id = zh_id[zh_name_jp.index(result[0])]
        startting = zh_starttime[zh_name_jp.index(result[0])]
        introduction = zh_introduction[zh_name_jp.index(result[0])]
        area = zh_area[zh_name_jp.index(result[0])]
        week = zh_week[zh_name_jp.index(result[0])]
        cover = zh_cover[zh_name_jp.index(result[0])]
        cv = zh_cv[zh_name_jp.index(result[0])]
        info = zh_info[zh_name_jp.index(result[0])]
        isfinish = zh_isfinish[zh_name_jp.index(result[0])]

    # sql = 'update animate set  name_cn="{}",area="{}",introduction="{}",douban_rating={},imdb_rating={},bangumi_rating={},' \
    #       'start_time="{}",info="{}",cv="{}",cover="{}",week="{}",is_finish={},bangumi_idid={},anikore_url="{}"  where animate_id={}'.format(
    #     cn_name, area, introduction, douban_score,
    #     imdb_score, bangumi_score, startting, info,
    #     cv, cover, week, isfinish, bangumi_id, anikore_src, animate_id)
    # db2.ping(reconnect=True)
    # cursor.execute(sql)
    # db2.commit()
    sql="update animate set  name_cn=%s,area=%s,introduction=%s,douban_rating=%s,imdb_rating=%s,bangumi_rating=%s where animate_id=%s"
    args=(cn_name, area, introduction, douban_score,imdb_score, bangumi_score,animate_id)
    db2.ping(reconnect=True)
    cursor.execute(sql,args)
    db2.commit()

    sql="update animate set  start_time=%s,info=%s,cv=%s,cover=%s,week=%s,is_finish=%s,bangumi_idid=%s,anikore_url=%s where animate_id=%s"
    args=(startting, info,cv, cover, week, isfinish, bangumi_id, anikore_src,animate_id)
    db2.ping(reconnect=True)
    cursor.execute(sql,args)
    db2.commit()

    print("-----------------已插入" + str(animate_id - 100000) + "条-----------------")


if __name__ == '__main__':
    for item_anikore in items_anikore:
        anikore_name_jp = item_anikore["jpname"]
        anikore_score = item_anikore["score"]
        anikore_src = item_anikore["src"]
        animate_id += 1
        p = Process(target=match, args=(anikore_name_jp,anikore_score,anikore_src,animate_id))

        p.start()
        time.sleep(0.5)
        # match(anikore_name_jp, anikore_score, anikore_src, animate_id)

    print("已完成！！！！！！！！！！！！！")
