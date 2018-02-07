<?php
  //セッション開始
  session_start();

  //関数定義ファイル読み込み
  include("../include/functions.php");

  //セッション変数として渡されているuserIdを変数$userIdに格納
  $userId = $_SESSION['userId'];
  //セッション変数として渡されているbookIdを変数$bookIdに格納
  $bookId = $_SESSION['bookId'];

  //DB接続
  $pdo = db_con();

  //２．データ登録SQL作成
  $sql = 'DELETE FROM book_table WHERE userId=:userId AND bookId=:bokId';

  //prepareメソッドで定義
  $stmt = $pdo -> prepare($sql);

  //bindValueを
  $stmt -> bindValue(":userId", $userId, PDO::PARAM_STR);
  $stmt -> bindValue(":bookId", $bookId, PDO::PARAM_STR);

  //実行
  $flag = $stmt -> execute();

  //３．データ表示
  $view="";

  if($flag == false){

    error_db_Info($stmt);

  } 
  else {

    //Selectデータの数だけ自動でループしてくれる ->は中の〜関数を使うという意味 :〜はバインド関数

    //    while( $result = $stmt -> fetch(PDO::FETCH_ASSOC)){
    //      $view .= '<p>';
    //        $view .= '<a href="detail.php?id='.$result["id"].'">'; 
    //          $view .= $result["name"]."[".$result["indate"]."]";
    //        $view .= '</a>';
    //      $view .= '</p>';
    //    }

    //header ~ exitはワンセット
    header("Location: select.php");
    exit();
  }



?>