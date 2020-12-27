<?php
    session_start();
    include "../conn.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "Select * from user where account='$username'";
    $result = mysqli_query($conn, $sql) or die("查询失败，请检查SQL语法");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["account"] = $username;
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('登陆成功');";
            echo "location.href='../index.php';";
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
?>
