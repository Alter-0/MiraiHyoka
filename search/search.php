<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>search</title>
<!--    <script src="../js/main.js"></script>-->
<!--    本页面的css样式-->
    <link rel="stylesheet" href="search.css" type="text/css">

</head>
<body>
<!--top begin-->
<!--top end-->

<!--search begin-->
<div class="search">
<!--        没有搜索内容的时候-->
    <?php
        if(empty($_GET['content'])){
    ?>
        <script type="text/javascript">
            var img = document.createElement("img");
            img.setAttribute("class", "img_no");
            img.setAttribute("src","img/bg1.png");
            img.setAttribute("height",window.innerHeight);
            document.body.appendChild(img);
            window.onresize = function(){
            img.setAttribute("height",window.innerHeight);
            }
            var no =document.querySelector(".search");
            no.style.margin="0";
            no.style.position="absolute";
            no.style.top="50%";
            no.style.left="50%";
            no.style.transform="translate(-50%,-50%)";
        </script>
        <form method="get" action="" class="no">
            <input type="text" name="content" class="search_box_n" autocomplete="off" placeholder="请输入查询内容"/>
            <input type="submit" value="搜索" class="btn_n"/>
        </form>
    <?php
        }else{

    ?>
<!--         有搜索内容的时候-->
        <script>
            var body=document.querySelector("body");
            body.setAttribute("class","yes_style");
            var search_yes =document.querySelector(".search");
            search_yes.style.background="rgba(255,255,255,.8)";
            // search_yes.style.height="1250px"
        </script>
        <script src="../js/main.js"></script>

        <form method="get" action="" class="yes">
            <a class="back" href="../index.php"><img src="img/logo.png" alt="" class="back_i"></a>
            <div class="search_box_top">
            <input type="text" name="content" class="search_box_y" autocomplete="off" value="<?php echo $_GET['content'];  ?>"/>
            <input type="submit" value="搜索" class="btn_y" />
            </div>
        </form>
        <div class="search_content">
            <ul class="result">
                <?php
                    for($i=1;$i<=5;$i++){
                    echo "<li>";
                    echo    "<div class='s_c_left'><img src='img/bg1.png' alt=''></div>";
                    echo    "<div class='s_c_right'><div><a>这是标题</a></div><div><a>这是日期</a></div><div><a>综合评分:9.8&nbsp排名:1</a></div></div>";
                    echo  "</li>";}
                ?>
            </ul>
            <ul class="page">
                <?php
                $num=56;
                $pageall=ceil($num/5.0);

                if(empty($_GET['pagenum'])){
                    $pagenum=1;
                }else{
                    $pagenum=$_GET['pagenum'];
                }
                ?>
                <li><a href="?pagenum=<?php echo $pagenum==1?1:($pagenum-1) ?>&content=<?php echo $_GET['content']?>">上一页</a></li>
                <?php
                if($pageall<=9){
                    if($pageall<=6){
                        for($j=1;$j<=$pageall;$j++){
                            echo "<li><a href='?pagenum=$j&content=".$_GET['content']."'>$j</a></li>";
                        }
                    }else if($pageall>6){
                        if($pagenum<=6){
                            for($j=1;$j<=7;$j++) {
                                echo "<li><a href='?pagenum=$j&content=".$_GET['content']."'>$j</a></li>";
                            }
                            echo "    ...    ";
                            echo "<li><a href='?pagenum=".$pageall."&content=".$_GET['content']."'>".$pageall."</a></li>";
                        } else{
                            echo "<li><a href='?pagenum=1&content=".$_GET['content']."'>1</a></li>";
                            echo "    ...    ";
                            for($j=1;$j<=($pageall-4);$j++){
                                $pagenum_now=($pagenum-3+$j);
                                echo "<li><a href='?pagenum=$pagenum_now&content=".$_GET['content']."'>$pagenum_now</a></li>";
                            }
                        }
                    }
                }else {
                    if ($pagenum < 4) {
                        echo "<li><a href='?pagenum=1&content=" . $_GET['content'] . "'>1</a></li>";
                        echo "<li><a href='?pagenum=2&content=" . $_GET['content'] . "'>2</a></li>";
                        echo "<li><a href='?pagenum=3&content=" . $_GET['content'] . "'>3</a></li>";
                        echo "<li><a href='?pagenum=4&content=" . $_GET['content'] . "'>4</a></li>";
                        echo "<li><a href='?pagenum=5&content=" . $_GET['content'] . "'>5</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=" . $pageall . "&content=" . $_GET['content'] . "'>" . $pageall . "</a></li>";
                    } else if ($pagenum == 4) {
                        echo "<li><a href='?pagenum=1&content=" . $_GET['content'] . "'>1</a></li>";
                        echo "<li><a href='?pagenum=2&content=" . $_GET['content'] . "'>2</a></li>";
                        echo "<li><a href='?pagenum=3&content=" . $_GET['content'] . "'>3</a></li>";
                        echo "<li><a href='?pagenum=4&content=" . $_GET['content'] . "'>4</a></li>";
                        echo "<li><a href='?pagenum=5&content=" . $_GET['content'] . "'>5</a></li>";
                        echo "<li><a href='?pagenum=6&content=" . $_GET['content'] . "'>6</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=" . $pageall . "&content=" . $_GET['content'] . "'>" . $pageall . "</a></li>";
                    } else if ($pagenum > 4 && $pagenum < ($pageall - 3)) {
                        echo "<li><a href='?pagenum=1&content=" . $_GET['content'] . "'>1</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=" . ($pagenum - 2) . "&content=" . $_GET['content'] . "'>" . ($pagenum - 2) . "</a></li>";
                        echo "<li><a href='?pagenum=" . ($pagenum - 1) . "&content=" . $_GET['content'] . "'>" . ($pagenum - 1) . "</a></li>";
                        echo "<li><a href='?pagenum=" . $pagenum . "&content=" . $_GET['content'] . "'>" . $pagenum . "</a></li>";
                        echo "<li><a href='?pagenum=" . ($pagenum + 1) . "&content=" . $_GET['content'] . "'>" . ($pagenum + 1) . "</a></li>";
                        echo "<li><a href='?pagenum=" . ($pagenum + 2) . "&content=" . $_GET['content'] . "'>" . ($pagenum + 2) . "</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=" . $pageall . "&content=" . $_GET['content'] . "'>" . $pageall . "</a></li>";
                    } else if ($pagenum >= ($pageall - 3)) {
                        echo "<li><a href='?pagenum=1&content=" . $_GET['content'] . "'>1</a></li>";
                        echo "    ...    ";
                        echo "<li><a href='?pagenum=" . ($pageall - 4) . "&content=" . $_GET['content'] . "'>" . ($pageall - 4) . "</a></li>";
                        echo "<li><a href='?pagenum=" . ($pageall - 3) . "&content=" . $_GET['content'] . "'>" . ($pageall - 3) . "</a></li>";
                        echo "<li><a href='?pagenum=" . ($pageall - 2) . "&content=" . $_GET['content'] . "'>" . ($pageall - 2) . "</a></li>";
                        echo "<li><a href='?pagenum=" . ($pageall - 1) . "&content=" . $_GET['content'] . "'>" . ($pageall - 1) . "</a></li>";
                        echo "<li><a href='?pagenum=" . $pageall . "&content=" . $_GET['content'] . "'>" . $pageall . "</a></li>";
                    }
                }
                ?>
                <li><a href="?pagenum=<?php echo $pagenum==$pageall?$pageall:($pagenum+1) ?>&content=<?php echo $_GET['content']?>">下一页</a></li>
            </ul>
            <script>
                var pagenum="<?php echo  $pagenum ?>";
                var pageall="<?php echo  $pageall ?>";
                pagenum=parseInt(pagenum);
                pageall=parseInt(pageall);
                if(pagenum<=4){
                    var li= document.querySelector(".search .search_content .page li:nth-child(<?php echo ($pagenum+1); ?>)");
                }else if(pagenum>4&&pagenum<(pageall-3)){
                    var li= document.querySelector(".search .search_content .page li:nth-child(5)");
                }else if(pagenum>=((pageall-3))){
                    var li= document.querySelector(".search .search_content .page li:nth-last-child(<?php echo ($pageall-$pagenum+2); ?>)");
                }
                li.onclick=function(){
                    return false;}
                li.setAttribute("class","page_on");
            </script>
        </div>
    <?php } ?>
</div>
<!--search end-->

<!--    <iframe  scrolling="no" class="bottom" src=""></iframe>-->
</body>

</html>