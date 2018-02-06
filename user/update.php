<?php

  //入力チェック(受信確認処理追加)
  if(
    !isset($_POST["id"]) || $_POST["id"]=="" ||
    !isset($_POST["loginId"]) || $_POST["loginId"]=="" ||
    !isset($_POST["loginPw"]) || $_POST["loginPw"]=="" ||
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["email"]) || $_POST["email"]=="" ||
    !isset($_POST["naiyou"]) || $_POST["naiyou"]==""
    ){
    exit('ParamError');
  }

  //1. POSTデータ取得
  $id = $_POST["id"];
  $loginId = $_POST["loginId"];
  $loginPw = $_POST["loginPw"];
  $name   = $_POST["name"];
  $email  = $_POST["email"];
  $naiyou = $_POST["naiyou"];

  //2. DB接続します(エラー処理追加)
  try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  }
  catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }

  //３．データ登録SQL作成
  $sql = 'UPDATE gs_user_table SET loginId=:loginId, loginPw=:loginPw, name=:name, email=:email, naiyou=:naiyou WHERE id=:id';
  $stmt = $pdo -> prepare($sql);
  $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
  $stmt -> bindValue(':loginId', $loginId, PDO::PARAM_INT);
  $stmt -> bindValue(':loginPw', $loginPw, PDO::PARAM_INT);
  $stmt -> bindValue(':name', $name, PDO::PARAM_STR);
  $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
  $stmt -> bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
  $flag = $stmt -> execute();

  //４．データ登録処理後
  if($flag==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }
  else{
    //５．select.phpへリダイレクト
    header("Location: select.php");
    exit;
  }
?>
