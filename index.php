<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>MiraiHyoka</title>
    <link rel="shortcut icon" href="image/favicon.ico">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="css/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
    <style>
        #showspider{
            height: 560px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    $isLogin = 0;
    if(isset( $_SESSION['user_id'])){
        $isLogin = $_SESSION['user_id'];
    }
    ?>
 <header>
    <div style="padding: 0" class="container">
        <div class="dis">
            <div class="logo"><img src="image/logo.png" alt=""></div>
        </div>
        <div class="dis">
            <div class="navli">
                <ul class="hidden-lg hidden-md">
                    <li ><a href="#">
                            <span id="span6" class="ul-span">菜单</span></a></li>
                </ul>
                <ul class="hidden-sm hidden-xs">
                    <li class="out-li"><a href="guide/guide.php"><span id="span1" class="ul-span">番剧</span></a>
                        <ul>
                            <li><a href="animate/detail.php">短评</a></li>
                            <li><a href="animate/detail.php">长评</a></li>
                        </ul>
                    </li>
                    <li class="out-li">
                        <a href="guide/guide.php">
                            <span class="ul-span">指引</span>
                        </a>
                           <ul>
                               <li><a href="guide/guide.php">分类</a></li>
                               <li><a href="guide/guide.php">标签</a></li>
                           </ul>
                    </li>
                    <li class="out-li"
                    <a href="search/search.php"><span id="span5" class="ul-span">探索</span></a>
                        <ul>
                            <li><a href="search/search.php?content=紫罗兰">紫罗兰</a></li>
                            <li><a href="search/search.php?content=青春">青春系列</a></li>
                            <li><a href="search/search.php?content=少女">少女系列</a></li>
                            <li><a href="#">我不喜欢的</a></li>
                        </ul>
                    </li>
                    <li class="hidden-md"><a href="animate/detail.php">
                            <span id="span-img" class="ul-span2"><img src="image/logo_doujin.png" alt="照片">
                            </span></a></li>
                </ul>
            </div>
        </div>
        <div id="user-login" class="dis">
            <div class="search hidden-sm hidden-xs">
                <form action="search/search.php" method="get">
                    <div class="inner">
                        <select name="cat" id="siteSearchSelect">
                            <option value="all">全部</option>
                            <option value="2">动画</option>
                            <option value="1" selected="selected">书籍</option>
                            <option value="4">游戏</option>
                            <option value="3">音乐</option>
                            <option value="6">三次元</option>
                            <option value="person">人物</option>
                        </select>
                            <input id="search_text" name="content" class="textfield sec" type="text">
                            <input type="submit" name="submit"  class="sec" id="search_btn" value="">
                        </div>
                </form>
            </div>
            <?php

            if ($isLogin==0){
                echo " <div id=\"login-btn\" class=\"login\">
                <a  href=\"user/login.php\">
                    <span id=\"login\" class=\"reg11\" style=\"padding: 0 5px 0 15px\">登录</span>
                </a>
                <a href=\"user/reg.php\">
                    <span id=\"reg11\" class=\"reg11\" style=\"padding:0 15px 0 5px\">注册</span>
                </a>
            </div>";
            }else{
                include "conn.php";
                $sql = " select avatar from user where user_id = $isLogin;";
                $avatar =  mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($avatar);
                $pic = $row['avatar'];
                if (empty($pic)){
                    $pic = "image/akari.jpg";
                }else{
                   $pic  = substr($pic,3);
                }
                echo " <div   id=\"headerpic\">
                      
                 <img src=\"$pic\" alt=\"oih\">
                 <ul>
                     <li><a href=\"user-center/usercenter.php\">个人中心</a></li>
                 <li><a href=\"user-center/usercenter.php\">我的评分</a></li>
                     <li><a href=\"user-center/usercenter.php\">我的收藏</a></li>
                     <li id=\"headerpic-last-li\">
                         <a href=\"user/exitlogin.php\">
                    退出登录
                         </a>
                     </li>
                 </ul>
             </div>";
            }
            ?>
<!--            <script>-->
<!--                $(function () {-->
<!--                    var login_btn = $('#login-btn');-->
<!--                    var hearpic = $('#headerpic');-->
<!--                    if ($('#isLogin').val()==1){-->
<!--                        login_btn.css('display','none');-->
<!--                        hearpic.css('display','inline-block');-->
<!--                    }else {-->
<!--                        login_btn.css('display','block');-->
<!--                        hearpic.css('display','none');-->
<!--                    }-->
<!--                })-->
<!--            </script>-->
        </div>
    </div>
    <div class="menu" id="menu">
    </div>
</header>
<script>
    var i = 0;
    var $menu = $('#menu');
    $('#span6').click(function () {
        if (i==0){
            $menu.slideDown(300);
            i++;
            $(this).html('关闭');
        }else {
            $menu.slideUp(300);
            i--;
            $(this).html('菜单');
        }
    });
</script>
<div id=showspider style="width: 100%;">
    <iframe id="spider" src="index-scroll.php" scrolling="no" frameborder="0" width="100%" height="100%">
    </iframe>
</div>
<script>
    $(window).resize(function () {
        var bodyw = $('body').width();
        console.log(bodyw);
        if (bodyw>640){
            console.log("zheiklasnhilkac")
            $('#showspider').css('height','580px');
        }else {
            $('#showspider').css('height','280px');
        }
    });
</script>
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
       <div class="ranking col-lg-4 col-md-4 col-sm-12 col-xs-12">
           <div class="rank-content">
               <h2>综合评分</h2>
               <ul>
                   <?php
                      include "conn.php";
                      include "static/dao.php";
                      $sql = "select animate_id,name_cn,media_rating from animate order by media_rating desc limit 12;";
                      $res = queryList($conn,$sql);
                      foreach ($res as $item){
                          $id = $item['animate_id'];
                          $name = $item['name_cn'];
                          $rates = floor($item['media_rating']*100)/100;
                          echo "<li><a href=\"animate/detail.php?animate_id=".$id."\">".$name."</a><span class=\"sorce\">".$rates."分</span></li>";
                      }
                   ?>
<!--                   <li><a href="#">不见星空经典系列20部合集</a><span class="sorce">9.9分</span></li>-->
               </ul>
           </div>
       </div>
       <div class="ranking col-lg-4 col-md-4 col-sm-12 col-xs-12">
           <div class="rank-content">
               <h2>最新排行</h2>
               <ul>
                   <?php
                   $sql = "select animate_id,name_cn,media_rating from animate order by bangumi_rating desc limit 12;";
                   $res = queryList($conn,$sql);
                   foreach ($res as $item){
                       $id = $item['animate_id'];
                       $name = $item['name_cn'];
                       $rates = floor($item['media_rating']*100)/100;
                       echo "<li><a href=\"animate/detail.php?animate_id=".$id."\">".$name."</a><span class=\"sorce\">".$rates."分</span></li>";
                   }
                   ?>
               </ul>
           </div>
       </div>
       <div class="ranking col-lg-4 col-md-4 col-sm-12 col-xs-12">
           <div class="rank-content">
               <h2>权威评分</h2>
               <ul>
                   <?php
                   $sql = "select animate_id,name_cn,anikore_rating from animate order by anikore_rating desc limit 12;";
                   $res = queryList($conn,$sql);
                   foreach ($res as $item){
                       $id = $item['animate_id'];
                       $name = $item['name_cn'];
                       $rates = floor($item['anikore_rating']*100)/1000;
                       echo "<li><a href=\"animate/detail.php?animate_id=".$id."\">".$name."</a><span class=\"sorce\">".$rates."分</span></li>";
                   }
                   ?>
               </ul>
           </div>
       </div>
   </div>
<!--    展示评论-->
    <div class="maybe">
      <div class="comment">
          <ul id="title-comment">
              <li id="new-comment">
                  最新评论
              </li>
              <li id="class-comment">经典长评</li>
              <li id="short-comment">热门短评</li>
              <li id="maybe-comment">可能想看</li>
          </ul>
      </div>
     <div class="maybe-main">
         <div class="row show-all-comment" id="show1">

             <div class="pic col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <img src="image/rabbitgirl.jpg" alt="hello">
             </div>
             <div class="show-comment col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="comment-list">
                     <ul id="frist-ul">
                         <?php
                         include "conn.php";

                            $sql  = "select  evaluation.animate_id,name_cn,content,time from evaluation join animate on evaluation.animate_id = animate.animate_id where is_long=0 order by time  limit 8;
";
                              $res = mysqli_query($conn,$sql);
                              $i = 0;
                              $output=[];
                              while ($row = mysqli_fetch_assoc($res)) {
                                  $output[$i] = $row;
                                  $i++;
                                  $content111= $row['content'];
                                  $id111= $row['animate_id'];
                                  $name_cn111 = $row['name_cn'];
                                  echo "<li><a href=\"animate/detail.php?animate_id=$id111\"> <span style='top:3px' class='glyphicon glyphicon-star-empty'></span><span class='ul-name-1'>$name_cn111</span>$content111 </a></li>";
                              }
                         ?>

                     </ul>
                 </div>
             </div>
         </div>
         <div class="row show-all-comment" id="show2">
             <div class="pic col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <img src="image/weilian-004.jpg" alt="hello">
             </div>
             <div class="show-comment col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="comment-list">
                     <ul id="second-ul">
                         <li><div class="long-com"><h4>某科学的超电磁炮</h4><p>哔哩哔哩点击</p></div></li>
                         <li><div class="long-com"><h4>某科学的超电磁炮</h4><p>哔哩哔哩点击</p></div></li>
                         <li><div class="long-com"><h4>某科学的超电磁炮</h4><p>哔哩哔哩点击</p></div></li>
                         <li><div class="long-com"><h4>某科学的超电磁炮</h4><p>哔哩哔哩点击</p></div></li>
                     </ul>
                 </div>
             </div>
         </div>
         <div class="row show-all-comment" id="show3">
             <div class="pic col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <img src="image/user_background.jpg" alt="hello">
             </div>
             <div class="show-comment col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="comment-list">
                     <ul id="thrid-ul">
                         <?php
                         include "conn.php";

                         $sql  = "select  evaluation.animate_id,name_cn,content,time from evaluation join animate on evaluation.animate_id = animate.animate_id where is_long=0 order by time  limit 8;
";
                         $res = mysqli_query($conn,$sql);
                         $i = 0;
                         $output=[];
                         while ($row = mysqli_fetch_assoc($res)) {
                             $output[$i] = $row;
                             $i++;
                             $content111= $row['content'];
                             $id111= $row['animate_id'];
                             $name_cn111 = $row['name_cn'];
                             echo "<li><a href=\"animate/detail.php?animate_id=$id111\"> <span style='top:3px' class='glyphicon glyphicon-star-empty'></span><span class='ul-name-1'>$name_cn111</span>$content111 </a></li>";
                         }
                         ?>

                     </ul>
                 </div>
             </div>
         </div>
         <div class="row show-all-comment" id="show4">
             <div class="pic col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <img src="image/violet.jpg" alt="hello">
             </div>
             <div class="show-comment col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="comment-list">
                     <ul>
                         <ul id="second-ul">
                             <li><div class="long-com"><h4>某科学的超电磁炮</h4><p>哔哩哔哩点击</p></div></li>
                             <li><div class="long-com"><h4>某科学的超电磁炮</h4><p>哔哩哔哩点击</p></div></li>
                             <li><div class="long-com"><h4>某科学的超电磁炮</h4><p>哔哩哔哩点击</p></div></li>
                             <li><div class="long-com"><h4>某科学的超电磁炮</h4><p>哔哩哔哩点击</p></div></li>
                         </ul>
                     </ul>
                 </div>
             </div>
         </div>
         <script>
            $(document).ready(function () {
                var wi =  $('.row').width();
                // var bodywi = $(document).body.width;
                // console.log(wi);
                if (wi<970){
                    if (wi<755){
                        if (wi<633){
                            if (wi<500){
                                $('.maybe').css('height','750px');
                            }else {
                                $('.maybe').css('height','800px');
                            }

                        }else {
                            $('.maybe').css('height','900px');
                        }
                        var title_comment =  $('#title-comment').children();
                        title_comment.css('font-size','18px');
                    }
                }else {
                    $('.maybe').css('height','520px');
                }
            })
           $(window).resize(function () {
               var wi =  $('.row').width();

               if (wi<970){
                   if (wi<755){
                       if (wi<633){
                           if (wi<500){
                               $('.maybe').css('height','750px');
                           }else {
                               $('.maybe').css('height','800px');
                           }

                       }else {
                           $('.maybe').css('height','900px');
                       }
                       var title_comment =  $('#title-comment').children();
                       title_comment.css('font-size','18px');
                   }
               }else {
                   $('.maybe').css('height','520px');
               }

           });
             var show1 =  $('#show1');
             var show2 =  $('#show2');
             var show3 =  $('#show3');
             var show4 =  $('#show4');
             $('#new-comment').hover(function () {
                 show4.css('display','none');
                 show3.css('display','none');
                 show2.css('display','none');
                 show1.css('top','300px');
                 show1.css('opacity','0');
                 show1.animate({top:'0',display:'block',opacity:'1'},600);
                 show1.css('display','block');
             },function () {

             });
             var r=1;
             $(function () {
                 $(document).scroll(function () {

                     var scrolltopTemp=document.documentElement.scrollTop||document.body.scrollTop
                     if (scrolltopTemp>900&&r>0){
                         show2.css('display','none');
                         show3.css('display','none');
                         show4.css('display','none');
                         show1.css({top:'300px',opacity:'0'});
                         show1.animate({top:'0',display:'block',opacity:'1'},600);
                         show1.css('display','block');
                         r = 0;
                     }
                 })
             })
             /**
              *      <li id="new-comment">
              最新评论
              </li>
              <li id="class-comment">经典长评</li>
              <li id="short-comment">热门短评</li>
              <li id="maybe-comment">可能想看</li>
              */

             $('#class-comment').hover(function () {
                 show4.css('display','none');
                 show3.css('display','none');
                 show1.css('display','none');
                 show2.css('top','300px');
                 show2.css('opacity','0');
                 show2.animate({top:'0',display:'block',opacity:'1'},600);
                 show2.css('display','block');
             },function () {

             });
             $('#short-comment').hover(function () {
                 show4.css('display','none');
                 show2.css('display','none');
                 show1.css('display','none');
                 show3.css('top','300px');
                 show3.animate({top:'0',display:'block',opacity:'1'},600);
                 show3.css('display','block');
             },function () {

             });
             $('#maybe-comment').hover(function () {
                 show2.css('display','none');
                 show3.css('display','none');
                 show1.css('display','none');
                 show4.css('top','300px');
                 show4.animate({top:'0',display:'block',opacity:'1'},600);
                 show4.css('display','block');
             },function () {

             });
         </script>
     </div>
    </div>
<!--    展示可能看的视频-->
    <div class="show-video">
        <h2># 猜你想看</h2>
         <div class="row">
             <?php

               $sql = "select * from animate order by douban_rating limit 4;";
                $res = queryList($conn,$sql);
               function msubstr($str, $start, $len) {
                 $tmpstr = "";
                 $strlen = $start + $len;
                 for($i = 0; $i < $strlen; $i++) {
                     if(ord(substr($str, $i, 1)) > 0xa0) {
                         $tmpstr .= substr($str, $i, 2);
                         $i++;
                     } else
                         $tmpstr .= substr($str, $i, 1);
                 }
                 return $tmpstr;
             }
             ?>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="maybe-video">
                     <div class="img">
                       <img src="<?php echo $res[0]['cover']; ?>" alt="">
                     </div>
                     <div class="word">
                         <h3 class="video-h3"><?php echo $res[0]['name_cn']; ?></h3>
                         <p>
                             <?php $in =  $res[0]['introduction'];
                             echo substr_max($in,200)."......";
                             ?>
                         </p>
                     </div>
                 </div> 
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="maybe-video">
                     <div class="img right-img" >
                         <img src="<?php echo $res[1]['cover']; ?>" alt="">
                     </div>
                     <div class="word" style="left: 0">
                         <h3 class="video-h3"><?php echo $res[1]['name_cn']; ?></h3>
                         <p>
                             <?php $in =  $res[1]['introduction'];
                             echo substr_max($in,200)."......";
                             ?>
                         </p>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="maybe-video">
                     <div class="img">
                         <img src="<?php echo $res[2]['cover']; ?>" alt="">
                     </div>
                     <div class="word">
                         <h3 class="video-h3"><?php echo $res[2]['name_cn']; ?></h3>
                         <p>
                             <?php $in =  $res[2]['introduction'];
                             echo substr_max($in,200)."......";
                             ?>
                         </p>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                 <div class="maybe-video">
                     <div class="img right-img">
                         <img src="<?php echo $res[3]['cover']; ?>" alt="">
                     </div>
                     <div class="word" style="left: 0">
                         <h3 class="video-h3"> <?php echo $res[3]['name_cn']; ?></h3>
                         <p>
                             <?php $in =  $res[3]['introduction'];
                                echo substr_max($in,200)."......";
                             ?>
                         </p>
                     </div>
                 </div>
             </div>
             <script>
                 $(window).resize(function () {
                     var wi =  $('.row').width();
                     if (wi<972){
                         $('.video-h3').css('font-size','17px');
                     }else {
                         $('.video-h3').css('font-size','21px');
                     }
                 });
             </script>
         </div>
    </div>
</div>
<footer>
<div class="container" style="border-bottom: 1px solid #cbcbcb;">
    <div class="left col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h1>MiraiHypka</h1>
        <p>致力于为二次元世界提供最权威最完整评分体系！</p>
        <p>建立初衷仅作为团队学习项目，并不包含任何商业信息，请勿上当受骗</p>
        <p >本站不提供任何视听上传服务，所有内容均来自视频站点分享，如有侵权请与我们联系删除</p>

    </div>
    <div class="right col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <h4>
            传送门
        </h4>
        <ul>
            <li><a href="#">关于</a></li>
            <li><a href="#">订阅</a></li>
            <li><a href="#">APP</a></li>
            <li><a href="#">赞助</a></li>  <li><a href="#">APP</a></li>
            <li><a href="#">赞助</a></li>
        </ul>
        <ul>
            <li><a href="#">关于</a></li>
            <li><a href="#">订阅</a></li>
            <li><a href="#">APP</a></li>
            <li><a href="#">赞助</a></li>   <li><a href="#">APP</a></li>
            <li><a href="#">赞助</a></li>
        </ul>
    </div>
</div>
    <div class="footer-bottom">
        <a href="#"><p>©Copyright 2020-2021 MIRAI | 未来 | 灵感工作室 | @备案号：冀10086-11</p></a>
    </div>
</footer>
</body>
</html>