<?php
$isLogin = 0;
if(isset( $_SESSION['user_id'])){
    $isLogin = $_SESSION['user_id'];
}
?>
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
                    <li class="out-li"><a href="../guide/guide.php"><span id="span1" class="ul-span">番剧</span></a>
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
                    <a href="../search/search.php"><span id="span5" class="ul-span">探索</span></a>
                    <ul>
                        <li><a href="../search/search.php?content=紫罗兰">紫罗兰</a></li>
                        <li><a href="../search/search.php?content=青春">青春系列</a></li>
                        <li><a href="../search/search.php?content=少女">少女系列</a></li>
                    </ul>
                    </li>
                    <li class="hidden-md"><a href="../animate/detail.php">
                            <span id="span-img" class="ul-span2"><img src="../image/logo_doujin.png" alt="照片">
                            </span>
                        </a>
                    </li>
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
                            <option value="6">三次元</option>
                            <option value="person">人物</option>
                        </select>
                        <input id="search_text" name="content" class="textfield sec" type="text">
                        <input type="submit" name="submit"  class="sec" id="search_btn" value="">
                    </div>
                </form>
            </div>
            <?php

            if ($isLogin==0){
                echo " <div id=\"login-btn\" class=\"login\">
                <a  href=\"../user/login.php\">
                    <span id=\"login\" class=\"reg11\" style=\"padding: 0 5px 0 15px\">登录</span>
                </a>
                <a href=\"../user/reg.php\">
                    <span id=\"reg11\" class=\"reg11\" style=\"padding:0 15px 0 5px\">注册</span>
                </a>
                 </div>";
            }else{
                $conn = mysqli_connect("47.115.15.18",
                    "wangyesheji", "e7BLUzfQv69wXybN",
                    "miraihyoka") or die("数据库连接失败");
                $sql = "select avatar from user where user_id = $isLogin;";
                $res =  mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                $pic = $row['avatar'];
                if (empty($pic)){
                    $pic = "../image/akari.jpg";
                }
                echo " <div   id=\"headerpic\">
                 <img src=\"$pic\" alt=\"oih\">
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
            }
            ?>
            <!--            <script>-->
            <!--                $(function () {-->
            <!--                    var login_btn = $('#login-btn');-->
            <!--                    var hearpic = $('#headerpic');-->
            <!--                    if ($('#isLogin').val()==1){-->
            <!--                        login_btn.css('display','none');-->
            <!--                        hearpic.css('display','inline-block');-->
            <!--                    }else {-->
            <!--                        login_btn.css('display','block');-->
            <!--                        hearpic.css('display','none');-->
            <!--                    }-->
            <!--                })-->
            <!--            </script>-->
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