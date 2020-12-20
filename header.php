<header>
<div style="padding: 0" class="container">
    <div class="dis">
        <div class="logo"><img src="../image/logo.png" alt=""></div>
    </div>
    <div class="dis">
        <div class="navli">
            <ul class="hidden-lg hidden-md">
                <li ><a href="#">
                  <span id="span6" class="ul-span">菜单</span></a></li>
            </ul>
            <ul class="hidden-sm hidden-xs">
                <li><a href="#"><span id="span1" class="ul-span">动画</span></a></li>
                <li><a href="#"><span class="ul-span">书籍</span></a></li>
                <li><a href="#"><span class="ul-span">音乐</span></a></li>
                <li><a href="#"><span class="ul-span">游戏</span></a></li>
                <li><a href="#"><span id="span5" class="ul-span">三次元</span></a></li>
                <li><a href="#"></a></li>
                <li><a href="#">hello</a></li>
                <li><a href="#">hello</a></li>
                <li><a href="#">hello</a></li>
                <li><a href="#">hello</a></li>
                <li><a href="#">hello</a></li>
            </ul>
        </div>
    </div>
    <div class="dis hidden-xs hidden-sm">
        <div class="inner">
            <input type="text">
        </div>
    </div>
    <div id="user-login" class="dis">
     <div class="login">
         <a href="user/login.html">
             <span id="login" class="reg" style="padding: 0 5px 0 15px">登录</span>
         </a>
         <a href="user/user.php">
             <span id="reg" class="reg" style="padding:0 15px 0 5px">注册</span>
         </a>
     </div>
    </div>
</div>
<div class="menu" id="menu">

</div>
</header>
<script>
    var i = 0;
    var $menu = $('#menu');
    $('#span6').click(function () {
        if (i==0){
            $menu.slideDown(300);
            i++;
            $(this).html('关闭');
            // $(this).append("关闭");
        }else {
            $menu.slideUp(300);
            i--;
            $(this).html('菜单');
        }
    });
</script>