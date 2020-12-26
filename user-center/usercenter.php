<!DOCTYPE html>
<html lang="en">
<head>
    <?php session_start() ?>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="../js/jquery.js"></script>
    <!-- 引用部分@blueberry -->
    <script src="../js/main.js"></script>
    <!-- 引用部分@blueberry -->
    <!--    <link href="font/style.css" rel="stylesheet"/>-->
    <meta charset="UTF-8" name="referrer" content="never">
    <title>Mirai-个人中心</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">

    <link href="css/usercenter.css" rel="stylesheet"/>

    <style>
        body {
            background: url("../image/background.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
        }
    </style>

</head>

<?php
include "../conn.php";

date_default_timezone_set("Asia/Shanghai");

//$_SESSION['user_id'] = 100001;
if(empty($_SESSION['user_id'])){
    $user_id=100001;
}else{
    $user_id = $_SESSION['user_id'];
}

$sql = "select * from user where user_id='$user_id'";
$result = mysqli_query($conn, $sql) or die("数据查询失败" . $sql);
$row = mysqli_fetch_assoc($result);

$username = $row['username'];
$account = $row['account'];
$sex = $row['sex'];
$introduction = $row['introduction'];
$email = $row['email'];
$avatar = $row['avatar'];
$background = $row['background'];
$is_timeline = $row['is_timeline'];
$is_favorite = $row['is_favorite'];
$reg_time = $row['reg_time'];

function timeline($choice)
{
    include "../conn.php";

    $user_id = $_SESSION['user_id'];
    if ($choice == 1) {
        $sql = "select time from evaluation where user_id='$user_id' group by date(time) order by time desc";
        $result = mysqli_query($conn, $sql) or die("数据查询失败" . $sql);
        $num_rows = mysqli_num_rows($result);
//        echo $num_rows;
        if ($num_rows != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $date = date("Y-m-d", strtotime($row['time']));

                $sql_time = "select * from evaluation where user_id='$user_id' and time like '$date%' order by time desc";
                $result_time = mysqli_query($conn, $sql_time) or die("数据查询失败" . $sql_time);
                echo '<div class="timeline_cell">';
                echo "
                <div class='timeline_time'>
                        $date
                </div>";

                echo "<div class='timeline_content'>";

                while ($row_time = mysqli_fetch_assoc($result_time)) {

                    $animate_id = $row_time['animate_id'];
                    $sql_animate = "select name_jp from animate where animate_id='$animate_id'";
                    $result_animate = mysqli_query($conn, $sql_animate) or die("数据查询失败" . $sql);
                    $row_animate = mysqli_fetch_assoc($result_animate);

                    $animate_name = $row_animate['name_jp'];

                    $time = cal_time($row_time['time']);

                    echo "
                    <div class='timeline_content'>
                        <p id='main'>我对[$animate_name]进行了评分</p>
                        <p id='other'>$time</p>
                    </div>";
                }
                echo '</div></div>';
            }
        }
    } elseif ($choice == 2) {
        $sql = "select time from favorites where user_id='$user_id' group by date(time) order by time desc ";
        $result = mysqli_query($conn, $sql) or die("数据查询失败" . $sql);

        $num_rows = mysqli_num_rows($result);
        if ($num_rows != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $date = date("Y-m-d", strtotime($row['time']));

                $sql_time = "select * from favorites where user_id='$user_id' and time like '$date%' order by time desc";
                $result_time = mysqli_query($conn, $sql_time) or die("数据查询失败" . $sql_time);
                echo '<div class="timeline_cell">';
                echo "
                <div class='timeline_time'>
                        $date
                </div>";

                echo "<div class='timeline_content'>";

                while ($row_time = mysqli_fetch_assoc($result_time)) {

                    $animate_id = $row_time['animate_id'];
                    $sql_animate = "select name_jp from animate where animate_id='$animate_id'";
                    $result_animate = mysqli_query($conn, $sql_animate) or die("数据查询失败" . $sql);
                    $row_animate = mysqli_fetch_assoc($result_animate);

                    $animate_name = $row_animate['name_jp'];

                    $time = cal_time($row_time['time']);

                    echo "
                    <div class='timeline_content'>
                        <p id='main'>我收藏了[$animate_name]</p>
                        <p id='other'>$time</p>
                    </div>";
                }
                echo '</div></div>';
            }
        }
    }
}

function cal_time($time): string
{
    $time_start = strtotime($time);
    $time_end = time();

    $cle = $time_end - $time_start;

    $d = floor($cle / 3600 / 24);
    $h = floor(($cle % (3600 * 24)) / 3600);  //%取余
    $m = floor(($cle % (3600 * 24)) % 3600 / 60);
    $s = floor(($cle % (3600 * 24)) % 60);

    return " $d 天 $h 小时 $m 分 $s 秒前";
}

function favorite()
{
    include "../conn.php";

    $user_id = $_SESSION['user_id'];
    $sql = "select * from favorites where user_id='$user_id' order by time desc ";
    $result = mysqli_query($conn, $sql) or die("数据查询失败" . $sql);
//    echo '<div class="timeline_cell">';
    while ($row = mysqli_fetch_assoc($result)) {
        $animate_id = $row['animate_id'];
        $sql_animate = "select * from animate where animate_id='$animate_id'";
        $result_animate = mysqli_query($conn, $sql_animate) or die("数据查询失败" . $sql);
        $row_animate = mysqli_fetch_assoc($result_animate);

        $animate_name = $row_animate['name_jp'];
        $animate_cover = $row_animate['cover'];

        echo "<div class='animate'>
                        <div class='animate_img'>
                            <a href='../animate/detail.php?animate_id=$animate_id'>
                                <img src='$animate_cover' alt=''>
                            </a>
                        </div>
                        <div class='animate_text'>
                            <a href='../animate/detail.php?animate_id=$animate_id'>
                                $animate_name
                            </a>
                        </div>
              </div>";
    }
//    echo "</div>";
}

function message($choice)
{
    include "../conn.php";
//    $user_id = $_SESSION['user_id'];

    if ($choice == 0) {
        $sql = "select * from reply order by time desc ";
        $result = mysqli_query($conn, $sql) or die("数据查询失败" . $sql);
        echo '<div class="timeline_cell">';
        while ($row = mysqli_fetch_assoc($result)) {
            $re_reply_id = $row['re_reply_id'];
            $reply_id=$row['reply_id'];
            $content=$row['content'];
            $sql_re = "select * from reply where reply_id='$re_reply_id'";
            $result_re = mysqli_query($conn, $sql_re) or die("数据查询失败" . $sql);

            $num_rows = mysqli_num_rows($result_re);
            if ($num_rows!=0){
                $row_re = mysqli_fetch_assoc($result_re);
                $time = date("Y-m-d", strtotime($row['time']));
                $re_content = $row_re['content'];

                $is_read=$row['is_read'];
                if ($is_read==0){
                    echo "<div class='message_content'>
                     <p id='main'>回复：'$content'</p>
                     <p id='main'>$re_content</p>
                     <p id='other'><a href='javascript:' id='refresh'><span id='$reply_id' class='reply'>未读</span></a></p>
                     <p id='other'>$time</p>
                  </div>";
                    $answer=$reply_id;
                }else{
                    echo "<div class='message_content'>
                     <p id='main'>回复：'$content'</p>
                     <p id='main'>$re_content</p>
                     <p id='other'>已读</p>
                     <p id='other'>$time</p>
                  </div>";
                    $answer='';
                }
            }
        }
        echo "</div>";
    }
    return $answer;
}
?>
<body>
<?php
/**
 * 登录后取消登录注册按钮，显示用户头像以及相关操作
 */
include "../header.php"

?>
<!--<div style="height: 50px"></div>-->
<div class="all">
    <div class="top">
        <div class="banner" style="background: url('<?php
        if (empty($background)) {
            echo "../image/new_banner1.png";
        } else {
            echo $background;
        }
        ?>') center center;">
            <div style="height: 200px"></div>
            <div class="banner_filter">
                <div class="info">
                    <div class="avatar">
                        <a href="#">
                            <img src="
                            <?php
                            if (empty($avatar)) {
                                echo "../image/akari.jpg";
                            } else {
                                echo $avatar;
                            }
                            ?>" alt="">
                        </a>
                    </div>
                    <div class="user">
                        <div class="user_name">
                            <?php
                            if (empty($username)) {
                                echo $account;
                            } else {
                                echo $username;
                            }
                            ?>
                        </div>
                        <div class="user_introduction">
                            <?php
                            if (empty($introduction)) {
                                echo "这个人很懒，什么都没有写...";
                            } else {
                                echo $introduction;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab_nav">
        <ul class="clearfix">
            <li onclick="changeTab(this)" class="on">时间线</li>
            <li onclick="changeTab(this)">收藏</li>
            <li onclick="changeTab(this)">消息</li>
            <li onclick="changeTab(this)">设置</li>
        </ul>
    </div>

    <div class="tab_de">
        <div class="time_line">
            <div class="left">
                <div class="timeline_tab_nav">
                    <ul>
                        <!--                        <li onclick="changeTab_timeline(this)" class="on">全部</li>-->
                        <li onclick="changeTab_timeline(this)" class="on">评分</li>
                        <li onclick="changeTab_timeline(this)">收藏</li>
                    </ul>
                </div>
                <div class="timeline_tab_de">
                    <!--                    <div class="timeline_all">-->
                    <!--                        --><?php
                    //                        timeline(1);
                    //                        ?>
                    <!--                    </div>-->

                    <div class="timeline_rating">
                        <?php
                        timeline(1);
                        ?>
                    </div>

                    <div class="timeline_favorite">
                        <?php
                        timeline(2);
                        ?>
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="right_in">
                    <!--需要动态插入-->
                    <p>用户名：
                        <?php
                        echo $account;
                        ?></p>
                    <p>邮箱：
                        <?php
                        echo $email;
                        ?></p>
                    <p>性别：
                        <?php
                        if ($sex == 1) {
                            echo "男";
                        } else {
                            echo "女";
                        }
                        ?>
                    </p>
                    <p>个人简介：
                        <?php
                        if (empty($introduction)) {
                            echo "这个人很懒，什么都没有写...";
                        } else {
                            echo $introduction;
                        }
                        ?>
                    </p>
                    <p>注册日期：
                        <?php
                        echo $reg_time;
                        ?></p>
                    <!--需要动态插入-->
                </div>
            </div>
        </div>

        <div class="favorite">
            <div class="left">
                <div class="favorite_top">
                    <h3>我的收藏</h3>
                </div>
                <div class="favorite_middle">
                    <?php
                    favorite();
                    ?>
                    <!--需要动态插入-->
                    <!--需要动态插入-->
                </div>

                <div class="favorite_bottom">
                </div>
            </div>

            <div class="right">
                <div class="right_in">
                    <!--需要动态插入-->
                    <p>用户名：
                        <?php
                        echo $account;
                        ?></p>
                    <p>邮箱：
                        <?php
                        echo $email;
                        ?></p>
                    <p>性别：
                        <?php
                        if ($sex == 1) {
                            echo "男";
                        } else {
                            echo "女";
                        }
                        ?>
                    </p>
                    <p>个人简介：
                        <?php
                        if (empty($introduction)) {
                            echo "这个人很懒，什么都没有写...";
                        } else {
                            echo $introduction;
                        }
                        ?>
                    </p>
                    <p>注册日期：
                        <?php
                        echo $reg_time;
                        ?></p>
                    <!--需要动态插入-->
                </div>
            </div>
        </div>

        <div class="message">
            <div class="left">
                <div class="message_tab_nav">
                    <ul>
                        <li onclick="changeTab_message(this)" class="on">我的消息</li>
                        <li onclick="changeTab_message(this)">系统消息</li>
                    </ul>
                </div>
                <div class="message_tab_de">
                    <div class="message_my">

                        <?php
                        $reply_id=message(0);
                        ?>
                        <!--需要动态插入-->
                        <!--需要动态插入-->
                    </div>
                    <div class="message_system">

                    </div>
                </div>

            </div>

            <div class="right">
                <div class="right_in">
                    <!--需要动态插入-->
                    <p>用户名：
                        <?php
                        echo $account;
                        ?></p>
                    <p>邮箱：
                        <?php
                        echo $email;
                        ?></p>
                    <p>性别：
                        <?php
                        if ($sex == 1) {
                            echo "男";
                        } else {
                            echo "女";
                        }
                        ?>
                    </p>
                    <p>个人简介：
                        <?php
                        if (empty($introduction)) {
                            echo "这个人很懒，什么都没有写...";
                        } else {
                            echo $introduction;
                        }
                        ?>
                    </p>
                    <p>注册日期：
                        <?php
                        echo $reg_time;
                        ?></p>
                    <!--需要动态插入-->
                </div>
            </div>
        </div>

        <div class="setting">
            <div class="left">
                <div class="setting_left">

                </div>
                <div class="setting_right">
                    <form action="upload.php" method="post" class="form" enctype="multipart/form-data">
                        <div class="settings" id="name">
                            <div class="settings_left">
                                昵称：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <input type="text" value="<?php echo $username; ?>" name="name">
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="sex">
                            <div class="settings_left">
                                性别：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <label>
                                        <input type="radio" name="sex" value="1">男
                                    </label>
                                    <label>
                                        <input type="radio" name="sex" value="0">女
                                    </label>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="introduction">
                            <div class="settings_left">
                                个人简介：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <textarea rows="5" cols="40" name="introduction"
                                              placeholder="这个人很懒，什么都没有写..."></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="avatar">
                            <div class="settings_left">
                                头像：
                            </div>
                            <div class="settings_right">
                                <label class="upload_img">
                                <span role="button">
                                    <input type="file" name="avatar" id="input_avatar" onchange="preview_avatar(this)"
                                           accept style="display: none" alt="">
                                    <img src="<?php
                                    if (empty($avatar)) {
                                        echo "../image/akari.jpg";
                                    } else {
                                        echo $avatar;
                                    }
                                    ?>" id="img_avatar" alt="avatar"
                                         style="max-height: 100%;max-width: 100%">
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="background">
                            <div class="settings_left">
                                背景图片：
                            </div>
                            <div class="settings_right">
                                <label class="upload_background">
                                <span role="button">
                                    <input type="file" name="background" id="input_background"
                                           onchange="preview_background(this)" accept style="display: none" alt="">
                                    <img src="<?php
                                    if (empty($background)) {
                                        echo "../image/new_banner1.png";
                                    } else {
                                        echo $background;
                                    }
                                    ?>" id="img_background" alt="background"
                                         style="max-height: 100%;max-width: 100%">
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="is_timeline">
                            <div class="settings_left">
                                是否允许他人查看我的时间线：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <label>
                                        <input type="radio" name="is_timeline" value="1">
                                        是
                                    </label>
                                    <label>
                                        <input type="radio" name="is_timeline" value="0">
                                        否
                                    </label>
                                </label>
                            </div>
                        </div>
                        <div class="settings" id="is_favorite">
                            <div class="settings_left">
                                是否允许他人查看我的收藏：
                            </div>
                            <div class="settings_right">
                                <label>
                                    <label>
                                        <input type="radio" name="is_favorite" value="1">
                                        是
                                    </label>
                                    <label>
                                        <input type="radio" name="is_favorite" value="0">
                                        否
                                    </label>
                                </label>
                            </div>
                        </div>
                        <div class="setting_submit">
                            <span>
                                <button type="submit">
                                    提交
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="right">
                <div class="right_in">
                    <!--需要动态插入-->
                    <p>用户名：
                        <?php
                        echo $account;
                        ?></p>
                    <p>邮箱：
                        <?php
                        echo $email;
                        ?></p>
                    <p>性别：
                        <?php
                        if ($sex == 1) {
                            echo "男";
                        } else {
                            echo "女";
                        }
                        ?>
                    </p>
                    <p>个人简介：
                        <?php
                        if (empty($introduction)) {
                            echo "这个人很懒，什么都没有写...";
                        } else {
                            echo $introduction;
                        }
                        ?>
                    </p>
                    <p>注册日期：
                        <?php
                        echo $reg_time;
                        ?></p>
                    <!--需要动态插入-->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../footer.php" ?>
<?php
//
//if(isset($_GET['d']) && $_GET['d']=='ajax'){
//    $id=$GLOBALS['reply_id'];
//    echo "<script>alert('$id')</script>";
//    include "../conn.php";
//    echo '<script>alert("已经执行了方法")</script>';
//    $sql="update reply set is_read='1' where reply_id=$id";
//    mysqli_query($conn, $sql);
//    exit();
//}
//
//?>
</body>

<script>
    //切换页面的函数
    function changeTab(tab) {
        var tabs = document.getElementsByClassName('tab_nav')[0].getElementsByTagName("li");
        var contents = document.querySelectorAll(".tab_de>div");
        for (var i = 0, len = tabs.length; i < len; i++) {
            if (tabs[i] === tab) {
                tabs[i].className = 'on';
                contents[i].style.display = 'grid';
            } else {
                tabs[i].className = '';
                contents[i].style.display = 'none';
            }
        }
    }

    function changeTab_timeline(tab) {
        var tabs = document.getElementsByClassName('timeline_tab_nav')[0].getElementsByTagName("li");
        var contents = document.querySelectorAll(".timeline_tab_de>div");
        for (var i = 0, len = tabs.length; i < len; i++) {
            if (tabs[i] === tab) {
                tabs[i].className = 'on';
                contents[i].style.display = 'grid';
            } else {
                tabs[i].className = '';
                contents[i].style.display = 'none';
            }
        }
    }

    function changeTab_message(tab) {
        var tabs = document.getElementsByClassName('message_tab_nav')[0].getElementsByTagName("li");
        var contents = document.querySelectorAll(".message_tab_de>div");
        for (var i = 0, len = tabs.length; i < len; i++) {
            if (tabs[i] === tab) {
                tabs[i].className = 'on';
                contents[i].style.display = 'grid';
            } else {
                tabs[i].className = '';
                contents[i].style.display = 'none';
            }
        }
    }

    function preview_avatar() {
        var reads = new FileReader();
        f = document.getElementById('input_avatar').files[0];
        reads.readAsDataURL(f);
        reads.onload = function (e) {
            document.getElementById('img_avatar').src = this.result;
        }
    }

    function preview_background() {
        var reads = new FileReader();
        f = document.getElementById('input_background').files[0];
        reads.readAsDataURL(f);
        reads.onload = function (e) {
            document.getElementById('img_background').src = this.result;
        }
    }

    $('#refresh').click(function (){
        $.get('upload_read.php?d=ajax&reply_id=<?php echo $reply_id?>',function (d){
            $('.reply').text('已读');
            alert(d);
        })
    })

</script>


</html>