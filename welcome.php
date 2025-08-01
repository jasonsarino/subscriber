<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<html>
<head>
	<title>Welcome</title>
	<link href="css/custom.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
	<div class="header">Welcome, <?php echo $_SESSION['user_name']; ?>!</div>
	<div class="content">
		<p>You have successfully logged in.</p>
		<a href="logout.php">Logout</a>
	</div>
</div>

</body>
</html>
