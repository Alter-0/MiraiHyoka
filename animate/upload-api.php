<?php
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
//echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 20480000)   // 小于 200 kb
    && in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        $json = array("errno"=>1,"data"=>array("#"));
        echo  json_encode($json,JSON_UNESCAPED_UNICODE);
    }
    else
    {

        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("img/upload/" . $_FILES["file"]["name"]))
        {

            $path =  "img/upload/" . $_FILES["file"]["name"];
            $json = array("errno"=>0,"data"=>array($path));
            echo  json_encode($json,JSON_UNESCAPED_UNICODE);
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "img/upload/" . $_FILES["file"]["name"]);
            $path =  "img/upload/" . $_FILES["file"]["name"];
            $json = array("errno"=>0,"data"=>array($path));
            echo  json_encode($json,JSON_UNESCAPED_UNICODE);
        }
    }
}
else
{
    $json = array("errno"=>1,"data"=>array("#"));
    echo  json_encode($json,JSON_UNESCAPED_UNICODE);
}
?>
