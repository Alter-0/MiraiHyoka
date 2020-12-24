<?php

if(isset($_GET['d']) && $_GET['d']=='ajax'){
    $id=$_GET['reply_id'];
//    echo "<script>alert('$id')</script>";
    include "../conn.php";
//    echo '<script>alert("已经执行了方法")</script>';
    $sql="update reply set is_read='1' where reply_id=$id";
    mysqli_query($conn, $sql);
    exit();
}