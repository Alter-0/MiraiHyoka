<?php
if (empty($_FILES["file"]["name"])){
    $json = array("errno"=>1,"data"=>array("#"));
    echo  json_encode($json,JSON_UNESCAPED_UNICODE);
}else{


$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
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
//        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
//        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
//        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

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
}
/**
 * {
// errno 即错误代码，0 表示没有错误。
//       如果有错误，errno != 0，可通过下文中的监听函数 fail 拿到该错误码进行自定义处理
"errno": 0,

// data 是一个数组，返回图片的线上地址
"data": [
"图片1地址",
"图片2地址",
"……"
]
}
 */