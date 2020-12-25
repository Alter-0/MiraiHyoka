<?php
include "../conn.php";
include "../static/dao.php";
$sql = "select * from evaluation
where is_long =1
and  user_id = 1
and animate_id = 100001;";
$res = queryOneRecord($conn,$sql);
print_r($res);