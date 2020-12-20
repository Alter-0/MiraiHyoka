<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <script src="../js/jquery.js"></script>
    <!-- 引用部分@blueberry -->
    <script src="../js/main.js"></script>
    <!-- 引用部分@blueberry -->

    <meta charset="UTF-8" name="referrer" content="never">
    <title><?php
        echo "番名"
        ?>_番剧点评_MiraiHyoka</title>
    <style>
        .header {
            width: 100%;
            height: 50px;
            position: relative;
            z-index: 1000;

        }

        .all {
            min-height: 100%;
            flex: 1;
            margin-bottom: -165px;
        }

        .top {
            width: 100%;
            height: 440px;
            text-align: center;
            box-sizing: border-box;
            border-radius: 0px;
            position: relative;
            top: -55px;
            overflow: hidden;

        }

        .top #bg {
            margin: -30px 0px -30px -100px;
            width: 120%;
            height: 500px;
            display: block;
            overflow: hidden;
            -webkit-filter: blur(20px) brightness(50%);
            -moz-filter: blur(20px);
            -ms-filter: blur(20px);
            -o-filter: blur(20px);
            filter: blur(20px) brightness(50%);

            object-fit: cover;
            text-align: center;
            vertical-align: middle;
            z-index: -1;
            position: absolute;
            top: 0px;
        }

        .top {
            z-index: 1;
        }

        .top .text {
            z-index: 1;
            vertical-align: center;
        }

        .top .nei {
            vertical-align: center;
            width: 80%;
            height: 390px;
            margin: 0 auto;
            display: table;
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translate(-50%, 0%);
        }

        .fjimg {
            width: 280px;
            height: 390px;
            float: left;
        }

        .top .nei #fj {
            margin: 25px 0px;
            width: 255px;
            border: 5px solid #ffffff;
            border-radius: 5px;
            float: left;
            z-index: 1;
        }

        .title {
            text-align: left;
            min-width: 1000px;
            float: left;
            position: absolute;
            top: 25px;
            left: 280px;
            display: inline;
            width: border-box;
            overflow: hidden;
            margin: 0 0 5px 20px;
        }

        .title .title_name {
            color: #ffffff;
            font-size: 22px;
            overflow: hidden;
            line-height: 25px;
            text-overflow: ellipsis;
            font-weight: 700;
        }

        .title .title_tags {
            margin: 0 0 0 20px;
        }

        .title_tag {
            width: 1000px;
            font-size: 12px;
            vertical-align: middle;
            margin-right: 10px;
            height: 20px;
            padding: 0 4px;
            line-height: 20px;
            color: #ffffff;
            border: 1px solid #ffffff;
            border-radius: 3px;
        }

        .title_tag:hover {

            color: #088bcf;
            border: 1px solid #088bcf;
        }

        .data {
            float: left;
            position: absolute;
            top: 80px;
            left: 290px;
        }

        .count {
            display: inline-block;
        }

        .count * {
            color: #ffffff;
            font-size: 14px;

        }

        .count .plays {

            padding-right: 20px;            max-width: 76px;
            width: 76px;
            text-indent: 0;
            border-right: 1px solid #ffffff;
            display: block;
            float: left;
        }

        .count .plays span {
            line-height: 12px;

        }

        .count .plays em {
            width: 76px;
            padding-top: 15px;
            line-height: 17px;
            font-style: normal;
            font-weight: 700;


        }

        .count .likes {
            max-width: 76px;
            width: 76px;
            text-indent: 0;

            display: block;
            float: left;
            margin-left: 20px;
        }

        .count .likes span {
            line-height: 12px;
        }

        .count .likes em {
            width: 76px;
            padding-top: 15px;
            line-height: 17px;
            font-style: normal;
            font-weight: 700;
        }

        .time {
            float: left;
            position: absolute;
            display: inline-block;
            top: 175px;
            left: 300px;
            height: 17px;
            color: #ffffff;
            font-size: 12px;
        }

        .time span {
            margin-right: 20px;
        }

        .time {
            float: left;
            position: absolute;
            display: inline-block;
            top: 175px;
            left: 300px;
            height: 17px;
            color: #ffffff;
            font-size: 12px;
        }

        .time span {
            margin-right: 20px;
        }

        .intro {
            text-align: left;
            float: left;
            width: 950px;
            position: absolute;
            display: block;
            top: 225px;
            left: 300px;
            height: 17px;
            color: #ffffff;
            font-size: 14px;
        }

        .intro_text {

        }

        .btns {

            float: left;
            display: inline-block;
            position: absolute;

            top: 300px;
            left: 300px;

        }

        .btn_like:hover {
            background-color: rgb(255, 133, 173);
        }

        .btn_like {
            vertical-align: center;
            display: inline-block;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            line-height: 50px;
            color: #ffffff;
            font-size: 16px;
            transition: all .3s ease 0s;
            width: 128px;
            height: 48px;
            background-color: #f36392;
        }

        .btn_like i {
            display: inline-block;
            vertical-align: -5px;
            width: 24px;
            height: 24px;
            margin-right: 7px;
            background-image: url(http://s1.hdslb.com/bfs/static/review/media/asserts/heart-bangumi.svg);
            background-repeat: no-repeat;
        }

        .btn_liked {
            width: 120px;
            height: 40px;
            line-height: 42px;
            background-color: hsla(0, 0%, 100%, 0.12);
            border: 4px solid hsla(0, 0%, 100%, 0.5);
            text-shadow: 0 0 4px rgba(0, 0, 0, 0.6);
        }

        .btn_liked:hover {
            background-color: hsla(0, 0%, 100%, 0.12);
        }

        .btn_liked i {

            vertical-align: -6px;
            background-image: url(http://s1.hdslb.com/bfs/static/review/media/asserts/icons.png);
            background-position: -660px -1938px;

        }
        /*从这里开始，下面的css均为下半部分的css样式*/
        .detail_tab {
            width: 100%;
            height: auto;
            position: relative;
            top: -30px;
        }

        .tab_nav {
            height: 60px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
            top: -40px;
            width: 80%;
            margin: 0 10% 11px 10%;
        }

        .tab_nav ul {
            font-size: 16px;
            margin-left: 40px;
            top: -3px;
        }

        .tab_nav ul li.on, .tab_nav ul li:hover {
            color: #00a1d6;
            border-bottom-color: #00a1d6;
        }

        .tab_nav ul li {
            cursor: pointer;
            float: left;
            padding: 0 6px 0px 6px;
            color: #222;
            transition: all 0.1s linear;
            border-bottom: 3px solid rgba(0, 0, 0, 0);
            height: 60px;
            line-height: 60px;
        }

        .tab_nav ul li + li {
            margin-left: 28px;
        }
        /*从这里开始，下面的css为第一部分，评分页*/
        .details_card_left{
            padding: 25px;
            height: 100%;
            width: 27%;
            margin-left: 10%;
            text-align: left;
            float: left;
            background: rgba(255, 255, 255, 0.8);
            box-sizing: border-box;
            border-radius: 15px;
            box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
        }
        .details_card_right{
            padding: 25px;
            height: 100%;
            width: 50%;
            margin-right: 10%;
            text-align: left;
            float: right;
            background: rgba(255, 255, 255, 0.8);
            box-sizing: border-box;
            border-radius: 15px;
            box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
        }
        .card_left_title{
            font-family: 幼圆, serif;
            font-size: 20px;
            font-weight: 700;
        }
        .card_left_text{
            font-family: 幼圆, serif;
            text-align: left;
            float:left;
            padding-top: 25px;
            line-height: 20px;
            font-size: 15px;
        }
        .card_right_title{
            font-family: 幼圆, serif;
            color: #0a0000;
            font-size:22px;
            line-height:20px;
        }
        .card_right_div{
            position: relative;
            width: 250px;
            height: 300px;
           text-align: center;
            margin-left: 10%;
            display: inline-block;
        }

        .card_right_bg{
            width: 200px;
            height: 200px;
            border-radius: 100%;
            background: #ccc;
            position: absolute;
            margin-top: 15px;
            margin-left: 20px;
        }
        .short_review{
           margin-left: 10%;
           margin-right: 10%;
           width: 100%;
           height: auto;

        }
        .short_review_middle{
            padding: 25px;
            height: 100%;
            width: 80%;
            text-align: left;
            float: left;
            background: rgba(255, 255, 255, 0.8);
            box-sizing: border-box;
            border-radius: 15px;
            box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
        }
        .long_review{
            display: none;
        }
        .diversity{
            display: none;
        }
        .short_review{
            display: none;
        }
    </style>
    <!--下面是圆形分数显示条的css-->
    <style>
        .bg {
            width: 200px;
            height: 200px;
            border-radius: 100%;
            background: #ccc;
            position: absolute;
            margin-top: 120px;
            margin-left: 700px;
        }
        .bg_2 {
            width: 200px;
            height: 200px;
            border-radius: 100%;
            background: #ccc;
            position: absolute;
            margin-top: 120px;
            margin-left: 950px;
        }

        .circle-right, .circle-left, .mask-right, .mask-left {
            width: 200px;
            height: 200px;
            border-radius: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .circle-right, .circle-left {
            background: skyblue;
        }

        .mask-right, .mask-left {
            background: #ccc;
        }

        .circle-right, .mask-right {
            clip: rect(0, 200px, 200px, 100px);
        }

        .circle-left, .mask-left {
            clip: rect(0, 100px, 200px, 0);
        }

        .text {
            width: 160px;
            height: 160px;
            line-height: 160px;
            text-align: center;
            font-size: 34px;
            color: deepskyblue;
            border-radius: 100%;
            background: #ffffff;
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .cirle_info{
            position: absolute;
            width: 450px;
            height: 20px;
            left: 700px;
            top: 70px;
        }
       .circle_line{
           position: absolute;
           width: 2px;
           height: 210px;
           background: #70c2db;
           left: 920px;
           top:100px;
       }
    </style>
    <script>
        $(function(){
            //获取百分比值
            var num = parseFloat($('.text').html());
            num=num*10;

            //通过计时器来显示过渡的百分比进度
            var temp = 0;
            var timer = setInterval(function(){
                calculate(temp);
                //清除计时器结束该方法调用
                if(temp == num){
                    clearInterval(timer);
                }
                temp++;
            },30)
            //改变页面显示百分比
            function calculate(value){
                //改变页面显示的值
                $('.text').html(value/10);

                //清除上次调用该方法残留的效果
                $('.circle-left').remove();
                $('.mask-right').remove();

                //当百分比小于等于50
                if(value <= 50){
                    var html = '';

                    html += '<div class="mask-right" style="transform:rotate('+ (value * 3.6) +'deg)"></div>';

                    //元素里添加子元素
                    $('.circle-right').append(html);
                }else{
                    value -= 50;
                    var html = '';

                    html += '<div class="circle-left">';
                    html += '<div class="mask-left" style="transform:rotate('+ (value * 3.6) +'deg)"></div>';
                    html += '</div>';

                    //元素后添加元素
                    $('.circle-right').after(html);
                }
            }
        })

        function changeTab(tab) {
            var tabs = document.getElementsByClassName('tab_nav')[0].getElementsByTagName("li");
            var contents = document.querySelectorAll(".tab_de>div");
            for (var i = 0, len = tabs.length; i < len; i++) {
                if (tabs[i] === tab) {
                    tabs[i].className = 'on';
                    contents[i].style.display = 'block';

                } else {
                    tabs[i].className = '';
                    contents[i].style.display = 'none';
                }
            }
        }
    </script>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include "../header.php"?>
<div style="height: 50px"></div>
<div class="all">
    <div class="main">
        <div class="top">
            <div class="nei">
                <!--  fgimg放番剧展示图 -->
                <div class="fjimg">
                    <img id="fj"
                         src="http://i0.hdslb.com/bfs/bangumi/image/0212baa8898d0c819c7fb84015e95b8fca621435.png">
                </div>
                <!--  title放番剧名和标签 -->
                <div class="title">
                    <span class="title_name"><?php echo "阿松" ?></span>
                    <!--  title放番剧标签  -->
                    <span class="title_tags">
                        <span class='title_tag'>日常番</span>
                        <span class='title_tag'>日常番</span>
                        <span class='title_tag'>日常番</span>
                        <?php
                        //循环输出番剧标签
                        /*  while ($arr = mysqli_fetch_row($tagsresult)) {
                            echo "<span class='title_tag'>" . $arr[0] . "</span>";
                        }
                        */ ?>
                    </span>
                </div>
                <div class="data">
                    <div class="count">
                        <span class="plays">
                            <span class="playslabel">总评论数</span>
                            <br/>
                            <em>0</em>
                        </span>
                        <span class="likes">
                            <span class="likeslabel">收藏人数</span>
                            <br/>
                            <em>0</em>
                        </span>
                    </div>

                </div>
                <!-- 圆形展示分数条上面的文字-->
                <div class="cirle_info">
                <span style="color:#ffffff;font-size:22px;line-height:20px;margin-right: 110px">综合用户评分</span>
                <span style="color:#ffffff;font-size:22px;line-height:20px;">综合媒体评分</span>
                </div>
                <!-- 圆形展示分数条-->
                <div class="bg">
                    <div class="circle-right"></div>
                    <div class="text">6.5</div>
                </div>
                <!-- 圆形展示分数条中间的线-->
                <div class="circle_line"></div>
                <!-- 圆形展示分数条-->
                <div class="bg_2">
                    <div class="circle-right"></div>
                    <div class="text">6.5</div>
                </div>
                <div class="time">
                    <?php
                    //上架时间
                    date_default_timezone_set('PRC');
                    $startdate = date("Y年m月d日", time());
                    echo "<span>" . $startdate . "开播</span>";
                    //判断是否完结，如果已完结，则执行
                    if (true) {
                        echo "<span>已完结</span>";
                    }
                    ?>

                </div>
                <div class="intro">
                    <span class="intro_text"><?php echo substr("这里是简介", 0, 490); ?>......</span>
                </div>
                <div onclick="changelike()" id="like_btn" class="btns">
                    <?php

                    //首先判断用户是否已经登录，若已经登录
                    if (1 == 1) {
                        echo '<div class="btn_like">';
                        echo '<i></i>';
                        echo '收藏';
                    } else {
                        if (1 == 1) {
                            $islike = 1;
                            echo '<div class="btn_like btn_liked">';
                            echo '<i></i>';
                            echo '已收藏';

                        } else {
                            $islike = 0;
                            echo '<div class="btn_like">';
                            echo '<i></i>';
                            echo '收藏';
                        }
                    }


                    ?>

                </div>
            </div>
        </div>
        <!--bg放的图片即番剧图        -->
        <img id="bg" src="http://i0.hdslb.com/bfs/bangumi/image/0212baa8898d0c819c7fb84015e95b8fca621435.png">
    </div>
    <!--  选择标签及具体内容部分  -->
    <div class="detail_tab">
            <!-- 选择菜单  -->
            <div class="tab_nav">
                <ul class="clearfix">
                    <li onclick="changeTab(this)" class="on">番剧概述</li>
                    <li onclick="changeTab(this)">分集讨论</li>
                    <li onclick="changeTab(this)"> 长评</li>
                    <li onclick="changeTab(this)"> 短评</li>
                </ul>
            </div>
            <!-- 接下来是 -评分页-分集页-长评-短评的具体版块    -->
            <div class="tab_de">
                <!--  评分页-->
                <div class="hyoka">
                    <!--第一部分，评分概述-左   -->
                    <div class="details_card_left">
                        <div class="card_left_title">详情</div>
                        <div class="card_left_text">
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                        </div>
                    </div>
                    <!--第一部分，评分概述-右   -->
                    <div class="details_card_right">
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 分集页-->
                <div class="diversity">
                    <div class="details_card_left">
                        <div class="card_left_title">详情</div>
                        <div class="card_left_text">
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                        </div>
                    </div>
                </div>
                <!--长评-->
                <div class="long_review">
                    <div class="details_card_left">
                        <div class="card_left_title">详情</div>
                        <div class="card_left_text">
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                        </div>
                    </div>
                </div>
                <!--短评-->
                <div class="short_review">
                    <div class="short_review_middle">
                        <div class="card_left_title">短评</div>
                        <div class="short_review">

                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>


</body>
</html>