<?php
	//セッション開始
	session_start();

	//関数定義ファイル読み込み
	include("../include/functions.php");

	//エラーメッセージの初期化
	$errMsg = '';

	//登録完了メッセージの初期化
	$signUpMsg = '';

	$signup = isset($_POST['signup']) ? $_POST['signup'] : '' ;

	//SIGNUPボタンが押された場合
	if($signup){
		
		/* ログインIDの入力チェック
		------------------------------ */
		//値が空の時
		if( empty($_POST['name']) ){
			$errMsg = '名前が未入力です。';
		}
		if( empty($_POST['loginId']) ){
			$errMsg = 'ログインIDが未入力です。';
		}
		else if( empty($_POST['loginPw']) ){
			$errMsg = 'ログインパスワードが未入力です。';
		}
		else if( empty($_POST['loginPw2']) ){
			$errMsg = 'パスワードが未入力です。';
		}
		
		//全部正確に入力されているなら
		if (!empty($_POST["name"]) && !empty($_POST["loginId"]) && !empty($_POST["loginPw"]) && !empty($_POST["loginPw2"]) && $_POST["loginPw"] === $_POST["loginPw2"]){
			
			//DB CONNECTION関数実行
			$pdo = dbConnection();
			
			//入力されたloginIdとloginPwを変数に格納
			$name = $_POST['name'];
			$loginId = $_POST['loginId'];
			$loginPw = $_POST['loginPw'];
			$manage_flag = 0;
			$life_flag = 0;
			
			//実行したいSQL文
			$sql = "INSERT INTO user_table (id, name, loginId, loginPw, regiDate, manage_flag, life_flag) VALUES (NULL, ?, ?, ?, sysdate(), ?, ?)";
				
			//prepareメソッドにセット
			$stmt = $pdo -> prepare($sql);

			//実行
			//$flag = $stmt -> execute( array( $name, $loginId, password_hash($loginPw, PASSWORD_DEFAULT), $manage_flag, $life_flag ) );
			$flag = $stmt -> execute( array( $name, $loginId, $loginPw, $manage_flag, $life_flag ) );
			
			// ログイン時に使用するIDとパスワード
			//$signUpMsg = '登録が完了しました。';
			
			//セッション変数に渡す
			$_SESSION['name'] = $name;
			
			header('Location: input_data.php');
			exit();
		}
		//入力内容に誤りがあるなら
		else if( $_POST["loginPw"] != $_POST["loginPw2"] ){
			$errMsg = 'パスワードに誤りがあります。';
		}
	}
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Create an account | BookMark</title>
		<link href="../lib/css/book/signup.css" rel="stylesheet">
		<link rel="stylesheet" href="../lib/css/book/remodal.css">
		<link rel="stylesheet" href="../lib/css/book/remodal-default-theme.css">
		<style>
			.remodal-bg.with-red-theme.remodal-is-opening,
			.remodal-bg.with-red-theme.remodal-is-opened {
				filter: none;
			}

			.remodal-overlay.with-red-theme {
				background-color: #f44336;
			}

			.remodal.with-red-theme {
				background: #fff;
			}
		</style>
		<script src="../lib/js/jquery-3.2.0.min.js"></script>
	</head>
	<body>
		<div class="form-wrapper">
			<h1>Create an Account</h1>
			
			<form method="post" action="signup.php" name="form2">
				<div><font color="#ff0000"><?php echo xss($errMsg); ?></font></div>
				<div><font color="#0000ff"><?php echo xss($signUpMsg); ?></font></div>
				<div class="form-item">
					<label for="name"></label>
					<input type="text" name="name" id="name"　required="required" placeholder="Name">
				</div>
				<div class="form-item">
					<label for="loginId"></label>
					<input type="text" name="loginId" id="loginId"　required="required" placeholder="Login ID">
				</div>
				<div class="form-item">
					<label for="loginPw"></label>
					<input type="password" name="loginPw" id="loginPw" required="required" placeholder="Login Password">
				</div>
				<div class="form-item">
					<label for="loginPw2"></label>
					<input type="password" name="loginPw2" id="loginPw2" required="required" placeholder="Login Password（For confirmation）">
				</div>
				<div class="button-panel">
					<input type="submit" class="button" title="signup" value="Create" name="signup">
				</div>
			</form>
<!--
			<form id="loginForm" name="loginForm" action="" method="POST">
				<fieldset>
					<div><font color="#ff0000"><?php //echo xss($errMsg); ?></font></div>
					<div><font color="#0000ff"><?php //echo xss($signUpMsg); ?></font></div>
					<label for="loginId">ログインID</label><input type="text" id="loginId" name="username" placeholder="ログインIDを入力" value="<?php if (!empty($_POST["loginId"])) {echo xss($_POST["loginId"]);} ?>">
					<br>
					<label for="loginPw">ログインパスワード</label><input type="password" id="loginPw" name="loginPw" value="" placeholder="ログインパスワードを入力">
					<br>
					<label for="loginPw2">ログインパスワード(確認用)</label><input type="password" id="loginPw2" name="loginPw2" value="" placeholder="再度ログインパスワードを入力">
					<br>
					<input type="submit" id="signUp" name="signUp" value="新規登録">
				</fieldset>
			</form>
-->
			
			
			
<!--
			<form action="login.php">
				<div class="button-panel">
					<input type="submit" class="button" value="戻る">
				</div>
			</form>
-->
			
<!--
			<div class="form-footer">
					<p><a href="login.php">ログインページへ戻る</a></p>
			</div>
-->
			
		</div>
		
		<script src="../lib/js/book/remodal.js"></script>
		<!-- Events -->
		<script>
			$(document).on('opening', '.remodal', function () {
				console.log('opening');
			});

			$(document).on('opened', '.remodal', function () {
				console.log('opened');
			});

			$(document).on('closing', '.remodal', function (e) {
				console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
			});

			$(document).on('closed', '.remodal', function (e) {
				console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
			});

			$(document).on('confirmation', '.remodal', function () {
				console.log('confirmation');
			});

			$(document).on('cancellation', '.remodal', function () {
				console.log('cancellation');
			});

			//  Usage:
			//  $(function() {
			//
			//    // In this case the initialization function returns the already created instance
			//    var inst = $('[data-remodal-id=modal]').remodal();
			//
			//    inst.open();
			//    inst.close();
			//    inst.getState();
			//    inst.destroy();
			//  });

			//  The second way to initialize:
			$('[data-remodal-id=modal2]').remodal({
				modifier: 'with-red-theme'
			});
		</script>
		
	</body>
</html>