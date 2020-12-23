<?php
include '../conn.php';

//查集数表
$animate_id=$_GET["animate_id"];
$sql="select * from episode where animate_id=".$animate_id;
$result=mysqli_query($conn,$sql) or die("失败".$sql);
//查封面
$ansql="select cover from animate where animate_id=".$animate_id;
$anresult=mysqli_query($conn,$ansql) or die("失败".$ansql);
$coverinfo=mysqli_fetch_array($anresult);
$cover=$coverinfo['cover'];



while ($info=mysqli_fetch_array($result)) {
    $string = $info['name'];

    if(preg_match("/(ep.[0-9]+.[0-9]+)/",$string)){
        continue;
    }
    $pattern = '/(ep.[0-9]+) (.)/';

    $replacement = '${2}';
    $ep_name=preg_replace($pattern, $replacement, $string);
    $name="第".$info['no']."话： ".$ep_name;


    echo '<li title='.$name.' class="misl_ep_item">';
    echo '<div class="misl_ep_img">';
    echo '<div class="common_lazy_img">';
    echo '<img src="'.$cover.'" alt="第'.$info['no'].'话">';
    echo '<div class="common_lazy_img_text">第<span class="common_lazy_img_num">'.$info['no'].'</span>话';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="misl_ep_title">';
    echo '<div class="misl_ep_title_name">'.$ep_name.'</div>';
    echo '</div>';
    echo '<div class="misl_ep_text">';
    echo '<div class="misl_ep_info">时长:24分钟</div>';

    //查评论数
    $replysql="select count(*) from reply where episode_id=".$info['episode_id'];
    $replyresult=mysqli_query($conn,$replysql) or die("失败".$ansql);
    $replayn=mysqli_fetch_array($replyresult);
    $replaynum=$replayn[0];

    echo '<div class="misl_ep_info">评论:+'.$replaynum.'</div>';
    echo '</div>';
    echo '</li>';
}
//<li title="第1话：「无能力」" class="misl_ep_item">
//                                            <div class="misl_ep_img">
//                                                <div class="common_lazy_img">
//                                                    <img src="http://i0.hdslb.com/bfs/bangumi/image/0212baa8898d0c819c7fb84015e95b8fca621435.png"
//                                                         alt="第1话">
//                                                    <div class="common_lazy_img_text">第<span
//                                                                class="common_lazy_img_num">1</span>话
//                                                    </div>
//                                                </div>
//                                            </div>
//                                            <div class="misl_ep_title">
//                                                <div class="misl_ep_title_name">「无能力」</div>
//
//                                            </div>
//                                            <div class="misl_ep_text">
//                                                <div class="misl_ep_info">时长:24分钟</div>
//                                                <div class="misl_ep_info">评论:+20</div>
//                                            </div>
//                                        </li>

