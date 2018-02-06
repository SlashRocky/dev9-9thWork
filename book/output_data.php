<?php 
  //セッション開始
  session_start();

	//関数定義ファイル読み込み
	include("../include/functions.php");

  //セッション変数として渡されているuserIdを変数$userIdに格納
  $userId = $_SESSION['userId'];

	//DB CONNECTION関数実行
	$pdo = dbConnection();

  //実行したいSQL文を変数$aqlに格納
  $sql = 'SELECT * FROM book_table WHERE userId = :userId';

  //実行したいSQL文をセット
  $stmt = $pdo -> prepare($sql);
  $stmt -> bindValue(':userId', $userId, PDO::PARAM_STR);

  //実際に実行　→　それを変数$flagに格納
  $flag = $stmt -> execute();

  //失敗　→　エラーメッセージ表示
  if($flag == false){
    
		//SQL ERROR関数実行
		queryError($stmt);
		
  }
  //成功　→　以下のDOMを実行
  else{ 
?>
 
  <!DOCTYPE html>
  <html lang="ja">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="format-detection" content="telephone=no">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Book Memo</title>
      <link rel="stylesheet" href="../lib/css/book/icomoon/icomoon_style.css">
      <link rel="stylesheet" href="../lib/css/book/book2.css">
      <script src="../lib/js/jquery-3.2.0.min.js"></script>
      <script src="../lib/js/book/book.js"></script>
    </head>
    <body>
      <main class="wrap indexMain">
        <section class="memoList">
          <h2>登録された書籍</h2>
          <ul>
            <?php
              //実行して返ってきたデータを変数$resultに格納　書籍データの数だけwhileで回して表示
              while( $result = $stmt -> fetch(PDO::FETCH_ASSOC) ){
            ?>
              <li>
                <div class="list_t">
                  <h3 class="title"><?php echo $result['title']; ?></h3>
                  <p class="text"><?php echo $result['comment']; ?></p>
                </div>
                <div class="list_img">
                  <img src="<?php echo $result['url']; ?>">
                </div>
              </li>
            <?php
              }
            ?>
          </ul>
        </section>
        <p class="toTopWrapper"><a href="input_data.php" class="toTop">検索画面に戻る</a></p>
      </main>
    </body>
  </html>

<?php } ?>