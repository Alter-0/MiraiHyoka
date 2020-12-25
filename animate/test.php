<?php
include "../conn.php";
//                        include "../static/dao.php";
$sql = "select title,time,content,username,avatar,score,is_long from evaluation
                        join user on evaluation.user_id = user.user_id where is_long =1 and animate_id =100001;";

print_r($rec);