<?php
require_once 'class/user.class.php';
$user = new User();

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$user->setName($name);
$user->setEmail($email);
$user->setPassword($password);

$result = $user->save_user();
echo json_encode($result);
?>
