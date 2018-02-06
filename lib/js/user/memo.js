/* ----------------------------------------
グローバル変数宣言
---------------------------------------- */
//memoオブジェクトを格納する配列memoList
var memoList = [];

//上から数えて何番目のmemoオブジェクトなのかを表す変数num（0スタート）
var num;

//memoオブジェクトがいくつあるのかを表す変数countNum
var countNum;

//配列memoListの何番目のmemoオブジェクトなのかを表す変数indexNum(０スタート)
var indexNum;



/* ----------------------------------------
 関数定義
---------------------------------------- */
// 1桁の数字を0埋めで2桁にする
var toDoubleDigits = function(digitNum) {
  digitNum += "";
  if (digitNum.length === 1) {
    digitNum = "0" + digitNum;
  }
  return digitNum;     
};

// ローカルストレージに保存する
var saveToLS = function(){
  //配列memoListを文字列memoStrに変換
  var memoStr = JSON.stringify(memoList);

  //ローカルストレージのKey"memo"にvalue"memoStr"をセッティング
  window.localStorage.setItem('memo',memoStr);
};



/* ----------------------------------------
DOMが読み込まれたら実行
---------------------------------------- */
$(function(){
  
  /* ----------------------------------------
  配列memoListを表示
  ---------------------------------------- */
  //ローカルストレージに保存されているkey"memo"（文字列情報）を変数memoStrに格納
  var memoStr = window.localStorage.getItem('memo');

  //ローカルストレージに一つでも情報が格納されている場合
  if(memoStr !== null){	

    //文字列memoStrを配列memoListに変換
    memoList = JSON.parse(memoStr);
  }

  //memoオブジェクトの個数だけfor文で回す　新しいものが上にくるように降順で表示
  for(var i = memoList.length - 1; i >= 0 ; i--){

    //i番目のmemoオブジェクのプロバティを変数に格納
    var category = memoList[i].category;
    var title = memoList[i].title;
    var editDay = memoList[i].editDay;
    var comment = memoList[i].comment;

    //textareaの改行反映
    var commentBr = comment;
    commentBr = commentBr.split("<").join("&lt;");
    commentBr = commentBr.split(">").join("&gt;");
    commentBr = commentBr.split("\n").join("<br>");
    
    //カテゴリ名書換
    var categoryName;
    if( category === 'btn1' ){
      categoryName = 'HTML';
    }
    else if( category === 'btn2' ){
      categoryName = 'CSS';
    }
    else if( category === 'btn3' ){
      categoryName = 'JavaScript';
    }
    else if( category === 'btn4' ){
      categoryName = 'jQuery';
    }
    else if( category === 'btn5' ){
      categoryName = 'React';
    }
    else if( category === 'btn6' ){
      categoryName = 'Angular';
    }
    else if( category === 'btn7' ){
      categoryName = 'PHP';
    }
    else if( category === 'btn8' ){
      categoryName = 'Laravel';
    }
    else if( category === 'btn9' ){
      categoryName = 'My SQL';
    }
    else if( category === 'btn10' ){
      categoryName = 'Ruby';
    }
    else if( category === 'btn11' ){
      categoryName = 'Ruby on Rails';
    }
    else if( category === 'btn12' ){
      categoryName = 'Other';
    };

    //memoのヘッダー
    var CATEGORYICON = '<span class="categoryIcon ' + category + '">' + categoryName + '</span>';
    var MEMOTITLE = '<span class="memoTitle">' + title + '&thinsp;</span>';
    var DAYTIME = '<span class="dayTime">' + editDay + '</span>';
    var ARROW = '<span class="st-arrow">Open or Close</span>';
    //memoヘッダーまとめ
    var memoHeader = CATEGORYICON + MEMOTITLE + DAYTIME + ARROW;

    //memoのコンテンツ
    var EDITDELETE = '<div class="editDelete f-right"><a href="#modal"><img src="lib/img/icon_edit.png" width="32px" height="32px" alt="編集" class="edit-btn mr20 op-05"></a><a href="javascript:void(0);"><img src="lib/img/icon_delete.png" width="32px" height="32px" alt="削除" class="delete-btn op-05"></a></div>';
    var MEMOCOMMENT = '<div class="clear"><p class="memoComment">' + commentBr + '&thinsp;</p></div>';
    //memoコンテンツまとめ
    var memoContents = EDITDELETE + MEMOCOMMENT;

    //タグ追加
    $('<li class="memo-item mb20 bg-f bs-bbox pl15 pr15 br-4 bs-4 '+ categoryName +'"><a href="javascript:void(0);">' + memoHeader + '</a><div class="st-content">' + memoContents + '</div></li>').appendTo('.memo-list').find('.categoryIcon').addClass(category);

  };
	
	
	
  /* ----------------------------------------
  ロゴ(all-btn) or カテゴリボタン が押されたら
  ---------------------------------------- */
  $('.all-btn, .btn1, .btn2, .btn3, .btn4, .btn5, .btn6, .btn7, .btn8, .btn9, .btn10, .btn11, .btn12').on('click',function(){

    //value属性値を取得し、変数targetに代入
    var target = $(this).attr('value');
    //value属性値確認
    console.log(target);

    //各memoオブジェクトに対してフィルターをかける
    $('.memo-item').each(function(){

      $(this).animate({'opacity':0},50,function(){

        //いったん全てを非表示にする
        $(this).hide();

        //条件が合うもののみを再表示
        if( $(this).hasClass(target) || target == "all"){
          $(this).show().animate({'opacity':1}, 500);
        }

      });

    });

  });
	
	
	
  /* ----------------------------------------
  「MyMemo内を検索する」に文字が入力されたら
  ---------------------------------------- */
  $('.search').on('change keyup',function(){

    //検索フォームに入力された文字を変数keywordに代入
    var keyword = $('.search').val();
    //検索ワード確認
    console.log(keyword);

    //各memoオブジェクトに対してフィルターをかける
    $('.memo-item').each(function(){

      //いったん全てを非表示にする
      $(this).hide();

      //条件が合うもののみを再表示
      if( $(this).find(".memoTitle").text().match(keyword) || $(this).find(".memoComment").text().match(keyword) ){
          $(this).show().animate({'opacity':1}, 500);
      }

    });

  });

	
	
  /* ----------------------------------------
  「新規作成」ボタンが押されたら
  ---------------------------------------- */
  $('.new-btn').on('click',function(){

    //入力フォームに残っているデータを空にする
    $('.input-category').val('btn1');
    $('.input-title').val('');
    $('.input-comment').val('');

    //「保存して閉じる」ボタン → 表示
    $('.save-btn').css('display','block');
    //「更新して閉じる」ボタン → 非表示
    $('.update-btn').css('display','none');

  });
	
	
	
  /* ----------------------------------------
  「保存して閉じる」ボタンが押されたら
  ---------------------------------------- */
  $('.save-btn').on('click',function(){
    
    //入力された値を取得
    var category = $('.input-category').val();
    console.log('categoryは' + category);
    var title = $('.input-title').val();
    console.log('titleは' + title);
    var comment = $('.input-comment').val();
    console.log('commentは' + comment);
    
    //入力された日時を取得
    var now = new Date();
    var year = now.getFullYear();
    var month = toDoubleDigits( now.getMonth()+1 );
    var date = toDoubleDigits( now.getDate() );
    var dayNames = [
      '(日)',
      '(月)',
      '(火)',
      '(水)',
      '(木)',
      '(金)',
      '(土)'
    ];
    var day = now.getDay();
    var dayName = dayNames[day];
    var hour = toDoubleDigits( now.getHours() );
    var min = toDoubleDigits( now.getMinutes() );
    var editDay = year + '年' + month + '月' + date + '日' + dayName + hour + ':' + min;		
    console.log('editDayは' + editDay);
    
    //textareaの改行反映
    var commentBr = comment;
    commentBr = commentBr.split("<").join("&lt;");
    commentBr = commentBr.split(">").join("&gt;");
    commentBr = commentBr.split("\n").join("<br>");
    console.log('commentBrは' + commentBr);
    
    //カテゴリ名書換
    var categoryName;
    if( category === 'btn1' ){
      categoryName = 'HTML';
    }
    else if( category === 'btn2' ){
      categoryName = 'CSS';
    }
    else if( category === 'btn3' ){
      categoryName = 'JavaScript';
    }
    else if( category === 'btn4' ){
      categoryName = 'jQuery';
    }
    else if( category === 'btn5' ){
        categoryName = 'React';
    }
    else if( category === 'btn6' ){
      categoryName = 'Node.js';
    }
    else if( category === 'btn7' ){
      categoryName = 'PHP';
    }
    else if( category === 'btn8' ){
      categoryName = 'Laravel';
    }
    else if( category === 'btn9' ){
      categoryName = 'My SQL';
    }
    else if( category === 'btn10' ){
      categoryName = 'Ruby';
    }
    else if( category === 'btn11' ){
      categoryName = 'Ruby on Rails';
    }
    else if( category === 'btn12' ){
      categoryName = 'Other';
    };
    console.log('categoryNameは' + categoryName);
		
    //memoのヘッダー
    var CATEGORYICON = '<span class="categoryIcon ' + category + '">' + categoryName + '</span>';
    var MEMOTITLE = '<span class="memoTitle">' + title + '&thinsp;</span>';
    var DAYTIME = '<span class="dayTime">' + editDay + '</span>';
    var ARROW = '<span class="st-arrow">Open or Close</span>';
    //memoヘッダーまとめ
    var memoHeader = CATEGORYICON + MEMOTITLE + DAYTIME + ARROW;
			
    //memoのコンテンツ
    var EDITDELETE = '<div class="editDelete f-right"><a href="#modal"><img src="lib/img/icon_edit.png" width="32px" height="32px" alt="編集" class="edit-btn mr20 op-05"></a><a href="javascript:void(0);"><img src="lib/img/icon_delete.png" width="32px" height="32px" alt="削除" class="delete-btn op-05"></a></div>';
    var MEMOCOMMENT = '<div class="clear"><p class="memoComment">' + commentBr + '&thinsp;</p></div>';
    //memoコンテンツまとめ
    var memoContents = EDITDELETE + MEMOCOMMENT;

    //ひとかたまりのメモデータをオブジェクト"memo"に格納
    var memo = {
      category : category,
      title : title,
      editDay : editDay,
      comment : comment
    };
		
    //"memo"を配列memoListの末尾に追加
    memoList.push(memo);
		
    //更新された配列memoListをローカルストレージに保存
    saveToLS();
    
    //タグ追加
    $('.memo-list').prepend('<li class="memo-item mb20 bg-f bs-bbox pl15 pr15 br-4 bs-4 ' + categoryName + '"><a href="javascript:void(0);">' + memoHeader + ' </a><div class="st-content">' + memoContents + '</div></li>'); 
    
    //アコーディオンで開けるようにする
    $('#st-accordion').accordion();
    
  });
  
	
	
  /* ----------------------------------------
  「編集」ボタンが押されたら
  ---------------------------------------- */
  $('.memo-list').on('click', '.edit-btn',function(){

    //「保存して閉じる」ボタン → 非表示
    $('.save-btn').css('display','none');
    //「更新して閉じる」ボタン → 表示
    $('.update-btn').css('display','block');

    //表示上、上から何番目のmemoオブジェクトか取得(０スタート)
    num = $('.memo-list .memo-item .edit-btn').index(this);
    console.log('numは' + num);
    //memoオブジェクがいくつあるかカウント
    countNum = $('.memo-item').length;
    console.log('countNumは' + countNum);
    //配列memoList的には何番目のmemoオブジェクトか取得(０スタート)
    indexNum = countNum - num - 1;
    console.log('indexNumは' + indexNum );

    //配列memoListの中から該当するmemoオブジェクトを取得し、変数memoに格納
    var memo = memoList[indexNum];
    //当該memoオブジェクトのプロパティのパラメーターを変数に格納
    var category = memo.category;
    var title = memo.title;
    var comment = memo.comment;
    
    //既に保存されていた内容を入力フォームに反映
    $('.input-category').val(category);
    $('.input-title').val(title);
    $('.input-comment').val(comment);
    console.log('commentは' + comment);
  });
	
	
	
  /* ----------------------------------------
  「更新して閉じる」ボタンが押されたら
  ---------------------------------------- */
  $('.update-btn').on('click',function(){
    
    //いったんカテゴリのクラスを削除
    $('.memo-item').eq(num).find('.categoryIcon').removeClass('btn1 btn2 btn3 btn4 btn5 btn6 btn7 btn8 btn9 btn10 btn11 btn12');

    //入力フォームに入力された値を取得
    var category = $('.input-category').val();
    console.log('categoryは' + category);
    var title = $('.input-title').val();
    console.log('titleは' + title);
    var comment = $('.input-comment').val();
    console.log('commentは' + comment);

    //入力された日時を取得
    var now = new Date();
    var year = now.getFullYear();
    var month = toDoubleDigits( now.getMonth()+1 );
    var date = toDoubleDigits( now.getDate() );
    var dayNames = [
      '(日)',
      '(月)',
      '(火)',
      '(水)',
      '(木)',
      '(金)',
      '(土)'
    ];
    var day = now.getDay();
    var dayName = dayNames[day];
    var hour = toDoubleDigits( now.getHours() );
    var min = toDoubleDigits( now.getMinutes() );
    var editDay = year + '年' + month + '月' + date + '日' + dayName + hour + ':' + min;		
    console.log('editDayは' + editDay);
    
    //textareaの改行反映
    var commentBr = comment;
    commentBr = commentBr.split("<").join("&lt;");
    commentBr = commentBr.split(">").join("&gt;");
    commentBr = commentBr.split("\n").join("<br>");
    console.log('commentBrは' + commentBr);
		
    //カテゴリ名書換
    var categoryName;
    if( category === 'btn1' ){
      categoryName = 'HTML';
    }
    else if( category === 'btn2' ){
      categoryName = 'CSS';
    }
    else if( category === 'btn3' ){
      categoryName = 'JavaScript';
    }
    else if( category === 'btn4' ){
      categoryName = 'jQuery';
    }
    else if( category === 'btn5' ){
      categoryName = 'React';
    }
    else if( category === 'btn6' ){
      categoryName = 'Node.js';
    }
    else if( category === 'btn7' ){
      categoryName = 'PHP';
    }
    else if( category === 'btn8' ){
      categoryName = 'Laravel';
    }
    else if( category === 'btn9' ){
      categoryName = 'My SQL';
    }
    else if( category === 'btn10' ){
      categoryName = 'Ruby';
    }
    else if( category === 'btn11' ){
      categoryName = 'Ruby on Rails';
    }
    else if( category === 'btn12' ){
      categoryName = 'Other';
    };
    console.log('categoryNameは' + categoryName);

    //配列memoListのindexNum番目に値をセット
    memoList[indexNum] = {
      category : category,
      title : title,
      editDay : editDay,
      comment : comment
    }
    
    //更新されたindexNum番目のmemoオブジェクトを変数new_memoに格納
    var new_memo = memoList[indexNum];
		
    //new_memoを配列memoListの末尾に追加
    memoList.push(new_memo);
    
    //編集前の元々あったmemoオブジェクトは削除
    memoList.splice(indexNum,1);
    
    //indexNumを無効な値にする
    indexNum = -1;
    
    //更新された配列memoListをローカルストレージに保存
    saveToLS();

    //更新された直を該当箇所にセット
    $('.memo-item').eq(num).find('.categoryIcon').addClass(category).text(categoryName);
    $('.memo-item').eq(num).find('.memoTitle').text(title);
    $('.memo-item').eq(num).find('.dayTime').text(editDay);
    $('.memo-item').eq(num).find('.memoComment').html(commentBr);
    
    //更新されたmemoオブジェクを一番上に表示
    var c = $('.memo-item').eq(num)
    var All = c.prevAll();
    if(All.length > 0) {
      var top = $(All[All.length - 1]);
      var p = $(All[0]);
      var Up = c.prop('offsetTop') - top.prop('offsetTop');
      var Down = (c.offset().top + c.outerHeight()) - (p.offset().top + p.outerHeight());
      c.css('position', 'relative');
      All.css('position', 'relative');
      c.animate({'top': -Up});
      All.animate({'top': Down}, {complete: function() {
        c.parent().prepend(c);
        c.css({'position': 'static', 'top': 0});
        All.css({'position': 'static', 'top': 0}); 
      }});
    }
  
    //0.5秒後にリロード
    setTimeout(function(){
        location.reload();
    },500);
		
  });
  
  
	
  /* ----------------------------------------
  「削除」ボタンが押されたら
  ---------------------------------------- */
  $('.memo-list').on('click', '.delete-btn',function(){
		
    //上から何番目のmemoオブジェクトか取得(０スタート)
    num = $('.memo-list .memo-item .delete-btn').index(this);
    console.log('numは' + num);
    //memoオブジェクがいくつあるかカウント
    countNum = $('.memo-item').length;
    console.log('countNumは' + countNum);
    //配列memoListの何番目のmemoオブジェクトか取得(０スタート)
    indexNum = countNum - num - 1;
    console.log('indexNumは' + indexNum);
		
    //numが-1の場合にはreturn以下の処理を無視
    if(indexNum === -1){
      return;
    }
    
    //該当の表示されているmemoオブジェクトをフェードアウト
    $(this).closest('.memo-item').fadeOut(500,function(){
      $(this).remove();
    });

    //当該memoオブジェクトを配列memoListから削除
    memoList.splice(indexNum,1); 
    
    //更新された配列memoListをローカルストレージに保存
    saveToLS();
    
    //indexNumを無効な値にする
    indexNum = -1;
     
  });
	
});