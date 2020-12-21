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
        height: 100px;
        position: relative;
    }
    .top iframe{
        width: 100%;
        height:50px;
        position: relative;
        z-index: 1000;
    }
    .header{
        width: 100%;
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
    .main .content{
        margin: 0px;
        background: #FBFBFB;
        border-top: 1px solid #FEFEFE;
        border-bottom: 1px solid #EEE;
        background: #fbfbfb;
    }
    .main .content:after{
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;

    }

    .main .content .name{
        width: 200px;
        height: 50px;
        background-color: #FFF;
        padding: 10px 0 15px 0;
        display:inline-block;
    }
    .main .content .name p{
        height: 25px;
        line-height: 25px;
        font-size: 18px;
        margin: 0 auto;
        width: 800px;
    }
    .main .content .avatar{
        width: 80px;
        margin-left: 220px;
        display: inline-block;

    }
    .main .content .avatar img{
        width: 60px;
        height: 60px;
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
        width: 900px;
        height: 500px;
        display:none;
        margin-left: 16%;
        background-color: #5b6c7d;
        position: relative;

    }
    .detail .record .myrecord{
        width: 800px;
        height: 15px;
        display: block;
        margin-left: 20px;
    }
    .detail .record .myrecord span{
        border-bottom: 1px solid #F4A6D7;
    }

    .detail .record .things{
        width: 780px;
        height: 100px;
        display: block;
        margin-left: 20px;
        margin-top: 20px;
        background-color: #faf15d;
        display: block;
        line-height: 180%;
        border-bottom: 1px solid #EEE;

    }
    .detail .record .things .cover{
        padding-top: 5px;
        display: inline-block;
    }
    .detail .record .things .introduce{
        display: inline-block;
        margin-left: 10px;
        height: 60px;
        position: absolute;
        margin-top: 0px;
    }


    .detail .record .cover a:visited{
        text-decoration: none;
        color: #444;
    }
    .detail .record .cover .cornect{
        height: 80px;
        width: 100%;

    }
    .detail .record .cover .cornect span img{
        height: 80px;
        width: 80px;
    }

     .detail .like{
         width: 900px;
         height: 600px;
         display: block;
         margin-left: 16%;
         background-color: #5b6c7d;
         position: relative;
         padding-bottom: 10px;
     }
     .detail .like .yes{
         width: 800px;
         height: 50px;
         display: block;
         padding-left: 20px;
         padding-top: 20px;
     }
    .detail .like .yes .p{
        margin-top: 12px;
        border-bottom: 1px solid #F4A6D7;
        font-size: 10px;
        display: block;
    }


    .detail .like .list{
        height: 120px;
        width: 120px;
        display:inline-block;
        background-color: #faf15d;
        padding-top: 10px;
    }
    .detail .like .list .photo{
        background-image: url("image/timg.jpg");
        height: 80px;
        width: 80px;
        margin-left: 10px;
        margin-top: 10px;
    }
    .detail .like .list .pn{
        display: block;
        margin-top: 3px;
        font-size: 10px;
        margin-left: 20px;
        white-space: nowrap;
        width: 80px;
    }
    .detail .like .no{
        width: 800px;
        height: 50px;
        display: block;
        padding-left: 20px;
        margin-top:15%;
        position: relative;
    }
    .detail .like .no .p{
        margin-top: 12px;
        border-bottom: 1px solid #F4A6D7;
        font-size: 10px;
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
   <iframe src="../header.php" scrolling="no" class="header"></iframe>
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
            <li class="chose" onclick="get">时光机</li>
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
            <div class="cover">
                <a class="cornect">
                    <span class="img">
                        <img src="image/timg.jpg">
                    </span>
                </a>
            </div>
            <div class="introduce">
                <h2>标题</h2>
                <h5>时间</h5>
                <h4>纪录内容</h4>
            </div>

        </div>
        <div class="things">
            <div class="cover">
                <a class="cornect">
                    <span class="img">
                        <img src="image/timg.jpg">
                    </span>
                </a>
            </div>
            <div class="introduce">
                <h2>标题</h2>
                <h5>时间</h5>
                <h4>纪录内容</h4>
            </div>
        </div>

    </div>
    <div class="like">
        <div class="yes">
            <p class="p">看过</p>

            <a class="list">
                <div class="photo"></div>
                <p class="pn">名称</p>
            </a>
            <a class="list">
                <div class="photo"></div>
                <p class="pn">名称</p>
            </a>
            <a class="list">
                <div class="photo"></div>
                <p class="pn">名称</p>
            </a>
            <a class="list">
                <div class="photo"></div>
                <p class="pn">名称</p>
            </a>
        </div>
        <div class="no">
            <p class="p">没看过</p>
            <a class="list">
                <div class="photo"></div>
                <p class="pn">名称</p>
            </a>
            <a class="list">
                <div class="photo"></div>
                <p class="pn">名称</p>
            </a>
        </div>
    </div>
</div>

<div class="bottom">
    <iframe src="../footer.html" scrolling="no" class="footer"></iframe>
</div>
<script src="../js/jquery.js"></script>
<script>
    $(document).read(function ()){
        $(".record").click(function ()
        {
            $(".record").css("display","black");
            $(".like").css("display","none");
        })
    }
</script>


</body>
</html>
