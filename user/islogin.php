<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
</head>

<body>
<?PHP session_start();
if(empty($_SESSION["user_id "]))
    header("location:login.php");
?>

</body>
</html>
