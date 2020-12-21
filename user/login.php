<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
</head>
<?php session_start();?>
<body>
<style>
    *{
        margin: 0;
        padding: 0;
        border: 0;
        list-style: none;
    }
    body{
        display: flex;
        flex-direction: column;
        background-attachment:fixed;
        background-image: url(../image/background.jpg);
        background-size: cover;
    }
    .content{
        width:100%;
        height: auto;
        margin-bottom: 100px;
    }

    .left{
        width: 30%;
        height: 500px;
        float: left;
        display: inline-block;
        background: url("../image/user_background.jpg") ;
        background-size: cover;
        box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
        border-radius: 15px;
        margin-left: 10%;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .right{
        width: 40%;
        height: 500px;
        display: inline-block;
        margin-left: 5%;
        margin-top: 20px;
        position: relative;

    }
    form{
        margin-left: 30px;
    }
    p{
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
    }
    #email{
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
    }
    #checknum{
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
    }

    #submit{
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        background-color: #1890ff;
        height: 40px;
        width: 200px;
        display: block;
        margin-top: 20px;
    }
    #reg{
        border: 1px solid #d9d9d9;
        box-sizing: border-box;
        border-radius: 4px;
        transition: all .3s;
        line-height: 2;
        background-color: #1890ff;
        height: 40px;
        width: 200px;
        display: block;
        margin-top: 20px;
    }

    .top{
        width: 100%;
        height: 200px;
        position: relative;
    }
    .top iframe{
        width: 100%;
        height:50px;
        position: relative;
        z-index: 1000;
    }


</style>

<body>
<div class="top">
    <iframe src="../header.php" class="header" scrolling="no"></iframe>
</div>
<div class="content">
    <div class="left">
    </div>
    <div class="right">
        <p>welcome</p>
        <form name="reg" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" id="username"  name="username" value="" placeholder="用户名">
            <input type="password" id="password"  name="password" value="" placeholder="密码">
            <input type="text" id="checknum"  name="checknum" value="" placeholder="请输入验证码">
            <div class="check">
                <img src="validcode.php" style="width:100px;height:25px;" id="code"/>
                <a href="javascript:changeCode()">看不清，换一张</a>
            </div>
            <input type="submit" id="submit" name="submit" value="登录">
            <button type="button" id="reg" >注册</button>
        </form>

    </div>
</div>

<script src="../js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#reg").click(function (){
            window.location.href = "reg.php";
        })
    })
</script>
<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

    function changeCode() {

        document.getElementById("code").src = "validcode.php?id=" + Math.random();
    }
</script>


<?php

if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (!empty($_POST["checknum"])&&($_POST["checknum"] == $_SESSION["validcode"])) {
        include "../conn.php";
        $username = $_POST["username"];
        $password = $_POST["password"];
        $checknum=$_POST["checknum"];
        $email=$_POST["email"];
        $sql = "Select * from user where account='$username'";
        $result = mysqli_query($conn, $sql) or die("查询失败，请检查SQL语法");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION["account"] = $username;
                echo "<script language='javascript' type='text/javascript'>";

                echo "alert('登陆成功');";

                echo "location.href='user.php';";

                echo "</script>";

            } else {
                echo "<script language='javascript' type='text/javascript'>";

                echo "alert('密码不正确');";

                echo "location.href='login.php';";

                echo "</script>";

            }
        } else {
            echo "<script language='javascript' type='text/javascript'>";

            echo "alert('用户名不正确');";

            echo "</script>";

        }
    }
    else{
        echo "<script language='javascript' type='text/javascript'>";

        echo "alert('重新输入');";

        echo "</script>";
    }
}
?>