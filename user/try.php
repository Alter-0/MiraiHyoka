<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>CodePen - Slide Sign In/Sign Up form</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container right-panel-active">

    <!-- Sign Up -->
    <div class="container__form container--signup">
        <form action="#" class="form" id="form1">
            <h2 class="form__title">注册</h2>
            <input type="text" placeholder="用户名" class="input" />
            <input type="email" placeholder="邮箱" class="input" />
            <input type="password" placeholder="密码" class="input" />
            <button class="btn">注册</button>
        </form>
    </div>

    <!-- Sign In -->
    <div class="container__form container--signin">
        <form action="#" class="form" id="form2">
            <h2 class="form__title">登录</h2>
            <input type="email" placeholder="邮箱" class="input" />
            <input type="password" placeholder="密码" class="input" />
            <a href="#" class="link">忘记密码?</a>
            <button class="btn">登录</button>
        </form>
    </div>

    <!-- Overlay -->
    <div class="container__overlay">
        <div class="overlay">
            <div class="overlay__panel overlay--left">
                <button class="btn" id="signIn">登录</button>
            </div>
            <div class="overlay__panel overlay--right">
                <button class="btn" id="signUp">注册</button>
            </div>
        </div>
    </div>
</div>

<script  src="js/script.js"></script>

</body>
</html>
