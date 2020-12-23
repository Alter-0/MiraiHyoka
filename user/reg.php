<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <!--    header必须引入的三个样式文件,使用php引入-->
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="../js/jquery.js"></script>
</head>
<?php session_start(); ?>
<style>
    .search{
        margin-right: 40px;
    }
    * {
        margin: 0;
        padding: 0;
        border: 0;
        list-style: none;
    }

    body {
        display: flex;
        flex-direction: column;
        background-attachment: fixed;
        background-image: url(../image/background.jpg);
        background-size: cover;
    }

    .content {
        width: 100%;
        height: auto;
        margin-bottom: 100px;
    }
    .left {
        width: 40%;
        height: 500px;
        float: left;
        display: inline-block;
        background: url("../image/user_background.jpg");
        background-size: cover;
        box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
        border-radius: 15px;
        margin-left: 10%;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .right {
        width: 40%;
        height: 500px;
        display: inline-block;
        margin-left: 5%;
        margin-top: 20px;
        position: relative;

    }

    form {
        margin-left: 30px;
    }

    p {
        font-size: 40px;
        color: #6cc4ff;
        font-family: 微软雅黑;
        margin-bottom: 20px;
        margin-left: 40px;
        margin-top: 0;
    }

    #username{
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        padding-left: 30px;
        width: 40%;
        height: 40px;
        margin-bottom: 24px;
        display: block;
        background: url("image/head.png") 3px 3px no-repeat;
        color: (0,0,0,.65);
    }
    #password{
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        width: 40%;
        height: 40px;
        margin-bottom: 24px;
        display: block;
        padding-left: 30px;
        background: url("image/password.png") 3px 3px no-repeat;
    }

    #repassword {
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        width: 40%;
        height: 40px;
        margin-bottom: 24px;
        display: block;
        padding-left: 30px;
        background: url("image/password.png") 3px 3px no-repeat;
    }

    #email {
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        width: 40%;
        height: 40px;
        margin-bottom: 24px;
        display: block;
        padding-left: 30px;
        background: url("image/email.png") 3px 3px no-repeat;
    }

    #checknum {
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        width: 40%;
        height: 40px;
        margin-bottom: 24px;
        display: block;
        padding-left: 30px;
        background-color: transparent;
        background: url("image/password.png") 3px 3px no-repeat;
    }

    #submit {
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        background-color: rgba(100, 149, 237, 0.7);
        height: 40px;
        width: 40%;
        display: block;
        margin-top: 20px;
    }

</style>

<body>
<?php  include "../header.php"?>
<div class="content">
    <div class="left"></div>
    <div class="right">
        <p>welcome</p>
        <form name="reg" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" id="username" name="username" value="" placeholder="用户名">
            <input type="password" id="password" name="password" value="" placeholder="密码">
            <input type="password" id="repassword" name="repassword" value="" placeholder="确认密码">
            <input type="email" id="email" name="email" placeholder="邮箱">
            <input type="text" id="checknum" name="checknum" value="" placeholder="请输入验证码">
            <div class="check">
                <img src="validcode.php" style="width:100px;height:25px;" id="code"/>
                <a href="javascript:changeCode()">看不清，换一张</a>
            </div>
            <input type="submit" id="submit" name="submit" value="提交">
        </form>

    </div>
</div>

<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

    function changeCode() {
        document.getElementById("code").src = "validcode.php?id=" + Math.random();
    }
</script>

<?php
include "../conn.php";
$nameErr = "";
$passErr = "";
$emailErr = "";
$passErr2 = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $email = $_POST["email"];
    $checknum = $_POST["checknum"];
    if (!empty($_POST["checknum"] && ($_POST["checknum"] == $_SESSION["validcode"]))) {

        if (empty($username)) {
            $nameErr = "用户名为空";
            echo $nameErr;
        } elseif (empty($password)) {
             $passErr="密码为空";
            echo $passErr;
        } elseif (empty($repassword)) {
            $passErr2 = "密码为空";
            echo $passErr2;
        } elseif (empty($email)) {
            $emailErr = "邮箱为空";
            echo $emailErr;
        } else {
            $sql = "select * from user where account='$username'";
            $result = mysqli_query($conn, $sql) or die("查询失败，请检查SQL语法" . $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<script language='javascript' type='text/javascript'>";
                echo "alert('用户已经注册，请设置其他用户名');";
                echo "</script>";
            } elseif ($password != $repassword) {
                echo "<script language='javascript' type='text/javascript'>";
                echo "alert('两次密码不一致');";
                echo "</script>";

            } else {
                $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "insert into user(account,password,email) values('$username','$pass_hash','$email')";
                $result = mysqli_query($conn, $sql) or die("查询失败，请检查SQL语法" . $sql);
                $time=date("Y-m-d");
                $sqltime="update user set reg_time='$time' where account='$username'";
                $result=mysqli_query($conn,$sqltime)or die("查询失败，请检查SQL语法".$sqltime);
                echo "<script language='javascript' type='text/javascript'>";
                echo "alert('注册成功');";
                echo "location.href='login.php';";
                echo "</script>";

            }
        }
    } else {
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('验证码不对，请重新输入');";
        echo "</script>";
    }
}

?>

</body>
</html>