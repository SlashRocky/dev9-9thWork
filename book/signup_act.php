<?php
  //セッション開始
  session_start();

  //関数定義ファイル読み込み
  include("../include/functions.php");

  //DB CONNECTION関数実行
  $pdo = dbConnection();

  //POST送信されたログインIdを$loginIdに格納
  $name = $_SESSION['name'];
  $loginId = $_SESSION['loginId'];
  $loginPw = $_SESSION['loginPw'];
  $manage_flag = $_SESSION['manage_flag'];
  $life_flag = $_SESSION['life_flag'];

  //SQL文　life_flg=0→在籍者　life_flg=1→退会者
  $sql = 'SELECT * FROM user_table WHERE loginId=:loginId AND loginPw=:loginPw AND life_flag=0';

  //prepareメソッドでセット
  $stmt = $pdo -> prepare($sql);

  //bindValue
  $stmt -> bindValue(':loginId', $loginId, PDO::PARAM_STR);
  $stmt -> bindValue(':loginPw', $loginPw, PDO::PARAM_STR);

  //実行
  $flag = $stmt -> execute();

  //SQL実行時にエラーがあれば
  if($flag == false){

    //SQL ERROR関数実行
    queryError($stmt);

  }
  //SQL実行時にエラーがなければ
  else{
    //1レコードだけ取得
    $row = $stmt -> fetch(); 

    //該当レコードがあれば
    if( $row["id"] != "" ){

      //セッションIdをセッション変数に渡す
      $_SESSION["chk_ssid"] = session_id();

      //book_tableのuserId = user_tableのid
      $_SESSION["userId"] = $row['id'];

      //データベースの値をセッション変数に渡す
      $_SESSION["name"] = $row['name'];
      $_SESSION["manage_flag"] = $row['manage_flag'];
      $_SESSION["life_flag"] = $row['life_flag'];

      //一覧画面にリダイレクト
      if($row['manage_flag'] == 1){

        //もし管理者ならユーザーを管理できるリンクのあるページに飛ばす
        header('Location: input_data_manage.php');

      }
      else{

        //それ以外だったら普通のページに飛ばす
        header('Location: input_data.php');

      }
    }
    //該当レコードがなければ
    else{
      //login画面へ
      header('Location: login.php');
    }
  }
  exit();
?>