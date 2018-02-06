<?php
	//セッション開始
  session_start();

	//関数定義ファイル読み込み
	include("../include/functions.php");

  //ログインしてなかったら
  if( !isset($_SESSION['name']) ){
		
		//logout.phpへリダイレクト
    header('Location: logout.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search | BookMark</title>
    <link rel="stylesheet" href="../lib/css/book/icomoon/icomoon_style.css">
		<link rel="stylesheet" href="../lib/css/book/book.css">
		<script src="../lib/js/jquery-3.2.0.min.js"></script>
		<script src="../lib/js/book/book.js"></script>
  </head>
  <body>
    <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']; ?>">
    <main class="wrap indexMain">
      <section class="searchTop on">
        <ul class="menu">
          <li class="menu1"><a href="logout.php">LOG OUT</a></li>
					<li class="menu2"><a href="output_data.php">登録書籍一覧</a></li>
					<li class="menu4"><a href="../user/select.php">ユーザー管理</a></li>
					<li class="menu3">ようこそ<u><?php echo xss($_SESSION['name']); ?></u>さん</li>
        </ul>
        <div class="inner">
          <h1>book!</h1>
          <p class="searchTop_icon"><span class="icon-book"></span></p>
          <p class="searchTop_catch">本を検索しよう！</p>
        </div>
      </section>
      <div class="searchBody on">
        <h2 class="searchBox titleBar">
          <div class="searchBox_text">
            <input type="text" class="searchBox_text_input">
          </div>
          <div id="search-btn" class="searchBox_text_btn">
            <span class="btn icon-search"></span>
          </div>
        </h2>
        <section class="searchResult">
          <div class="searchResult_head">
            <p class="searchResult_keyword"></p>
          </div>
          <div class="inner">
            <ul>
            
            </ul>
          </div>
        </section>
      </div>
    </main>
  </body>
</html>
