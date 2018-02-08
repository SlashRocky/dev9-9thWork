<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>logIn | BookMarkApp</title>
		<link href="../lib/css/book/login-logout.css" rel="stylesheet">
		<script src="../lib/js/jquery-3.2.0.min.js"></script>
	</head>
	<body>
		<div class="form-wrapper">
			<h1>LOG IN</h1>
			<form method="post" action="login_act.php" name="form1">
				<!--<p style="color:red;"><?php echo $errMsg;?></p>-->
				<div class="form-item">
					<label for="loginId"></label>
					<input type="text" name="loginId" id="loginId"　required="required" placeholder="Login ID">
				</div>
				<div class="form-item">
					<label for="loginPw"></label>
					<input type="password" name="loginPw" id="loginPw" required="required" placeholder="Login Password">
				</div>
				<div class="button-panel">
					<input type="submit" class="button" title="login" value="Log In" name="login">
				</div>
			</form>
			<div class="form-footer">
				<p><a href="signup.php">Create an account</a></p>
				<!--<p><a href="#">Forgot password?</a></p>-->
			</div>
		</div>
	</body>
</html>