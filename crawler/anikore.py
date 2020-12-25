
from selenium import webdriver

import time
import pymysql


id=301677
option = webdriver.ChromeOptions()
option.add_argument("--user-data-dir="+r"C:/Users/alter/AppData/Local/Google/Chrome/User Data/")
# option.add_argument("--proxy-server=http://127.0.0.1:7890")
driver = webdriver.Chrome(options=option)
driver.implicitly_wait(20)
driver.get("https://www.anikore.jp/pop_ranking/page:68")
# try:
#     element = WebDriverWait(driver, 10,0.5).until(
#         EC.presence_of_element_located((By.CLASS_NAME, "l-header_loginIcon"))
#
#     )
# finally:
#     driver.quit()
# driver.find_element_by_class_name("l-header_loginIcon").find_element_by_tag_name("a").click()

# UserEmail
# UserOriginalPassword
# login_btn


# driver.find_element_by_id("UserEmail").send_keys("0gaibian0@gmail.com")
# driver.find_element_by_id("UserOriginalPassword").send_keys("FqX7GWXg8S6H7Qn")
# time.sleep(1)
# driver.find_element_by_id("login_btn").click()
# time.sleep(1)
# driver.find_element_by_class_name("gnav_pop").click()
# /html/body/section[4]/div/div[2]/div[3]/h2/a/span[1]
# /html/body/section[4]/div/div[2]/div[4]/h2/a/span[1]
# /html/body/section[4]/div/div[2]/div[5]/h2/a/span[1]
# /html/body/section[4]/div/div[2]/div[6]/h2/a/span[1]
# /html/body/section[4]/div/div[2]/div[27]/h2/a/span[1]

# /html/body/section[4]/div/div[2]/div[3]/h2/a/span[1]
# /html/body/section[4]/div/div[2]/div[27]/h2/a/span[1]

# /html/body/section[4]/div/div[2]/div[3]/h2/a/span[3]
# /html/body/section[4]/div/div[2]/div[3]/h2/a
db = pymysql.connect("localhost", "root", "", "bidscore")
cursor = db.cursor()

def updata(item):
    global id
    score=driver.find_element_by_xpath("/html/body/section[4]/div/div[2]/div[{}]/h2/a/span[1]".format(item)).text
    print(score)
    name=driver.find_element_by_xpath("/html/body/section[4]/div/div[2]/div[{}]/h2/a/span[3]".format(item)).text
    name=str(name).split("（",1)
    name=name[0]
    print(name)
    src=driver.find_element_by_xpath("/html/body/section[4]/div/div[2]/div[{}]/h2/a".format(item)).get_attribute("href")
    print(src)
    sql1 = "insert into anikore(jpname,score,src,anikore_id) values (%s,%s,%s,%s)"
    args = (name, score, src, id)
    # db.ping(reconnect=True)
    cursor.execute(sql1, args)
    db.commit()
    id+=1
    print("成功爬取"+str(id))

def start():
    for item in range(3,28):
        updata(item)
    time.sleep(2)
    driver.find_element_by_xpath("/html/body/section[5]/span[11]/a").click()

while(id>=106414):
    start()

# time.sleep(1000)
# /html/body/section[5]/span[11]/a
# /html/body/section[5]/span[11]/a