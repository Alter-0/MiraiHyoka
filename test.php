<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>测试网页</title>
    <script src="js/jquery.js"></script>
    <style>
        body{
            position: absolute;
        }
        .move,.show{
            position: absolute;
            width: 100px;
            height: 100px;
            background-color: #3c763d;
            margin: 10px;
        }
        .show{
            left: 20px;
            background-color: pink;
            top: 100px;
        }

    </style>
</head>
<body>
<h1>测试网页</h1>
<div class="move">
 move
</div>
<div class="show">
 show
</div>
<script>
     $('.move').hover(function () {
         // alert("hello")
         $('.show').animate({left:'100px'},400,function (){
             alert("动画已经完成");
         });

     },function () {
      //   $('.show').animate({left:'500px'},1000);
     })
</script>
</body>
</html>