<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <!--    header必须引入的三个样式文件,使用php引入-->
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="../js/jquery.js"></script>
    <style>
        .search{
            margin-right: 40px;
        }
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
        form{
            margin-left: 30px;
        }
        p{
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
            width: 40%;
            height: 40px;
            margin-bottom: 24px;
            display: block;
            background: url("image/head.png") 3px 3px no-repeat;
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
        #submit{
            border: 1px solid #d9d9d9;
            box-sizing: border-box;
            border-radius: 4px;
            transition: all .3s;
            line-height: 2;
            background-image: linear-gradient(120deg, #db3125 0%, #578bc3 100%);
            height: 40px;
            width: 40%;
            display: block;
            margin-top: 20px;
        }
        #reg{
            border: 1px solid #d9d9d9;
            box-sizing: border-box;
            border-radius: 4px;
            transition: all .3s;
            line-height: 2;
            background-color: rgba(100, 149, 237, 0.7);
            height: 40px;
            width: 20%;
            display:inline-block;
            margin-top: 30px;
        }
        #check{
            border: 1px solid #d9d9d9;
            box-sizing: border-box;
            border-radius: 4px;
            transition: all .3s;
            line-height: 2;
            background-color: rgba(100, 149, 237, 0.7);
            height: 40px;
            width: 20%;
            display:inline-block;
            margin-top: 30px;
        }
    </style>
    <link rel="stylesheet" href="code.css">
</head>

<body>
<?php include "../header.php"?>
<div class="content">
    <div class="left">
    </div>
    <div class="right">
        <div class="total">
        <p>welcome</p>
        <form id="form" name="login" method="post" onsubmit="return veryfy()" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" id="username"  name="username" value="" placeholder="用户名">
            <input type="password" id="password"  name="password" value="" placeholder="密码">
            <input type="submit" id="submit" name="submit" value="登录">
            <button type="button" id="check" >验证</button>
            <button type="button" id="reg" >注册</button>
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
<script>
    $(document).ready(function(){
        $("#reg").click(function (){
            window.location.href = "reg.php";
        })
    })
</script>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST") {
        include "../conn.php";
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "Select * from user where account='$username'";
        $result = mysqli_query($conn, $sql) or die("查询失败，请检查SQL语法");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION["UID"] =$row['user_id'];
                echo "<script language='javascript' type='text/javascript'>";

                echo "alert('登陆成功');";

                echo "location.href='../user-center/usercenter.php';";

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
?>