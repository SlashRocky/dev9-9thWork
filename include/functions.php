<?php
  /* ----------------------------------------
  DB CONNECTION
  ---------------------------------------- */
  function dbConnection(){
    $dbname='work_db';
    try{
      $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
    } 
    catch(PDOException $e){
      exit('DbConnectError:'.$e->getMessage());
    }
    return $pdo;
  }

  /* ----------------------------------------
  SQL ERROR
  ---------------------------------------- */
  function queryError($stmt){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }

  /* ----------------------------------------
  vs XSS
  ---------------------------------------- */
  function xss($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
  }

  /* ----------------------------------------
  SESSION CHECK
  ---------------------------------------- */
  function chkSession(){
    if( !isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id() ){
      exit('Login...');
    }
    else{
      session_regenerate_id(true);
      $_SESSION['chk_ssid'] = session_id();
    }
  }
?>
