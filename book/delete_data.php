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

  //bindValue
  $stmt -> bindValue(":userId", $userId, PDO::PARAM_STR);
  $stmt -> bindValue(":bookId", $bookId, PDO::PARAM_STR);

  //実行
  $flag = $stmt -> execute();
  
  //実行が失敗したら
  if($flag == false){

    //queryError関数実行
    queryError($stmt);

  }
  //実行が成功したら
  else {

    //ユーザーの一覧画面に戻す
    header("Location: output_data.php");
    exit();
    
  }



?>