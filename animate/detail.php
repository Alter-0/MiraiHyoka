<?php
session_start();
$id = empty($_GET['animate_id']) ? 100001 : $_GET['animate_id'];
$uid = empty($_SESSION['user_id']) ? 1 : $_SESSION['user_id'];
?>
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
    <?php
    include "../conn.php";
    $sql = "select *from animate where animate_id=$id";
    $result = mysqli_query($conn, $sql) or die("数据库查询评论失败" . $sql);
    if (mysqli_num_rows($result) <= 0) {
        echo "<script>alert('番剧信息不存在');</script>";
    }

    $row = mysqli_fetch_assoc($result);
    $animate_name = $row['name_cn'];
    $animate_fj = $row['cover'];
    $animate_starttime = $row['start_time'];
    $animate_isfinish = $row['is_finish'];
    $animate_info = $row['introduction'];
    $sql = "select COUNT(animate_id) from evaluation where animate_id=$id";
    $result = mysqli_query($conn, $sql) or die("数据库查询评论失败" . $sql);
    if (mysqli_num_rows($result) <= 0) {
        $animate_reviewnum = 0;
    } else {
        $row = mysqli_fetch_row($result);
        $animate_reviewnum = $row[0];
    }
    $sql = "select COUNT(animate_id) from favorites where animate_id=$id";
    $result = mysqli_query($conn, $sql) or die("数据库查询评论失败" . $sql);
    if (mysqli_num_rows($result) <= 0) {
        $animate_favnum = 0;
    } else {
        $row = mysqli_fetch_row($result);
        $animate_favnum = $row[0];
    }
    ?>
    <title>
        <?php
        echo $animate_name
        ?>_番剧点评_MiraiHyoka</title>

    <!--    头和脚-->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <!--    长评-->
    <link rel="stylesheet" href="css/long-comment-in.css">
</head>
<body>
<?php include "../header.php" ?>
<div style="height: 50px"></div>
<div class="all">
    <div class="main">
        <div class="top">
            <div class="nei container">
                <!--  fgimg放番剧展示图 -->
                <div class="fjimg">
                    <img id="fj"
                         src="<?php echo $animate_fj; ?>">
                </div>
                <!--  title放番剧名和标签 -->
                <div class="title">
                    <span class="title_name"><?php echo $animate_name; ?></span>
                    <!--  title放番剧标签  -->
                    <span class="title_tags">
                        <?php
                        //循环输出番剧标签
                        $sql = "select * from tags where animate_id=$id";
                        $result = mysqli_query($conn, $sql) or die("数据库查询评论失败" . $sql);
                        while ($arr = mysqli_fetch_row($result)) {
                            echo "<span class='title_tag'>" . $arr[1] . "</span>";
                        }
                        ?>
                    </span>
                </div>
                <div class="data">
                    <div class="count">
                        <span class="plays">
                            <span class="playslabel">总评论数</span>
                            <br/>
                            <em><?php echo $animate_reviewnum; ?></em>
                        </span>
                        <span class="likes">
                            <span class="likeslabel">收藏人数</span>
                            <br/>
                            <em><?php echo $animate_favnum; ?></em>
                        </span>
                    </div>
                </div>
                <!-- 圆形展示分数条上面的文字-->
                <div class="cirle_info">
                    <span style="color:#ffffff;font-size:22px;line-height:20px;margin-right: 132px">综合媒体评分</span>
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
                    echo "<span>" . $animate_starttime . "开播</span>";
                    //判断是否完结，如果已完结，则执行
                    if ($animate_isfinish == 1) {
                        echo "<span>已完结</span>";
                    } else {
                        echo "<span>连载中</span>";
                    }
                    ?>

                </div>
                <div class="intro">
                    <span class="intro_text"><?php echo substr($animate_info, 0, 201); ?>......</span>
                </div>
                <div onclick="changelike()" id="like_btn" class="btns">
                    <?php

                    //首先判断用户是否已经登录，若已经登录
                    if ($uid == "") {
                        echo '<div class="btn_like">';
                        echo '<i></i>';
                        echo '收藏';
                    } else {
                        $sql = "select *from favorites where animate_id=$id and user_id=$uid";
                        $result = mysqli_query($conn, $sql) or die("数据库查询评论失败" . $sql);
                        if (mysqli_num_rows($result) > 0) {
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
        <img id="bg" src="<?php echo $animate_fj; ?>">
    </div>
    <!--  选择标签及具体内容部分  -->
    <div class="detail_tab container" style="padding: 0">
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
                <div class="row">
                    <!-- 第一部分，评分概述-左   -->
                    <div class="col-lg-9 col-md-9 hidden-12 hidden-12">
                        <div class="details_card_left ">
                            <div class="card_right_div">
                                <span class="card_right_title">综合媒体评分</span>
                                <div class="hyoka_rank" style="position: relative">
                                    <?php
                                    include "../conn.php";
                                    $sql = "select *from animate where animate_id=$id";
                                    $result = mysqli_query($conn, $sql) or die("数据库查询评论失败" . $sql);
                                    $sql_user = "select COUNT(user_id),SUM(score) from evaluation where animate_id=$id";
                                    $result_user = mysqli_query($conn, $sql_user) or die("数据库查询评论失败" . $sql_user);
                                    if (mysqli_num_rows($result) <= 0) {
                                        echo "<script>alert('番剧信息不存在');</script>";
                                    }

                                    $row = mysqli_fetch_assoc($result);
                                    $score2 = $row['media_rating'];//综合媒体评分
                                    $score2 = round($score2, 1);
                                    $score = $row['user_rating'];//综合用户评分
                                    if ($score == null) {
                                        $score = 0;
                                    } else {
                                        $score = round($score, 1);
                                    }
                                    if (mysqli_num_rows($result_user) > 0) {
                                        $row_user = mysqli_fetch_row($result_user);
                                        $score = $row_user[1] / $row_user[0];
                                        $score = round($score, 1);
                                    }

                                    $score3 = $score2 * 14.5;
                                    if (0 < $score2 && $score2 <= 2) {
                                    } else if (2 < $score2 && $score2 <= 4) {
                                        $score3 = $score3 + 16.3;
                                    } else if (4 < $score2 && $score2 <= 6) {
                                        $score3 = $score3 + 32.6;
                                    } else if (6 < $score2 && $score2 <= 8) {
                                        $score3 = $score3 + 48.9;
                                    } else if (8 < $score2 && $score2 <= 10) {
                                        $score3 = $score3 + 65;
                                    }


                                    ?>
                                    <span class="compre_scorenum"><?php echo $row['media_rating'] ?></span>
                                    <div class="compre_score_empty">
                                        <i class='icon-star-empty'> <i></i> </i>
                                        <i class='icon-star-empty'> <i></i> </i>
                                        <i class='icon-star-empty'> <i></i> </i>
                                        <i class='icon-star-empty'> <i></i> </i>
                                        <i class='icon-star-empty'> <i></i> </i>
                                    </div>
                                    <div class="compre_score">
                                        <i class='icon-star-full'> <i></i> </i>
                                        <i class='icon-star-full'> <i></i> </i>
                                        <i class='icon-star-full'> <i></i> </i>
                                        <i class='icon-star-full'> <i></i> </i>
                                        <i class='icon-star-full'> <i></i> </i>
                                    </div>
                                    <span class="compre_ping">总评</span>
                                    <span class="compre_ping_num">第<?php echo $row['media_rank'] ?>名</span>


                                </div>

                            </div>
                            <div class="card_right_div" style="margin-top: 20px;">
                                <div class="hyoka_rank">
                                    <div class="col-lg-4 col-md-4 .col-xs-12 .col-sm-12">
                                        <div class="rank_first">
                                            <div class="rank_first_line">
                                                <img src="img/mal.png" class="rank_first_img">
                                                <span class="rank_first_name">mal</span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_score"><?php echo $row['mal_rating'] ?></span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_rank">#第<?php echo $row['mal_rank'] ?>名</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 .col-xs-12 .col-sm-12">
                                        <div class="rank_first">
                                            <div class="rank_first_line">
                                                <img src="img/anidb.png" class="rank_first_img">
                                                <span class="rank_first_name">anidb</span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_score"><?php echo $row['anidb_rating'] ?></span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_rank">#第<?php echo $row['anidb_rank'] ?>名</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 .col-xs-12 .col-sm-12">
                                        <div class="rank_first">
                                            <div class="rank_first_line">
                                                <img src="img/ann.png" class="rank_first_img">
                                                <span class="rank_first_name">ann</span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_score"><?php echo $row['ann_rating'] ?></span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_rank">#第<?php echo $row['ann_rank'] ?>名</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card_right_div_fourth" style="margin-top: 20px;">

                                <div class="hyoka_rank_fourth">
                                    <div class="col-lg-3 col-md-3 .col-xs-12 .col-sm-12">
                                        <div class="rank_first">
                                            <div class="rank_first_line">
                                                <img src="img/anikore.ico" class="rank_first_img">
                                                <span class="rank_first_name">anikore</span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_score"><?php echo $row['ann_rating'] ?></span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_rank">#第<?php echo $row['anikore_rank'] ?>名</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 .col-xs-12 .col-sm-12">
                                        <div class="rank_first">
                                            <div class="rank_first_line">
                                                <img src="img/bangumi.png" class="rank_first_img">
                                                <span class="rank_first_name">bangumi</span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_score"><?php echo $row['bangumi_rating'] ?></span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_rank">#第<?php echo $row['bangumi_rank'] ?>名</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 .col-xs-12 .col-sm-12">
                                        <div class="rank_first">
                                            <div class="rank_first_line">
                                                <img src="img/imdb.png" class="rank_first_img">
                                                <span class="rank_first_name">imdb</span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_score"><?php echo $row['imdb_rating'] ?></span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_rank">#第<?php echo $row['imdb_rank'] ?>名</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 .col-xs-12 .col-sm-12">
                                        <div class="rank_first">
                                            <div class="rank_first_line">
                                                <img src="img/douban.png" class="rank_first_img">
                                                <span class="rank_first_name">douban</span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_score"><?php echo $row['douban_rating'] ?></span>
                                            </div>
                                            <div class="rank_first_line">
                                                <span class="rank_first_rank">#第<?php echo $row['douban_rank'] ?>名</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div></div>
                            <div class="card_right_div_fifth" style="border-top: 1px solid #e5e9ef;padding-top: 30px;">
                                <div class="details_card_right_cv" style="padding-left: 10px;">
                                    <div class="card_left_title" style="text-align: center">CV表</div>

                                    <?php
                                    $cv = explode("\n", $row['cv']);
                                    foreach ($cv as $cvname) {
                                        $c = explode(":", $cvname);
                                        if ($c[0] == "") {
                                            break;
                                        }
                                        echo "<div class='col-lg-4 col-md-4 .col-xs-12 .col-sm-12'><div class='cv_border'><p>";
                                        echo "角色：" . "$c[0]" . "<br>";
                                        echo "声优：" . "$c[1]" . "<br>";
                                        echo "</div></p></div>";

                                    }

                                    ?>

                                </div>
                            </div>


                        </div>
                    </div>
                    <!--    第一部分，评分概述-右-->
                    <div class=" col-lg-3 col-md-3 hidden-sm hidden-xs">
                        <div class="details_card_right" style="padding-left: 10px;">
                            <div class="card_left_title">信息</div>
                            <div class="card_left_text">
                                <?php
                                echo nl2br($row['info']);
                                ?>
                                <!--                                <p>详情一:详情内容</p><br>-->
                                <!--                                <p>详情一:详情内容</p><br>-->
                                <!--                                <p>详情一:详情内容</p><br>-->
                                <!--                                <p>详情一:详情内容</p><br>-->
                                <!--                                <p>详情一:详情内容</p><br>-->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- 分集页-->
            <div class="diversity">

                <div class="diversity_review">
                    <div class="diversity_review_bg">
                        <div class="diversity_review_close"></div>
                        <div class="diversity_review_header">
                            <div style="width: 100%;">
                                <img src="//i0.hdslb.com/bfs/bangumi/image/0cc63d7bd7f82722137b6d5b27f13866c865e671.png@100w_133h.png"
                                     alt="" style="float: left;">
                                <div class="diversity_review_info">
                                    <h4><strong>第1话</strong></h4>
                                    <p style="font-size: 14px;margin-top: 20px;margin-bottom: 25px;">请与他人友善讨论本话</p>
                                </div>
                            </div>
                        </div>
                        <div class="diversity_review_middle">
                            <textarea></textarea>
                            <span>0/100</span>
                            <button class="diversity_review_button">发布</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 hidden-12 hidden-12">
                    <div class="episode_card_right">
                        <div class="episode_card_right_content">
                            <div class="episode_lists">
                                <div class="episode_card_right_title">
                                    正片
                                </div>
                                <div class="sl_list">
                                    <ul class="episode_list_php">
                                        <!--                                        <li title="第1话：「无能力」" class="misl_ep_item">-->
                                        <!--                                            <div class="misl_ep_img">-->
                                        <!--                                                <div class="common_lazy_img">-->
                                        <!--                                                    <img src="http://i0.hdslb.com/bfs/bangumi/image/0212baa8898d0c819c7fb84015e95b8fca621435.png"-->
                                        <!--                                                         alt="第1话">-->
                                        <!--                                                    <div class="common_lazy_img_text">第<span-->
                                        <!--                                                                class="common_lazy_img_num">1</span>话-->
                                        <!--                                                    </div>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="misl_ep_title">-->
                                        <!--                                                <div class="misl_ep_title_name">「无能力」</div>-->
                                        <!---->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="misl_ep_text">-->
                                        <!--                                                <div class="misl_ep_info">时长:24分钟</div>-->
                                        <!--                                                <div class="misl_ep_info">评论:+20</div>-->
                                        <!--                                            </div>-->
                                        <!--                                        </li>-->

                                    </ul>
                                </div>
                            </div>
                            <div class="episode_comment_lists">
                                <div class="episode_comment_title">
                                    <div class="common_content_title_text">
                                        本话的讨论
                                    </div>
                                    <div class="common_content_re">
                                        加入讨论
                                    </div>

                                </div>
                                <div class="episode_comment_content">
                                    <ul class="episode_comment_items_php">

                                        <!--                                        <li class="episode_comment_item ll">-->
                                        <!---->
                                        <!--                                            <div class="common_icon">-->
                                        <!--                                                <div class="common_icon_face">-->
                                        <!--                                                    <div class="common_icon_img">-->
                                        <!--                                                        <img alt="Yrqiiii"-->
                                        <!--                                                             src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp"-->
                                        <!--                                                             lazy="loaded">-->
                                        <!--                                                    </div>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="common_content">-->
                                        <!--                                                <div class="common_content_info">-->
                                        <!--                                                    <div class="common_username">-->
                                        <!--                                                        gaibian-->
                                        <!--                                                    </div>-->
                                        <!---->
                                        <!--                                                    <div class="common_time">-->
                                        <!--                                                        12月22号 9:33-->
                                        <!--                                                    </div>-->
                                        <!--                                                </div>-->
                                        <!---->
                                        <!--                                                <div class="common_text">-->
                                        <!--                                                    这集确实不错-->
                                        <!--                                                </div>-->
                                        <!---->
                                        <!--                                            </div>-->
                                        <!--                                        </li>-->
                                        <!--                                        <li class="episode_comment_item rr">-->
                                        <!---->
                                        <!--                                            <div class="common_icon">-->
                                        <!--                                                <div class="common_icon_face">-->
                                        <!--                                                    <div class="common_icon_img">-->
                                        <!--                                                        <img alt="Yrqiiii"-->
                                        <!--                                                             src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp"-->
                                        <!--                                                             lazy="loaded">-->
                                        <!--                                                    </div>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="common_content">-->
                                        <!--                                                <div class="common_content_info">-->
                                        <!--                                                    <div class="common_username">-->
                                        <!--                                                        gaibian-->
                                        <!--                                                    </div>-->
                                        <!---->
                                        <!--                                                    <div class="common_time">-->
                                        <!--                                                        12月22号 9:33-->
                                        <!--                                                    </div>-->
                                        <!--                                                </div>-->
                                        <!--                                                <div class="common_text">-->
                                        <!--                                                    这集确实不错-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                        </li>-->
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-3 col-md-3 hidden-sm hidden-xs">

                    <div class="episode_card_left">

                        <div class="episode_detail">
                            <div class="episode_detail_left_title">信息</div>
                            <div class="episode_detail_left_text">
                                <?php
                                echo nl2br($row['info']);
                                ?>
                            </div>
                        </div>
                        <div class="episode_directory">
                            <div class="episode_directory_title">
                                目录
                            </div>

                            <div class="episode_directory_content">
                                <ul class="episode_directory_php">
                                    <!--                                    <li>-->
                                    <!--                                        <div class="episode_directory_item">-->
                                    <!--                                            第1话：「无能力」-->
                                    <!--                                        </div>-->
                                    <!--                                    </li>-->
                                    <!--                                    <li>-->
                                    <!--                                        <div class="episode_directory_item chosendd">-->
                                    <!--                                            第1话：「无能力」-->
                                    <!--                                        </div>-->
                                    <!--                                    </li>-->
                                    <!--                                    <li>-->
                                    <!--                                        <div class="episode_directory_item">-->
                                    <!--                                            第1话：「无能力」-->
                                    <!--                                        </div>-->
                                    <!--                                    </li>-->
                                    <!--                                    <li>-->
                                    <!--                                        <div class="episode_directory_item">-->
                                    <!--                                            第1话：「无能力」-->
                                    <!--                                        </div>-->
                                    <!--                                    </li>-->
                                    <!--                                    <li>-->
                                    <!--                                        <div class="episode_directory_item">-->
                                    <!--                                            第1话：「无能力」-->
                                    <!--                                        </div>-->
                                    <!--                                    </li>-->
                                </ul>
                            </div>
                            <div class="episode_directory_back">
                                返回剧集页面
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--长评-->
            <div class="long_review">
                <div class="short_review_middle">
                    <div class="card_left_title" style="display: inline-block">短评</div>
                    <div class="short_review_drop">
                        <div>默认<i></i></div>
                        <ul>
                            <li>
                                <!--短评具体内容-头像那一行-->
                                <div class="li_first_div">
                                    <div class="short_review_face">
                                        <div class="short_review_img">
                                            <img alt="Yrqiiii"
                                                 src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp"
                                                 lazy="loaded">
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
                                        <i class="icon-praise"
                                           style="font-size: 14px;margin-right: 6px;"></i><span>5</span>
                                    </div>
                                    <div>
                                        <i class="icon-criticism"
                                           style="font-size: 14px;margin-right: 6px;"></i><span>1</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="short_review_write">去写短评</div>
                    <ul class="short_review_write_ul">
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                        <li><a href="long-comment-out.php">hello</a></li>
                    </ul>
                </div>
            </div>
            <!--短评-->
            <div class="short_review">
                <div class="short_review_middle">
                    <!--短评的头部-->
                    <div class="card_left_title" style="display: inline-block">短评</div>
                    <div class="short_review_drop">
                        <div>默认<i></i></div>
                        <ul>
                            <li>默认</li>
                            <li>最新</li>
                        </ul>
                    </div>
                    <div class="short_review_write">去写短评</div>
                    <!--短评具体内容-->
                    <ul class="short_review_write_ul">
                        <?php
                        $conn = mysqli_connect("47.115.15.18",
                            "wangyesheji", "e7BLUzfQv69wXybN",
                            "miraihyoka") or die("数据库连接失败");
                        mysqli_query($conn, 'set names utf8');
                        $sql = "select * from evaluation,user where evaluation.user_id=user.user_id and animate_id=$id and is_long=0 limit 0,5";
                        $result = mysqli_query($conn, $sql) or die("数据库查询评论失败" . $sql);

                        //                        $pic_url = "//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp";
                        //                        $name = "cccccc";
                        //                        $time = "2020/12/21";
                        //                        $review = "那天发发图肥牛饭";
                        //                        $short_score = array(6, 4, 8, 10, 4, 8);
                        //for ($i = 0; $i < 5; $i++)
                        while ($row = mysqli_fetch_assoc($result)) {     //$row['time']= strtotime($row['time']);
                            $row['time'] = substr($row['time'], 0, 16);
                            echo " <li> <div class='li_first_div'> <div class='short_review_face'> <div class='short_review_img'>"
                                . " <img alt='无' src='" . $row['avatar'] . "'>"
                                . "  </div> </div> <div class='short_review_name'>" . $row['username']
                                . " </div> <div class='short_review_star'> <span class='review_star'>";
                            for ($j = 0; $j < 5; $j++) {

                                if ($row['score'] > 0) {
                                    echo " <i class='icon-star-full'> <i></i> </i>";
                                    $row['score'] = $row['score'] - 2;
                                } else {
                                    echo "<i class='icon-star-empty'> <i></i> </i>";
                                }

                            }
                            echo "</span></div> <div class='short_review_time'>" . $row['time']
                                . "</div> </div> <div class='li_second_review'> <div class='second_review'>" . $row['content']
                                . "</div> </div> <div class='li_third_icon'> <div> <i class='icon-praise' style='font-size: 14px;margin-right: 6px;'></i><span></span></div>"
                                . "<div> <i class='icon-criticism' style='font-size: 14px;margin-right: 6px;'></i><span></span></div> </div> </li>";
                        }
                        ?>
                    </ul>
                </div>
                <!--写短评的弹窗-->
                <div class="write_review">
                    <div class="write_review_bg">
                        <div class="write_review_close"></div>
                        <div class="write_review_header">
                            <div style="width: 100%;">
                                <img src="<?php echo $animate_fj; ?>"
                                     alt="" style="float: left;width: 100px;height: 133px;">
                                <div class="write_review_info">
                                    <h4><strong><?php echo $animate_name; ?></strong></h4>
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
                <p class="insert_success">评论成功</p>
            </div>
        </div>
    </div>
</div>

<?php
include "../footer.php";
?>

</body>
<!--这里是js-->
<script>
    //    第一个函数-分数圆形条
    $(function () {
        //通过计时器来显示过渡的百分比进度，计时器不能直接放入循环中
        var temp = 0;
        var timer = setInterval(function () {

            calculate(1, temp, 1);
            //清除计时器结束该方法调用
            if (temp == <?php echo $score * 10; ?>) {
                clearInterval(timer);
            }
            temp++;
        }, 30);
        var temp2 = 0;
        var timer2 = setInterval(function () {
            calculate(0, temp2, 0);
            //清除计时器结束该方法调用
            if (temp2 ==<?php echo $score2 * 10; ?>) {
                clearInterval(timer2);
            }
            temp2++;
        }, 30);
        var comprenum =<?php echo $score3; ?>;
        var comprescore = "rect(0px," + comprenum + "px,50px,0px)";
        $('.compre_score').css("clip", comprescore);
        //var temp3 = 0;
        //var timer3 = setInterval(function () {
        //    calculate(2, temp3, 2);
        //    //清除计时器结束该方法调用
        //    if (temp3 ==<?php //echo $score2 * 10; ?>//) {
        //        clearInterval(timer3);
        //    }
        //    temp3++;
        //}, 30);
        //var temp4 = 0;
        //var timer4 = setInterval(function () {
        //    calculate(3, temp4, 3);
        //    //清除计时器结束该方法调用
        //    if (temp4 ==<?php //echo $score1 * 10; ?>//) {
        //        clearInterval(timer4);
        //    }
        //    temp4++;
        //}, 30);
        //var temp5 = 0;
        //var timer5 = setInterval(function () {
        //    calculate(4, temp5, 4);
        //    //清除计时器结束该方法调用
        //    if (temp5 ==<?php //echo $score2 * 10; ?>//) {
        //        clearInterval(timer5);
        //    }
        //    temp5++;
        //}, 30);
        //var temp6 = 0;
        //var timer6 = setInterval(function () {
        //    calculate(5, temp6, 5);
        //    //清除计时器结束该方法调用
        //    if (temp6 ==<?php //echo $score2 * 10; ?>//) {
        //        clearInterval(timer6);
        //    }
        //    temp6++;
        //}, 30);
        //var temp7 = 0;
        //var timer7 = setInterval(function () {
        //    calculate(6, temp7, 6);
        //    //清除计时器结束该方法调用
        //    if (temp7 ==<?php //echo $score2 * 10; ?>//) {
        //        clearInterval(timer7);
        //    }
        //    temp7++;
        //}, 30);
        //var temp8 = 0;
        //var timer8 = setInterval(function () {
        //    calculate(7, temp8, 7);
        //    //清除计时器结束该方法调用
        //    if (temp8 ==<?php //echo $score2 * 10; ?>//) {
        //        clearInterval(timer8);
        //    }
        //    temp8++;
        //}, 30);


        //改变页面显示百分比
        function calculate(index, value, i) {
            //改变页面显示的值
            $('.text').eq(i).html(value / 10);
            if (index == 0) {
                $('.bg .circle-left').remove();
                $('.bg .mask-right').remove();
            } else if (index == 1) {
                $('.bg_2 .circle-left').remove();
                $('.bg_2 .mask-right').remove();
            }
            // else if (index == 2) { //清除上次调用该方法残留的效果
            //
            //     $('.bg_3 .circle-left').remove();
            //     $('.bg_3 .mask-right').remove();
            // } else if (index == 3) { //清除上次调用该方法残留的效果
            //
            //     $('.bg_4 .circle-left').remove();
            //     $('.bg_4 .mask-right').remove();
            // } else if (index == 4) { //清除上次调用该方法残留的效果
            //
            //     $('.bg_5 .circle-left').remove();
            //     $('.bg_5 .mask-right').remove();
            // } else if (index == 5) { //清除上次调用该方法残留的效果
            //
            //     $('.bg_6 .circle-left').remove();
            //     $('.bg_6 .mask-right').remove();
            // } else if (index == 6) { //清除上次调用该方法残留的效果
            //
            //     $('.bg_7 .circle-left').remove();
            //     $('.bg_7 .mask-right').remove();
            // } else if (index == 7) { //清除上次调用该方法残留的效果
            //
            //     $('.bg_8 .circle-left').remove();
            //     $('.bg_8 .mask-right').remove();
            // }


            //当百分比小于等于50
            if (value <= 50) {
                var html = '';

                html += '<div class="mask-right" style="transform:rotate(' + (value * 3.6) + 'deg)"></div>';

                //元素里添加子元素
                $('.circle-right').eq(i).after(html);
            } else {
                value -= 50;
                var html = '';

                html += '<div class="circle-left">';
                html += '<div class="mask-left" style="transform:rotate(' + (value * 3.6) + 'deg)"></div>';
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
                changeheight();


            } else {
                tabs[i].className = '';
                contents[i].style.display = 'none';
            }
        }
    }
    // 更新左侧高度
    function changeheight(){
        var tureheight1 = $(".details_card_right").height()+50;
        // console.log(tureheight);
        $(".details_card_left").css("min-height", tureheight1);

        var tureheight2 = $(".episode_detail").height()+55;
        $(".episode_card_right_content").css("min-height", tureheight2);
    }

</script>
<script>
    //是否点击收藏
    function changelike() {
        var islogin =<?php echo $uid; ?>;
        var user_idd =<?php if ($uid != "") echo $uid; else echo '1';?>;


        if (islogin === "") {
            alert("请登录！")
            window.location.href = "../auth/login.php";
        } else {
            $.post("short_review_load.php",
                {objective: "islike", userid: user_idd, animateid:<?php echo $id;?>},
                function (data) {
                    data = eval('(' + data + ')');
                    $("#like_btn").html(data.text);
                });
        }
    }

    //后加入的点赞的互动
    function praise(e) {
        if ($(e).attr("class") == 'icon-praise' || $(e).attr("class") == 'icon-praise_full') {
            if ($(e).parent().parent().find("div:nth-child(2)").find("i").attr("class") == "icon-criticism_full") {
                return;
            }
            if ($(e).attr("class") == "icon-praise") {
                $(e).attr("class", "icon-praise_full");
                $(e).siblings().css("color", "#1189ef");
                var n = parseInt($(e).siblings().html());
                if ($(e).siblings().html() == "") {
                    n = 0;
                }
                $(e).siblings().html((n + 1));
            } else {
                $(e).attr("class", "icon-praise");
                $(e).siblings().css("color", "#99a2aa");
                var n = parseInt($(e).siblings().html());
                if (n == 1) {
                    $(e).siblings().html("");
                } else {
                    $(e).siblings().html((n - 1));
                }

            }
        }

    }

    function criticism(e) {
        if ($(e).attr("class") == 'icon-criticism' || $(e).attr("class") == 'icon-criticism_full') {
            if ($(e).parent().parent().find("div:nth-child(1)").find("i").attr("class") == "icon-praise_full") {
                return;
            }
            if ($(e).attr("class") == "icon-criticism") {
                $(e).attr("class", "icon-criticism_full");
                $(e).siblings().css("color", "#1189ef");
                var n = parseInt($(e).siblings().html());
                if ($(e).siblings().html() == "") {
                    n = 0;
                }
                $(e).siblings().html((n + 1));
            } else {

                $(e).attr("class", "icon-criticism");
                $(e).siblings().css("color", "#99a2aa");
                var n = parseInt($(e).siblings().html());
                if (n == 1) {
                    $(e).siblings().html("");
                } else {
                    $(e).siblings().html((n - 1));
                }
            }
        }
    }


</script>
<script>

    $(document).ready(function () {
        var indexnum = "";//第几颗星星
        var temp_success = 0;//评论成功消失的标识
        var shortreview = 0;//是否发表过短评
        //弹窗的加载
        $(".short_review_write").click(function () {
            $(".write_review").css("display", "block");
            $.post("short_review_load.php",
                {objective: "reviewcheck", userid: <?php echo $uid ?>},
                function (data) {
                    data = eval('(' + data + ')');
                    if (data.makesure == 1) {
                        //发表评论
                        $(".write_review_button").text("发表评论");
                    } else {
                        //修改评论
                        $(".write_review_button").text("修改评论");
                    }
                });
        });
        //弹窗的关闭
        $(".write_review_close").click(function () {
            $(".write_review").css("display", "none");

        });
        //评分的星星互动及按钮的检查
        $('.write_review_star i').hover(function () {
            var index = $(this).attr("index");
            indexnum = index;
            for (i = 0; i < index; i++) {
                $('.write_review_star i').eq(i).attr("class", "icon-star-full");
            }
            for (i = index; i < 5; i++) {
                $('.write_review_star i').eq(i).attr("class", "icon-star-empty");
            }
            if ($('.write_review_button').css("cursor") == "not-allowed") {
                $('.write_review_button').css("cursor", "pointer");
                $('.write_review_button').css("background", "#0cc7ef");
                $('.write_review_button').css("color", "#ffffff");

            }
        });
        //弹窗字数的更新及超字数提示
        $('.write_review_middle textarea').keyup(function () {
            var textlength = $(this).val().length;
            $('.write_review_middle span').text(textlength + "/100");

            if (textlength > 100) {
                $('.write_review_middle span').text("评论不超过100字");
                $('.write_review_middle span').css("color", "red");

            } else if ($('.write_review_middle span').css("color") == "rgb(255, 0, 0)") {
                $('.write_review_middle span').css("color", "#99a2aa");
            }

        });


        //点赞按钮的互动
        $('.icon-praise').click(function (e) {
            if ($(e.target).parent().parent().find("div:nth-child(2)").find("i").attr("class") == "icon-criticism_full") {
                return;
            }
            if ($(e.target).attr("class") == "icon-praise") {
                $(e.target).attr("class", "icon-praise_full");
                $(e.target).siblings().css("color", "#1189ef");
                var n = parseInt($(e.target).siblings().html());
                if ($(e.target).siblings().html() == "") {
                    n = 0;
                }
                $(e.target).siblings().html((n + 1));
            } else {
                $(e.target).attr("class", "icon-praise");
                $(e.target).siblings().css("color", "#99a2aa");
                var n = parseInt($(e.target).siblings().html());
                if (n == 1) {
                    $(e.target).siblings().html("");
                } else {
                    $(e.target).siblings().html((n - 1));
                }

            }
        });
        //点踩按钮的互动
        $('.icon-criticism').click(function (e) {
            if ($(e.target).parent().parent().find("div:nth-child(1)").find("i").attr("class") == "icon-praise_full") {
                return;
            }
            if ($(e.target).attr("class") == "icon-criticism") {
                $(e.target).attr("class", "icon-criticism_full");
                $(e.target).siblings().css("color", "#1189ef");
                var n = parseInt($(e.target).siblings().html());
                if ($(e.target).siblings().html() == "") {
                    n = 0;
                }
                $(e.target).siblings().html((n + 1));
            } else {

                $(e.target).attr("class", "icon-criticism");
                $(e.target).siblings().css("color", "#99a2aa");
                var n = parseInt($(e.target).siblings().html());
                if (n == 1) {
                    $(e.target).siblings().html("");
                } else {
                    $(e.target).siblings().html((n - 1));
                }
            }
        });
        //对滚轮的监听，是否申请新的评论
        var postnum = 5;//请求的次数，决定了申请什么位置的评论
        $(window).scroll(function () {
            if ($(".short_review").css("display") != "none") {
                var scrollTop = $(this).scrollTop();
                var scrollHeight = $(document).height();
                var windowHeight = $(this).height();
                if ((scrollHeight - (scrollTop + windowHeight)) <= 1) {
                    $.post("short_review_load.php",
                        {objective: "reviewload", "postnum": postnum, "id":<?php echo $id ?>},
                        function (data) {
                            postnum = postnum + 5;
                            data = eval('(' + data + ')');
                            for (i = 0; i < data.num; i++) {
                                var name = data.name[i];
                                var time = data.time[i];
                                var review = data.review[i];
                                var score = data.score[i];
                                var photo = data.photo[i];

                                var revtext1 = " <li> <div class='li_first_div'> <div class='short_review_face'> <div class='short_review_img'>"
                                    + " <img alt='a' src='" + photo + "' lazy='loaded'>"
                                    + "  </div> </div> <div class='short_review_name'>" + name
                                    + " </div> <div class='short_review_star'> <span class='review_star'>";
                                for ($j = 0; $j < 5; $j++) {

                                    if (score > 0) {
                                        var revtext1 = revtext1 + " <i class='icon-star-full'> <i></i> </i>";
                                        score = score - 2;
                                    } else {
                                        var revtext1 = revtext1 + " <i class='icon-star-empty'> <i></i> </i>";
                                    }

                                }
                                var revtext3 = revtext1 + "</span>"
                                    + "</div> <div class='short_review_time'>" + time
                                    + "</div> </div> <div class='li_second_review'> <div class='second_review'>" + review
                                    + "</div> </div> <div class='li_third_icon'> <div> <i class='icon-praise' style='font-size: 14px;margin-right: 6px;' onclick='praise(this)'></i><span></span></div>"
                                    + "<div> <i class='icon-criticism' style='font-size: 14px;margin-right: 6px;' onclick='criticism(this)'></i><span></span></div> </div> </li>";
                                $(".short_review_middle .short_review_write_ul").append(revtext3);
                            }
                        });


                }
            }
        });
        //短评的提交
        $('.write_review_button').click(function () {
            var text = $('.write_review_middle textarea').val();
            var textlength = text.length;
            if (textlength > 100 || $('.write_review_star i:nth-child(1)').attr("class") == "icon-star-empty") {
                return;
            }
            var index = 0;
            for (i = 0; i < 5; i++) {
                if ($('.write_review_star i').eq(i).attr("class") == "icon-star-full") {
                    index = index + 2;
                } else {
                    break;
                }
            }
            $.post("short_review_load.php",
                {
                    objective: "reviewinsert",
                    score: index,
                    shortreview: text,
                    userid: <?php echo $uid ?>,
                    id:<?php echo $id ?>},
                function (data) {
                    data = eval('(' + data + ')');
                    var name = data.name[0];
                    var time = "刚刚";
                    var review = text;
                    var photo = data.photo[0];
                    if (data.makesure == 1) {
                        $(".write_review").css("display", "none");
                        $('.insert_success').css({"display": "block", "z-index": 1000, "top": "50%"});
                        setTimeout(function () {
                            $('.insert_success').css("display", "none");
                        }, 500);
                        var revtext1 = " <li> <div class='li_first_div'> <div class='short_review_face'> <div class='short_review_img'>"
                            + " <img alt='a' src='" + photo + "' lazy='loaded'>"
                            + "  </div> </div> <div class='short_review_name'>" + name
                            + " </div> <div class='short_review_star'> <span class='review_star'>";
                        for ($j = 0; $j < 5; $j++) {

                            if (index > 0) {
                                revtext1 = revtext1 + " <i class='icon-star-full'> <i></i> </i>";
                                index = index - 2;
                            } else {
                                revtext1 = revtext1 + " <i class='icon-star-empty'> <i></i> </i>";
                            }

                        }
                        var revtext3 = revtext1 + "</span>"
                            + "</div> <div class='short_review_time'>" + time
                            + "</div> </div> <div class='li_second_review'> <div class='second_review'>" + review
                            + "</div> </div> <div class='li_third_icon'> <div> <i class='icon-praise' style='font-size: 14px;margin-right: 6px;' onclick='praise(this)'></i><span></span></div>"
                            + "<div> <i class='icon-criticism' style='font-size: 14px;margin-right: 6px;' onclick='criticism(this)'></i><span></span></div> </div> </li>";
                        $(".short_review_middle .short_review_write_ul").prepend(revtext3);
                    }
                });
        });
    });
</script>

<!--集数评论-->
<script>

    const animate_id = 100001;
    $(document).ready(function () {


        //弹窗的加载
        $(".common_content_re").click(function () {
            $(".diversity_review").css("display", "block");
            // $.post("release_episode_conmment.php",
            //     {objective: "reviewcheck", userid: "11111"},
            //     function (data) {
            //         data = eval('(' + data + ')');
            //         if (data.makesure == 1) {
            //             //发表评论
            //         } else {
            //             //修改评论
            //         }
            //     });
        });
        //弹窗的关闭
        $(".diversity_review_close").click(function () {
            $(".diversity_review").css("display", "none");
        });

        //弹窗字数的更新及超字数提示
        $('.diversity_review_middle textarea').keyup(function () {
            var textlength = $(this).val().length;
            $('.diversity_review_middle span').text(textlength + "/100");

            if (textlength === 0) {
                $('.diversity_review_button').css("cursor", "not-allowed");
                $('.diversity_review_button').css("background", "");
                $('.diversity_review_button').css("color", "");

            } else {
                if ($('.diversity_review_button').css("cursor") == "not-allowed") {
                    $('.diversity_review_button').css("cursor", "pointer");
                    $('.diversity_review_button').css("background", "#0cc7ef");
                    $('.diversity_review_button').css("color", "#ffffff");

                }
            }

            if (textlength > 100) {
                $('.diversity_review_middle span').text("评论不超过100字");
                $('.diversity_review_middle span').css("color", "red");


            } else if ($('.diversity_review_middle span').css("color") == "rgb(255, 0, 0)") {
                $('.diversity_review_middle span').css("color", "#99a2aa");
            }

        });

        //发布讨论
        $('.diversity_review_button').click(function () {
            var text = $('.diversity_review_middle textarea').val();
            var textlength = text.length;
            if (textlength > 100 || textlength === 0) {
                return;
            }
            let noin = $(".episode_directory_php li").index($(".chosendd").parent());
            noin = noin + 1
            $(".diversity_review").css("display", "none");
            $.post("release_episode_conmment.php",
                {diversity_review: text, userid: 1, no: noin, animate_id: animate_id},
                function (data) {
                    $(".episode_comment_items_php").html(data);
                });
        });
        changeheight();
        window.onresize = function () {
            changeheight();
        }

        function changeheight(){
            var tureheight1 = $(".details_card_right").height()+50;
            // console.log(tureheight);
            $(".details_card_left").css("min-height", tureheight1);

            var tureheight2 = $(".episode_detail").height()+55;
            $(".episode_card_right_content").css("min-height", tureheight2);
        }


        // $.ajaxSettings.async = true;
        //得到剧集列表
        $.get("episode_list.php?animate_id=" + animate_id, function (data, status) {
            $(".episode_list_php").html(data);
            // 返回列表
            $('.episode_directory_back').click(function (e) {
                $(".episode_comment_lists").css("display", "none");
                $(".episode_directory").css("display", "none");
                $(".episode_lists").css("display", "block");
                $(".episode_detail").css("display", "block");
                $(window).off("scroll");
                $('.clearfix>li').off("click");
                $('.episode_card_left').css('marginTop', 0);
                backep_top();
            });

            // 进入单独的剧集讨论
            $('.misl_ep_item').click(function (e) {
                $(".episode_comment_lists").show();
                $(".episode_directory").show();
                $(".episode_lists").css("display", "none");
                $(".episode_detail").css("display", "none");
                // 浮动侧栏
                $(window).scroll(setmargintop);
                $('.clearfix>li').click(setmargintop);


                const no = $(this).find(".common_lazy_img_num").text()
                $('.chosendd').removeClass("chosendd");
                $(".episode_directory_php li:eq(" + (no - 1) + ") div").addClass("chosendd");
                // console.log($(".episode_directory_php li:eq("+(no-1)+")" ).html())
                $.get("episode_comment.php?no=" + no + "&animate_id=" + animate_id, function (data, status) {
                    $(".episode_comment_items_php").html(data);
                });
            });
        });


        $.get("get_episode.php?animate_id=" + animate_id, function (data, status) {
            $(".episode_directory_php").html(data);
            // 侧栏点击
            $('.episode_directory_item').click(function (e) {
                $('.chosendd').removeClass("chosendd");
                $(this).addClass("chosendd");
                const index = $(".episode_directory_php li").index($(this).parent());

                $.get("episode_comment.php?no=" + (index + 1) + "&animate_id=" + animate_id, function (data, status) {
                    $(".episode_comment_items_php").html(data);
                });

            });

        });


        //返回列表后返回顶部
        function backep_top() {

            //每30ms执行一次  scrollTop+iSpeed
            timer = setInterval(function () {
                var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                //算速度     除以的数值越大，速度越慢
                var iSpeed = Math.floor(0 - scrollTop / 5);
                if (scrollTop == 0) {
                    //不关闭定时器，会导致第一次回到顶部之后，导致不能在响应用户的滚动，不定的触发回到顶部
                    clearInterval(timer);
                }
                //当按钮启动页面滚动，设置为true
                bSys = true;
                document.documentElement.scrollTop = document.body.scrollTop = scrollTop + iSpeed;
            }, 30);

        }


        function setmargintop() {

            var scrtop = $(window).scrollTop() - 360;
            if (scrtop < 0) {
                return
            }
            console.log(scrtop);
            // 计算用户向下滚动页面的百分比
            var scrollPercent = 100 * scrtop / ($(document).height() - $(window).height());

            // 获取粘性元素的高度
            var stickyHeight = 350;
            // console.log(stickyHeight);
            // 计算粘性元素的边距顶部
            var marginTop = (($(".episode_card_right_content").height() - stickyHeight) / 100) * scrollPercent;

            // 设置粘性元素的上边距
            $('.episode_card_left').css('marginTop', marginTop);
        }
    });


</script>

</html>
