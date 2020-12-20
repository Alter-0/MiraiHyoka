<?php
$objective=$_POST["objective"];
if($objective=="reviewload")
{
$review=array(
    "name"=>array(),
    "time"=>array(),
    "review"=>array()
);
$review["name"][0]="vddv";
$review["name"][1]="csz";
$review["name"][2]="fbrbr";
$review["name"][3]="bfcbcfb";
$review["time"][0]="2020/12/18";
$review["time"][1]="2020/12/16";
$review["time"][2]="2020/12/16";
$review["time"][3]="2020/12/15";
$review["review"][0]="vddv";
$review["review"][1]="csz";
$review["review"][2]="fbrbr";
$review["review"][3]="bfcbcfb";

echo json_encode($review);
}
?>