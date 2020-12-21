<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MriaiHyoka(* ￣3)(ε￣ *)经典长评</title>
    <!--    header必须引入的三个样式文件,使用php引入-->
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="css/long-comment-out.css">
    <script src="../js/jquery.js"></script>
</head>

<body>
<?php  include "../header.php";?>
<div  class="container">
    <div style="height: 30px">
    </div>
    <div class="row">
        <div class="l-comment-left col-lg-8 col-md-8 col-sm-12 col-xs-12">
           <div class="row">
               <div class="l-left col-lg-2 col-md-2 hidden-xs hidden-sm">
                   <a href=""><span class="l-bar">hello world</span></a>
                   <a href=""><span class="l-bar">hello world</span></a>
                   <a href=""><span class="l-bar">hello world</span></a>
                   <a href=""><span class="l-bar">hello world</span></a>
                   <a href=""><span class="l-bar">hello world</span></a>
               </div>
               <div class="l-right col-lg-10 col-md-10 col-sm-12 col-xs-12">
                   <div class="l-cover">
                       <img src="img/misaka.png" alt="">
                   </div>
                   <div class="litle-cover">
                        <img src="" alt="">
                        <div class="litle-cover-info">
                            <h6>某科学的超电磁炮T</h6>
                            <p><span style="margin-right: 5px">番剧</span> |<span style="margin-left: 5px">日本</span>  </p>
                            <span id="star">hello</span>
                        </div>
                   </div>
                   <div class="l-title">
                       <h1>某科学的超电磁炮</h1>
                       <div class="l-info">
                           <span>
                               访问量
                           </span>
                           <span>
                               点赞
                           </span>
                           <span>
评论
                           </span>
                       </div>
                       <div id="comment-content">
                          <p> 从超炮第一季开始,白井黑子便有了一个大致的形

                              象。</p>
<p>

    她是个会偷拍舍友（琴）的变态。
</p>

                           <p>她是个非常关心身边人的少女。</p>

                           <p>她是个非常尊重他人的人。</p>

                         <p>  她是个对待工作认真负责的工作狂。</p>

                           <p>她是个即使受伤也不会有任何怨言的笨蛋。</p>

                           <p>她是个只会对名为御坂美琴的少女专一的白痴。</p>

                           <p>她是个不会把私情带入工作处理,哪怕对方是自己最</p>

                    <p> 爱的姐姐大人,也不会有任何退后的少女。</p>

                          <p> 食蜂操祈曾夸耀过白井黑子。</p>
                       </div>
                   </div>
                   <div class="long-comment-ccontent">

                   </div>
                   <div class="l-comment-in-comment">

                   </div>
               </div>
           </div>
        </div>
        <div class="l-comment-right col-lg-3 col-md-3 hidden-sm hidden-xs">
               <div id="l-combar" class="comment-bar">
                <div class="bar-person">

                </div>
               </div>
        </div>
        <script>
            $(document).scroll(function () {
                var scrolltopTemp=document.documentElement.scrollTop||document.body.scrollTop
                console.log(scrolltopTemp);
                if (scrolltopTemp>80){
                   $('#l-combar').css('margin-top',scrolltopTemp-80);
                }else {
                    $('#l-combar').css('margin-top',0);
                }
            })
        </script>
    </div>
</div>
</body>
</html>