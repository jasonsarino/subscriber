<html>
<head>
	<title>Login</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="css/custom.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
	<div class="header">Login</div>
	<div id="msg"></div>
	<form method="post" id="form-login" action="handle_login.php">
	<div class="input-icon">
		<span class="fa-name"><img src="images/mail_icon.png"></span>
		<input type="email" name="email" placeholder="Email" class="form-input" required autocomplete="off">
	</div>
    <div class="input-icon">
		<span class="fa-name"><img src="images/user_icon.png"></span>
		<input type="password" name="password" placeholder="Password" class="form-input" required autocomplete="off">
	</div>
	<input type="submit" id="btn-login" value="Login">
	</form>
    <div class="form-footer">
        <a href="signup.php">Don't have an account? Sign Up</a> | <a href="index.php">Home</a>
    </div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
