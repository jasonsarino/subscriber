<?php
require_once 'database.class.php';

class User extends Database {

    private $name, $email, $password;

    public function __construct() {
        parent::__construct();
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function save_user() {
        $query = "INSERT INTO `users`(`name`, `email`, `password`) VALUES(?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $this->name, $this->email, $this->password);
        $success = $stmt->execute();
        if ($success) {
            $data['success'] = TRUE;
            $data['message'] = "You have successfully registered.";
        } else if ($stmt->errno) {
            $data['success'] = FALSE;
            if ($stmt->errno == 1062) { // Duplicate entry
                $data['message'] = "The email address is already registered.";
            } else {
                $data['message'] = $stmt->error;
            }
        }
        return $data;
    }

    public function authenticate_user($email, $password) {
        $query = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $data['success'] = TRUE;
            } else {
                $data['success'] = FALSE;
                $data['message'] = "Invalid password.";
            }
        } else {
            $data['success'] = FALSE;
            $data['message'] = "No user found with this email.";
        }
        return $data;
    }
}
?>
