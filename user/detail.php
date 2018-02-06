<?php
  //GET送信されたidを取得(URLの後ろについてるデータ)
  $id = $_GET["id"];
  echo $id;

	//関数定義ファイル読み込み
	include("../include/functions.php");

	//DB CONNECTION関数実行
	$pdo = dbConnection();

  //実行SQL文
  $sql = 'SELECT * FROM user_table WHERE id=:id';

  //prepareメソッド生成
  $stmt = $pdo -> prepare($sql);

  //bindValue
  $stmt -> bindValue(":id", $id, PDO::PARAM_INT);

  //実行
  $flag = $stmt -> execute();

  //３．データ表示
  if($flag == false){

		//SQL ERROR関数実行
		queryError($stmt);

  }
  else{
		//一行だけ取り出す
    $result = $stmt -> fetch();

    //実行SQL文
    $sql = 'SELECT * FROM book_table WHERE userId = :userId';

    //prepareメソッドにセット
    $stmt = $pdo -> prepare($sql);
    
    //bindValue ※ book_tableのuser_id = user_tableのid 
    $stmt -> bindValue(':userId', $id, PDO::PARAM_STR);

    //実行
    $flag = $stmt -> execute();
		
		//生成したいタグ
		$view = "";
		
		//その人が登録してあるだけの書籍データ取得
    while( $result2 = $stmt -> fetch(PDO::FETCH_ASSOC) ){
			
			$view .= '<li>';
				$view .= '<div class="list_t">';
					$view .= '<h3 class="title"><?php echo'.$result2['title'].'; ?></h3>';
					$view .= '<p class="text"><?php echo'. $result2['comment'].'; ?></p>';
				$view .= '</div>';
				$view .= '<div class="list_img">';
					$view .= '<img src="<?php echo'.$result2['url'].'; ?>">';
				$view .= ' </div>';
			$view .= ' </li>';
			
    }
  }
?>


<!doctype html>
<!--[if lt IE 7]><html lang="ja" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="ja" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="ja" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ja" prefix="og: http://ogp.me/ns#" class="no-js">
  <!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Book Mark LAB</title>

    <!-- mobile meta -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="lib/img/apple-touch-icon.png">
    <link rel="icon" href="lib/img/favicon.png">
    <!--[if IE]>
    <link rel="shortcut icon" href="/lib/img/favicon.ico">
    <![endif]-->
    <meta name="msapplication-TileColor" content="#f01d4f">
    <meta name="msapplication-TileImage" content="lib/img/win8-tile-icon.png">

    <!-- favicon -->
    <link rel="icon" type="image/vnd.microsoft.icon" href="lib/img/favicon.ico" />

    <!-- css -->
    <link rel="stylesheet" href="../lib/css/style.css">
    <link rel="stylesheet" href="../lib/css/user/memo.css">
		<link rel="stylesheet" href="../lib/css/book/book3.css">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- accordion CSS -->
    <noscript>
      <style>
        .st-accordion ul li{
          height:auto;
        }
        .st-accordion ul li > a span{
          visibility:hidden;
        }
      </style>
    </noscript>

    <!-- Google CDN jQuery with fallback to local -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
			window.jQuery || document.write('<script src="../lib/js/jquery-3.2.0.min"><\/script>')
    </script>

    <!-- ColumnScroller -->
    <script src="../lib/js/user/jquery-smartColumnScroller.js"></script>
    <script>
      $(window).load(function() {
        $('#header').smartColumnScroller();
      });
    </script>

    <!-- modal JS -->
    <script src="../lib/js/user/remodal.js"></script>
    <script>
      $(document).on('opening', '.remodal', function () {
          console.log('opening');
      });
      $(document).on('opened', '.remodal', function () {
          console.log('opened');
      });
      $(document).on('closing', '.remodal', function (e) {
          console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
      });
      $(document).on('closed', '.remodal', function (e) {
          console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
      });
      $(document).on('confirmation', '.remodal', function () {
          console.log('confirmation');
      });
      $(document).on('cancellation', '.remodal', function () {
          console.log('cancellation');
      });
      //  Usage:
      //  $(function() {
      //
      //    // In this case the initialization function returns the already created instance
      //    var inst = $('[data-remodal-id=modal]').remodal();
      //
      //    inst.open();
      //    inst.close();
      //    inst.getState();
      //    inst.destroy();
      //  });
      //  The second way to initialize:
      $('[data-remodal-id=modal2]').remodal({
          modifier: 'with-red-theme'
      });
    </script>

  </head>

  <body itemscope itemtype="http://schema.org/WebPage">
    <div id="container" class="remodal-bg p-relative">

      <!-- header -->
      <header id="header" class="bs-bbox w200 h100 bg-manageSide p-fixed top0 left0 o-scroll">
        <div id="header-inner"  class="">
          <h1 class="ta-center">
            <button class="all-btn color-f ff-roboto fs-caps fs-20 lh-03 c-pointer op-05 " value="all">
              BM USER
            </button>
          </h1>
          <a href="index.php" class="new-btn color-f fs-14 d-block ta-center w90 m-auto b-all-f pr20 pl20 pt10 pb10 br-4 bg-3 op-05 c-pointer">
            <i class="fa fa-plus color-f"></i>&emsp;ユーザー新規登録
          </a>
        </div>
      </header>

      <!-- contents -->
      <main id="main" class="w100 h100 bg-manage p-fixed top0 left200 o-scroll">
        <section id="main-inner" class="mr200 pt30 pb10">
          <div class="container">
            <div class="wrapper">

              <fieldset>
                <legend>USER情報</legend>
                <label>名前：<input type="text" name="name" value="<?=$result["name"]?>"></label><br>
                <label>ログインID：<input type="text" name="loginId" value="<?=$result["loginId"]?>"></label><br>
                <label>ログインパスワード：<input type="text" name="loginPw" value="<?=$result["loginPw"]?>"></label><br>
								<ul class="book-list">
									<?=$view?>
								</ul>
                <input type="submit" value="送信">
                <!-- 裏でidを渡す -->
                <input type="hidden" name="id" value="<?=$id?>">
              </fieldset>

            </div>
          </div>
        </section>
      </main>

    </div>

    <!-- memo JS -->
    <script src="../lib/js/user/memo.js"></script>

    <!-- Accordion JS -->
    <script src="../lib/js/user/jquery.accordion.js"></script>
    <script src="..lib/js/user/jquery.easing.1.3.js"></script>
    <script>
      $(function() {　
        $('#st-accordion').accordion();
        $('#st-accordion').$items.find('div.st-content').hide();
      });
    </script>

  </body>
</html>