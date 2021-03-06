/*
Infomation
==========================================================================================
jQuery Plugin
	Name       : jquery.ajaxSuggest
	Version    : 1.4
	Update     : 2010-12-08
	Author     : sutara_lumpur
	Author-URI : http://d.hatena.ne.jp/sutara_lumpur/20100718/1279420832
	License    : MIT License (http://www.opensource.org/licenses/mit-license.php)
	Based-on   : Uses code and techniques from following libraries...
		* jquery.suggest 1.1
			Author     : Peter Vulgaris
			Author-URI : http://www.vulgarisoip.com/
==========================================================================================

Contents
==========================================================================================
	01. 変数・部品の定義
	02. イベントハンドラ
	03. Suggest用メソッド - 未分類
	04. Suggest用メソッド - Ajax関連
	05. Suggest用メソッド - 候補リスト関連
	06. 処理の始まり
==========================================================================================
*/
(function($) {
	$.ajaxSuggest = function(input_obj, source, options) {
		//Ajaxにおけるキャッシュを無効にする
		$.ajaxSetup({cache: false});
		
		//================================================================================
		// 01. 変数・部品の定義
		//--------------------------------------------------------------------------------
		//**********************************************
		//変数の初期化
		//**********************************************
		var show_hide        = false; //候補を、タイマー処理で表示するかどうかの予約
		var timer_show_hide  = false; //タイマー。フォーカスが外れた後、候補を非表示にするか
		var timer_val_change = false; //タイマー変数(一定時間ごとに入力値の変化を監視)
		var reserve_click    = false; //マウスのキーを押し続ける操作に対応するためmousedownを検知
		var $xhr             = false; //XMLHttpオブジェクトを格納
		var prev_value       = '';    //Suggestの、以前の値
		var user_value       = '';    //ユーザが入力したもともとの値
		var is_select        = false; //キー入力ではなく、候補選択で$(input_obj)の値が変わったか？
		var key_select       = false; //キーで候補移動したか？？

		//**********************************************
		//部品の定義
		//**********************************************
		$(input_obj).attr('autocomplete','off');
			
		var $results = $('<ul></ul>')
			.addClass(options.results_class)
			.appendTo('body');
		
		//================================================================================
		// 02. イベントハンドラ
		//--------------------------------------------------------------------------------
		//**********************************************
		//テキスト入力エリア
		//**********************************************
		//前処理(クロスブラウザ用)
		if($.support.checkOn && $.support.cssFloat){
			$(input_obj).keypress(processKey);
		}else{
			$(input_obj).keydown(processKey);
		}
		$(input_obj).focus(function() {
			show_hide = true;
			checkValChange();
		});
		$(input_obj).blur(function(ev) {
			//入力値の監視を中止
			clearTimeout(timer_val_change);

			//候補消去を予約
			show_hide = false;

			//消去予約タイマーをセット
			checkShowHide();
		});
		$(input_obj).mousedown(function(ev) {
			reserve_click = true;

			//消去予約タイマーを中止
			clearTimeout(timer_show_hide);

			ev.stopPropagation();
		});
		$(input_obj).mouseup(function(ev) {
			$(input_obj).focus();
			reserve_click = false;
			ev.stopPropagation();
		});

		//**********************************************
		//body全体
		//**********************************************
		$('body').mouseup(function() {
			//消去予約タイマーを中止
			clearTimeout(timer_show_hide);

			//候補を消去する
			show_hide = false;
			hideResult();
		});

		//================================================================================
		// 03. Suggest用メソッド - 未分類
		//--------------------------------------------------------------------------------
		//**********************************************
		//タイマーによる入力値変化監視
		//**********************************************
		function checkValChange() {
			timer_val_change = setTimeout(isChange,500);

			function isChange() {
				var now_value = $(input_obj).val();
				if(!now_value){
					hideResult();
				}else if(now_value != prev_value && !is_select) {					
					suggest();
				}
				is_select = false;
				prev_value = now_value;
				
				//ユーザがもともと入力していた値を格納
				if(!getCurrentResult()) user_value = $(input_obj).val();

				//一定時間ごとの監視を再開
				checkValChange();
			}
		}

		//**********************************************
		//候補の消去を本当に実行するか判断
		//**********************************************
		function checkShowHide() {
			timer_show_hide = setTimeout(function() {
				if (show_hide == false && reserve_click == false){
					hideResult();
				}
			},500);
		}

		//**********************************************
		//キー入力への対応
		//**********************************************
		function processKey(e) {
			if (
				(/27$|38$|40$|^9$/.test(e.keyCode) && $results.is(':visible')) ||
				(/^13$|^9$/.test(e.keyCode) && getCurrentResult())
			) {
				if (e.preventDefault)  e.preventDefault();
				if (e.stopPropagation) e.stopPropagation();

				e.cancelBubble = true;
				e.returnValue  = false;
				
				switch(e.keyCode) {
					case 38: // up
						key_select = true;
						prevResult();
						break;

					case 40: // down
						key_select = true;
						nextResult();
						break;

					case 9:  // tab
						hideResult();
						break;

					case 13: // return
						selectCurrentResult(true);
						break;

					case 27: //	escape
						hideResult();
						break;
				}
			} else {
				checkValChange();
			}
		}

		//================================================================================
		// 04. Suggest用メソッド - Ajax関連
		//--------------------------------------------------------------------------------
		//**********************************************
		//Ajaxの中断
		//**********************************************
		function abortAjax() {
			if ($xhr){
				$xhr.abort();
				$xhr = false;
			}
		}

		//**********************************************
		//Ajax通信
		//**********************************************
		function suggest(){
			if($(input_obj).val().search(/^[ 　\n\r\t]*$/) > -1) return;
			
			//Ajax通信をキャンセル
			abortAjax();
			
			//ここでAjax通信を行っている
			$xhr = $.getJSON(
				options.source,
				{
					'q_word'   : $(input_obj).val(),
					'database' : options.database,
					'and_or'   : options.and_or,
					'limit'    : options.limit,
					'order_by' : options.order_by
				},
				function(json_data){
					if(json_data.length < 1){
						hideResult();
					} else {
						displayItems(json_data);
					}
				}
			);
		}

		//================================================================================
		// 05. Suggest用メソッド - 候補リスト関連
		//--------------------------------------------------------------------------------
		//**********************************************
		//候補一覧の<ul>成形、表示
		//**********************************************
		// @params array arr_candidate   DBから検索・取得した値の配列
		//
		//arr_candidateそれぞれの値を<li>で囲んで表示。
		//同時に、イベントハンドラを記述。
		function displayItems(arr_candidate) {
		
			//候補リストを、一旦リセット
			$results.empty();

			for (var i = 0; i < arr_candidate.length; i++) {
				//候補リスト
				var $li = $('<li>' + arr_candidate[i] + '</li>');
				$results.append($li);
			}
			//----------------------------------------------
			//候補リストの位置を指定
			//----------------------------------------------
			var offset = $(input_obj).offset();

			offset.top +=
				parseInt($(input_obj).height(), 10) +
				parseInt($(input_obj).css('border-top-width'), 10) +
				parseInt($(input_obj).css('padding-top'), 10) +
				parseInt($(input_obj).css('padding-bottom'), 10);
			var ua = navigator.userAgent.toLowerCase();
			if(ua.indexOf('msie') > -1){
				//IEは相対座標でoffsetを取得する。
				//そのため、画面スクロール分を足し合わせる必要がある。
				offset.top += parseInt($results.scrollTop(), 10);
			}
			
      // 不要
			// offset.left += parseInt($(input_obj).css('padding-left'), 10);
			if(ua.indexOf('msie') > -1 || ua.indexOf('opera') > -1){
				offset.left -= parseInt($(input_obj).css('border-left-width'), 10);
			}
			
			//画面に表示
			$results
				.show()
				.css({'top':offset.top, 'left':offset.left})
				.width(
					parseInt($(input_obj).width()) +
					parseInt($(input_obj).css('padding-left'), 10) +
					parseInt($(input_obj).css('padding-right'), 10)
				);

			$results
				.children('li')
				.mouseover(function() {

					//Firefoxでは、候補一覧の上にマウスカーソルが乗っていると
					//うまくスクロールしない。そのための対策。イベント中断。
					if (key_select) {
						key_select = false;
						return;
					}

					$results.children('li').removeClass(options.select_class);
					$(this).addClass(options.select_class);
				})
				.mousedown(function(e) {
					reserve_click = true;

					//消去予約タイマーを中止
					clearTimeout(timer_show_hide);
					//ev.stopPropagation();
				})
				.mouseup(function(e) {
					reserve_click = false;

					//Firefoxでは、候補一覧の上にマウスカーソルが乗っていると
					//うまくスクロールしない。そのための対策。イベント中断。
					if (key_select) {
						key_select = false;
						return;
					}
					e.preventDefault();
					e.stopPropagation();
					selectCurrentResult(false);
				});
		}

		//**********************************************
		//現在選択中の候補を取得
		//**********************************************
		// @return object current_result 現在選択中の候補のオブジェクト(<li>要素)
		function getCurrentResult() {

			if (!$results.is(':visible')) return false;

			var $current_result = $results.children('li.' + options.select_class);

			if (!$current_result.length) $current_result = false;

			return $current_result;
		}
		//**********************************************
		//現在選択中の候補に決定する
		//**********************************************
		function selectCurrentResult(type) {

			var $current_result = getCurrentResult();
			if ($current_result) {
				$(input_obj).val($current_result.text());
				hideResult();

				//added
				prev_value = $(input_obj).val();
			}
			$(input_obj).focus();  //テキストボックスにフォーカスを移す
			$(input_obj).trigger(options.bind_to, type); //候補選択を引き金に、イベントを発火する
		}
		//**********************************************
		//選択候補を次に移す
		//**********************************************
		function nextResult() {
			var $current_result = getCurrentResult();

			if ($current_result) {
				$current_result
					.removeClass(options.select_class)
					.next()
						.addClass(options.select_class);
			}else{
				$results.children('li:first-child').addClass(options.select_class);
			}
			//テキストボックスの値を変更
			//候補リストからボックスへ戻るなら、元々の値を表示
			is_select = true;
			if($current_result && $current_result.is('li:last-child')){
				$(input_obj).val(user_value);
			}else{
				var selected = $results.children('.'+options.select_class).text();
				$(input_obj).val(selected);
			}
		}
		//**********************************************
		//選択候補を前に移す
		//**********************************************
		function prevResult() {
			var $current_result = getCurrentResult();

			if ($current_result) {
				$current_result
					.removeClass(options.select_class)
					.prev()
						.addClass(options.select_class);
			}else{
				$results.children('li:last-child').addClass(options.select_class);
			}
			//テキストボックスの値を変更
			//候補リストからボックスへ戻るなら、元々の値を表示
			is_select = true;
			if($current_result && $current_result.is('li:first-child')){
				$(input_obj).val(user_value);
			}else{
				var selected = $results.children('.'+options.select_class).text();
				$(input_obj).val(selected);
			}
		}
		//**********************************************
		//候補エリアを消去
		//**********************************************
		function hideResult() {
			$results.hide();

			//Ajax通信をキャンセル
			abortAjax();
		}
	};
	//================================================================================
	// 06. 処理の始まり
	//--------------------------------------------------------------------------------
	$.fn.ajaxSuggest = function(source, options) {
		if (!source) return;

		//************************************************************
		//オプション
		//************************************************************
		options = $.extend({
			//基本設定
			source   : source,
			database : 0,      //接続するDBの設定(配列の番号)
			and_or   : 'AND',   //AND検索か、OR検索か?
			limit    : 10,     //候補リストとして表示する最大件数
			order_by : 'ASC',  //ORDER BY(SQL) で、並ベ替えるのは昇順か降順か
			bind_to  : 'ajaxSuggest_selected', //候補が選択されたときに発火するイベント名
			results_class : 'as_results',      //候補一覧を囲む<ul>
			select_class  : 'as_over'          //選択中の<li>
		}, options);
		
		//orderが渡されていない場合は、fieldを格納する
		for(var i=0; i<options.database.length; i++){ 
			if(options.database[i].order === undefined){
				options.database[i].order = options.database[i].field;
			}
		}

		this.each(function() {
			new $.ajaxSuggest(this, source, options);
		});
		return this;
	};
})(jQuery);
