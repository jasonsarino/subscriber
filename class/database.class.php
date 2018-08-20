<?php 
DEFINE('HOSTNAME',      'localhost');
DEFINE('USERNAME',      'root');
DEFINE('PASSWORD',      '');
DEFINE('DATABASE',      'subscribers');

class Database{ 

    public $db; 

    /**
    * Connect to database
	* @param string HOSTNAME
    * @param string USERNAME
    * @param string PASSWORD
    * @param string DATABASE
    */ 	

    function __construct()
    { 
        try{ 
            $this->db = new Mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die("".mysqli_error()); 
            $this->db->set_charset("utf8mb4");  
            return $this->db; 
        }catch(exceptions $e){ 
            return $e; 
        } 

    } 
     

}