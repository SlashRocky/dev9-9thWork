<?php
	//セッション開始
	session_start();

	//関数定義ファイル読み込み
	include("../include/functions.php");

  $id = $_GET["id"];

	//DB CONNECTION関数実行
	$pdo = dbConnection();

  //実行SQL文
  $sql = 'DELETE FROM user_table WHERE id=:id';

	//prepare文にセット
  $stmt = $pdo -> prepare($sql);

  //bindValue
  $stmt -> bindValue(":id", $id, PDO::PARAM_INT);

  //実行
  $flag = $stmt -> execute();

  //生成したいタグ
  $view="";

	//実行が失敗なら
  if($flag == false){

		//SQL ERROR関数実行
		queryError($stmt);

  }
	//実行が成功なら
  else {

    //削除データを反映したうえで、ユーザー一覧画面に戻す
    header("Location: select.php");
    exit();
  }

?>