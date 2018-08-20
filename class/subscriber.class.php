<?php 
require 'database.class.php'; 

class Subscriber extends Database{ 

    private $name, $email;

    function __construct()
    { 
        parent::__construct();
    } 

    public function save_subscriber()
    {
        $query = "INSERT INTO `subscribers`(`name` , `email`) VALUES(?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $this->name, $this->email);
        $success = $stmt->execute();
        if($success) {
            $data['success'] = TRUE;
            $data['message'] = "Hi ".$this->name."!<br />Thank you for submitting your information.";
        } else if ($stmt->errno) {
            $data['success'] = FALSE;
            $data['message'] = $stmt->error;
        }
        return $data;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
     

}