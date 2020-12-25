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
<div style="width: 100%;background-color:#fafafa;">
    <div class="container">
        <div class="editor ">
            <div class="e-title">
                <span id="border">
                    <h3 id="title">专栏投稿  </h3>
                </span>
            </div>
            <div class="comment-score">
                <div id="small-title">谋学的超电磁炮的长评</div>
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
            editor.config.height = 500;
            editor.config.uploadImgServer = 'upload-api.php'
            editor.config.uploadImgHooks = {
                // 上传图片之前
                before: function(xhr) {
                    // console.log(xhr)
                    //
                    // // 可阻止图片上传
                    // return {
                    //     prevent: true,
                    //     msg: '需要提示给用户的错误信息'
                    // }
                },
                // 图片上传并返回了结果，图片插入已成功
                success: function(xhr) {
                    console.log('success', xhr)
                },
                // 图片上传并返回了结果，但图片插入时出错了
                fail: function(xhr, editor, resData) {
                    console.log('fail', resData)
                },
                // 上传图片出错，一般为 http 请求的错误
                error: function(xhr, editor, resData) {
                    console.log('error', xhr, resData)
                },
                // 上传图片超时
                timeout: function(xhr) {
                    console.log('timeout')
                },
                // 图片上传并返回了结果，想要自己把图片插入到编辑器中
                // 例如服务器端返回的不是 { errno: 0, data: [...] } 这种格式，可使用 customInsert
                customInsert: function(insertImgFn, result) {
                    // result 即服务端返回的接口
                    console.log('customInsert', result)

                    // insertImgFn 可把图片插入到编辑器，传入图片 src ，执行函数即可
                    insertImgFn(result.data[0])
                }
            }
            editor.create()
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
                    data:{action:"save",content:content,title:$('#input-title').val(),id:$('#id').val(),uid:$('#uid').val(),score:score},
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
