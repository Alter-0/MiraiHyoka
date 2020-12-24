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
    <link rel="stylesheet" href="code.css">
</head>
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

    .left{
        width: 40%;
        height: 500px;
        float: left;
        display: inline-block;
        background: url("../image/user_background.jpg") ;
        background-size: cover;
        box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
        border-radius: 15px;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        margin-left: 10%;
        margin-top: 20px;
        margin-bottom: 20px;

    }
    .right{
        width: 40%;
        height: 500px;
        display: inline-block;
        margin-top: 20px;
        position: relative;
        box-shadow: 7px 7px 17px rgba(52, 56, 66, 0.8);
        border-radius: 15px;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        margin-right: 10%;

    }
    .total{
        margin-left: 20%;
    }

    form {
        margin-left: 30px;
    }

    p {
        font-size: 40px;
        color: #00cdff;
        font-family: Arial;
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
        width: 50%;
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
        width: 50%;
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
        width: 50%;
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
        width: 50%;
        height: 40px;
        margin-bottom: 24px;
        display: block;
        padding-left: 30px;
        background: url("image/email.png") 3px 3px no-repeat;
    }

    #check{
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        background-color: rgba(100, 149, 237, 0.7);
        height: 40px;
        width: 50%;
        display: block;
        margin-top: 20px;
    }

    #submit {
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        background-color: rgba(100, 149, 237, 0.7);
        height: 40px;
        width: 50%;
        display: block;
        margin-top: 20px;
    }

</style>

<body>
<?php  include "../header.php"?>
<div class="content">
    <div class="left"></div>
    <div class="right">
        <div class="total">
        <p>MiraiHyoka</p>
        <form name="reg" method="post" onsubmit="return veryfy()" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" id="username" name="username" value="" placeholder="用户名">
            <input type="password" id="password" name="password" value="" placeholder="密码">
            <input type="password" id="repassword" name="repassword" value="" placeholder="确认密码">
            <input type="email" id="email" name="email" placeholder="邮箱">
            <input type="button" id="check" name="check" value="验证">
            <input type="submit" id="submit" name="submit" value="提交">
        </form>
        </div>
        <div id="valid-code" style="display: none" class="container-code">
            <div id="captcha" style="position: relative"></div>
        </div>
        <script src="code.js"></script>
        <script>
            var i=0;
            $('#check').click(function () {
                if (i==0){
                    $('#valid-code').css('display','block');
                    i++;
                }else {
                    $('#valid-code').css('display','none');
                    i--;
                }
            })
            function veryfy(){
                if(j==1){
                    return true;
                }
                if(j==0){
                    alert("请先验证!");
                    return false;
                }
            }
        </script>

    </div>
</div>
<?php
include "../conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $email = $_POST["email"];
        if (empty($username)) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('用户名为空');";
            echo "</script>";
        } elseif (empty($password)) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('密码为空');";
            echo "</script>";

        } elseif (empty($repassword)) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('请确认密码');";
            echo "</script>";
        } elseif (empty($email)) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('邮箱为空');";
            echo "</script>";
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
}

?>

</body>
</html>