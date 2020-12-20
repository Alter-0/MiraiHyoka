<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guide</title>
    <link rel="stylesheet" href="guide.css" type="text/css">
</head>
<body>
<!--top begin-->
<div class="top">
    <iframe  scrolling="no" src=""></iframe>
    <div class="img1"><img src="" alt=""></div>
</div>
<!--top end-->

<!--content begin-->
<div class="content" id="content">
    <div class="left">
        <div class="l-title">番剧</div>
        <div class="l-content">
            <ul>
             <?php

                for($i=1;$i<=16;$i++){
                    echo  "<li>";
				    echo  "<div><a href='' target='_blank'><img src='image/1.jpg' alt=''/></a></div>";
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
                <li><a href="?pagenum=<?php echo $pagenum==1?1:($pagenum-1) ?>#content">上一页</a></li>
                <?php

                    if($pagenum<4){
                        echo "<li><a href='?pagenum=1#content'>1</a></li>";
                        echo "<li><a href='?pagenum=2#content'>2</a></li>";
                        echo "<li><a href='?pagenum=3#content'>3</a></li>";
                        echo "<li><a href='?pagenum=4#content'>4</a></li>";
                        echo "<li><a href='?pagenum=5#content'>5</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".$pageall."#content'>".$pageall."</a></li>";
                     }else if($pagenum==4){
                        echo "<li><a href='?pagenum=1#content'>1</a></li>";
                        echo "<li><a href='?pagenum=2#content'>2</a></li>";
                        echo "<li><a href='?pagenum=3#content'>3</a></li>";
                        echo "<li><a href='?pagenum=4#content'>4</a></li>";
                        echo "<li><a href='?pagenum=5#content'>5</a></li>";
                        echo "<li><a href='?pagenum=6#content'>6</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".$pageall."#content'>".$pageall."</a></li>";
                    }else if($pagenum>4&&$pagenum<($pageall-4)){
                        echo "<li><a href='?pagenum=1#content'>1</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".($pagenum-2)."#content'>".($pagenum-2)."</a></li>";
                        echo "<li><a href='?pagenum=".($pagenum-1)."#content'>".($pagenum-1)."</a></li>";
                        echo "<li><a href='?pagenum=".$pagenum."#content'>".$pagenum."</a></li>";
                        echo "<li><a href='?pagenum=".($pagenum+1)."#content'>".($pagenum+1)."</a></li>";
                        echo "<li><a href='?pagenum=".($pagenum+2)."#content'>".($pagenum+2)."</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".$pageall."#content'>".$pageall."</a></li>";
                    }else if($pagenum>=($pageall-4)){
                        echo "<li><a href='?pagenum=1#content'>1</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=".($pageall-4)."#content'>".($pageall-4)."</a></li>";
                        echo "<li><a href='?pagenum=".($pageall-3)."#content'>".($pageall-3)."</a></li>";
                        echo "<li><a href='?pagenum=".($pageall-2)."#content'>".($pageall-2)."</a></li>";
                        echo "<li><a href='?pagenum=".($pageall-1)."#content'>".($pageall-1)."</a></li>";
                        echo "<li><a href='?pagenum=".$pageall."#content'>".$pageall."</a></li>";
                    }

                ?>
                <li><a href="?pagenum=<?php echo $pagenum==$pageall?$pageall:($pagenum+1) ?>#content">下一页</a></li>
            </ul>
        </div>
    </div>
    <div class="right">
        <div class="r-title">筛选</div>
        <div class="r-tag">
            <div class="filter-block">
                <div class="filter-name">状态</div>
                <ul>
                    <li><a href="">全部</a></li>
                    <li><a href="#?#content">完结</a></li>
                    <li><a href="">连载</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">时间</div>
                <ul>
                    <li><a href="">全部</a></li>
                    <li><a href="">2020</a></li>
                    <li><a href="">2019</a></li>
                    <li><a href="">2018</a></li>
                    <li><a href="">2017</a></li>
                    <li><a href="">2016</a></li>
                    <li><a href="">2015</a></li>
                    <li><a href="">2014</a></li>
                    <li><a href="">之前</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">标签</div>
                <ul>
                    <li><a href="">全部</a></li>
                    <li><a href="">标签</a></li>
                    <li><a href="">标签</a></li>
                    <li><a href="">标签</a></li>
                    <li><a href="">标签</a></li>
                    <li><a href="">标签</a></li>
                    <li><a href="">标签</a></li>
                    <li><a href="">标签</a></li>
                    <li><a href="">标签</a></li>
                </ul>
            </div>
            <div class="filter-block">
                <div class="filter-name">地区</div>
                <ul>
                    <li><a href="">全部</a></li>
                    <li><a href="">日本</a></li>
                    <li><a href="">中国</a></li>
                    <li><a href="">欧美</a></li>
                    <li><a href="">其他</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--cotent end-->
<?php

?>
</body>
<script>
        var li= document.querySelector(".content .left .page li:nth-child(<?php echo ($pagenum+1); ?>)");
        li.onclick=function(){
            return false;}

</script>
</html>