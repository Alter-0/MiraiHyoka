<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guide</title>
    <link rel="stylesheet" href="guide.css" type="text/css">
    <script src="../js/main.js"></script>
</head>
<body>
<!--top begin-->
<div class="top">
    <iframe src="../header.php" scrolling="no"></iframe>
<!--    <div class="img1"><img src="" alt=""></div>-->
</div>
<!--top end-->

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
        <?php
            $is_finished=array("全部","完结","连载");
            $time=array("全部",2020,2019,2018,2016,2015,2014,"之前");
            $tags=array();
            $area=array("全部","日本","中国","欧美","其他");

            //                这部分具体命名要根据数据库来定
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
        ?>
        <div class="l-content">
            <ul>
             <?php
//                生成左边的封面和名字
                for($i=1;$i<=16;$i++){
                    echo  "<li>";
				    echo  "<div class='fengmian'><a href='' target='_blank'><img src='../image/huiye.jpeg' alt=''/></a><div>9.4</div></div>";
				    echo  "<p><a href='' target='_blank'>名字</a></p>";
			    	echo  "</li>";
                 }
              ?>
            </ul>
        </div>
        <div class="page">
            <?php
                    $num=159;
                    $pageall=ceil($num/16.0);

                    if(empty($_GET['pagenum'])){
                        $pagenum=1;
                    }else{
                        $pagenum=$_GET['pagenum'];
                    }
             ?>
            <ul>
                <li><a href="?pagenum=<?php echo $pagenum==1?1:($pagenum-1) ?>&is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>#content">上一页</a></li>
                <?php

                    if($pagenum<4){
                        echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>1</a></li>";
                        echo "<li><a href='?pagenum=2&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>2</a></li>";
                        echo "<li><a href='?pagenum=3&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>3</a></li>";
                        echo "<li><a href='?pagenum=4&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>4</a></li>";
                        echo "<li><a href='?pagenum=5&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>5</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".$pageall."</a></li>";
                     }else if($pagenum==4){
                        echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>1</a></li>";
                        echo "<li><a href='?pagenum=2&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>2</a></li>";
                        echo "<li><a href='?pagenum=3&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>3</a></li>";
                        echo "<li><a href='?pagenum=4&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>4</a></li>";
                        echo "<li><a href='?pagenum=5&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>5</a></li>";
                        echo "<li><a href='?pagenum=6&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>6</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".$pageall."</a></li>";
                    }else if($pagenum>4&&$pagenum<($pageall-3)){
                        echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>1</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".($pagenum-2)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".($pagenum-2)."</a></li>";
                        echo "<li><a href='?pagenum=".($pagenum-1)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".($pagenum-1)."</a></li>";
                        echo "<li><a href='?pagenum=".$pagenum."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".$pagenum."</a></li>";
                        echo "<li><a href='?pagenum=".($pagenum+1)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".($pagenum+1)."</a></li>";
                        echo "<li><a href='?pagenum=".($pagenum+2)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".($pagenum+2)."</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".$pageall."</a></li>";
                    }else if($pagenum>=($pageall-3)){
                        echo "<li><a href='?pagenum=1&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>1</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".($pageall-4)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".($pageall-4)."</a></li>";
                        echo "<li><a href='?pagenum=".($pageall-3)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".($pageall-3)."</a></li>";
                        echo "<li><a href='?pagenum=".($pageall-2)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".($pageall-2)."</a></li>";
                        echo "<li><a href='?pagenum=".($pageall-1)."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".($pageall-1)."</a></li>";
                        echo "<li><a href='?pagenum=".$pageall."&is_finished=$get_is_finished&time=$get_time&tags=$get_tags&area=$get_area#content'>".$pageall."</a></li>";
                    }

                ?>
                <li><a href="?pagenum=<?php echo $pagenum==$pageall?$pageall:($pagenum+1) ?>&is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>#content">下一页</a></li>
            </ul>
        </div>
    </div>
    <div class="right">
        <div class="r-title">筛选</div>
        <div class="r-tag">
            <div class="filter-block">
                <div class="filter-name">状态</div>
                <ul>
                    <li><a href="?is_finished=0&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">全部</a></li>
                    <li><a href="?is_finished=1&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">完结</a></li>
                    <li><a href="?is_finished=2&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">连载</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">时间</div>
                <ul>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=0&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">全部</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=1&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">2020</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=2&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">2019</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=3&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">2018</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=4&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">2017</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=5&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">2016</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=6&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">2015</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=7&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">2014</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=8&tags=<?php echo "$get_tags"?>&area=<?php echo "$get_area"?>">之前</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">标签</div>
                <ul>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=0&area=<?php echo "$get_area"?>">全部</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=1&area=<?php echo "$get_area"?>">标签</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=2&area=<?php echo "$get_area"?>">标签</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=3&area=<?php echo "$get_area"?>">标签</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=4&area=<?php echo "$get_area"?>">标签</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=5&area=<?php echo "$get_area"?>">标签</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=6&area=<?php echo "$get_area"?>">标签</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=7&area=<?php echo "$get_area"?>">标签</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=8&area=<?php echo "$get_area"?>">标签</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">地区</div>
                <ul>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=0">全部</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=1">日本</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=2">中国</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=3">欧美</a></li>
                    <li><a href="?is_finished=<?php echo "$get_is_finished"?>&time=<?php echo "$get_time"?>&tags=<?php echo "$get_tags"?>&area=4">其他</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--cotent end-->
</body>
<script type="text/javascript">
    window.addEventListener('load', function() {
        var pagenum="<?php echo  $pagenum ?>";
        var pageall="<?php echo  $pageall ?>";
        pagenum=parseInt(pagenum);
        pageall=parseInt(pageall);
        if(pagenum<=4){
          var li= document.querySelector(".content .left .page li:nth-child(<?php echo ($pagenum+1); ?>)");
        }else if(pagenum>4&&pagenum<(pageall-3)){
          var li= document.querySelector(".content .left .page li:nth-child(5)");
        }else if(pagenum>=((pageall-3))){
          var li= document.querySelector(".content .left .page li:nth-last-child(<?php echo ($pageall-$pagenum+2); ?>)");
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
    <?php
        if(empty($_GET['choosen'])){
            $choosen=2;
        }else{
            $choosen=$_GET['choosen'];
        }
    ?>
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
