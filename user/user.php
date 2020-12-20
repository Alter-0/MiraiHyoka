<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>个人信息</title>
</head>
<style type="text/css">
    .top{
        width: 100%;
        height: 200px;
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
        height: 100px;
    }
    .name{
        width: 100%;
        height: 50px;
        margin-top: 10px;
    }
    .name p{
        height: 25px;
        line-height: 25px;
        font-size: 18px;
        width: 1000px;
        margin-left: 25%;
    }
    .avatar{
        width: 80px;
        margin-left: 20%;
    }
    .avatar img{
        width: 60px;
        margin: 0 auto;
    }
    .tab{
        height: 40px;
        width: 100%;
        margin: 0 auto;
    }
    .navtab{
        height: 40px;
        line-height: 40px;
        padding: 0 15px;
        width: 1000px;
        margin: 0 auto;
    }


</style>
<body>

<div class="top">
    <iframe src="../header.php" class="header" scrolling="no"></iframe>
</div>
<div class="main">
    <div class="avatar">
        <img src="image/logo.png">
    </div>
    <div class="name">
        <p>昵称</p>
    </div>
    <div class="tab">
        <ul class="navtab">
            <li></li>
        </ul>

    </div>
</div>

</body>
</html>
