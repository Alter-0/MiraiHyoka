<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
</head>

<body>
<?php
session_start();
destory($_SESSION['account']);
header("location:login.php");
?>
</body>
</html>
