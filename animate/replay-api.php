<?php
date_default_timezone_set("PRC");
include "../conn.php";
include "../static/dao.php";
if (empty($_POST['action'])){
 echo "啥都没有玩个锤子";

}else{
    // data:{action:"hello",uid:$('#uid').val(),eid:$('#eid').val(),repalyid:0,content:$('#comment-in-l').val()},
    //
    $evaluation_id  = $_POST['eid'];
    $uid = $_POST['uid'];
    $time = date("Y-m-d H:m:s");
    $re_replay_id = $_POST['repalyid'];
    $content = $_POST['content'];
//    echo $evaluation_id.$uid.$time.$re_replay_id.$content;
    $sql = "INSERT INTO reply (user_id, episode_id, evaluation_id, re_reply_id, content, time, is_read)
VALUES ('$uid',0,'$evaluation_id','$re_replay_id','$content','$time',0);";
    if (changeRecord($conn,$sql)){
        $sql = "select reply_id from reply where time = '$time';";
        $rec = queryOneRecord($conn,$sql);
        $time = substr_max($time,19);
        $id = $rec['reply_id'];
        echo $id;
    }else{
        echo 0;
    }
}
