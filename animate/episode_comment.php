<?php
include '../conn.php';
date_default_timezone_set('Asia/Shanghai');
//查集数表
$no = $_GET["no"];
$animate_id = $_GET["animate_id"];
$sql = "select episode_id from episode where no=" . $no . " and animate_id=" . $animate_id;
$result = mysqli_query($conn, $sql) or die("失败" . $sql);
if (mysqli_num_rows($result) < 1) {
    echo '<div class="no_common">现在还没有关于本集讨论哦。</div>';
} else {
    $ep_id = mysqli_fetch_array($result);
    $ep_id = $ep_id[0];

    $sql = "select * from reply where episode_id=" . $ep_id . " order by time desc";
    $result = mysqli_query($conn, $sql) or die("失败" . $sql);

//<li class="episode_comment_item ll">
//
//<div class="common_icon">
//<div class="common_icon_face">
//<div class="common_icon_img">
//<img alt="Yrqiiii"
//src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp"
//lazy="loaded">
//</div>
//</div>
//</div>
//<div class="common_content">
//<div class="common_content_info">
//<div class="common_username">
//gaibian
//</div>
//
//<div class="common_time">
//12月22号 9:33
//</div>
//</div>
//
//<div class="common_text">
//这集确实不错
//</div>
//
//</div>


//</li>


//<li class="episode_comment_item rr">
//
//<div class="common_icon">
//<div class="common_icon_face">
//<div class="common_icon_img">
//<img alt="Yrqiiii"
//src="//i2.hdslb.com/bfs/face/65d914e518ff8b1d14d8fd26720366984f291e05.jpg@35w_35h.webp"
//lazy="loaded">
//</div>
//</div>
//</div>
//<div class="common_content">
//<div class="common_content_info">
//<div class="common_username">
//gaibian
//</div>
//
//<div class="common_time">
//12月22号 9:33
//</div>
//</div>
//<div class="common_text">
//这集确实不错
//</div>
//</div>
//</li>
//
    $i = 1;
    if (mysqli_num_rows($result) < 1) {
        echo '<div class="no_common">现在还没有关于本集讨论哦。</div>';
    } else {

        while ($info = mysqli_fetch_array($result)) {

            $usersql = "select * from user where user_id=" . $info["user_id"];
            $userresult = mysqli_query($conn, $usersql) or die("失败" . $sql);
            $userinfo = mysqli_fetch_array($userresult);
            $avatar = $userinfo["avatar"];
            if ($userinfo["username"]) {
                $username = $userinfo["username"];
            } else {
                $username = $userinfo["account"];
            }
            if ($i % 2 == 0) {
                echo '<li class="episode_comment_item rr">';
            } else {
                echo '<li class="episode_comment_item ll">';
            }
            $i += 1;

            echo '<div class="common_icon">';
            echo '<div class="common_icon_face">';
            echo '<div class="common_icon_img">';
            echo '<img alt="头像"';
            echo 'src="' . $avatar . '"';
            echo 'lazy="loaded">';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="common_content">';
            echo '<div class="common_content_info">';
            echo '<div class="common_username">' . $username . '</div>';
            echo '<div class="common_time">' . date("Y-m-d H:i:s", strtotime($info["time"])) . '</div>';
            echo '</div>';
            echo '<div class="common_text">' . $info["content"] . '</div>';
            echo '</div>';
            echo '</li>';

        }
    }
}