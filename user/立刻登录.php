<?php
session_start();
if (!isset($_SESSION['account'])){
    $_SESSION['account']=10086;
}
echo "<a href=\"../index.php\">快速登录，懂！</a>";

?>


