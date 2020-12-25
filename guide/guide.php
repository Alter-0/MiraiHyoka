<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8" name="referrer" content="never">
    <title>Guide</title>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <?php session_start();?>
<!--    本页面的css样式-->
    <link rel="stylesheet" href="guide.css" type="text/css">
</head>
<body>
<!--top begin-->
<!--<div class="top">-->
<!--    <iframe src="../header.php" scrolling="no"></iframe>-->
<!--    <div class="img1"><img src="" alt=""></div>-->
<!--</div>-->
<!--top end-->
<?php include "../header.php"?>
<!--content begin-->
<div class="content" id="content">
    <div class="left">
        <div class="l-title">
            <ul>
                <li class="sort_item">
                    <i class="up"></i>
                    <span>评分最高</span>
                    <i class="down"></i>
                </li>
                <li class="sort_item">
                    <i class="up"></i>
                    <span>更新时间</span>
                    <i class="down"></i>
                </li>
            </ul>
        </div>
        <!-- 数据库相关的内容 -->
        <?php

//            取get
            $is_finished=array("全部",1,0);  //具体可能根据数据库进行修改
            $time=array(2021,2020,2019,2018,2017,2016,2015,2014,2014);
            $tags=array("全部","奇幻","剧情","喜剧","战争","爱情","动作","科幻","犯罪");
            $area=array("全部","日本","中国","欧美","其他");
            //这部分具体命名要根据数据库来定
            if(empty($_GET['is_finished'])){
                $get_is_finished=0;
            }else{
                $get_is_finished=$_GET['is_finished'];
            }
            if(empty($_GET['time'])){
                $get_time=0;
            }else{
                $get_time=$_GET['time'];
            }
            if(empty($_GET['tags'])){
                $get_tags=0;
            }else{
                $get_tags=$_GET['tags'];
            }
            if(empty($_GET['area'])){
                $get_area=0;
            }else{
                $get_area=$_GET['area'];
            }

//            连接数据库
            include  "../conn.php";
//            $conn = mysqli_connect("47.115.15.18", "wangyesheji", "e7BLUzfQv69wXybN", "web_design") or die("数据库连接失败");
//            mysqli_query($conn,'set names utf8');

            $is_where=0;
            $cover=array();//这里存放封面
            $name=array();
            $rating=array();
            $animate_id=array();

            $sql= "select * from animate";
            $sql1="select count(animate_id) from animate";
//            判断是否有完结条件
            if($get_is_finished!=0){
                if($is_where==0){
                    $sql.=" where is_finish =$is_finished[$get_is_finished]";
                    $sql1.=" where is_finish =$is_finished[$get_is_finished]";
                    $is_where=1;
                }else{
                    $sql.=" and is_finish=$is_finished[$get_is_finished]";
                    $sql1.=" and is_finish=$is_finished[$get_is_finished]";
                }
            }

//            判断是否有时间条件
            if($get_time!=0){
                if($is_where==0){
                    if($get_time!=8){
                        $sql.=" where year(start_time) = $time[$get_time]" ;
                        $sql1.=" where year(start_time) = $time[$get_time]" ;
                    }else{
                        $sql.=" where year(start_time)<$time[8]";
                        $sql1.=" where year(start_time)<$time[8]";
                    }
                    $is_where=1;
                }else{
                    if($get_time!=8){
                        $index_time=$get_time-1;
                        $sql.=" and year(start_time) = $time[$get_time] ";
                        $sql1.=" and year(start_time) = $time[$get_time] ";
                    }else{
                        $sql.=" and year(start_time)<$time[8]";
                        $sql1.=" and year(start_time)<$time[8]";
                    }
                }
            }

//            判断地区是否有条件
            if($get_area!=0){
                if($is_where==0){
                    $sql.=" where area like '%$area[$get_area]%'";
                    $sql1.=" where area like '%$area[$get_area]%'";
                    $is_where=1;
                }else{
                    $sql.=" and area like '%$area[$get_area]%'";
                    $sql1.=" and area like '%$area[$get_area]%'";
                }
            }

//            判断是否有标签条件
            if($get_tags!=0){
                if($is_where==0){
                    $sql.=" where animate_id in (select animate.animate_id from animate,tags where animate.animate_id=tags.animate_id and tag like '%$tags[$get_tags]%')";
                    $sql1.=" where animate_id in (select animate.animate_id from animate,tags where animate.animate_id=tags.animate_id and tag like '%$tags[$get_tags]%')";
                    $is_where=1;
                }else{
                    $sql.=" and animate_id in (select animate.animate_id from animate,tags where animate.animate_id=tags.animate_id and tag like '%$tags[$get_tags]%')";
                    $sql1.=" and animate_id in (select animate.animate_id from animate,tags where animate.animate_id=tags.animate_id and tag like '%$tags[$get_tags]%')";
                }
            }
//            判断排序
            if(empty($_GET['choosen'])){
                $choosen=2;
            }else{
                $choosen=$_GET['choosen'];
            }

            if($choosen==1){
                $sql.=" order by media_rating ASC";
            }
            if($choosen==2){
                $sql.=" order by media_rating DESC";
            }
            if($choosen==3){
                $sql.=" order by start_time ASC";
            }
            if($choosen==4){
                $sql.=" order by start_time DESC";
            }
//            判断有多少条内容
            //            页码
//          $num=mysqli_num_rows($result1);
            $result1=mysqli_query($conn,$sql1) or die("sql语句执行失败".$sql1);
            $row=mysqli_fetch_row($result1);
            $num=$row[0];
            $pageall=ceil($num/16.0);

            if(empty($_GET['pagenum'])){
                $pagenum=1;
            }else{
                $pagenum=$_GET['pagenum'];
            }
            //            判断页码
            $limit_start_num=($pagenum-1)*16;
            $sql.=" limit $limit_start_num,16";
//            执行sql语句
            $result2=mysqli_query($conn,$sql) or die("sql语句执行失败".$sql);
            if(mysqli_num_rows($result2)){
                while ($row=mysqli_fetch_assoc($result2)){
                    $cover[]=$row['cover'];
                    $name[]=$row["name_cn"];
                    $rating[]=$row["media_rating"];
                    $animate_id[]=$row['animate_id'];
                }
            }
//            数据库相关代码结束处

        ?>
        <div class="l-content">
            <ul>
             <?php
                if($pagenum<$pageall){
//                生成左边的封面和名字
                    for($i=0;$i<16;$i++){
                        $this_rate=sprintf("%.1f",$rating[$i]);
                        echo  "<li>";
                        echo  "<div class='fengmian'><a href='../animate/detail.php?id=$animate_id[$i]' target='_blank'><img src='$cover[$i]' alt=''/></a><div> $this_rate</div></div>";
                        echo  "<p><a href='../animate/detail.php?id=$animate_id[$i]' target='_blank'>$name[$i]</a></p>";
                        echo  "</li>";
                     }
                }else{
                    $last_num=$num-(($pageall-1)*16);
                    if(!empty($rating)){
                        for($i=0;$i<$last_num;$i++){
                            $this_rate=sprintf("%.1f",$rating[$i]);
                            echo  "<li>";
                            echo  "<div class='fengmian'><a href='../animate/detail.php?id=$animate_id[$i]' target='_blank'><img src='$cover[$i]' alt=''/></a><div> $this_rate</div></div>";
                            echo  "<p><a href='../animate/detail.php?id=$animate_id[$i]' target='_blank'>$name[$i]</a></p>";
                            echo  "</li>";
                        }
                    }else{
                            echo "<h2 class='there_no_data'>暂无数据</h2>";
                    }
                }
              ?>
            </ul>
        </div>
        <div class="page">
<!--            --><?php
//                    $num=159;
//                    $pageall=ceil($num/16.0);
//
//                    if(empty($_GET['pagenum'])){
//                        $pagenum=1;
//                    }else{
//                        $pagenum=$_GET['pagenum'];
//                    }
//             ?>
            <ul>
                <li><a href="?pagenum=<?php echo $pagenum==1?1:($pagenum-1) ?>&is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>#content">上一页</a></li>
                <?php
                    if($pageall<=9){
                        if($pageall<=6){
                            for($j=1;$j<=$pageall;$j++){
                            echo "<li><a href='?pagenum=$j&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>$j</a></li>";
                            }
                        }else if($pageall>6){
                            if($pagenum<6){
                                for($j=1;$j<=6;$j++) {
                                    echo "<li><a href='?pagenum=$j&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>$j</a></li>";
                                }
                                echo "    ...    ";
                                echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".$pageall."</a></li>";
                            } else{
                                 echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>1</a></li>";
                                 echo "    ...    ";
                                 for($j=1;$j<=($pageall-4);$j++){
                                    $pagenum_now=(4+$j);
                                    echo "<li><a href='?pagenum=$pagenum_now&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>$pagenum_now</a></li>";
                                    }
                            }
                        }
                    }else{
                        if($pagenum<4){
                            echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>1</a></li>";
                            echo "<li><a href='?pagenum=2&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>2</a></li>";
                            echo "<li><a href='?pagenum=3&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>3</a></li>";
                            echo "<li><a href='?pagenum=4&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>4</a></li>";
                            echo "<li><a href='?pagenum=5&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>5</a></li>";
                            echo "    ...    ";
                            echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".$pageall."</a></li>";
                         }else if($pagenum==4){
                            echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>1</a></li>";
                            echo "<li><a href='?pagenum=2&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>2</a></li>";
                            echo "<li><a href='?pagenum=3&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>3</a></li>";
                            echo "<li><a href='?pagenum=4&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>4</a></li>";
                            echo "<li><a href='?pagenum=5&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>5</a></li>";
                            echo "<li><a href='?pagenum=6&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>6</a></li>";
                            echo "    ...    ";
                            echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".$pageall."</a></li>";
                        }else if($pagenum>4&&$pagenum<($pageall-3)){
                            echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>1</a></li>";
                            echo "    ...    ";
                            echo "<li><a href='?pagenum=".($pagenum-2)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".($pagenum-2)."</a></li>";
                            echo "<li><a href='?pagenum=".($pagenum-1)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".($pagenum-1)."</a></li>";
                            echo "<li><a href='?pagenum=".$pagenum."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".$pagenum."</a></li>";
                            echo "<li><a href='?pagenum=".($pagenum+1)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".($pagenum+1)."</a></li>";
                            echo "<li><a href='?pagenum=".($pagenum+2)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".($pagenum+2)."</a></li>";
                            echo "    ...    ";
                            echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".$pageall."</a></li>";
                        }else if($pagenum>=($pageall-3)){
                            echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>1</a></li>";
                            echo "    ...    ";
                            echo "<li><a href='?pagenum=".($pageall-4)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".($pageall-4)."</a></li>";
                            echo "<li><a href='?pagenum=".($pageall-3)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".($pageall-3)."</a></li>";
                            echo "<li><a href='?pagenum=".($pageall-2)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".($pageall-2)."</a></li>";
                            echo "<li><a href='?pagenum=".($pageall-1)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".($pageall-1)."</a></li>";
                            echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area&choosen=$choosen#content'>".$pageall."</a></li>";
                    }}
                ?>
                <li><a href="?pagenum=<?php echo $pagenum==$pageall?$pageall:($pagenum+1) ?>&is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>#content">下一页</a></li>
            </ul>
        </div>
    </div>
    <div class="right">
        <div class="r-title">筛选</div>
        <div class="r-tag">
            <div class="filter-block">
                <div class="filter-name">状态</div>
                <ul>
                    <li><a href="?is_finished=0&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">全部</a></li>
                    <li><a href="?is_finished=1&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">完结</a></li>
                    <li><a href="?is_finished=2&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">连载</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">时间</div>
                <ul>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=0&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">全部</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=1&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">2020</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=2&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">2019</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=3&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">2018</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=4&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">2017</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=5&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">2016</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=6&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">2015</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=7&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">2014</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=8&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">之前</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">标签</div>
                <ul>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=0&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">全部</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=1&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">奇幻</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=2&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">剧情</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=3&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">喜剧</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=4&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">战争</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=5&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">爱情</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=6&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">动作</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=7&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">科幻</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=8&area=<?php echo "$get_area"?>&choosen=<?php echo $choosen?>">犯罪</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">地区</div>
                <ul>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=0&choosen=<?php echo $choosen?>">全部</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=1&choosen=<?php echo $choosen?>">日本</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=2&choosen=<?php echo $choosen?>">中国</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=3&choosen=<?php echo $choosen?>">欧美</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=4&choosen=<?php echo $choosen?>">其他</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--cotent end-->
<!--footer-->
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
<script type="text/javascript">
    window.addEventListener('load', function() {
        var pagenum="<?php echo  $pagenum ?>";
        var pageall="<?php echo  $pageall ?>";
        pagenum=parseInt(pagenum);
        pageall=parseInt(pageall);

        if(pageall<=9){
            if(pageall<=6){
               var li= document.querySelector(".content .left .page li:nth-child(<?php echo ($pagenum+1); ?>)");
            }else if(pageall>6){
                if(pagenum<6){
                    var li= document.querySelector(".content .left .page li:nth-child(<?php echo ($pagenum+1); ?>)");
                }else{
                    var li= document.querySelector(".content .left .page li:nth-child(<?php echo ($pagenum-2); ?>)");
                }
            }
        }else{
            if(pagenum<=4){
              var li= document.querySelector(".content .left .page li:nth-child(<?php echo ($pagenum+1); ?>)");
            }else if(pagenum>4&&pagenum<(pageall-3)){
              var li= document.querySelector(".content .left .page li:nth-child(5)");
            }else if(pagenum>=((pageall-3))){
              var li= document.querySelector(".content .left .page li:nth-last-child(<?php echo ($pageall-$pagenum+2); ?>)");
            }
        }
        li.onclick=function(){
            return false;}
        li.setAttribute("class","l_page_on");

        if(pagenum==1){
            var li1= document.querySelector(".content .left .page li:nth-child(1)");
            li1.onclick=function(){
                return false;}

        }else if(pagenum==pageall){
            var li1= document.querySelector(".content .left .page li:last-child");
            li1.onclick=function(){
                return false;}
        }
        var r_li1=document.querySelector(".filter-block:nth-child(1) li:nth-child(<?php echo ($get_is_finished+1) ?>)");
        var r_li2=document.querySelector(".filter-block:nth-child(2) li:nth-child(<?php echo ($get_time+1) ?>)");
        var r_li3=document.querySelector(".filter-block:nth-child(3) li:nth-child(<?php echo ($get_tags+1) ?>)");
        var r_li4=document.querySelector(".filter-block:nth-child(4) li:nth-child(<?php echo ($get_area+1)?>)");
        r_li1.setAttribute("class","r_li_on");
        r_li2.setAttribute("class","r_li_on");
        r_li3.setAttribute("class","r_li_on");
        r_li4.setAttribute("class","r_li_on");
        })


</script>
<!--筛选条件-->
<script>
    var choosen = <?php echo $choosen ?>;
    choosen=parseInt(choosen);

    $(document).ready(function (){
        if (choosen<=2){
            $(".sort_item:first i:eq(<?php echo ($choosen-1) ?>)").css("border-color","#00a1d6 rgba(0,0,0,0)");
        }else{
            $(".sort_item:last i:eq(<?php echo ($choosen-3) ?>)").css("border-color","#00a1d6 rgba(0,0,0,0)");
        }
        // 点击第一个筛选条件
        $(".sort_item:first").click(function(){
            if(choosen==2){
                window.location.href="?choosen=1&is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>";
            }else{
                window.location.href="?choosen=2&is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>";
            }
        })
        // // 点击第二个筛选条件
        $(".sort_item:last").click(function(){
            if(choosen==4){
                window.location.href="?choosen=3&is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>"
            }else{
                window.location.href="?choosen=4&is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>"
            }
        })
    })

</script>
</html>