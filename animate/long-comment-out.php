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
<?php
        include "../header.php";
        include "../conn.php";
        include "../static/dao.php";
        $commentid = empty($_GET['id'])?100021:$_GET['id'];
        $sql = "select animate_id,title,time,content,username,avatar,score from evaluation  join user on evaluation.user_id = user.user_id where evaluation_id = $commentid;";
        $res =  queryOneRecord($conn,$sql);

?>

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
                        <img src="img/misakaka.webp" alt="">
                        <div class="litle-cover-info">
                            <h6><?php echo $res['title'];?></h6>
                            <p><span style="margin-right: 5px">番剧</span> |<span style="margin-left: 5px">日本</span>  </p>
                            <span id="star">hello</span>
                        </div>
                   </div>
                   <div class="l-title">
                       <h1>某科学的超电磁炮</h1>
                       <div class="l-info">
                           <span>
                               访问量 100
                           </span>
                           <span>
                               点赞 99
                           </span>
                           <span>
                            评论18
                           </span>
                        </div>
                        <div id="comment-content">
                          <p> <?php echo $res['content'];?></p>
                       </div>
                   </div>
<!--                    长评的评论部分-->
<!--                   文章底栏，标签部分-->
                   <div class="l-mark">
                       <p>

                                本文禁止转载或摘编

                       </p>

                       <p>
                           本文为个人创作
                       </p>
                   </div>
                   <div class="l-tag">
                            <div class="l-tag-one">
                              <p>  标签函数</p>
                            </div>
                       <div class="l-tag-one">
                           <p>  标签函数</p>
                       </div>
                       <div class="l-tag-one">
                           <p> 某科学的超电磁炮</p>
                       </div>
                   </div>
                   <div class="l-nice">
                       <button  class="btn btn-lg">
                            <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-up">
                            </span>点赞
                       </button>
                       <button  class="btn btn-lg">
                            <span style="top:3px;left: -5px" class="glyphicon glyphicon-heart">
                            </span>关注
                       </button>
                       <button  class="btn btn-lg">
                            <span style="top:3px;left: -5px" class="glyphicon glyphicon-star">
                            </span>收藏
                       </button>
                   </div>
                   <h3 id="comment-num">888 评论</h3>
                   <div class="l-commnent-header">
                       <ul>
                           <li id="frist-li">按时间排序</li>
                           <li style="margin-left: 12px">按热度排序</li>
                       </ul>
                   </div>
                   <div id="l-in-comment">
                       <ul>
                            <!--    一级回复-->
                           <li>
                               <div id="user-header" class="l-icon">
                                   <img src="../image/headerpic.jpg" alt="ghello">
                               </div>
                               <div class="l-main-commment">
                                   <div id="input-comment">
                                       <textarea cols="80" name="msg" rows="5" placeholder="发条友善的评论" class="ipt-txt">

                                       </textarea>
                                       <button class="btn btn-default" id="l-btn">发表<br>评论</button>
                                   </div>
                               </div>
                           </li>
                           <li>
                               <div class="l-icon">
                                   <img src="../image/headerpic.jpg" alt="ghello">
                               </div>
                               <div class="l-main-commment">
                                   <div style="width: 100%;border-top: 1px #f4f5f7 solid;height: 1px"></div>
                                   <div class="l-user">
                                       樱岛麻衣 <span class="l-l-time">2020-12-18 16:44:12</span>
                                   </div>
                                   <p class="l-text">坚持心中的信念，做出正确的选择。我们从白井黑子身上可以学到很多很多。她不仅仅是一个大众眼中的“hentai”，她也不仅仅是美琴的学妹，她拥有的闪光点更多的是独立人格。期待炮三的美山篇，希望大家可以看到帅气的黑子 2020-01-29 01:06 483
                                   </p>
                                   <div class="l-info">
                                       <button  class="btn btn-xs">
                                        <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-up">
                                        </span>1080
                                       </button>
                                       <button  class="btn btn-xs">
                                        <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-down">
                                        </span>
                                       </button>
                                       <button class="btn btn-xs">
                                           回复
                                       </button>
                                   </div>
                                   <div class="l-replay">
                                       <div class="l-r-icon">
                                           <img src="../image/headerpic.jpg" alt="ghello">
                                       </div>
                                <!--        二级回复-->
                                       <div class="l-r-main">
                                           <span class="l-r-replay-time">2020-12-18 16:44:12</span>
                                           <h6>你妈的</h6>
                                           <p class="l-r-text">我是动画入的坑，记得当年看完超炮，就一直在感叹，黑子才是四人组中最冷静最坚守自己信条的那一个（其实动画对黑仔的塑造也很不错，虽然加强了hentai属性，但只是日常的调味剂而已，我也是不懂为什么很多人只看到了黑仔的hentai而忽略了其他） 后来去补了漫画，我次奥老黑好帅啊，减少了hentai属性的黑子，真的帅爆！但不变的依旧是她的内心，不论是在动画里还是漫画里（原著没看过，不过看过很多粉丝贴的原著片段，应该也是一样），黑子始终是那个站在光明的一侧，努力追寻心中的正义，坚强、睿智、冷静又敏感的风纪委员；始终是那个对他人保持着淑女礼仪君子之交，对朋友关心照顾包容体贴的常盘台“大小姐”；始终是那个不会过多追问，默默守护在身旁，竭尽全力去帮助她，适时的hentai一下帮她缓解紧张悲伤心情的，乖巧完美的学妹，御坂美琴的白井黑子。 她也有缺点，为了坚持正义总让自己深陷危机，伤痕累累，河马对黑子可能是有多爱就要有多虐？始终没让黑子接触学园都市的黑暗面，让她行走于光明之中，却也总是让她受各种各样或大或小的伤，心疼我老黑…… 看超炮也好多年了，越来越爱黑子，越来越爱小琴琴，当然也越来越爱黑琴，官配什么的我不管，美琴喜不喜欢当麻我也不管，黑子和美琴的羁绊就摆在那里，更何况，上茵不倒，我黑琴就长青[doge] 期待大霸星祭老黑再次被小琴琴攻略，两人的羁绊再次发光发热，期待老黑主场的美山篇！ 白井黑子我爱你！！！[打call] 黑琴赛高！黑琴赛高！！黑琴赛高！！！[打call]
                                              </p>
                                            <div class="l-info">
                                                <button  class="btn btn-xs">
                                                    <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-up">
                                                    </span>
                                                </button>
                                                <button  class="btn btn-xs">
                                                    <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-down">
                                                    </span>
                                                </button>
                                                <button class="btn btn-xs">
                                                    回复
                                                </button>
                                            </div>
                                       </div>
                                   </div>
                                   <div class="l-replay">
                                       <div class="l-r-icon">
                                           <img src="../image/headerpic.jpg" alt="ghello">
                                       </div>
                                       <div class="l-r-main">
                                           <h6>你妈的</h6>
                                           <p class="l-r-text">
                                               还不错吧
                                           </p>
                                           <button  class="btn btn-xs">
                                            <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-down">
                                            </span>
                                           </button>
                                           <button class="btn btn-xs">
                                               回复
                                           </button>
                                       </div>
                                   </div>
                               </div>
                           </li>
                           <li>
                               <div class="l-icon">
                                   <img src="../image/headerpic.jpg" alt="ghello">
                               </div>
                               <div class="l-main-commment">
                                   <div style="width: 100%;border-top: 1px #f4f5f7 solid;height: 1px"></div>
                                   <div class="l-user">
                                       bilibili <span class="l-l-time">2020-12-18 16:44:12</span>
                                   </div>
                                   <p class="l-text">我是动画入的坑，记得当年看完超炮，就一直在感叹，黑子才是四人组中最冷静最坚守自己信条的那一个（其实动画对黑仔的塑造也很不错，虽然加强了hentai属性，但只是日常的调味剂而已，我也是不懂为什么很多人只看到了黑仔的hentai而忽略了其他） 后来去补了漫画，我次奥老黑好帅啊，减少了hentai属性的黑子，真的帅爆！但不变的依旧是她的内心，不论是在动画里还是漫画里（原著没看过，不过看过很多粉丝贴的原著片段，应该也是一样），黑子始终是那个站在光明的一侧，努力追寻心中的正义，坚强、睿智、冷静又敏感的风纪委员；始终是那个对他人保持着淑女礼仪君子之交，对朋友关心照顾包容体贴的常盘台“大小姐”；始终是那个不会过多追问，默默守护在身旁，竭尽全力去帮助她，适时的hentai一下帮她缓解紧张悲伤心情的，乖巧完美的学妹，御坂美琴的白井黑子。 她也有缺点，为了坚持正义总让自己深陷危机，伤痕累累，河马对黑子可能是有多爱就要有多虐？始终没让黑子接触学园都市的黑暗面，让她行走于光明之中，却也总是让她受各种各样或大或小的伤，心疼我老黑…… 看超炮也好多年了，越来越爱黑子，越来越爱小琴琴，当然也越来越爱黑琴，官配什么的我不管，美琴喜不喜欢当麻我也不管，黑子和美琴的羁绊就摆在那里，更何况，上茵不倒，我黑琴就长青[doge] 期待大霸星祭老黑再次被小琴琴攻略，两人的羁绊再次发光发热，期待老黑主场的美山篇！ 白井黑子我爱你！！！[打call] 黑琴赛高！黑琴赛高！！黑琴赛高！！！[打call]
                                   </p>
                               </div>
                           </li>
                       </ul>
                       <ul>
                           <li>
                               <div class="l-icon">

                               </div>
                           </li>
                           <li></li>
                           <li></li>
                           <li></li>
                           <li></li>
                           <li></li>
                           <li></li>
                           <li></li>
                       </ul>
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
<?php  include "../footer.php";?>
</body>
</html>