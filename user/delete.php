<?php
  //index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）

  include("functions.php");

  $id = $_GET["id"];

  //1.  DB接続します
  $pdo = db_con();

  //２．データ登録SQL作成
  $sql = 'DELETE FROM gs_user_table WHERE id=:id';

  $stmt = $pdo -> prepare($sql);
  //ハッキングされないための関数 bindValueを通して無効化したものを入れる
  $stmt -> bindValue(":id", $id, PDO::PARAM_INT);

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