<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MiraiHyoka</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="js/jquery.js">
    </script>
    <script src="css/bootstrap/js/bootstrap.min.js">
    </script>
</head>
<body>

<?php  include "header.php";?>
    <div id="carousel-example-generic" class="showli carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner showli"  role="listbox">
            <div class="item active">
                <img src="image/background.jpg" alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            <div class="item">
                <img src="image/new_banner.png" alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            <div class="item">
                <img src="image/user_background.jpg" alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<div class="container">
       <div class="title">
           <h2>
               最新的各个榜单番剧排行
           </h2>
           <p>
               2020年9月-2021年最新最全面的番剧榜单全国仅此一家
           </p>
           <div class="line">
           </div>
       </div>
   <div class="row rank">
       <div class="ranking col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="rankcontent"></div></div>
       <div class="ranking col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="rankcontent"></div></div>
       <div class="ranking col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="rankcontent"></div></div>
   </div>
    <div class="maybe">
     <div class="maybe-main"></div>
    </div>
    <div class="maybe">
        <div class="maybe-main"></div>
    </div>
</div>
<footer>
    <div class="container">
       <div class="foot">
           <p>
               hello world
           </p>
       </div>
    </div>
</footer>
</body>
</html>