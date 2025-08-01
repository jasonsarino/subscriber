<?php
require_once 'class/user.class.php';
$user = new User();

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$result = $user->authenticate_user($email, $password);

if ($result['success']) {
    header('Location: welcome.php');
} else {
    echo json_encode($result);
}
?>
