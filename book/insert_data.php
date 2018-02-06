<?php 
  //セッションスタート開始
  session_start();

	//関数定義ファイル読み込み
	include("../include/functions.php");
	
  //book.jsのファイルでPOST送信されたデータの受け取り
  $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
  $bookId = isset($_POST['bookId']) ? $_POST['bookId'] : '';
  $title = isset($_POST['title']) ? $_POST['title'] : '';
  $url = isset($_POST['url']) ? $_POST['url'] : '';
  $comment = isset($_POST['comment']) ? $_POST['comment'] : '';

	//DB CONNECTION関数実行
	$pdo = dbConnection();

  //実行したいSQL文
  $sql = "INSERT INTO book_table (no, userId, bookId, title, url, comment, regiDate) VALUES ( NULL, :userId, :bookId, :title, :url, :comment, sysdate() )";

  //実行したいSQL文をセット
  $stmt = $pdo -> prepare($sql);

  //各パラメーターに保存したい値をセット
  $stmt -> bindValue(':userId', $userId, PDO::PARAM_STR);
  $stmt -> bindValue(':bookId', $bookId, PDO::PARAM_STR);
  $stmt -> bindValue(':title', $title, PDO::PARAM_STR);
  $stmt -> bindValue(':url', $url, PDO::PARAM_STR);
  $stmt -> bindValue(':comment', $comment, PDO::PARAM_STR);

  //実際に実行　→　それを変数$flagに格納
  $flag = $stmt -> execute();

  //失敗　→　エラーメッセージ表示
  if($flag == false){
		
		//SQL ERROR関数実行
		queryError($stmt);
		
  }

  //成功　→　output_data.phpにリダイレクト
  else{
    echo 1;
    //header('Location: output_data.php');
    //exit();
		
  }
?>
