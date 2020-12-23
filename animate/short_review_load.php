<?php
$objective=$_POST["objective"];
$conn = mysqli_connect("47.115.15.18",
    "wangyesheji", "e7BLUzfQv69wXybN",
    "miraihyoka") or die("数据库连接失败");
mysqli_query($conn,'set names utf8');
if($objective=="reviewload")
{

    $postnum=$_POST["postnum"];
    $sql="select * from evaluation,user where evaluation.user_id=user.user_id and is_long=0 and animate_id=100001 limit ".intval($postnum).",5";
    $result= mysqli_query($conn,$sql) or die("数据库查询评论失败");
    $num=0;
    $i=0;
    $review=array(
    "num"=>$num,
    "name"=>array(),
    "time"=>array(),
    "review"=>array(),
    "score"=>array()
);
    $review["num"]=mysqli_num_rows($result);
    while($row=mysqli_fetch_assoc($result))
    {   $row['time']=substr($row['time'], 0,16);
        $review["name"][$i]=$row['username'];
        $review["time"][$i]=$row['time'];
        $review["review"][$i]=$row['content'];
        $review["score"][$i]=$row['score'];
        $i++;
    }



echo json_encode($review);
}
else if($objective=="reviewcheck")
{
    $review=array(
        "makesure"=>"1"
    );
    echo json_encode($review);
}
else if($objective=="reviewinsert")
{    $content=$_POST["shortreview"];
     $user_id=$_POST["userid"];
     $score=$_POST["score"];
    date_default_timezone_set("PRC");
    $time=time();
    $sql="insert into evaluation(animate_id,is_long,content,user_id,score,time) value(100001,0,'$content',$user_id,$score,'$time')";
    $result= mysqli_query($conn,$sql) or die("评论失败");
    $sql="select * from user where user_id=100001";
    $result= mysqli_query($conn,$sql) or die("查询失败");
    if($row=mysqli_num_rows($result))
    $review=array("name"=>$row['name'],"makesure"=>"1","photo"=>"../image/headerpic.jpg");
    echo json_encode($review);
}

?>