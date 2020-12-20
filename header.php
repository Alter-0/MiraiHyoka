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
                    <li class="out-li"><a href="#"><span id="span1" class="ul-span">动画</span></a>
                        <ul>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                        </ul>
                    </li>
                    <li class="out-li">
                        <a href="#">
                            <span class="ul-span">书籍</span>
                        </a>
                        <ul>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                        </ul>
                    </li>
                    <li class="out-li">
                        <a href="#">
                            <span class="ul-span">音乐</span>
                        </a>
                        <ul>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                        </ul>
                    </li>
                    <li class="out-li"><a href="#"><span class="ul-span">游戏</span></a>
                        <ul>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                        </ul>
                    </li>
                    <li class="out-li"><a href="#"><span id="span5" class="ul-span">三次元</span></a>
                        <ul>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                        </ul>
                    </li>
                    <li class="out-li"><a href="#"></a></li>
                    <li class="out-li"><a href="#"><span id="span7" class="ul-span2">人物</span></a>
                        <ul>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                        </ul>
                    </li>
                    <li class="out-li"><a href="#"><span class="ul-span2">小组</span></a>
                        <ul>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                        </ul>
                    </li>
                    <li class="out-li"><a href="#"><span class="ul-span2">展开</span></a>
                        <ul>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                        </ul>
                    </li>
                    <li class="out-li"><a href="#"><span class="ul-span2">探索</span></a>
                        <ul>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                            <li><a href="#">hello world</a></li>
                        </ul>
                    </li>
                    <li ><a href="#"><span id="span-img" class="ul-span2"><img src="#" alt="照片"></span></a></li>
                </ul>
            </div>
        </div>
        <div id="user-login" class="dis">
            <div class="search">
                <form action="#" method="post">
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
                        <input id="search_text" name="search_text" class="textfield sec" type="text">
                        <input type="submit" name="submit"  class="sec" id="search_btn" value="">
                    </div>
                </form>
            </div>
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
</header>