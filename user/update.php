<?php
	//セッション開始
	session_start();

	//関数定義ファイル読み込み
	include("../include/functions.php");

  //入力チェック(受信確認処理追加)
  if(
    !isset($_POST["id"]) || $_POST["id"]=="" ||
		!isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["loginId"]) || $_POST["loginId"]=="" ||
    !isset($_POST["loginPw"]) || $_POST["loginPw"]=="" ||
		!isset($_POST["manage_flag"]) || $_POST["manage_flag"]=="" ||
		!isset($_POST["life_flag"]) || $_POST["life_flag"]==""
    ){
    exit('ParamError');
  }

  //POST送信されたデータの取得
  $id = $_POST["id"];
	$name   = $_POST["name"];
  $loginId = $_POST["loginId"];
  $loginPw = $_POST["loginPw"];
	$manage_flag  = $_POST["manage_flag"];
	$life_flag = $_POST["life_flag"];

	//DB CONNECTION関数実行
	$pdo = dbConnection();

  //実行SQL文
	$sql = 'UPDATE user_table SET name=:name, loginId=:loginId, loginPw=:loginPw, manage_flag=:manage_flag, life_flag=:life_flag WHERE id='.$id;

	//prepareメソッドでセット
  $stmt = $pdo -> prepare($sql);

	//bindValue
	$stmt -> bindValue(':name', $name, PDO::PARAM_STR);
  $stmt -> bindValue(':loginId', $loginId, PDO::PARAM_STR);
  $stmt -> bindValue(':loginPw', $loginPw, PDO::PARAM_STR);
	$stmt -> bindValue(':manage_flag', $manage_flag, PDO::PARAM_STR);
	$stmt -> bindValue(':life_flag', $life_flag, PDO::PARAM_STR);

	//実行
  $flag = $stmt -> execute();

 //実行が失敗なら
  if($flag == false){
		
		//SQL ERROR関数実行
		queryError($stmt);
		
  }
	//実行が成功なら
  else{
		
    //変更内容を反映したうえでユーザー一覧画面に戻す
    header("Location: select.php");
    exit();
		
  }
?>
