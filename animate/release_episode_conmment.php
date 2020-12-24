<?php
include '../conn.php';
date_default_timezone_set('Asia/Shanghai');
$text=$_POST['diversity_review'];
$user_id=$_POST['userid'];
$no = $_POST["no"];
$animate_id = $_POST["animate_id"];

$sql = "select episode_id from episode where no=" . $no . " and animate_id=" . $animate_id;
$result = mysqli_query($conn, $sql) or die("失败" . $sql);
$ep_id = mysqli_fetch_array($result);
$ep_id = $ep_id[0];

$data=date('y-m-d h:i:s',time());

$sql="insert into reply(user_id,episode_id,time,content) value ('".$user_id."','".$ep_id."','".$data."','".$text."')";
$result = mysqli_query($conn, $sql) or die("失败" . $sql);

$sql = "select * from reply where episode_id=" . $ep_id . " order by time desc";
$result = mysqli_query($conn, $sql) or die("失败" . $sql);


$i = 1;
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