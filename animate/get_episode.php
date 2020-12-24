<?php
include '../conn.php';

//查集数表
$animate_id=$_GET["animate_id"];
$sql="select * from episode where animate_id=".$animate_id;
$result=mysqli_query($conn,$sql) or die("失败".$sql);



while ($info=mysqli_fetch_array($result)) {
    $string = $info['name'];
    if(preg_match("/(ep.[0-9]+.[0-9]+)/",$string)){
        continue;
    }
    $pattern = '/(ep.[0-9]+) (.)/';
    $replacement = '${2}';
    $ep_name=preg_replace($pattern, $replacement, $string);
    $name="第".$info['no']."话： ".$ep_name;
    echo '<li>';
    echo '<div class="episode_directory_item">'.$name.'</div>';
    echo '</li>';
}
//<!--                                    <li>-->
//<!--                                        <div class="episode_directory_item">-->
//<!--                                            第1话：「无能力」-->
//<!--                                        </div>-->
//<!--                                    </li>-->