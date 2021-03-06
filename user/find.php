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

        #email {
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

        #submit ,#return {
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
            margin-bottom: 20px;
        }
        #submit:hover {
            background-color: #F4A6D7;
        }
        #return:hover{
            background-color: #F4A6D7;
        }
    </style>
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
                <input type="email" id="email" name="email" value="" placeholder="邮箱">
                <input type="submit" id="submit" name="submit" value="提交">
                <input type="button" id="return" name="return" value="返回">
            </form>
        </div>
    </div>
</div>
<script src="../js/jquery.js"></script>

    <script>
        $(document).ready(function () {
        $("#return").click(function () {
            window.location.href = "login.php";
        })
    })
</script>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../conn.php");
    $username = $_POST['username'];
    $email = $_POST['email'];
    $sql = "select * from user where account='$username'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) > 0 && $row['email'] == $email) {
        require 'class.phpmailer.php';
        require 'class.smtp.php';
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 3; // Enable verbose debug output
        $mail->isSMTP(); // 使用SMTP服务
        $mail->Host = 'smtp.qq.com'; // 发送方的SMTP服务器地址
        $mail->SMTPAuth = true; //是否使用身份验证
        $mail->Username = '2483232294@qq.com';
        $mail->Password = 'mmlqxnjqkfibebde';
        $mail->SMTPSecure = 'ssl'; // 使用ssl协议方式
        $mail->Port = 465; // 端口号
        $mail->setFrom('2483232294@qq.com', "小可爱");
        //$mail->AddCC('2424275819@qq.com', "小可爱");//设置发件人信息，有时候下载的phpmailer不一样，里面函数名不同

        $mail->addAddress($email, '.');
        $mail->addReplyTo($email, 'php');
        $code = rand(100000, 999999);
        $mail->isHTML(true);
        $mail->Subject = '找回密码';
        $mail->Body = "这里是验证中心；<b>您的验证码是：</b>" . $code;
        if (!$mail->Send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            $sql2 = "update user set code='$code'  where account='$username'";
            mysqli_query($conn, $sql2);
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('发送成功');";
            echo "location.href='update.php';";
            echo "</script>";
        }
    }
    else{
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('用户邮箱不匹配或未填写');";
        echo "</script>";
    }
}
?>