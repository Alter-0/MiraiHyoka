<?php
$objective=$_POST["objective"];
$conn = mysqli_connect("47.115.15.18",
    "wangyesheji", "e7BLUzfQv69wXybN",
    "miraihyoka") or die("数据库连接失败");
mysqli_query($conn,'set names utf8');
if($objective=="reviewload")
{

    $postnum=$_POST["postnum"];
    $id=$_POST["id"];
    $sql="select * from evaluation,user where evaluation.user_id=user.user_id and is_long=0 and animate_id=$id limit ".intval($postnum).",5";
    $result= mysqli_query($conn,$sql) or die("数据库查询评论失败");
    $num=0;
    $i=0;
    $review=array(
    "num"=>$num,
    "name"=>array(),
    "time"=>array(),
    "review"=>array(),
    "score"=>array(),
     "photo"=>array(),
);
    $review["num"]=mysqli_num_rows($result);
    while($row=mysqli_fetch_assoc($result))
    {   $row['time']=substr($row['time'], 0,16);
        $review["name"][$i]=$row['username'];
        if($row['username']=="")
        {$review["name"][$i] = $row['account'];}
        $review["time"][$i]=$row['time'];
        $review["review"][$i]=$row['content'];
        $review["score"][$i]=$row['score'];
        $review["photo"][$i]=$row['avatar'];
        if(empty($row['avatar']))
        {
            $review["photo"][$i]="../image/upload/akari.jpg";
        }
        $i++;
    }



echo json_encode($review);
}
else if($objective=="reviewcheck")
{   $id=$_POST["animateid"];
    $user_id=$_POST["userid"];
    $sql="select * from evaluation where user_id=$user_id and animate_id = $id and is_long=0";
    $result= mysqli_query($conn,$sql) or die("评论查询失败".$sql);
    if(mysqli_num_rows($result)<=0) {
        $review = array(
            "makesure" => "1"
        );
    }
    else{
        $row=mysqli_fetch_assoc($result);
        $review = array(
            "makesure" => "2",
            "score"=>$row['score'],
            "review"=>$row['content']
        );

    }
    echo json_encode($review);
}
else if($objective=="reviewinsert")
{    $content=$_POST["shortreview"];
     $user_id=$_POST["userid"];
     $score=$_POST["score"];
    $id=$_POST["id"];
    $flag=$_POST["flag"];
    if($flag=="发表评论") {
        date_default_timezone_set("PRC");
        $time = date('Y-m-d H:i:s', time());
        $sql = "insert into evaluation(animate_id,is_long,content,user_id,score,time) value($id,0,'$content',$user_id,$score,'$time')";
        $result = mysqli_query($conn, $sql) or die("评论失败" . $sql);
        $sql = "select * from user where user_id=$user_id";
        $result = mysqli_query($conn, $sql) or die("查询失败");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];
            if($row['username']=="")
            {$username = $row['account'];}
            $photo = $row['avatar'];
            if(empty($row['avatar']))
            {
                $photo="../image/upload/akari.jpg";
            }
            $review = array(
                "name" => array(),
                "makesure" => "1",
                "photo" => array()
            );
        }
        $review["name"][0] = $username;
        $review["photo"][0] = $photo;
    }
    if($flag=="修改评论") {
        date_default_timezone_set("PRC");
        $time = date('Y-m-d H:i:s', time());
        $sql = "update evaluation set content='$content',score=$score,time='$time' where user_id=$user_id and animate_id=$id and is_long=0";
        $result = mysqli_query($conn, $sql) or die("修改失败" . $sql);
        $sql = "select * from user where user_id=$user_id";
        $result = mysqli_query($conn, $sql) or die("查询失败");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];
            if($row['username']=="")
            {$username = $row['account'];}
            $photo = $row['avatar'];
            if(empty($row['avatar']))
            {
                $photo="../image/upload/akari.jpg";
            }
            $review = array(
                "name" => array(),
                "makesure" => "1",
                "photo" => array()
            );
        }
        $review["name"][0] = $username;
        $review["photo"][0] = $photo;
    }
    echo json_encode($review);

}
else if($objective=="islike")
{   $user_id=$_POST["userid"];
    $animate_id=$_POST["animateid"];
    date_default_timezone_set("PRC");
    $time= date('Y-m-d H:i:s', time());
    $sql="select * from favorites where user_id=$user_id and animate_id=$animate_id";
    $result= mysqli_query($conn,$sql);
    $review=array(
        "text"=>"<div class='btn_like'><i></i>收藏</div>"
    );
    if(mysqli_num_rows($result)<=0)
    {
        $review['text']="<div class='btn_like'><i></i>收藏</div>";
        $sql="insert into favorites(user_id,animate_id,time) value('$user_id','$animate_id','$time')";
        $result= mysqli_query($conn,$sql) or die("收藏失败".$sql);
        $review['text']="<div class='btn_like  btn_liked'><i></i>已收藏</div>";
    }
    else{
        $sql="delete from favorites where user_id=$user_id and animate_id=$animate_id";
        $result= mysqli_query($conn,$sql) or die("取消收藏失败".$sql);
        $review['text']="<div class='btn_like'><i></i>收藏</div>";
    }
    echo json_encode($review);
}

?>