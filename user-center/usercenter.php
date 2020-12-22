<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <script src="../js/jquery.js"></script>
    <!-- 引用部分@blueberry -->
    <script src="../js/main.js"></script>
    <!-- 引用部分@blueberry -->
    <!--    <link href="font/style.css" rel="stylesheet"/>-->
    <meta charset="UTF-8" name="referrer" content="never">
    <title><?php
        echo "我的名字"
        ?>的个人中心-Mirai</title>

    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">

    <link href="css/usercenter.css" rel="stylesheet"/>

    <style>
        body {
            background: url("../image/background.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
        }
    </style>

</head>
<body>
<?php include "../header.php" ?>
<!--<div style="height: 50px"></div>-->

<div class="all">
    <div class="top">
        <div class="banner">
            <div style="height: 200px"></div>
            <div class="banner_filter">
                <div class="info">
                    <div class="avatar">
                        <a href="#">
                            <img src="../image/akari.jpg" alt="">
                        </a>
                    </div>
                    <div class="user">
                        <div class="user_name">
                            用户名
                        </div>
                        <div class="user_introduction">
                            用户个人简介
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab_nav">
        <ul class="clearfix">
            <li onclick="changeTab(this)" class="on">时间线</li>
            <li onclick="changeTab(this)">收藏</li>
            <li onclick="changeTab(this)">消息</li>
            <li onclick="changeTab(this)">设置</li>
        </ul>
    </div>

    <div class="tab_de">
        <div class="time_line">
            <div class="left">
                <div class="timeline_tab_nav">
                    <ul>
                        <li onclick="changeTab_timeline(this)" class="on">全部</li>
                        <li onclick="changeTab_timeline(this)">评分</li>
                        <li onclick="changeTab_timeline(this)">收藏</li>
                    </ul>
                </div>
                <div class="timeline_tab_de">
                    <div class="timeline_all">

                        <!--需要动态插入-->
                        <div class="timeline_time">
                            2020-12-21
                        </div>

                        <div class="timeline_content">
                            <p id="main">123123123</p>
                            <p id="other">2天3小时前</p>
                        </div>

                        <div class="timeline_time">
                            2020-12-21
                        </div>

                        <div class="timeline_content">
                            <p id="main">123123123</p>
                            <p id="other">2天3小时前</p>
                        </div>
                        <!--需要动态插入-->

                    </div>

                    <div class="timeline_rating">
                        2
                    </div>

                    <div class="timeline_favorite">
                        3
                    </div>
                </div>

            </div>

            <div class="right">
                <div class="right_in">
                    <!--                    要显示邮箱 登录名 *性别 *个人简介 注册日期 -->

                    <!--需要动态插入-->
                    <p>用户名：Blueberry</p>
                    <p>邮箱：775486682@qq.com</p>
                    <p>性别：男</p>
                    <p>个人简介：这里是个人简介芜湖起飞飞飞飞飞飞飞飞飞飞飞飞飞飞飞飞飞飞飞</p>
                    <p>注册日期：2020-12-21</p>
                    <!--需要动态插入-->

                </div>
            </div>
        </div>

        <div class="favorite">
            <div class="left">
                <div class="favorite_top">
                    <h3>我的收藏</h3>
                </div>
                <div class="favorite_middle">

                    <!--需要动态插入-->
                    <div class="animate">
                        <div class="animate_img">
                            <a href="#">
                                <img src="../image/default_animate.png" alt="">
                            </a>
                        </div>
                        <div class="animate_text">
                            <a href="#">
                                要显示的动漫名字
                            </a>
                        </div>
                    </div>
                    <!--需要动态插入-->

                </div>

                <div class="favorite_bottom">

                </div>

            </div>
            <div class="right">

            </div>
        </div>

        <div class="message">
            <div class="left">
                <div class="message_tab_nav">
                    <ul>
                        <li onclick="changeTab_message(this)" class="on">我的消息</li>
                        <li onclick="changeTab_message(this)">系统消息</li>
                    </ul>
                </div>
                <div class="message_tab_de">
                    <div class="message_my">
                        <!--需要动态插入-->
                        <div class="message_time">
                            2020-12-21
                        </div>

                        <div class="message_content">
                            <p id="main">123123123</p>
                            <p id="other">2天3小时前</p>
                        </div>

                        <div class="message_time">
                            2020-12-21
                        </div>

                        <div class="message_content">
                            <p id="main">123123123</p>
                            <p id="other">2天3小时前</p>
                        </div>
                        <!--需要动态插入-->
                    </div>
                    <div class="message_system">

                    </div>
                </div>

            </div>
            <div class="right">

            </div>
        </div>

        <div class="setting">
            <div class="left">
                <div class="setting_left">

                </div>
                <div class="setting_right">
                    <form method="post" class="form">
                        <div class="settings" id="name">
                            <div class="settings_left">
                                昵称：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <input type="text" value="我的姓名" name="name">
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="sex">
                            <div class="settings_left">
                                性别：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <label>
                                        <input type="radio" name="sex" value="男">男
                                    </label>
                                    <label>
                                        <input type="radio" name="sex" value="女">女
                                    </label>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="introduction">
                            <div class="settings_left">
                                个人简介：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <textarea rows="5" cols="40" name="introduction" placeholder="这个人很懒，什么都没有写..."></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="avatar">
                            <div class="settings_left">
                                头像：
                            </div>
                            <div class="settings_right">
                                <label class="upload_img">
                                <span role="button">
                                    <input type="file" accept style="display: none" alt="">
                                    <img src="../image/akari.jpg" alt="avatar" style="max-height: 100%;max-width: 100%">
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="background">
                            <div class="settings_left">
                                背景图片：
                            </div>
                            <div class="settings_right">
                                <label class="upload_background">
                                <span role="button">
                                    <input type="file" accept style="display: none" alt="">
                                    <img src="../image/new_banner1.png" alt="background"
                                         style="max-height: 100%;max-width: 100%">
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="is_timeline">
                            <div class="settings_left">
                                是否允许他人查看我的时间线：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <label>
                                        <input type="radio" name="is_timeline" value="是">
                                        是
                                    </label>
                                    <label>
                                        <input type="radio" name="is_timeline" value="否">
                                        否
                                    </label>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="is_favorite">
                            <div class="settings_left">
                                是否允许他人查看我的收藏：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <label>
                                        <input type="radio" name="is_favorite" value="是">
                                        是
                                    </label>
                                    <label>
                                        <input type="radio" name="is_favorite" value="否">
                                        否
                                    </label>
                                </label>
                            </div>
                        </div>
                        <div class="setting_submit">
                            <span>
                                <button type="submit">
                                    提交
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="right">

            </div>
        </div>

    </div>


</div>

</body>

<script>
    //切换页面的函数
    function changeTab(tab) {
        var tabs = document.getElementsByClassName('tab_nav')[0].getElementsByTagName("li");
        var contents = document.querySelectorAll(".tab_de>div");
        for (var i = 0, len = tabs.length; i < len; i++) {
            if (tabs[i] === tab) {
                tabs[i].className = 'on';
                contents[i].style.display = 'grid';
            } else {
                tabs[i].className = '';
                contents[i].style.display = 'none';
            }
        }
    }

    function changeTab_timeline(tab) {
        var tabs = document.getElementsByClassName('timeline_tab_nav')[0].getElementsByTagName("li");
        var contents = document.querySelectorAll(".timeline_tab_de>div");
        for (var i = 0, len = tabs.length; i < len; i++) {
            if (tabs[i] === tab) {
                tabs[i].className = 'on';
                contents[i].style.display = 'grid';
            } else {
                tabs[i].className = '';
                contents[i].style.display = 'none';
            }
        }
    }

    function changeTab_message(tab) {
        var tabs = document.getElementsByClassName('message_tab_nav')[0].getElementsByTagName("li");
        var contents = document.querySelectorAll(".message_tab_de>div");
        for (var i = 0, len = tabs.length; i < len; i++) {
            if (tabs[i] === tab) {
                tabs[i].className = 'on';
                contents[i].style.display = 'grid';
            } else {
                tabs[i].className = '';
                contents[i].style.display = 'none';
            }
        }
    }
</script>


</html>