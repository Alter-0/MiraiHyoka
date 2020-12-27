<?php

session_start();
if (empty($_SESSION['user_id'])){
    /**
     * put the url into session,if exist
     */
    if(!empty($_SERVER['REQUEST_URI']))
        $_SESSION['LOGIN_REQUEST_URI']= $_SERVER['REQUEST_URI'];
    header('location:../user/login.php');
}else{
    $uid = $_SESSION['user_id'];
}
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>创作中心@某科学的超电磁炮</title>
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="shortcut icon" href="../image/favicon.ico">
    <link rel="stylesheet" href="../css/default.css">
    <script src="../js/jquery.js"></script>
    <style>
        body{

        }
        .editor {
            border: 1px silver solid;
            padding: 0 30px;
            margin-top: 20px;
            margin-bottom: 30px;
            background-color: #FFFFFF!important;

        }
        .e-title{
            border-bottom: #dbdbdb solid 2px;
            padding: 20px 10px 10px;


        }
        #border{
            border-bottom: #2aabd2 2px solid;
        }
        #title{

            color: #5bc0de!important;
        }
        #small-title{
            margin-top: 10px;
            font-size: 20px;
            color: #212121;
        }
        #comment-title{
            padding: 20px 0;
            width: 100%;
        }
        input:focus, textarea:focus {

            outline: none;

        }
        #border2 input{
            padding: 0 20px;
            font-size: 30px;
        }
        #border2 input:link{
         outline: #FFFFFF;
        }
        textarea{
            outline: none;
            /*outline: #FFFFFF;*/
        }
        textarea:link{
            outline: none;
        }
        textarea:focus{
               outline: none;
           }
       .btngroup{
           /*padding-right: 30px;*/
           text-align: right;
           padding: 10px 20px;
       }
       #input-title{
           width: 100%;
           height: 64px;
           font-size: 25px;
       }
       #long-comment-editor{
           padding: 0 20px;
       }
       .btn-star{

           font-size: 20px;
           line-height: 30px;
           display: inline-block;
           width: 23px;
           height: 30px;
           background-color: #FFFFFF;
       }
        .comment-score{
            padding-left: 25px;
        }
       .comment-score p{
           margin: 10px 0 0;
           font-size: 12px;
           color: silver;
       }
       .btn-star:focus{
           outline: none;
       }
       .btn-star:hover{
           color: #2aabd2;
       }
    </style>
</head>
<body>
<?php
  include "../header.php";
?>
<div style="width: 100%;background-color:rgba(255,255,255,.3);">
    <div class="container">
        <div class="editor ">
            <div class="e-title">
                <span id="border">
                    <h3 id="title">专栏投稿  </h3>
                </span>
            </div>
            <div class="comment-score">
                <?php
                $animate_id = empty($_GET['id'])?100001:$_GET['id'];

                $sql = "select animate.animate_id,evaluation_id,title,name_cn,content from evaluation join animate on animate.animate_id = evaluation.animate_id
           where evaluation.animate_id =$animate_id and user_id =$uid and is_long = 1;";
                include "../conn.php";
                include "../static/dao.php";
                $res = queryOneRecord($conn,$sql);
                if (empty($res)){
                    $isfrist = 0;
                    $content = "第一次评论";
                }else{
                    $isfrist = $res['evaluation_id'];
                    $content = $res['content'];
                }
                ?>
                <div id="small-title">的长评</div>
                <p>请发表你对这部作品的评分</p>
                <div class="score-star">
                    <span class="glyphicon glyphicon-star btn-star" ></span>
                    <span class="glyphicon glyphicon-star btn-star" ></span>
                    <span class="glyphicon glyphicon-star btn-star" ></span>
                    <span class="glyphicon glyphicon-star btn-star" ></span>
                    <span class="glyphicon glyphicon-star btn-star" ></span>
                </div>
                <input id="score" type="hidden" name="score">
                <script>
                    $('.btn-star').click(function () {
                       var prevall =  $(this).prevAll('span');
                       var nextall = $(this).nextAll('span');
                        $(this).css('color','#2aabd2');
                        nextall.css('color','#000000');
                        prevall.css('color','#2aabd2');
                        var index = $(this).index();
                        index++;
                        $('#score').attr('value',index);
                    });
                </script>
            </div>
            <div id="comment-title">
                <span id="border2">
                   <input id="input-title" type="text" name="LongcommentTitle"  placeholder="请输入标题(30个字以内)">
                </span>
            </div>
            <div style="font-size: 16px" id="long-comment-editor">
            </div>
            <div class="btngroup">
                <button class="btn" id="btn-paper">
                    保存为草稿
                </button>
                <button class="btn btn-success" id="btn-save">
                    保存
                </button>
            </div>
        </div>
        <input id="uid" type="hidden" name="uid" value="<?php $uid = empty($_SESSION['user_id'])?1:$_SESSION['user_id']; echo $uid?>">
        <input id="id" type="hidden" name="id" value="<?php $id = empty($_GET['id'])?100001:$_GET['id']; echo $id?>">
        <script type="text/javascript" src="//unpkg.com/wangeditor/dist/wangEditor.min.js"></script>
        <script type="text/javascript">
            const E = window.wangEditor
            const editor = new E('#long-comment-editor')
            // 或者 const editor = new E( document.getElementById('div1') )
            editor.config.uploadImgShowBase64 = true
            editor.config.height = 500;
            editor.create()
            editor.txt.html('<?php echo $content;?>');
            // editor.txt.html('<p>用 JS 设置的内容</p>');
            $('#btn-save').click(function () {
                var content = editor.txt.html();
                var score = $('#score').val();
                if (score =="") {
                    alert("忘记打分了哦，请主人打分");
                    return 0;
                }
                $.ajax({
                    url:"long-comment-api.php",
                    type:"POST",
                    data:{action:"save",content:content,title:$('#input-title').val(),id:$('#id').val(),uid:$('#uid').val(),score:score,isfirst:<?php echo $isfrist;?>},
                    dataType:"text",
                    success:function (data) {
                      alert(data);
                    }
                });
            });
        </script>
    </div>
</div>
<?php  include "../footer.php"?>
</body>
</html>
