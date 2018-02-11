<?php
  //セッション開始
  session_start();

  //関数定義ファイル読み込み
  include("../include/functions.php");

  //入力チェック(受信確認処理追加)
  if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["loginId"]) || $_POST["loginId"]=="" ||
    !isset($_POST["loginPw"]) || $_POST["loginPw"]=="" ||
    !isset($_POST["manage_flag"]) || $_POST["manage_flag"]=="" ||
    !isset($_POST["life_flag"]) || $_POST["life_flag"]=="" ){
		
    exit('ParamError');
  }

  //POST送信されたデータの取得
  $name   = $_POST["name"];
  $loginId  = $_POST["loginId"];
  $loginPw  = $_POST["loginPw"];
  $manage_flag = $_POST["manage_flag"];
  $life_flag = $_POST["life_flag"];

  //DB CONNECTION関数実行
  $pdo = dbConnection();

  //実行SQL文
  $sql = "INSERT INTO user_table (id, name, loginId, loginPw, regiDate, manage_flag, life_flag) VALUES (NULL, :name, :loginId ,:loginPw, sysdate(), :manage_flag, :life_flag)";

  //３．データ登録SQL作成
	$stmt = $pdo -> prepare($sql);
  
  //bindValue
  $stmt -> bindValue(':name', $name, PDO::PARAM_STR);
  $stmt -> bindValue(':loginId', $loginId, PDO::PARAM_STR);
  $stmt -> bindValue(':loginPw', $loginPw, PDO::PARAM_STR);
  $stmt -> bindValue(':manage_flag', $manage_flag, PDO::PARAM_INT);
  $stmt -> bindValue(':life_flag', $life_flag, PDO::PARAM_INT);
  
  //実行
  $status = $stmt -> execute();

  //実行が失敗ならば
  if($status == false){
    
    //queryError関数実行
    queryError($stmt);
    
  }
	//実行が成功ならば
  else{
    header("Location: select.php");
    exit;
  }
?>
