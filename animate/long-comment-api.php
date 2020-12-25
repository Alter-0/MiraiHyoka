<?php

include "../conn.php";
include "../static/dao.php";
if (!empty($_POST['action'])){
    $action = $_POST['action'];
    switch ($action){
        case 'save':
            saveComment($conn);
            break;
        case 'querybyid':
            queryById($conn);
            break;
        case 'update':
            update($conn);
            break;
        case 'uploadimg':
            uploadimg($conn);
               break;
        default:
            echo "啥都没有";
    }
}

function saveComment($conn){

}
function queryById($conn){

}
function update($conn){

}

function uploadimg($conn){

}