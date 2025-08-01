<html>
<head>
	<title>Sign Up</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="css/custom.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
	<div class="header">Sign Up</div>
	<div id="msg"></div>
	<form method="post" id="form-signup" action="handle_signup.php">
	<div class="input-icon">
		<span class="fa-name"><img src="images/user_icon.png"></span>
		<input type="text" name="name" placeholder="Name" class="form-input" required autocomplete="off">
	</div>
	<div class="input-icon">
		<span class="fa-name"><img src="images/mail_icon.png"></span>
		<input type="email" name="email" placeholder="Email" class="form-input" required autocomplete="off">
	</div>
    <div class="input-icon">
		<span class="fa-name"><img src="images/user_icon.png"></span>
		<input type="password" name="password" placeholder="Password" class="form-input" required autocomplete="off">
	</div>
	<input type="submit" id="btn-signup" value="Sign Up">
	</form>
    <div class="form-footer">
        <a href="login.php">Already have an account? Login</a> | <a href="index.php">Home</a>
    </div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
