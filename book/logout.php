<?php
  //セッション開始
  session_start();

  //関数定義ファイル読み込み
  include("../include/functions.php");

  //ログインしてたならば
  if( isset($_SESSION['name']) ){
    $errMsg = "ログアウトしました。";
  }
  //そうでないなら
  else{
    $errMsg = "セッションがタイムアウトしました。";
  }

  //セッション変数を初期化する
  $_SESSION = array();

  //Cookieに保存してある"SessionIDの保存期間を過去にして破棄
  if ( isset($_COOKIE[session_name()]) ) { 
    setcookie(session_name(), '', time()-42000, '/');
  }

  //セッションIDの破棄
  session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>logOut | BookMark</title>
    <link href="../lib/css/book/login-logout.css" rel="stylesheet">
    <script src="js/jquery-3.2.0.min.js"></script>
  </head>
  <body>
    <div class="form-wrapper">
      <h1>LOG OUT</h1>
      <div class="form-footer">
        <p><?php echo xss($errMsg); ?></p>
        <p style="margin-top: 20px;"><a href="../index.php">トップページに戻る</a></p>
      </div>
    </div>
  </body>
</html>