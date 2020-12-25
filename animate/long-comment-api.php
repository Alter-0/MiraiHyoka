<?php

include "../conn.php";
include "../static/dao.php";
date_default_timezone_set("PRC");
if (!empty($_POST['action'])){
    $action = $_POST['action'];
    $uid = empty($_POST['uid'])?1:$_POST['uid'];
    $aid = empty($_POST['id'])?100001:$_POST['id'];
    switch ($action){
        case 'save':
            saveComment($conn);
            break;
        case 'querybyid':
            queryById($conn,$id);
            break;
        case 'update':
            update($conn);
            break;
        case 'uploadimg':
            uploadimg();
               break;
        default:
            echo "啥都没有";
    }
}

function saveComment($conn){
   $content =  $_POST['content'];
   $uid =  $_POST['uid'];
   $id =  $_POST['id'];
   $score =  $_POST['score'];
   $title =  $_POST['title'];
   $time  = date("Y-m-d H:m:s");
   $sql = "select * from evaluation
where is_long =1
and  user_id = $uid
and animate_id = $id;";
   $res = queryOneRecord($conn,$sql);
   if (empty($res)){
       $sql  = "INSERT INTO evaluation(animate_id, is_long, title, content, user_id, score, time) 
VALUES ('$id','1','$title','$content','$uid',8.88,'$time');";
       if (changeRecord($conn,$sql)){
           echo "保存成功";
       }else{
           echo "保存失败，请重试";
       }
   }else{
       $sql  = "update evaluation  
                set  content ='$content' ,score='$score',title='$title',time='$time' 
                where is_long =1
                and  user_id = $uid
                and animate_id = $id;";
       if (changeRecord($conn,$sql)){
           echo "保存成功";
       }else{
           echo "保存失败，请重试";
       }
   }





}
function queryById($conn){

}
function update($conn){

}
