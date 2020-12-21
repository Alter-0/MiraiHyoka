<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <script src="../js/jquery.js"></script>
    <!-- 引用部分@blueberry -->
    <script src="../js/main.js"></script>
    <!-- 引用部分@blueberry -->
     <link href="font/style.css" rel="stylesheet"/>
    <link href="detail_m.css" rel="stylesheet"/>
    <meta charset="UTF-8" name="referrer" content="never">
    <title><?php
        echo "番名"
        ?>_番剧点评_MiraiHyoka</title>

    <?php
    $score=6.8;
    $score1=6.4;
    $score2=7.5;
    ?>

    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include "../header.php"?>
<div style="height: 50px"></div>
<div class="all">
    <div class="main">
        <div class="top">
            <div class="nei">
                <!--  fgimg放番剧展示图 -->
                <div class="fjimg">
                    <img id="fj"
                         src="http://i0.hdslb.com/bfs/bangumi/image/0212baa8898d0c819c7fb84015e95b8fca621435.png">
                </div>
                <!--  title放番剧名和标签 -->
                <div class="title">
                    <span class="title_name"><?php echo "阿松" ?></span>
                    <!--  title放番剧标签  -->
                    <span class="title_tags">
                        <span class='title_tag'>日常番</span>
                        <span class='title_tag'>日常番</span>
                        <span class='title_tag'>日常番</span>
                        <?php
                        //循环输出番剧标签
                        /*  while ($arr = mysqli_fetch_row($tagsresult)) {
                            echo "<span class='title_tag'>" . $arr[0] . "</span>";
                        }
                        */ ?>
                    </span>
                </div>
                <div class="data">
                    <div class="count">
                        <span class="plays">
                            <span class="playslabel">总评论数</span>
                            <br/>
                            <em>0</em>
                        </span>
                        <span class="likes">
                            <span class="likeslabel">收藏人数</span>
                            <br/>
                            <em>0</em>
                        </span>
                    </div>

                </div>
                <!-- 圆形展示分数条上面的文字-->
                <div class="cirle_info">
                <span style="color:#ffffff;font-size:22px;line-height:20px;margin-right: 110px">综合媒体评分</span>
                <span style="color:#ffffff;font-size:22px;line-height:20px;">综合用户评分</span>
                </div>
                <!-- 圆形展示分数条-->
                <div class="bg">
                    <div class="circle-right"></div>
                    <div class="text">6.5</div>
                </div>
                <!-- 圆形展示分数条中间的线-->
                <div class="circle_line"></div>
                <!-- 圆形展示分数条-->
                <div class="bg_2">
                    <div class="circle-right"></div>
                    <div class="text">6.5</div>
                </div>
                <div class="time">
                    <?php
                    //上架时间
                    date_default_timezone_set('PRC');
                    $startdate = date("Y年m月d日", time());
                    echo "<span>" . $startdate . "开播</span>";
                    //判断是否完结，如果已完结，则执行
                    if (true) {
                        echo "<span>已完结</span>";
                    }
                    ?>

                </div>
                <div class="intro">
                    <span class="intro_text"><?php echo substr("这里是简介", 0, 490); ?>......</span>
                </div>
                <div onclick="changelike()" id="like_btn" class="btns">
                    <?php

                    //首先判断用户是否已经登录，若已经登录
                    if (1 == 1) {
                        echo '<div class="btn_like">';
                        echo '<i></i>';
                        echo '收藏';
                    } else {
                        if (1 == 1) {
                            $islike = 1;
                            echo '<div class="btn_like btn_liked">';
                            echo '<i></i>';
                            echo '已收藏';

                        } else {
                            $islike = 0;
                            echo '<div class="btn_like">';
                            echo '<i></i>';
                            echo '收藏';
                        }
                    }


                    ?>

                </div>
            </div>
        </div>
        <!--bg放的图片即番剧图        -->
        <img id="bg" src="http://i0.hdslb.com/bfs/bangumi/image/0212baa8898d0c819c7fb84015e95b8fca621435.png">
    </div>
    <!--  选择标签及具体内容部分  -->
    <div class="detail_tab">
            <!-- 选择菜单  -->
            <div class="tab_nav">
                <ul class="clearfix">
                    <li onclick="changeTab(this)" class="on">番剧概述</li>
                    <li onclick="changeTab(this)">分集讨论</li>
                    <li onclick="changeTab(this)"> 长评</li>
                    <li onclick="changeTab(this)"> 短评</li>
                </ul>
            </div>
            <!-- 接下来是 -评分页-分集页-长评-短评的具体版块    -->
            <div class="tab_de">
                <!--  评分页-->
                <div class="hyoka">
                    <!--第一部分，评分概述-左   -->
                    <div class="details_card_left">
                        <div class="card_left_title">详情</div>
                        <div class="card_left_text">
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                        </div>
                    </div>
                    <!--第一部分，评分概述-右   -->
                    <div class="details_card_right">
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg bg_3">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg bg_4">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg bg_5">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg bg_6">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg bg_7">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                        <div class="card_right_div">
                            <span class="card_right_title">用户评分</span>
                            <div class="card_right_bg bg_8">
                                <div class="circle-right"></div>
                                <div class="text">6.5</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 分集页-->
                <div class="diversity">
                    <div class="details_card_left">
                        <div class="card_left_title">详情</div>
                        <div class="card_left_text">
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>

                        </div>
                    </div>
                </div>
                <!--长评-->
                <div class="long_review">
                    <div class="details_card_left">
                        <div class="card_left_title">详情</div>
                        <div class="card_left_text">
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                            <p>详情一:详情内容</p><br>
                        </div>
                    </div>
                </div>
                <!--短评-->
                <div class="short_review">
                    <div class="short_review_middle">
                        <!--短评的头部-->
                        <div class="card_left_title" style="display: inline-block">短评</div>
                        <div class="short_review_drop"><div>默认<i></i></div> <ul><li>默认</li><li>最新</li></ul></div>
                        <div class="short_review_write">去写短评</div>
                        <!--短评具体内容-->
                        <ul class="short_review_write_ul">
                            <li>
                                <!--短评具体内容-头像那一行-->
                                <div class="li_first_div">
                                    <div class="short_review_face">
                                        <div class="short_review_img">
                                            <img alt="Yrqiiii" src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp" lazy="loaded">
                                        </div>
                                    </div>
                                    <div class="short_review_name">
                                        bfbdntf
                                    </div>
                                    <div class="short_review_star">
                                        <span class="review_star">
                                            <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-empty">
                                                <i></i>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="short_review_time">22小时前</div>
                                </div>
                                <!--短评具体内容-评论内一行-->
                                <div class="li_second_review">
                                    <div class="second_review">
                                        剧情紧凑不拖沓 打击感强 人物性格也很鲜明 纯恶与善的对决
                                    </div>

                                </div>
                                <!--点赞-->
                                <div class="li_third_icon">
                                    <div>
                                        <i class="icon-praise" style="font-size: 14px;margin-right: 6px;"></i><span>5</span>
                                    </div>
                                    <div>
                                        <i class="icon-criticism" style="font-size: 14px;margin-right: 6px;"></i><span>1</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!--短评具体内容-头像那一行-->
                                <div class="li_first_div">
                                    <div class="short_review_face">
                                        <div class="short_review_img">
                                            <img alt="Yrqiiii" src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp" lazy="loaded">
                                        </div>
                                    </div>
                                    <div class="short_review_name">
                                        bfbdntf
                                    </div>
                                    <div class="short_review_star">
                                        <span class="review_star">
                                            <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-empty">
                                                <i></i>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="short_review_time">22小时前</div>
                                </div>
                                <!--短评具体内容-评论内一行-->
                                <div class="li_second_review">
                                    <div class="second_review">
                                        剧情紧凑不拖沓 打击感强 人物性格也很鲜明 纯恶与善的对决
                                    </div>

                                </div>
                                <!--点赞-->
                                <div class="li_third_icon">
                                    <div>
                                        <i class="icon-praise" style="font-size: 14px;margin-right: 6px;"></i><span>5</span>
                                    </div>
                                    <div>
                                        <i class="icon-criticism" style="font-size: 14px;margin-right: 6px;"></i><span>1</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!--短评具体内容-头像那一行-->
                                <div class="li_first_div">
                                    <div class="short_review_face">
                                        <div class="short_review_img">
                                            <img alt="Yrqiiii" src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp" lazy="loaded">
                                        </div>
                                    </div>
                                    <div class="short_review_name">
                                        bfbdntf
                                    </div>
                                    <div class="short_review_star">
                                        <span class="review_star">
                                            <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-empty">
                                                <i></i>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="short_review_time">22小时前</div>
                                </div>
                                <!--短评具体内容-评论内一行-->
                                <div class="li_second_review">
                                    <div class="second_review">
                                        剧情紧凑不拖沓 打击感强 人物性格也很鲜明 纯恶与善的对决
                                    </div>

                                </div>
                                <!--点赞-->
                                <div class="li_third_icon">
                                    <div>
                                        <i class="icon-praise" style="font-size: 14px;margin-right: 6px;"></i><span>5</span>
                                    </div>
                                    <div>
                                        <i class="icon-criticism" style="font-size: 14px;margin-right: 6px;"></i><span>1</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!--短评具体内容-头像那一行-->
                                <div class="li_first_div">
                                    <div class="short_review_face">
                                        <div class="short_review_img">
                                            <img alt="Yrqiiii" src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp" lazy="loaded">
                                        </div>
                                    </div>
                                    <div class="short_review_name">
                                        bfbdntf
                                    </div>
                                    <div class="short_review_star">
                                        <span class="review_star">
                                            <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-empty">
                                                <i></i>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="short_review_time">22小时前</div>
                                </div>
                                <!--短评具体内容-评论内一行-->
                                <div class="li_second_review">
                                    <div class="second_review">
                                        剧情紧凑不拖沓 打击感强 人物性格也很鲜明 纯恶与善的对决
                                    </div>

                                </div>
                                <!--点赞-->
                                <div class="li_third_icon">
                                    <div>
                                        <i class="icon-praise" style="font-size: 14px;margin-right: 6px;"></i><span>5</span>
                                    </div>
                                    <div>
                                        <i class="icon-criticism" style="font-size: 14px;margin-right: 6px;"></i><span>1</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!--短评具体内容-头像那一行-->
                                <div class="li_first_div">
                                    <div class="short_review_face">
                                        <div class="short_review_img">
                                            <img alt="Yrqiiii" src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp" lazy="loaded">
                                        </div>
                                    </div>
                                    <div class="short_review_name">
                                        bfbdntf
                                    </div>
                                    <div class="short_review_star">
                                        <span class="review_star">
                                            <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-full">
                                                <i></i>
                                            </i>
                                             <i class="icon-star-empty">
                                                <i></i>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="short_review_time">22小时前</div>
                                </div>
                                <!--短评具体内容-评论内一行-->
                                <div class="li_second_review">
                                    <div class="second_review">
                                        剧情紧凑不拖沓 打击感强 人物性格也很鲜明 纯恶与善的对决
                                    </div>

                                </div>
                                <!--点赞-->
                                <div class="li_third_icon">
                                    <div>
                                        <i class="icon-praise" style="font-size: 14px;margin-right: 6px;"></i><span>5</span>
                                    </div>
                                    <div>
                                        <i class="icon-criticism" style="font-size: 14px;margin-right: 6px;"></i><span>1</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                <!--写短评的弹窗-->
                    <div class="write_review">
                        <div class="write_review_bg">
                            <div class="write_review_close"></div>
                            <div class="write_review_header">
                                <div style="width: 100%;">
                                    <img  src="//i0.hdslb.com/bfs/bangumi/image/0cc63d7bd7f82722137b6d5b27f13866c865e671.png@100w_133h.png" alt=""  style="float: left;">
                                    <div class="write_review_info">
                                     <h4><strong>阿松</strong></h4>
                                     <p style="font-size: 14px;margin-top: 20px;margin-bottom: 25px;">请发表你对这部作品的评价</p>
                                     <span class="write_review_star">
                                            <i class="icon-star-empty" index="1">

                                            </i>
                                             <i class="icon-star-empty" index="2">

                                            </i>
                                             <i class="icon-star-empty" index="3">

                                            </i>
                                             <i class="icon-star-empty" index="4">

                                            </i>
                                             <i class="icon-star-empty" index="5">

                                            </i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="write_review_middle">
                            <textarea></textarea>
                            <span>0/100</span>
                            <button class="write_review_button">发表短评</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


</div>


</body>
<!--这里是js-->
<script>
//    第一个函数-分数圆形条
    $(function(){
        //通过计时器来显示过渡的百分比进度，计时器不能直接放入循环中
        var temp= 0;
        var timer= setInterval(function(){

            calculate(1,temp,1);
            //清除计时器结束该方法调用
            if(temp== <?php echo $score*10; ?>){
                clearInterval(timer);
            }
            temp++;
        },30);
        var temp2= 0;
        var timer2= setInterval(function(){
            calculate(0,temp2,0);
            //清除计时器结束该方法调用
            if(temp2==<?php echo $score2*10; ?>){
                clearInterval(timer2);
            }
            temp2++;
        },30);
        var temp3= 0;
        var timer3= setInterval(function(){
            calculate(2,temp3,2);
            //清除计时器结束该方法调用
            if(temp3==<?php echo $score2*10; ?>){
                clearInterval(timer3);
            }
            temp3++;
        },30);
        var temp4= 0;
        var timer4= setInterval(function(){
            calculate(3,temp4,3);
            //清除计时器结束该方法调用
            if(temp4==<?php echo $score1*10; ?>){
                clearInterval(timer4);
            }
            temp4++;
        },30);
        var temp5= 0;
        var timer5= setInterval(function(){
            calculate(4,temp5,4);
            //清除计时器结束该方法调用
            if(temp5==<?php echo $score2*10; ?>){
                clearInterval(timer5);
            }
            temp5++;
        },30);
        var temp6= 0;
        var timer6= setInterval(function(){
            calculate(5,temp6,5);
            //清除计时器结束该方法调用
            if(temp6==<?php echo $score2*10; ?>){
                clearInterval(timer6);
            }
            temp6++;
        },30);
        var temp7= 0;
        var timer7= setInterval(function(){
            calculate(6,temp7,6);
            //清除计时器结束该方法调用
            if(temp7==<?php echo $score2*10; ?>){
                clearInterval(timer7);
            }
            temp7++;
        },30);
        var temp8= 0;
        var timer8= setInterval(function(){
            calculate(7,temp8,7);
            //清除计时器结束该方法调用
            if(temp8==<?php echo $score2*10; ?>){
                clearInterval(timer8);
            }
            temp8++;
        },30);



        //改变页面显示百分比
        function calculate(index,value,i){
            //改变页面显示的值
            $('.text').eq(i).html(value/10);
            if(index==0)
            {
                $('.bg .circle-left').remove();
                $('.bg .mask-right').remove();
            }
            else if(index==1)
            {
                $('.bg_2 .circle-left').remove();
                $('.bg_2 .mask-right').remove();
            }
            else if(index==2)
            { //清除上次调用该方法残留的效果

                $('.bg_3 .circle-left').remove();
                $('.bg_3 .mask-right').remove();
            }
            else if(index==3)
            { //清除上次调用该方法残留的效果

                $('.bg_4 .circle-left').remove();
                $('.bg_4 .mask-right').remove();
            }
            else if(index==4)
            { //清除上次调用该方法残留的效果

                $('.bg_5 .circle-left').remove();
                $('.bg_5 .mask-right').remove();
            }
            else if(index==5)
            { //清除上次调用该方法残留的效果

                $('.bg_6 .circle-left').remove();
                $('.bg_6 .mask-right').remove();
            }
            else if(index==6)
            { //清除上次调用该方法残留的效果

                $('.bg_7 .circle-left').remove();
                $('.bg_7 .mask-right').remove();
            }
            else if(index==7)
            { //清除上次调用该方法残留的效果

                $('.bg_8 .circle-left').remove();
                $('.bg_8 .mask-right').remove();
            }



            //当百分比小于等于50
            if(value <= 50){
                var html = '';

                html += '<div class="mask-right" style="transform:rotate('+ (value * 3.6) +'deg)"></div>';

                //元素里添加子元素
                $('.circle-right').eq(i).append(html);
            }else{
                value -= 50;
                var html = '';

                html += '<div class="circle-left">';
                html += '<div class="mask-left" style="transform:rotate('+ (value * 3.6) +'deg)"></div>';
                html += '</div>';

                //元素后添加元素
                $('.circle-right').eq(i).after(html);
            }
        }
    });
    //切换页面的函数
    function changeTab(tab) {
        var tabs = document.getElementsByClassName('tab_nav')[0].getElementsByTagName("li");
        var contents = document.querySelectorAll(".tab_de>div");
        for (var i = 0, len = tabs.length; i < len; i++) {
            if (tabs[i] === tab) {
                tabs[i].className = 'on';
                contents[i].style.display = 'block';

            } else {
                tabs[i].className = '';
                contents[i].style.display = 'none';
            }
        }
    }

</script>
<script>
//    加载短评，点赞，弹窗等
    $(document).ready(function(){
        var indexnum="";
        $(".short_review_write").click(function(){
            $(".write_review").css("display","block");
        });
        $(".write_review_close").click(function(){
            $(".write_review").css("display","none");
        });
        $('.write_review_star i').hover(function(){
            var index=$(this).attr("index");
            indexnum=index;
            for(i=0;i<index;i++)
            {
                $('.write_review_star i').eq(i).attr("class","icon-star-full");
            }
            for(i=index;i<5;i++)
            {
                $('.write_review_star i').eq(i).attr("class","icon-star-empty");
            }

        });

        $('.icon-praise').click(function(e){
            if($(e.target).parent().parent().find("div:nth-child(2)").find("i").attr("class")=="icon-criticism_full")
            {return;}
            if($(e.target).attr("class")=="icon-praise")
            {
                $(e.target).attr("class","icon-praise_full");
                $(e.target).siblings().css("color","#1189ef");
                var n=parseInt($(e.target).siblings().html());
                $(e.target).siblings().html((n+1));
            }
            else
            {
                $(e.target).attr("class","icon-praise");
                $(e.target).siblings().css("color","#99a2aa");
                var n=parseInt($(e.target).siblings().html());
                $(e.target).siblings().html((n-1));
            }
        });
        $('.icon-criticism').click(function(e){
            if($(e.target).parent().parent().find("div:nth-child(1)").find("i").attr("class")=="icon-praise_full")
            {return;}
            if($(e.target).attr("class")=="icon-criticism")
            {
                $(e.target).attr("class","icon-criticism_full");
                $(e.target).siblings().css("color","#1189ef");
                var n=parseInt($(e.target).siblings().html());
                $(e.target).siblings().html((n+1));
            }
            else
            {

                $(e.target).attr("class","icon-criticism");
                $(e.target).siblings().css("color","#99a2aa");
                var n=parseInt($(e.target).siblings().html());
                $(e.target).siblings().html((n-1));
            }
        });

        $(window).scroll(function() {
            if ($(".short_review").css("display") !="none")
            {
                var scrollTop = $(this).scrollTop();
                var scrollHeight = $(document).height();
                var windowHeight = $(this).height();
                if ((scrollHeight - (scrollTop + windowHeight)) < 10)
                {   $.post("short_review_load.php",
                    {objective:"reviewload"},
                    function(data){
                        data = eval('('+data+')');
                        for(i=0;i<4;i++)
                        {
                            var name = data.name[i];
                            var time = data.time[i];
                            var review =data.review[i];
                            $(".short_review_middle .short_review_write_ul").append(" <li> <div class='li_first_div'> <div class='short_review_face'> <div class='short_review_img'>"
                                + " <img alt='a' src='//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp' lazy='loaded'>"
                                + "  </div> </div> <div class='short_review_name'>" + name
                                + " </div> <div class='short_review_star'> <span class='review_star'>"
                                + " <i class='icon-star-full'> <i></i> </i> <i class='icon-star-full'> <i></i> </i> <i class='icon-star-full'>"
                                + "<i></i> </i> <i class='icon-star-full'> <i></i> </i> <i class='icon-star-empty'> <i></i> </i> </span>"
                                + "</div> <div class='short_review_time'>" + time
                                + "</div> </div> <div class='li_second_review'> <div class='second_review'>" + review
                                + "</div> </div> <div class='li_third_icon'> <div> <i class='icon-praise' style='font-size: 14px;margin-right: 6px;'></i><span>5</span></div>"
                                + "<div> <i class='icon-criticism' style='font-size: 14px;margin-right: 6px;'></i><span>1</span></div> </div> </li>");
                        }
                    });


                }
            }
        });


    });
</script>
</html>
