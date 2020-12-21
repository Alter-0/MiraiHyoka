/**
 * anikore core function
 *
 */
var anikore = {}
anikore.commonScript = {}

/**
 *! order Categroyの変更、リダイレクト
 *
 */
anikore.commonScript.classStarter = function(obj){
  // li : first-child & last-child
  obj.find("li:first-child").addClass("first-child");
  obj.find("li:last-child").addClass("last-child");
  obj.find("dt:first-child").addClass("first-child");
  obj.find("dt:first-child").next("dd").addClass("first-child");
  obj.find("dd:last-child").addClass("last-child");
  obj.find("dd:last-child").prev("dt").addClass("last-child");

  // formclass
  obj.find("input:text").addClass("fm-text");
  obj.find("input:password").addClass("fm-pass");
  obj.find("input:image").addClass("fm-submit");
  obj.find("option").mouseover(function(){
    $(this).css("background","#F5FF94");
  });
  obj.find("option").mouseout(function(){
    $(this).css("background","#FFF");
  });

  // formsetting
  obj.find("input:text").focus(function(){$(this).addClass("fm-focus");});
  obj.find("input:text").blur(function(){$(this).removeClass("fm-focus");});
  obj.find("input:password").focus(function(){$(this).addClass("fm-focus");});
  obj.find("input:password").blur(function(){$(this).removeClass("fm-focus");});
  obj.find("textarea").focus(function(){$(this).addClass("fm-focus");});
  obj.find("textarea").blur(function(){$(this).removeClass("fm-focus");});

  // mainTable,Odd & Even
  obj.find("table tr:even").addClass("even");
  obj.find("table tr:odd").addClass("odd");

  // gmenu
  anikore.gmenu.init();
}

/**
 * 重複サブミットの防止
 *
 */
anikore.commonScript.preventDuplicateSubmit = function(obj, timeoutOffset){
  this.clickable = true;
  this.timeoutOffset = 5000;
  if(typeof timeoutOffset !== "undefined" && parseInt(timeoutOffset) >= 1000) {
    this.timeoutOffset = parseInt(timeoutOffset);
  }
  var that = this;
  obj.bind('submit click', function(e){
      if(that.clickable === false) {
        window.alert("処理実行中にゅ。少し待ってて欲しいにゅ。");
        e.preventDefault();
        return true;
      }
      that.clickable = false;
      window.setTimeout(function(){
        that.clickable = true;
      }, that.timeoutOffset);
      return true;
  });
}

/**
 * htmlのエンコード、デコード処理
 */
anikore.commonScript.htmlEncode = function(value){
  return $('<div/>').text(value).html();
}
anikore.commonScript.htmlDecode = function(value){
  return $('<div/>').html(value).text();
}

/**
 * グローバルメニュー表示
 *
 */
anikore.gmenu = {
  keep: false,
  init: function(){
    if($('.gmenu__unit--menu').size() > 0) {
      $('.gmenu__unit--menu').toggle(function(){
        anikore.gmenu.keep = true;
      },function(){
        anikore.gmenu.keep = false;
      });
      $('.gmenu__unit--menu, .gsubmenu').mouseover(function(){
        $('.gsubmenu').stop(true, true).delay(10).show(10);
      });
      $('.gmenu__unit--menu, .gsubmenu').mouseleave(function(){
        if(anikore.gmenu.keep === false) {
          $('.gsubmenu').stop(true, true).delay(10).hide(10);
        }
      });
    }
  }
}

/**
 *! AjaxSuggest support for anikore
 *
 */
anikore.suggest = {
  // changer
  transChanger: {
    searchAnimeByKeyword: 'keyword',
    searchAnimeByTag: 'tag',
    searchUserByName: 'user'
  },
  // typeDecider (in same form element)
  typeDecider: '.AnimeMode',

  // add to searchElement
  setElement: function(obj){
    if(obj.size() === 0){
      console.log('target object not found');
      return false;
    }
    // event bind
    obj.parents('form').find(anikore.suggest.typeDecider).bind('change', obj, anikore.suggest.changeType);
    obj.bind('focus', obj, anikore.suggest.changeType);
  },
  // change type
  changeType: function(event){
    var obj = event.data;
    var typeVal = obj.parents('form').find(anikore.suggest.typeDecider).val();
    if(typeof anikore.suggest.transChanger[typeVal] === 'string'){
      var type = anikore.suggest.transChanger[typeVal];
      obj.unbind();
      anikore.commonScript.classStarter(obj.parent());
      $('body').unbind('mouseup');
      $('.as_results').remove();
      anikore.suggest.start[type](obj);
    } else {
      console.error('trans change error.');
    }
  },
  // trigger suggest
  start: {
    keyword: function(obj){
      obj.ajaxSuggest(
        '/animes/ajaxSuggest',
        {'database': [
          {'table':'Anime','field':'title','order':'point','target':'yomigana'},
          {'table':'Anime','field':'title','order':'point','target':'title'}
        ]}
      );
    },
    tag: function(obj){
      obj.ajaxSuggest(
        '/tags/ajaxSuggest',
        {'database': [
          {'table':'Tag','field':'title','order':'title','target':'title'}
        ]}
      );
    },
    user: function(obj){
      obj.ajaxSuggest(
        '/users/ajaxSuggest',
        {'database': [
          {'table':'User','field':'nickname','order':'nickname','target':'nickname'}
        ]}
      );
    }
  }
}
/**
 *! 共通エレメント - 検索フォームの動作部分
 *
 * @use anikore.suggest
 */
anikore.commonSearch = {
  // initialize
  typeDecider: anikore.suggest.typeDecider,
  setElement: function(obj){
    obj.bind('submit enter', obj, anikore.commonSearch.exec);
  },
  exec: function(event){
    // initialize
    var dec = event.data.find(anikore.commonSearch.typeDecider).val();
    var key = ''
    if(event.data.find('input[type="search"]').size() > 0){
      key = event.data.find('input[type="search"]').val();
    } else {
      key = event.data.find('input[type="text"]').val();
    }
    var loc = '/';
    if(typeof key !== 'string' || key === ''){
      return false;
    }
    switch(dec){
      case 'searchAnimeByKeyword':
        loc = loc + 'anime_title/' + key + '/';
        break;
      case 'searchAnimeByTag':
        loc = loc + 'tag/' + key + '/';
        break;
      case 'searchUserByName':
        loc = loc + 'users/search/' + key + '/';
        break;
      default:
        console.error('invalid search pattern');
        return false;
    }
    window.location.href = loc;
    return false;
  }
}

/**
 *! 共通スクリプト - 画像のマウスオーバー処理
 *
 * @param string objPath jquery $()に引き渡すクラスパス
 */
anikore.commonScript.swapImage = function(objPath){
  $(objPath).mouseenter(function() {
    if($(this).attr("src").match("_on.")) {
      $(this).addClass("current");
    };
    if(!$(this).attr("src").match("_on")) {
      $(this).attr("src",$(this).attr("src").replace(/^(.+)(\.[a-z]+)$/, "$1_on$2"))
    };
  });
  $(objPath).mouseleave(function() {
    if(!$(this).attr("class").match("current")) {
      if($(this).attr("src").match("_on.")) {
        $(this).attr("src",$(this).attr("src").replace(/^(.+)_on(\.[a-z]+)$/, "$1$2"))
      };
    };
  });
}

/**
 * SP判定＠javascript
 *
 */
anikore.commonScript.isSP = function(){
  var ua = navigator.userAgent;
  if(ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 ||
     ua.indexOf('iPad') > 0 || ua.indexOf('iPod') > 0 ) {
    return true;
  }
  return false;
}

/**
 * GoogleBot判定＠javascript
 *
 * @see https://support.google.com/webmasters/answer/1061943?hl=ja
 */
anikore.commonScript.isGoogleBot = function(){
  var ua = navigator.userAgent;
  if(ua.indexOf('Googlebot') > 0 || ua.indexOf('Mediapartners-Google') > 0 ||
     ua.indexOf('AdsBot-Google') > 0 ) {
    return true;
  }
  return false;
}

/**
 * GoodAdの表示共通化
 *
 */
anikore.commonScript.goodAd = function(targetPath){
  if(anikore.commonScript.isGoogleBot() === false && typeof Cookies.get('goodad.display') === 'undefined'){
    var env = "REAL";
    if($("#development").size() > 0 ){
      env = "TEST";
    }
    goodAd.show({
      appkey: "C5CBR8TKUJBDMZNB",
      env: env,
      isWebViewAvailable: true
    });
    Cookies.set('goodad.display', 1, {expires: 4, path: targetPath});
  }
}

/**
 * vertical-align: middle
 *
 */
anikore.commonScript.verticalAlignMiddle = function($object){
  var $tables = $("<span><span><span></span></span></span>");
  $tables.css({
    display: "table",
    height: $object.height()+'px'
  });
  $tables.find('span').css({
    display: "table-row"
  });
  $tables.find('span > span').css({
    display: "table-cell",
    verticalAlign: "middle"
  });
  $object.wrapInner($tables[0]);
}

/**
 *! order Categroyの変更、リダイレクト
 *
 */
anikore.commonScript.changeSort = function(sortName){
  var baseUrl = location.href;
  var slashIndex = location.href.split('').reverse().join('').indexOf('/');
  if(slashIndex > 0){
    baseUrl = baseUrl + '/';
  }
  // pageは1ページ目へ強制遷移
  baseUrl = baseUrl.replace(/page\:[0-9]+/g, "page:1");
  location.href = baseUrl + "oc:" + sortName + "/";
}

/**
 *! blockUIのリサイズ時のセンタリング調整
 *
 */
anikore.commonScript.resizeBlockUI = function(){
  $(window).resize(function(){
    var leftPos = Math.max(0, Math.floor(($(window).width() - $('.blockMsg').width()) / 2));
    var topPos  = Math.max(0, Math.floor(($(window).height() - $('.blockMsg').height()) / 2));
    $('.blockMsg').css('left', leftPos + 'px').css('top', topPos + 'px');
  });
}

/**
 *! lazyload
 */
anikore.lazyload = $(function(){
  $('img.lazyload').lazyload();
  if($('#sub').size() > 0){
    $('#sub img.lazyload').lazyload();
  }
  if($('#clm23_main').size() > 0){
    $('#clm23_main img.lazyload').lazyload();
  }
});

/**
 *! 共通スクリプト - 棚への登録、削除
 *
 */
anikore.shelfOperate = {
  // templateList
  templates: {
    animeDetail     : 1,
    rspSearchResult : 2,
    searchResult    : 3
  },
  add: function(animeId, templateName, replaceObj){
    if(typeof anikore.shelfOperate.templates[templateName] === 'number'){
      anikore.shelfOperate._commonScript(animeId, anikore.shelfOperate.templates[templateName], 'insert', replaceObj);
    }
    anikore.shelfOperate._displayShelfStatusChange(animeId);
    return false;
  },
  remove: function(animeId, templateName, replaceObj){
    if(typeof anikore.shelfOperate.templates[templateName] === 'number' && window.confirm('本当に棚から外しますか？')){
      anikore.shelfOperate._commonScript(animeId, anikore.shelfOperate.templates[templateName], 'delete', replaceObj);
    }
    return false;
  },
  _commonScript: function(animeId, templateId, actionType, replaceObj){
    $.ajax({
      async: false,
      type: 'post',
      beforeSend: function(){
        $.blockUI({
          message : '棚を整理しているにゅ。ちょっと待つにゅよ'
        });
      },
      complete: function(request, json){
        $.unblockUI();
        replaceObj.after(request.responseText).remove();
      },
      url: '/animes/ajaxAnimeFavorite',
      data: {
        anime_id: animeId,
        action: actionType,
        mode: templateId
      }
    });
    return false;
  },
  _callAnimeRecommend: function(animeId){
    $.ajax({
      async: true,
      type: 'post',
      dataType: 'html',
      success: function(request, dataType){
        if(request.length > 0){
          var width = 600;
          var topPos = (($(window).height() - 350)) / 2;
          var background = '#fff';
          if($('body').outerWidth() < 600) {
            width = $('body').outerWidth();
            topPos = 0;
            background = 'transparent';
          }
          var leftPos = (($('body').outerWidth() - width)) / 2;
          $.blockUI({
            message : request,
            css     : {
              cursor : 'default',
              border : 'none',
              width  : width + 'px',
              top    : topPos + 'px',
              left   : leftPos + 'px',
              background : background
            }
          });
          $('.blockOverlay').css('cursor', 'default').click($.unblockUI);
          $('.ajaxAnimeRecommendList img').lazyload();
          $('.modal__pushList__item img').lazyload();
        }
      },
      url: '/anime_recommends/ajaxGet',
      data: {
        anime_id : animeId
      }
    });
  },
  _displayShelfStatusChange: function(animeId){
    $.ajax({
      async: true,
      type: 'post',
      dataType: 'html',
      success: function(request, dataType){
        if(request.length > 0){
          var width = 940;
          if($('body').width() < 940) {
            width = $('body').width();
          }
          var leftPos = (($('body').outerWidth() - width)) / 2;
          var topPos  = Math.max(0, (($(window).height() - 588)) / 2);
          $.blockUI({
            message : request,
            css     : {
              cursor     : 'default',
              border     : 'none',
              width      : width + 'px',
              top        : topPos + 'px',
              left       : leftPos + 'px',
              background : 'transparent'
            }
          });
          $('.blockOverlay').css('cursor', 'default').click($.unblockUI);
        }
      },
      url: '/users/ajaxDispChangeAnimeStatus',
      data: {
        anime_id : animeId
      }
    });
  },
  statusChange: function(animeId, usersAnimeId, statusId){
    $.ajax({
      async: true,
      type: 'post',
      dataType: 'json',
      success: function(request, dataType){
        $.unblockUI();
        anikore.shelfOperate._callAnimeRecommend(animeId);
      },
      url: '/users/ajaxChangeAnimeStatus',
      data: {
        is_favorite : -1,
        status_id   : statusId,
        id          : usersAnimeId
      }
    });
  },
  sort: function(id, order) {
    $.extend($.blockUI.defaults.growlCSS, {
      width: '400px',
      top: '45%',
      right: '50%',
      marginRight: '-200px',
      padding: '15px',
      opacity: 0.8,
      fontSize: '1.4em'
    });
    $.ajax({
      async: true,
      type: 'post',
      url: '/users/ajaxUpdateCollectionOrder',
      timeout: 3000,
      dataType: 'json',
      error: function(res) {
        $.growlUI(
          '<div class="pB20">あにこれβは混雑中にゅよ…</div>',
          '今にゅにゅも忙しくて、みんなの棚の整理に時間がかかっちゃってるにゅ。すまねーにゅ。<br />ちょっと時間をおいて整理して欲しいにゅよ。',
          10000
        );
      },
      success: function(res){
        if(res.result === false){
          $.growlUI(
            '<div class="pB20">並び替えに失敗したにゅ…</div>',
            '時間をおいてもう一度やって欲しいにゅ。いっぱい失敗するようなら運営に言ってみるにゅ。',
            10000
          );
        }
      },
      data:{
        'id': id,
        'order': order
      }
    });
  }
}

/**
 *! あにこれレビューシステム共通機能
 *
 */
anikore.reviewPost = {
  startVotePoint: 3,
  currentVotePoint: 3,
  resetVote: function(categoryId){
    var targetObject = $('#reviewPostCategory' + categoryId);
    // select
    targetObject.find('select').val('3');
    // image
    anikore.reviewPost.changeStarImage(targetObject.find('.reviewPostVoteStar'), 3, true);
  },
  voteInit: function(){
    $('.review_star').each(function(){
        // select to image
        $(this).find('select').change(function(){
          // calcPoint
          var pt = 0;
          $('.review_star option:selected').each(function(){
            pt += parseFloat($(this).val());
          });
          pt = Number(pt/5).toFixed(1);
          // replace
          anikore.reviewPost.changeStarImage($('.reviewPostStarImage'), pt, true);
          $('.review_total_point').text(pt);
        });
    });
  },
  touchVoteInit: function(obj, influence){
    obj.bind('touchstart touchmove', function(e){
        e.preventDefault();
        // get before point
        if(e.type == 'touchstart') {
          anikore.reviewPost.startVotePoint = parseFloat(obj.next().text());
        }
        var elemX = 0;
        if(typeof e.originalEvent !== 'undefined' && typeof e.originalEvent.changedTouches !== 'undefined') {
          // for android
          elemX = e.originalEvent.changedTouches[0].pageX - $(this)[0].offsetLeft;
        } else {
          // for normal
          elemX = e.offsetX;
        }
        var point = Math.round((elemX / $(this).width() * 5) * 10) / 10;
        // n.1～n.4 = n.5, n.5～ = n+1
        if(Math.round(point) != point && Math.round(point) < point) {
          point = Math.round(point) + 0.5;
        } else {
          point = Math.round(point);
        }
        if(point < 1) {
          point = 1;
        }
        if(point > 5) {
          point = 5;
        }
        anikore.reviewPost.currentVotePoint = point;
        // render
        anikore.reviewPost.changeStarImage(obj, anikore.reviewPost.currentVotePoint, true);
        obj.next().text(anikore.reviewPost.currentVotePoint.toFixed(1));
    });
    obj.bind('touchend', function(e){
      anikore.reviewPost.changeStarImage(obj, anikore.reviewPost.currentVotePoint, true);
      obj.next().text(anikore.reviewPost.currentVotePoint.toFixed(1));
      // influence to detail points
      if(typeof influence !== 'undefined' && influence === true) {
        $('.review_star select').val(anikore.reviewPost.currentVotePoint);
      }
    });
    obj.bind('touchCancel', function(e){
      anikore.reviewPost.changeStarImage(obj, anikore.reviewPost.startVotePoint, true);
      obj.next().text(anikore.reviewPost.startVotePoint.toFixed(1));
    });
  },
  changeStarImage: function(obj, point, hasHalf){
    for (var i = 1; i <= 5; i++){
      var src = obj.find('img:nth-child(' + i + ')');
      var halfImg = hasHalf ? 'half' : 'off';
      // ON
      if(i <= point) {
        src.attr('src', src.attr('src').replace(/(on|off|half)/, 'on'));
      // HALF
      } else if(i-1 < point) {
        src.attr('src', src.attr('src').replace(/(on|off|half)/, halfImg));
      // OFF
      } else {
        src.attr('src', src.attr('src').replace(/(on|off|half)/, 'off'));
      }
    }
  },
  toggleTagExplain: function(duration, height){
    if(typeof height === 'undefined') {
      height = '4.9em';
    }
    switch($('#reviewPostCustomTagExplain').css('display')){
      case 'none':
        $('#reviewPostCustomTagExplain').css('display', 'block');
        $('#reviewPostCustomTagExplain').animate({
          'opacity': 1,
          'height': height
        }, duration, 'swing');
        break;
      case 'block':
        $('#reviewPostCustomTagExplain').animate({
          'opacity': 0,
          'height': 0
        }, duration, 'swing', function(){
          $('#reviewPostCustomTagExplain').css('display', 'none');
        });
        break;
    }
  },
  postInit: function(){
    $('#reviewPostSubmitBtnDefaultSubmit input[type=submit]').click(function(){
      $('#ReviewClosedFlg').val(0);
    });
    $('#reviewPostSubmitBtnNoteSubmit input[type=submit]').click(function(){
      $('#ReviewClosedFlg').val(1);
    });
  }
}

/**
 *! あにこれサンキューシステム共通処理
 *
 */
anikore.thanks = {
  isFirstThanksDisplay: true,
  transaction: false,

  /**
   * post ajax thanks
   *
   * @param mode          integer 1:レビュー 2:Best10
   *        update_field  string  更新DIV ID
   *        user_id       integer ユーザーID
   *        review_id     integer レビューID
   *        isFirstThanks boolean
   *        template      string  テンプレート特殊指定
   */
  post: function(mode, update_field, user_id, review_id, isFirstThanks, template){
    // 初めてのサンキュー時のお知らせ
    if(isFirstThanks && anikore.thanks.isFirstThanksDisplay){
      var modalHtml = $('#modal_thanks').html();
      // サンキュー用にパラメーターを置換
      modalHtml = modalHtml.replace('#THANK_CATEGORY#', mode);
      modalHtml = modalHtml.replace('#THANK_DIV_ID#'  , update_field);
      modalHtml = modalHtml.replace('#THANK_USER_ID#' , user_id);
      modalHtml = modalHtml.replace('#THANK_ITEM_ID#' , review_id);
      var width = '600px';
      var height = '384px';
      var pleft = '25%';
      var ptop = '20%';
      var background = '#fff';
      if($('#modal_thanks #modalThanx').size() > 0) {
        width = '100%';
        height = '100%';
        pleft = 0;
        ptop = 0;
        background = 'transparent';
      }
      $.blockUI({
        message: modalHtml,
        css: {
          width:      width,
          height:     height,
          top:        ptop,
          left:       pleft,
          textAlign:  'left',
          border:     '0',
          cursor:    'default',
          background: background
        }
      });
      $('.blockOverlay').attr('title', 'Click to unblock').click($.unblockUI);
      anikore.thanks.isFirstThanksDisplay = false;
    } else if(anikore.thanks.transaction === false) {
      var url = '/thanks/ajaxThank/' + mode + '/' + user_id +  '/' + review_id;
      if(typeof template !== 'undefined') {
        url = url + '/' + template;
      }
      anikore.thanks.transaction = true;
      $.unblockUI();
      $.ajax({
        async:true,
        type:'post',
        complete:function(request, json) {
          if(mode == 1){
            $('#' + update_field ).parent().html($(request.responseText).html());
          } else {
            $('#' + update_field ).html(request.responseText);
          }
          anikore.thanks.transaction = false;
        },
        url: url
      });
    } else {
      console.error('now sending. block duplicate ajax thanks');
    }
  }
}

/**
 *! あにこれユーザフォロー共通処理
 *
 */
anikore.userFollow = {
  follow: function(userId, mode){
    anikore.userFollow._commonScript(userId, mode, 'insert');
  },
  release: function(userId, mode){
    if(window.confirm('本当にリリースしますか？')){
      anikore.userFollow._commonScript(userId, mode, 'delete');
    }
  },
  _commonScript: function(userId, mode, type){
    $.ajax({
      async: true,
      type: 'post',
      complete: function(request, json) {
        $('#catch').html(request.responseText);
      },
      data: {
        action: type,
        followed_user_id: userId,
        mode: mode
      },
      url: '/users/ajaxUserFollow'
    });
  }
}

/**
 * ネタバレ報告ボタンのAjax処理
 *
 */
anikore.reviewWarn = {
  display: function(){
    var width = 940;
    if($('body').width() < 940) {
      width = $('body').width();
    }
    var leftPos = (($('body').outerWidth() - width)) / 2;
    var topPos  = Math.max(0, (($(window).height() - 588)) / 2);
    $.blockUI({
      message: $('.m-reviewNetabareModal').html(),
      css: {
        cursor     : 'default',
        border     : 'none',
        width      : width + 'px',
        top        : topPos + 'px',
        left       : leftPos + 'px',
        background : '#fff'
      }
    });
    $('.blockOverlay').css('cursor','default').click($.unblockUI);
    anikore.commonScript.resizeBlockUI();
  },
  send: function(reviewId, userId){
    $.ajax({
      async: true,
      type: 'post',
      beforeSend: function(xhr){
        $.unblockUI();
      },
      complete: function(request,json){
        var json = request.responseText;
        var obj = jQuery.parseJSON(json);
        // in PC
        if(obj.isDispWarning) {
          $('.review_neta_warn').removeClass('none');
        }
        if(obj.isDispNetabare) {
          $('.review_neta_warn').addClass('none');
          $('.review_neta').html("<div class=\"atrp_neta\">ネタバレ</div>");
        }
        $('.reviewNetaBtn').attr('src', '/img/clm21/netabare_btn_off.png');
      },
      url:'/review_netabares/add',
      data:{
        review_id : reviewId,
        user_id   : userId
        }
    });
  }
}

/**
 * メッセージボード処理機能
 *
 */
anikore.messageBoard = {
  formObj: null,
  commentListObj: null,
  runup: function(targetForm, targetList){
    anikore.messageBoard.formObj = $(targetForm);
    anikore.messageBoard.commentListObj = $(targetList);
  },
  add: function(){
    var inputForm = anikore.messageBoard.formObj.find('input:text');
    if(inputForm.attr('title') == inputForm.val()){
      return;
    }
    var data = {};
    $.each(anikore.messageBoard.formObj.serializeArray(), function(key, obj){
        data[obj.name] = obj.value;
    });
    $.ajax({
      type: 'POST',
      url: '/users_comments/add',
      async: true,
      beforeSend: function(xhr){
        $.blockUI({
          message: '<div id=\'loading\'><h1><img src="/img/common/ajax-loader.gif" />投稿中…(´・ω・｀)</h1></div>'
        });
      },
      success: function(request, xhr){
        inputForm.val('');
      },
      complete: anikore.messageBoard._completeCallBack,
      data: data
    });
  },
  remove: function(id){
    if(window.confirm('本当に削除しますか？')){
      $.ajax({
        type: 'POST',
        url: '/users_comments/del/' + id,
        async: true,
        beforeSend: function(xhr){
          $.blockUI({
            message: '<div id=\'loading\'><h1><img src="/img/common/ajax-loader.gif" />削除中…(´；ω；｀)</h1></div>'
          });
        },
        complete: anikore.messageBoard._completeCallBack
      });
    }
  },
  _completeCallBack: function(){
    if(anikore.messageBoard.formObj === null || anikore.messageBoard.commentListObj === null){
      return;
    }
    $.unblockUI();
    var data = {};
    $.each(anikore.messageBoard.formObj.serializeArray(), function(key, obj){
        data[obj.name] = obj.value;
    });
    if(data.mode.length > 1){
      mode = "/mode:" + data.mode;
    } else {
      mode = '';
    }
    anikore.messageBoard.commentListObj.load('/users/ajax_message_box/' + data.user_id + mode, function(){
      anikore.messageBoard.commentListObj.find('img.lazyload').lazyload();
    });
  }
}

/**
 * アニメ放題LPへの移動チェックcookie付与
 *
 */
anikore.animeHodaiLanding = function(eventCategory, eventAction, eventLabel){
  Cookies.set('_sb_animeHodai_landing', 1, {expires: 365, path: '/'});
  ga('send', 'event', 'sb_' + eventCategory, eventAction, eventLabel);
}

