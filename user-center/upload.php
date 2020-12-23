<?php
include "../conn.php";
session_start();

// 上传头像
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["avatar"]["name"]);
echo $_FILES["avatar"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["avatar"]["type"] == "image/gif")
        || ($_FILES["avatar"]["type"] == "image/jpeg")
        || ($_FILES["avatar"]["type"] == "image/jpg")
        || ($_FILES["avatar"]["type"] == "image/pjpeg")
        || ($_FILES["avatar"]["type"] == "image/x-png")
        || ($_FILES["avatar"]["type"] == "image/png"))
    && ($_FILES["avatar"]["size"] < 20480000)   // 小于 200 kb
    && in_array($extension, $allowedExts))
{
    if ($_FILES["avatar"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["avatar"]["error"] . "<br>";
    }
    else
    {
        echo "上传文件名: " . $_FILES["avatar"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["avatar"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["avatar"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置: " . $_FILES["avatar"]["tmp_name"] . "<br>";

        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("upload/" . $_FILES["avatar"]["name"]))
        {
            echo $_FILES["avatar"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["avatar"]["tmp_name"], "../image/upload/" . $_FILES["avatar"]["name"]);
            echo "文件存储在: " . "upload/" . $_FILES["avatar"]["name"];
        }
    }
}
else
{
    echo "非法的文件格式";
}

// 上传背景
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["background"]["name"]);
echo $_FILES["background"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["background"]["type"] == "image/gif")
        || ($_FILES["background"]["type"] == "image/jpeg")
        || ($_FILES["background"]["type"] == "image/jpg")
        || ($_FILES["background"]["type"] == "image/pjpeg")
        || ($_FILES["background"]["type"] == "image/x-png")
        || ($_FILES["background"]["type"] == "image/png"))
    && ($_FILES["background"]["size"] < 20480000)   // 小于 200 kb
    && in_array($extension, $allowedExts))
{
    if ($_FILES["background"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["background"]["error"] . "<br>";
    }
    else
    {
        echo "上传文件名: " . $_FILES["background"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["background"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["background"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置: " . $_FILES["background"]["tmp_name"] . "<br>";

        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("upload/" . $_FILES["background"]["name"]))
        {
            echo $_FILES["background"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["background"]["tmp_name"], "../image/upload/" . $_FILES["background"]["name"]);
            echo "文件存储在: " . "../image/upload/" . $_FILES["background"]["name"];
        }
    }
}
else
{
    echo "非法的文件格式";
}

$user_id=$_SESSION['user_id'];
$username=$_POST['name'];
$sex=$_POST['sex'];
$introduction=$_POST['introduction'];
$avatar="../image/upload/".$_FILES["avatar"]["name"];
$background="../image/upload/".$_FILES["background"]["name"];
$is_timeline=$_POST['is_timeline'];
$is_favorite=$_POST['is_favorite'];

$sql = "update user set username='$username',sex='$sex',introduction='$introduction',avatar='$avatar',background='$background',is_timeline='$is_timeline',is_favorite='$is_favorite' where user_id='$user_id'";
$result = mysqli_query($conn, $sql) or die("数据更新失败".$sql);

header('location:usercenter.php');


?>