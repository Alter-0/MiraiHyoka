<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>长评页面</title>
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/edit.css">

</head>
<body>
<div class="container">
    <h1>某科学的超电磁炮长评</h1>
    <div id="div1">
        <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
    </div>

    <script type="text/javascript" src="//unpkg.com/wangeditor/dist/wangEditor.min.js"></script>
    <script type="text/javascript">
        const E = window.wangEditor
        const editor = new E('#div1')
        // 或者 const editor = new E( document.getElementById('div1') )
        editor.create()
    </script>
</div>

</body>
</html>
