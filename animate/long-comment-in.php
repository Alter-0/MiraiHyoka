<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>hello</title>
    <!--    header必须引入的三个样式文件,使用php引入-->
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="css/long-comment-in.css">
    <script src="../js/jquery.js"></script>

</head>
<body>
<?php
 include "../header.php";
?>
<div class="container">
    <div class="l-left-comment">
        这个是左边
    </div>
    <div class="l-right-bar">
        <div class="bar-title">
            这个是右边
        </div>
    </div>
</div>
</body>
</html>