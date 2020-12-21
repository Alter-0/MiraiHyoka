<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>个人信息</title>
</head>
<style type="text/css">
    *{
        margin: 0;
        padding: 0;
        border: 0;
        list-style: none;
    }
    .top{
        width: 100%;
        height: 150px;
        position: relative;
    }
    .top iframe{
        width: 100%;
        height:50px;
        position: relative;
        z-index: 1000;
    }
    .main{
        width: 100%;
        height: 150px;
    }
    .main:after{
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }
    .content{
        margin: 0px;
        background: #FBFBFB;
        border-top: 1px solid #FEFEFE;
        border-bottom: 1px solid #EEE;
        background: #fbfbfb;
    }
    .content:after{
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;

    }

    .name{
        width: 200px;
        height: 50px;
        margin-left: 16%;
        background-color: #FFF;
        padding: 10px 0 15px 0;
        display: inline;
    }
    .name p{
        height: 25px;
        line-height: 25px;
        font-size: 18px;
        margin: 0 auto;
        width: 800px;
    }
    .avatar{
        width: 80px;
        margin-left: 200px;
        display: inline;
        margin-left: 15%;
    }
    .avatar img{
        width: 60px;
        margin: 0 auto;
    }
    .tabwarp{
        height: 40px;
        width: 100%;
        margin: 0 auto;
        border-bottom: 1px solid #F4A6D7;
    }
    .navtab{
        height: 40px;
        line-height: 40px;
        padding: 0 15px;
        width: 1000px;
        margin: 0 auto;
    }
    .tabwarp ul li{
        float: left;
        font-size: 18px;
        margin: 0 40px 0 0;
    }
    .tabwarp ul li a:{
        color: #888;
        padding: 10px 10px 9px 10px;

    }
    .detail{
        width: 100%;
        height: auto;
        margin-top: 10px;
        display: block;
        position: relative;
    }
    .detail .record{
        width: 800px;
        height: 500px;
        display: block;
        margin-left: 16%;
        border-left-style: solid;
        border-right-style: groove;
        border-bottom-style: solid;
        border-top-style: solid;
        background-color: #5b6c7d;

    }
    .detail .record .myrecord{
        width: 800px;
        height: 15px;
        display: block;
        margin-left: 20px;
        border-left-style: solid;
        border-right-style: groove;
        border-bottom-style: solid;
        border-top-style: solid;
    }
    .detail .record .things{
        width: 780px;
        height: 80px;
        display: block;
        margin-left: 20px;
        margin-top: 20px;
        border-left-style: solid;
        border-right-style:solid;
        border-bottom-style: solid;
        border-top-style: solid;
        background-color: #faf15d;
        display: block;

    }

    .bottom{
        width: 100%;
        margin-top: 30px;
    }
    .footer{
        width: 100%;
    }

</style>
<body>

<div class="top">
    <iframe src="../header.php" class="header" scrolling="no"></iframe>
</div>

<div class="main">

    <div class="content">
    <div class="avatar">
        <img src="image/timg.jpg">
    </div>
    <div class="name">
        <p>昵称</p>
    </div>
    </div>

    <div class="tabwarp">
        <ul class="navtab">
            <li class="chose"><a href="">时光机</a></li>
            <li class="chose">收藏</li>
            <li class="chose">目录</li>
            <li class="chose">时间胶囊</li>
            <li class="chose">个人中心</li>
        </ul>
    </div>
</div>

<div class="detail">
    <div class="record">
        <div class="myrecord">
            <span>我的日志</span>
        </div>
        <div class="things">
            133
        </div>
        <div class="things">
            456
        </div>

    </div>
</div>

<div class="bottom">
    <iframe src="../footer.html" scrolling="no" class="footer"></iframe>

</div>


</body>
</html>
