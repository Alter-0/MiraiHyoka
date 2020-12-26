<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
</head>
<body>
<?php
session_start();
unset($_SESSION['user_id']);
header("location:../index.php");
?>
</body>
</html>
