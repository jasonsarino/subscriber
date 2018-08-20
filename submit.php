<?php 
require_once 'class/subscriber.class.php';
$subscriber = new Subscriber();

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');

$subscriber->setName($name);
$subscriber->setEmail($email);
$result = $subscriber->save_subscriber();
echo json_encode($result);