<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>search</title>
    <link rel="stylesheet" href="search.css" type="text/css">
</head>
<body>
<!--top begin-->
<div class="top">
    <iframe  scrolling="no" src=""></iframe>
<!--    <div class="img1"><img src="" alt=""></div>-->
</div>
<!--top end-->

<!--search begin-->
<div class="search">
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

        </script>
        <form method="get" action="" class="no">
            <input type="text" name="content" class="search_box_n" autocomplete="off" placeholder="请输入查询内容"/>
            <input type="submit" value="搜索" class="btn_n"/>
        </form>
    <?php
        }else{
    ?>
        <form method="get" action="" class="yes">
            <div class="search_box_top">
            <input type="text" name="content" class="search_box_y" autocomplete="off" value="<?php echo $_GET['content'];  ?>"/>
            <input type="submit" value="搜索" class="btn_y" />
            </div>
        </form>
        <div class="search_content">
            <ul>
                <?php
                    for($i=1;$i<=5;$i++){
                    echo "<li>";
                    echo    "<div class='s_c_left'><img src='' alt=''></div>";
                    echo    "<div class='s_c_right'><div><a>这是标题</a></div><div><a>这是日期</a></div><div><a>综合评分:9.8&nbsp排名:1</a></div></div>";
                    echo  "</li>";}
                ?>
            </ul>
        </div>
    <?php } ?>
</div>
<!--search end-->

<!--    <iframe  scrolling="no" class="bottom" src=""></iframe>-->
</body>
</html>