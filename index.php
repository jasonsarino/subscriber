<html>
<head>
	<title>Test</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="css/custom.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
	<div class="header">Suscribe to our Newsletter</div>
	<div id="msg"></div>
	<form method="post" id="form-subscribe" action="submit.php">
	<div class="input-icon">
		<span class="fa-name"><img src="images/user_icon.png"></span>
		<input type="text" name="name" placeholder="Name" class="form-input" required autocomplete="off">
	</div>
	<div class="input-icon">
		<span class="fa-name"><img src="images/mail_icon.png"></span>
		<input type="email" name="email" placeholder="Email" class="form-input" required autocomplete="off">
	</div>
	<input type="submit" id="btn-subscriber" value="">
	</form>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>