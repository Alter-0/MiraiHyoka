<!doctype html>
<html lang="zh-CN">
<head>
    <?php session_start();?>
    <meta charset="UTF-8">
    <title>登录</title>
    <!--    header必须引入的三个样式文件,使用php引入-->
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="../js/jquery.js"></script>
    <style>
        .search {
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
            background: url(../image/background.jpg) no-repeat center center fixed;
            background-size: cover;
        }

        .content {
            height: 500px;
            width: auto;
            position: relative;
            white-space: nowrap;
            margin-left: 10%;
            margin-right: 10%;
            margin-top: 5%;
            margin-bottom: 5%;
            box-sizing: border-box;
        }

        .left {
            height: 100%;
            width: 50%;
            margin-left: 10%;
            float: left;
            box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
            background: url("../image/user_background.jpg") center center;
            background-size: cover;
            border-radius: 15px;
            border-bottom-right-radius: 0;
            border-top-right-radius: 0;
        }

        .right {
            width: 30%;
            height: 100%;
            float: left;
            margin-right: 10%;
            overflow: hidden;
            box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
            background-color: rgba(255, 255, 255, 0.8);

        }

        .total {
            margin-left: 10%;
            margin-right: 10%;
            height: 100%;
        }

        form {
            margin-left: 10%;
            margin-right: 10%;
            margin-top: 50px;
        }

        .mylogo {
            height:50px;
            margin-left: 25%;
            margin-right: 25%;
            width: 50%;
        }

        .mylogo img {
            height: 100%;
            width: auto;
        }

        #username {
            border: 1px solid #d9d9d9;
            box-sizing: border-box;
            border-radius: 4px;
            transition: all .3s;
            line-height: 2;
            padding-left: 30px;
            width: 100%;
            height: 40px;
            margin-bottom: 25px;
            display: block;
            background: url("image/head.png") 3px 3px no-repeat;
            margin-top: 100px;
        }

        #password {
            border: 1px solid #d9d9d9;
            box-sizing: border-box;
            border-radius: 4px;
            transition: all .3s;
            line-height: 2;
            width: 100%;
            height: 40px;
            margin-bottom: 25px;
            display: block;
            padding-left: 30px;
            background: url("image/password.png") 3px 3px no-repeat;
        }
        #repassword{
            border: 1px solid #d9d9d9;
            box-sizing: border-box;
            border-radius: 4px;
            transition: all .3s;
            line-height: 2;
            width: 100%;
            height: 40px;
            margin-bottom: 25px;
            display: block;
            padding-left: 30px;
            background: url("image/password.png") 3px 3px no-repeat;
        }
        #check{
            border: 1px solid #d9d9d9;
            box-sizing: border-box;
            border-radius: 4px;
            transition: all .3s;
            line-height: 2;
            width: 100%;
            height: 40px;
            margin-bottom: 25px;
            display: block;
            padding-left: 30px;
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
            width: 100%;
            display: block;
            margin-top: 20px;
            margin-bottom: 25px;
        }
        #submit:hover {
            background-color: #F4A6D7;
        }

    </style>
    <link rel="stylesheet" href="code.css">
</head>

<body>
<?php include "../header.php" ?>

<div class="content">
    <img class="left">
    <div class="right">
        <div class="total">
            <div class="mylogo">
                <img src="../image/logo.png">
            </div>
            <form id="form" name="login" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" id="username" name="username" value="" placeholder="用户名">
                <input type="password" id="password" name="password" value="" placeholder="密码">
                <input type="password" id="repassword" name="repassword" value="" placeholder="确认密码">
                <input type="text" id="check" name="check" value="" placeholder="请输入验证码">
                <input type="submit" id="submit" name="submit" value="提交">
            </form>
        </div>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../conn.php");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $check=$_POST["check"];
    if (empty($username)) {
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('用户名为空');";
        echo "</script>";
    } elseif (empty($password)) {
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('密码为空');";
        echo "</script>";
    } elseif(empty($repassword)) {
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('请确认密码');";
        echo "</script>";
    }elseif(empty($check)) {
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('请输入验证码');";
        echo "</script>";
    }elseif ($password!=$repassword){
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('密码不一致');";
        echo "</script>";
    }
    else {
        $sql = "select * from user where account='$username'";
        $result = mysqli_query($conn, $sql) or die("查询失败，请检查SQL语法" . $sql);
        $row=mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
           if($row['code']==$check){
               $pass_hash = password_hash($password, PASSWORD_DEFAULT);
               $sql2="update user set password='$pass_hash' where account='$username'";
               mysqli_query($conn, $sql2);
               echo "<script language='javascript' type='text/javascript'>";
               echo "alert('修改成功');";
               echo "location.href='login.php'";
               echo "</script>";
           }
           else{
               echo "<script language='javascript' type='text/javascript'>";
               echo "alert('验证码错误');";
               echo "</script>";
           }
        }

    }
}
?>

