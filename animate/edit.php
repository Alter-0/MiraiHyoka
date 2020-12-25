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
            margin-left: 10px;
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
    </style>
</head>
<body>
<?php
  include "../header.php";
?>
<div style="width: 100%;background-color:#fafafa;">
    <div class="container">
        <div class="editor ">
            <div class="e-title">
                <span id="border">
                    <h3 id="title">专栏投稿  <span id="small-title">谋学的超电磁炮的长评</span></h3>

                </span>
            </div>
            <div id="comment-title">
                <span id="border2">
                   <input id="input-title" type="text" name="LongcommentTitle"  placeholder="请输入标题(30个字以内)">
                </span>
            </div>
            <div style="font-size: 16px" id="long-comment-editor">
            </div>
            <div class="btngroup">
                <button class="btn">
                    保存为草稿
                </button>
                <button class="btn btn-success">
                    保存
                </button>
            </div>
        </div>
        <div id="show">

        </div>
        <script type="text/javascript" src="//unpkg.com/wangeditor/dist/wangEditor.min.js"></script>
        <script type="text/javascript">
            const E = window.wangEditor
            const editor = new E('#long-comment-editor')
            // 或者 const editor = new E( document.getElementById('div1') )
            editor.config.height = 500;

            editor.create()
            // editor.txt.html('<p>用 JS 设置的内容</p>');
            function f() {
                // editor.txt.append('<p>追加的内容</p>')
                alert(editor.txt.html());
                $('#show').html(editor.txt.html());
            }
        </script>
    </div>
</div>
<?php  include "../footer.php"?>
</body>
</html>
