<!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="google-site-verification" content="SOywZSSwGgxD-HKp57253mwRiqFQKFh52FCCsbWGBnY" />
    <meta name="msvalidate.01" content="A8E40848D1CE4A10613BA4BD8F027CB3" />
    <meta charset="UTF-8">
    <title>おすすめアニメ動画を感想評価/人気でランキング【あにこれβ】</title>

    <link rel="stylesheet" href="static/css/normalize.min.css">
    <link href="static/css/0168b790eb2044f4abc9c1c90ebc1989.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="static/css/jquery.ajaxsuggest.css" />
    <link rel="stylesheet" type="text/css" href="static/css/common.css" />
    <script type="text/javascript" src="static/js/jquery.min.js"></script>
    <script type="text/javascript" src="static/js/jquery.lazyload.min.js"></script>
    <link rel="stylesheet" type="text/css" href="static/css/home.css" />
    <meta name="description" content="あにこれβはおすすめアニメ動画を成分タグ・ランキング・レビュー感想や放送時期でさがせるアニメ評価サイト。参加するとアニメ動画をコレクションできるアニメ棚がもらえるぞ。あにこれβで今すぐアニメを棚で管理！おすすめアニメ動画をみんなで教えあおう！" />
    <meta name="keywords" content="おすすめ,アニメ,動画,感想,評価,人気,ランキング" />

    <meta name="author" content="anikore" lang="ja">
    <meta name="copyright" content="copyright (c) Anikore Allrights Reserved." />
    <meta name="google" content="nositelinkssearchbox">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="start" href="https://www.anikore.jp/" />

    <link rel="shortcut icon" href="https://www.anikore.jp/fav.ico" />
    <link rel="apple-touch-icon-precomposed" href="https://www.anikore.jp/img/common/fav.gif">
    <meta property="og:image" content="https://www.anikore.jp/img/common/facebook_logo.jpg">

    <script src="static/js/5638090428.js"></script>
</head>
<body>
<section class="m-topSlider">
    <p class="m-topSlider_loading">Now Loading...</p>
    <ul class="m-topSlider_inner">
        <?php
        include "conn.php";
        include "static/dao.php";
        $sql = "select animate_id,cover,name_jp,name_en from animate order by douban_rating limit 20;";
        $res = queryList($conn,$sql);
       foreach ($res as $item){
           $title = $item['name_jp'];
           $cover = $item['cover'];
           $id = $item['animate_id'];
           $en = $item['name_en'];
           echo " <li class=\"m-topSlider_unit\"><a target='_parent' href=\"animate/detail.php?animate_id=$id\">
                <div class=\"m-topSlider_unit_image\"><img data-original=\"$cover\" width=\"600\" height=\"600\" class=\"lazyload\"></div>
                <p class=\"m-topSlider_unit_title\">$title</p>
                <p class=\"m-topSlider_unit_nickname\">$en</p>
            </a></li>";
       }
        ?>
<!--        <li class="m-topSlider_unit"><a href="/review/2109875">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12866.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">女子高生部活物、今季は競技クライミング！</p>-->
<!--                <p class="m-topSlider_unit_nickname">のび太</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2109778">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12786.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">喜びも悲しみも旅のまにまに</p>-->
<!--                <p class="m-topSlider_unit_nickname">ato00</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2109648">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12772.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">厨二を自覚するという事</p>-->
<!--                <p class="m-topSlider_unit_nickname">ぺー</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2109546">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12786.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">自由きままに旅する魔女の物語</p>-->
<!--                <p class="m-topSlider_unit_nickname">のび太</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2109229">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/517ukda328l.jpg._aa400_.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">自分と重ね合わせた時。</p>-->
<!--                <p class="m-topSlider_unit_nickname">こま</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2109211">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/8237.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">心の壁を突き崩すレイド</p>-->
<!--                <p class="m-topSlider_unit_nickname">101匹足利尊氏</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2109127">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12669.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">好き嫌い分かれてますね♪</p>-->
<!--                <p class="m-topSlider_unit_nickname">スラえもん</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2109121">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12669.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">マガジンでジャンプをやらんと欲すれば</p>-->
<!--                <p class="m-topSlider_unit_nickname">ぺー</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2109109">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/518jy9bz2cl.jpg._aa400_.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">健康保険証や運転免許証の裏をあなたは見たことがありますか？</p>-->
<!--                <p class="m-topSlider_unit_nickname">でこぽん</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2108817">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12529.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">好みが分かれそうな作品だけど、面白かった！</p>-->
<!--                <p class="m-topSlider_unit_nickname">ダビデ</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2108506">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12493.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">7年超に及ぶ執念の自主制作により炸裂したロックな“初期衝動”</p>-->
<!--                <p class="m-topSlider_unit_nickname">101匹足利尊氏</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2108483">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/51yh6yr3bdl.jpg._aa400_.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">やっぱりベタが好き</p>-->
<!--                <p class="m-topSlider_unit_nickname">VECCI</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2108319">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/2282.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">世の中には二種類の人間しかいない。</p>-->
<!--                <p class="m-topSlider_unit_nickname">カエル王子</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2108045">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/3707.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">逆転の発想が光る秀作</p>-->
<!--                <p class="m-topSlider_unit_nickname">VECCI</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2107905">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12766.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">レディースアクションアニメ</p>-->
<!--                <p class="m-topSlider_unit_nickname">褐色の猪</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2107867">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/7561.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">間違える権利まで奪わないで欲しい</p>-->
<!--                <p class="m-topSlider_unit_nickname">VECCI</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2107785">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/8316.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">「大切な人といつかまためぐり合えますように」</p>-->
<!--                <p class="m-topSlider_unit_nickname">take_0(ゼロ)</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2107772">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/2983.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">ちょっと独特な雰囲気の大人の童話</p>-->
<!--                <p class="m-topSlider_unit_nickname">かんぱり</p>-->
<!--            </a></li>-->
<!--        <li class="m-topSlider_unit"><a href="/review/2107621">-->
<!--                <div class="m-topSlider_unit_image"><img data-original="static/picture/12747.jpg" width="600" height="600" class="lazyload"></div>-->
<!--                <p class="m-topSlider_unit_title">地味すぎて、すご～く、損してますね。</p>-->
<!--                <p class="m-topSlider_unit_nickname">えりりん908</p>-->
<!--            </a></li>-->
    </ul>
    <div class="m-topSlider_moveLeft">&lt;</div>
    <div class="m-topSlider_moveRight">&gt;</div>
</section>

<script type="text/javascript" src="static/js/jquery.ajaxsuggest.1.4.js"></script>    <script type="text/javascript" src="static/js/js.cookie.js"></script>    <script type="text/javascript" src="static/js/anikore.core.js"></script>    <script type="text/javascript" src="static/js/common.js"></script>
<script type="text/javascript" src="static/js/home.js"></script>
<script async src="static/js/adsbygoogle.js"></script>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-4626144340722272",
        enable_page_level_ads: true
    });
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','static/js/hello.js','ga');

    ga('create', 'UA-16032070-1', 'auto');
    ga('require', 'linkid', 'linkid.js');
    ga('set', 'dimension1', 'desktop');
    ga('set', 'dimension2', 'no_sb_linked_anime');
    ga('set', 'dimension3', 'not_login');
    ga('send', 'pageview');

</script>
</body>
</html>
