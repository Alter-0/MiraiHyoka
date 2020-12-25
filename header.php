<header>
<!--  <?php
$isLogin = 0;
if(isset( $_SESSION['user_id'])){
    $isLogin =1;
}
?>   -->
    <div style="padding: 0" class="container">
        <div class="dis">
            <div class="logo"><a href="../index.php"><img src="../image/logo.png" alt=""></a></div>
        </div>
        <div class="dis">
            <div class="navli">
                <ul class="hidden-lg hidden-md">
                    <li >
                        <span id="span6" class="ul-span">菜单</span>
                    </li>
                </ul>
                <ul class="hidden-sm hidden-xs">
                    <li class="out-li"><a href="../animate/detail.php"><span id="span1" class="ul-span">番剧</span></a>
                        <ul>
                            <li><a href="../animate/detail.php">短评</a></li>
                            <li><a href="../animate/detail.php">长评</a></li>
                        </ul>
                    </li>
                    <li class="out-li">
                        <a href="../guide/guide.php">
                            <span class="ul-span">指引</span>
                        </a>
                        <ul>
                            <li><a href="../guide/guide.php">分类</a></li>
                            <li><a href="../guide/guide.php">标签</a></li>
                        </ul>
                    </li>
                    <li class="out-li"
                    <a href="search/search.php"><span id="span5" class="ul-span">探索</span></a>
                    <ul>
                        <li><a href="../search/search.php?content=紫罗兰">紫罗兰</a></li>
                        <li><a href="../search/search.php?content=青春">青春系列</a></li>
                        <li><a href="../search/search.php?content=少女">少女系列</a></li>
                    </ul>
                    </li>
                    <li class="hidden-md"><a href="#"><span id="span-img" class="ul-span2"><img src="../image/logo_doujin.png" alt="照片"></span></a></li>
                </ul>
            </div>
        </div>
        <div id="user-login" class="dis">
            <div class="search hidden-sm hidden-xs">
                <form action="../search/search.php" method="get">
                    <div class="inner">
                        <select name="cat" id="siteSearchSelect">
                            <option value="all">全部</option>
                            <option value="2">动画</option>
                            <option value="1" selected="selected">书籍</option>
                            <option value="4">游戏</option>
                            <option value="3">音乐</option>
                        </select>
                        <input id="search_text" name="content" class="textfield sec" type="text">
                        <input type="submit" name="submit"  class="sec" id="search_btn" value="">
                    </div>
<!--                    <span id="btn-sear"  style="top: -21px;left: 28px;z-index: 0" class="glyphicon glyphicon-search">-->
<!--                         </span>-->
                </form>
            </div>
            <?php
            if ($isLogin==1){
                echo " <div   id=\"headerpic\">
                 <img src=\"../image/headerpic.jpg\" alt=\"oih\">
                 <ul>
                     <li><a href=\"../user-center/usercenter.php\">个人中心</a></li>
                <li><a href=\"../user-center/usercenter.php\">我的评分</a></li>
                     <li><a href=\"../user-center/usercenter.php\">我的收藏</a></li>
                     <li id=\"headerpic-last-li\">
                         <a href=\"../user/exitlogin.php\">
                    退出登录
                         </a>
                     </li>
                 </ul>
             </div>";
            }else{
                echo " <div id=\"login-btn\" class=\"login\">
                <a  href=\"../user/login.php\">
                    <span id=\"login\" class=\"reg11\" style=\"padding: 0 5px 0 15px\">登录</span>
                </a>
                <a href=\"../user/reg.php\">
                    <span id=\"reg11\" class=\"reg11\" style=\"padding:0 15px 0 5px\">注册</span>
                </a>
            </div>";
            }
            ?>
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
        }else {
            $menu.slideUp(300);
            i--;
            $(this).html('菜单');
        }
    });
</script>