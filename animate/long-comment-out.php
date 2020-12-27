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
    <link rel="shortcut icon" href="../image/favicon.ico">
    <script src="../js/jquery.js"></script>

</head>
<body>
<?php
session_start();
if (empty($_SESSION['user_id'])){
    /**
     * put the url into session,if exist
     */
    if(!empty($_SERVER['REQUEST_URI']))
        $_SESSION['LOGIN_REQUEST_URI']= $_SERVER['REQUEST_URI'];
    header('location:../user/login.php');
}else{
   $uid = $_SESSION['user_id'];
}

include "../header.php";
        include "../conn.php";
        include "../static/dao.php";
        $animate_id = empty($_GET['animate_id'])?100001:$_GET['animate_id'];
        $evaluation_id = empty($_GET['id'])?100022:$_GET['id'];
        $sql = "select animate_id,title,time,content,username,avatar,score from evaluation  join user on evaluation.user_id = user.user_id where evaluation_id = $evaluation_id;";
        $res =  queryOneRecord($conn,$sql);
        $sql2 = "select cover,name_jp,name_cn from animate where animate_id = $animate_id;";
        $res2 = queryOneRecord($conn,$sql2);
?>
<div  class="container">
    <div style="height: 30px">
    </div>
    <div class="row">
        <div class="l-comment-left col-lg-8 col-md-8 col-sm-12 col-xs-12">
           <div class="row">
               <div class="l-left col-lg-2 col-md-2 hidden-xs hidden-sm">
                        <div id="left-bar">
                            <a href="../animate/detail.php?animate_id=100001"><span class="l-bar"><span style="top: 2px;left: -3px" class="glyphicon glyphicon-film"></span>返回番剧</span></a>
                            <a href="../index.php"><span class="l-bar"><span style="top: 2px;left: -3px" class="glyphicon glyphicon-flag"></span>返回首页</span></a>
                            <a href="../index.php"><span class="l-bar"><span style="top: 2px;left: -3px" class="glyphicon glyphicon-search"></span>返回索引</span></a>
                        </div>
               </div>
               <div class="l-right col-lg-10 col-md-10 col-sm-12 col-xs-12">
                   <div class="l-cover">
                       <img src="<?php echo $res2['cover'];?>" alt="">
                   </div>
                   <div class="contain">
                       <div class="litle-cover">
                           <img src="<?php echo $res2['cover'];?>" alt="">
                           <div class="litle-cover-info">
                               <h6><?php echo $res2['name_cn'];?></h6>
                               <p><span style="margin-right: 5px">番剧</span> |<span style="margin-left: 5px">日本</span>  </p>
                               <span id="star"><?php echo $res2['name_jp'];?></span>
                           </div>
                       </div>
                       <div class="l-title">
                           <h1><?php echo $res['title'];?></h1>
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
                           <button  class="btn btn-lg nice-btn">
                            <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-up">
                            </span>点赞
                           </button>
                           <button  class="btn btn-lg nice-btn">
                            <span style="top:3px;left: -5px" class="glyphicon glyphicon-heart">
                            </span>关注
                           </button>
                           <button  class="btn btn-lg nice-btn">
                            <span style="top:3px;left: -5px" class="glyphicon glyphicon-star">
                            </span>收藏
                           </button>
                           <script>
                               $('.nice-btn').click(function () {
                                   $(this).css('color','#5bc0de');
                               });
                           </script>
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
                               <li>
                                   <div id="user-header" class="l-icon">
                                       <?php
                                                $sql = "select avatar,username from user where  user_id =$uid ;";
                                                $res3 = queryOneRecord($conn,$sql);
                                       ?>
                                       <img src="<?php echo $res3['avatar'];?>" alt="ghello">
                                   </div>
                                   <div class="l-main-commment">
                                       <div id="input-comment">
                                       <textarea id="comment-in-l" cols="80" name="msg" rows="5" placeholder="发条友善的评论" class="ipt-txt">

                                       </textarea>
                                           <button class="btn btn-default" id="l-btn">发表<br>评论</button>
                                       </div>
                                       <input id="uid" name="uid" value=" <?php echo $uid ?>" type="hidden">
                                       <input id="user_name" name="user_name" value=" <?php echo  $res3['username'];?>" type="hidden">
                                       <input id="eid" name="eid" value="<?php echo $evaluation_id;?>" type="hidden">
                                       <input id="picc" name="picc" value="<?php echo $res3['avatar'];?>" type="hidden">
                                   </div>
                               </li>
                           </ul>
                           <ul id="replay-ul">
                               <script>
                                   function getFormatDate(){
                                       var nowDate = new Date();
                                       var year = nowDate.getFullYear();
                                       var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1) : nowDate.getMonth() + 1;
                                       var date = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
                                       var hour = nowDate.getHours()< 10 ? "0" + nowDate.getHours() : nowDate.getHours();
                                       var minute = nowDate.getMinutes()< 10 ? "0" + nowDate.getMinutes() : nowDate.getMinutes();
                                       var second = nowDate.getSeconds()< 10 ? "0" + nowDate.getSeconds() : nowDate.getSeconds();
                                       return year + "-" + month + "-" + date+" "+hour+":"+minute+":"+second;
                                   }

                                   $('#l-btn').click(function () {
                                       var content = $('#comment-in-l').val()
                                       $.ajax({
                                           url:"replay-api.php",
                                           data:{action:"hello",uid:$('#uid').val(),eid:$('#eid').val(),repalyid:0,content:content},
                                           type:"POST",
                                           dataType:"json",
                                           success:function (da) {
                                               var str = getFormatDate();

                                               $('#user_name').val();
                                               var text = "         <li>\n" +
                                                   "                                  <div class=\"l-icon\">\n" +
                                                   "                                       <img src=\""+$('#picc').val()+"\" alt=\"ghello\">\n" +
                                                   "                                   </div>\n" +
                                                   "                                   <div id='"+da+"' class=\"l-main-commment\">\n" +
                                                   "                                       <div style=\"width: 100%;border-top: 1px #f4f5f7 solid;height: 1px\"></div>\n" +
                                                   "                                       <div class=\"l-user\">\n" +
                                                   "                                           "+$('#user_name').val()+" <span class=\"l-l-time\">"+str+"</span>\n" +
                                                   "                                       </div>\n" +
                                                   "                                       <p class=\"l-text\">"+content+"</p>\n" +
                                                   "                                       <div class=\"l-info\">\n" +
                                                   "                                           <button  class=\"btn btn-xs\">\n" +
                                                   "                                        <span style=\"top:3px;left: -5px\" class=\"glyphicon glyphicon-thumbs-up\">\n" +
                                                   "                                        </span>1080\n" +
                                                   "                                           </button>\n" +
                                                   "                                           <button  class=\"btn btn-xs\">\n" +
                                                   "                                        <span style=\"top:3px;left: -5px\" class=\"glyphicon glyphicon-thumbs-down\">\n" +
                                                   "                                        </span>\n" +
                                                   "                                           </button>\n" +
                                                   "                                           <button class=\"btn btn-xs low-in-low\">\n" +
                                                   "                                               回复\n" +
                                                   "                                           </button>\n" +
                                                   "                                       </div>\n" +
                                                   "                                   </div>\n" +
                                                   "                               </li>";

                                                       if (da==0){
                                                           alert("回复失败")
                                                       }else {
                                                           $('#replay-ul').prepend(text);
                                                       }
                                           }
                                       })
                                   });
                               </script>
                               <!--    一级回复-->
                               <?php
                                   $sql = "select reply_id,user.user_id,content,time,avatar,username
from reply JOIN user on user.user_id = reply.user_id 
where re_reply_id = 0 and evaluation_id = $evaluation_id order by time desc;";
                                  $res =  queryList($conn,$sql);
                                  foreach ($res as $item){
                                      $avatar = $item['avatar'];
                                      $reply_id = $item['reply_id'];
                                      $user_id = $item['user_id'];
                                      $content = $item['content'];
                                      $time = substr_max($item['time'],19);
                                      $username = $item['username'];
                                      echo "<li>
                                   <div class=\"l-icon\">
                                       <img src=\"$avatar\" alt=\"ghello\">
                                   </div>
                                   <div id='$reply_id' class=\"l-main-commment\">
                                       <div style=\"width: 100%;border-top: 1px #f4f5f7 solid;height: 1px\"></div>
                                       <div class=\"l-user\">
                                           $username<span class=\"l-l-time\">$time</span>
                                       </div>
                                       <p class=\"l-text\">$content</p>
                                        <div class=\"l-info\">
                                           <button  class=\"btn btn-xs\">
                                        <span style=\"top:3px;left: -5px\" class=\"glyphicon glyphicon-thumbs-up\">
                                        </span>1080
                                           </button>
                                           <button  class=\"btn btn-xs\">
                                        <span style=\"top:3px;left: -5px\" class=\"glyphicon glyphicon-thumbs-down\">
                                        </span>
                                           </button>
                                           <button class=\"btn btn-xs low-in-low\">
                                               回复
                                           </button>
                                       </div>
                                   </div>
                               </li>";
                                  }
                               ?>
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
                                           <button class="btn btn-xs low-in-low">
                                               回复
                                           </button>

                                       </div>
                                       <!--        二级回复-->
                                       <div class="l-replay">
                                           <div class="l-r-icon">
                                               <img src="../image/headerpic.jpg" alt="ghello">
                                           </div>
                                           <div class="l-r-main">
                                               <span class="l-r-replay-time">2020-12-18 16:44:12</span>
                                               <h6>燕山大学</h6>
                                               <p class="l-r-text">我是动画入的坑，</p>
                                               <div class="l-info">
                                                   <button  class="btn btn-xs">
                                                    <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-up">
                                                    </span>
                                                   </button>
                                                   <button  class="btn btn-xs">
                                                    <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-down">
                                                    </span>
                                                   </button>
                                                   <button class="btn btn-xs low-in-low">
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
                                               <h6>燕山大学</h6>
                                               <p class="l-r-text">
                                                   还不错吧
                                               </p>
                                               <button  class="btn btn-xs ">
                                            <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-down">
                                            </span>
                                               </button>
                                               <button class="btn btn-xs low-in-low">
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
                                       <div class="l-info">
                                           <button  class="btn btn-xs">
                                        <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-up">
                                        </span>1080
                                           </button>
                                           <button  class="btn btn-xs">
                                        <span style="top:3px;left: -5px" class="glyphicon glyphicon-thumbs-down">
                                        </span>
                                           </button>
                                           <button class="btn btn-xs low-in-low">
                                               回复
                                           </button>
                                       </div>
                                   </div>
                               </li>
                           </ul>
                           <script>
                               var i = 0;
                               $(document).on("click", ".low-in-low", function () {

                                  $('.louzhonglouhuifu').remove();
                                   var lowbtn =  $(this);
                                   var text = lowbtn.parent();
                                   var input = "<div class=\"louzhonglouhuifu\">\n" +
                                       "                                                       <textarea name=\"low-replay\" class=\"wodehuifu\" cols=\"10\" rows=\"10\"></textarea>\n" +
                                       "                                                       <button class=\"btn btn-xs tijiaolouzhonglou\">提交</button>\n" +
                                       "                                                       <button class=\"btn btn-xs quxiao\">取消</button>\n" +
                                       "                                       </div>";
                                       text.append(input);


                               })
                               $(document).on("click", ".tijiaolouzhonglou", function () {
                                   var hello = $(this).parent('div').children('.wodehuifu').val();
                                   var parent = $(this).parent().parent().parent();
                                   var id = parent.attr('id');
                                   var username= "<?php echo $res3['username'];?>";
                                   var piccc = "<?php echo $res3['avatar'];?>";
                                   // action:"hi",uid:$('#uid').val(),eid:$('#eid').val(),repalyid:id,content:content
                                   $.ajax({
                                       url:"replay-api.php",
                                       data:{action:"hi",uid:$('#uid').val(),eid:$('#eid').val(),repalyid:id,content:hello},
                                       type:"POST",
                                       dataType:"text",
                                       success:function (data) {
                                           var text = " <div class=\"l-replay\">\n" +
                                               "                 <div class=\"l-r-icon\">\n" +
                                               "                                               <img src=\""+piccc+"\" alt=\"ghello\">\n" +
                                               "                                           </div>\n" +
                                               "                                           <div class=\"l-r-main\">\n" +
                                               "                                               <span class=\"l-r-replay-time\">2020-12-18 16:44:12</span>\n" +
                                               "                                               <h6>"+username+"</h6>\n" +
                                               "                                               <p class=\"l-r-text\">"+hello+"</p>\n" +
                                               "                                               <div class=\"l-info\">\n" +
                                               "                                                   <button  class=\"btn btn-xs\">\n" +
                                               "                                                    <span style=\"top:3px;left: -5px\" class=\"glyphicon glyphicon-thumbs-up\">\n" +
                                               "                                                    </span>\n" +
                                               "                                                   </button>\n" +
                                               "                                                   <button  class=\"btn btn-xs\">\n" +
                                               "                                                    <span style=\"top:3px;left: -5px\" class=\"glyphicon glyphicon-thumbs-down\">\n" +
                                               "                                                    </span>\n" +
                                               "                                                   </button>\n" +
                                               "                                                   <button class=\"btn btn-xs low-in-low\">\n" +
                                               "                                                       回复\n" +
                                               "                                                   </button>\n" +
                                               "                                               </div>\n" +
                                               "                                           </div>\n" +
                                               "                                       </div>";
                                           parent.append(text);

                                       }
                                   });
                               });
                               $(document).on("click", ".quxiao", function () {
                                  $(this).parent().remove('.louzhonglouhuifu');
                               });
                               $(document).ready(function () {
                                   $.ajax({
                                       url:"replay-api.php",
                                       data:{action:"get"},
                                       type:"POST",
                                       dataType:"json",
                                       success:function (data) {
                                        data.forEach(function (val,index){
                                            var id = "#"+val.re_reply_id;
                                            var addtext = "<div class=\"l-replay\">\n" +
                                                "                                           <div class=\"l-r-icon\">\n" +
                                                "                                               <img src=\"../image/headerpic.jpg\" alt=\"ghello\">\n" +
                                                "                                           </div>\n" +
                                                "                                           <div class=\"l-r-main\">\n" +
                                                "                                               <span class=\"l-r-replay-time\">2020-12-18 16:44:12</span>\n" +
                                                "                                               <h6>"+val.username+"</h6>\n" +
                                                "                                               <p class=\"l-r-text\">"+val.content+ "                                               </p>\n" +
                                                "                                               <div class=\"l-info\">\n" +
                                                "                                                   <button  class=\"btn btn-xs\">\n" +
                                                "                                                    <span style=\"top:3px;left: -5px\" class=\"glyphicon glyphicon-thumbs-up\">\n" +
                                                "                                                    </span>\n" +
                                                "                                                   </button>\n" +
                                                "                                                   <button  class=\"btn btn-xs\">\n" +
                                                "                                                    <span style=\"top:3px;left: -5px\" class=\"glyphicon glyphicon-thumbs-down\">\n" +
                                                "                                                    </span>\n" +
                                                "                                                   </button>\n" +
                                                "                                                   <button class=\"btn btn-xs low-in-low\">\n" +
                                                "                                                       回复\n" +
                                                "                                                   </button>\n" +
                                                "                                               </div>\n" +
                                                "                                           </div>\n" +
                                                "                                       </div>";
                                            $(id).append(addtext);
                                        })
                                       }
                                   });
                               })
                           </script>

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
        </div>
        <div class="l-comment-right col-lg-3 col-md-3 hidden-sm hidden-xs">
               <div id="l-combar" class="comment-bar">
                <div class="bar-person">
                    <img src="../image/headerpic.jpg" alt="">
                </div>
               </div>
        </div>
        <script>
            $(document).scroll(function () {
                var scrolltopTemp=document.documentElement.scrollTop||document.body.scrollTop
                // console.log(scrolltopTemp);
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