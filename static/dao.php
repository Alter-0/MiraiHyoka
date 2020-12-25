<?php

/**
 * @param $con
 * @param $sql
 * @return array
 * 我写的函数，查询和修改
 */
function  queryList($conn,$sql){
    $res = mysqli_query($conn,$sql);
    $i = 0;
    $output=[];
    while ($row = mysqli_fetch_assoc($res)) {
        $output[$i] = $row;
        $i++;
    }
    return $output;
}

/**
 * @param $conn 参数
 * @param $sql  参数
 * @return string[]|null
 *  对应数组 查一个，返回一个关联数组
 */
function queryOneRecord($con,$sql){
    $res = mysqli_query($con,$sql) or  die("查询失败");
    $row = mysqli_fetch_assoc($res);
    return $row;
}

/**
 * @param $conn
 * @param $sql
 * @return bool 对应增删改查
 */
function changeRecord($conn,$sql){
    $res = mysqli_query($conn,$sql) or  die("查询失败");
    if (empty($res)){
        return false;
    }
    return true;
}

function substr_max($str,$num)
{
    $start=0;
    $strlen=$num;
    $tmpstr="";
    for($i = $start; $i < $strlen;) {
        if (ord ( substr ( $str, $i, 1 ) ) > 0xa0) { // 如果字符串中首个字节的ASCII序数
            $tmpstr .= substr ( $str, $i, 3 ); // 每次取出三位字符赋给变量$tmpstr，即等

            $i=$i+3; // 变量自加3
        } else{
            $tmpstr .= substr ( $str, $i, 1 ); // 如果不是汉字，则每次取出一位字符赋给
            $i++;
        }
    }
    return $tmpstr; // 返回字符串
}

                    ?>