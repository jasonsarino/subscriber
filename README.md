# Subscriber Features
This code show you how to create a subscriber function in php and mysql.

### First create a table
```
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date_subscribe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```
Note: Set id field as primary key and auto increment

### Forms
We need to create forms to input the name and email elements.
Copy the code below and save as index.html or index.php
```
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
```

### CSS (custom.css)
Also we need to make the form more attractive to the users.
```
body{
	background: #EEE;
	font-family: Arial;
}
.container{
	width: 360px;
	border:1px solid #FFF;
	background: #FFF;
	margin-left: auto;
	margin-right: auto;
	margin-top: 100px;
	padding: 40px;
	-webkit-box-shadow:0 0 80px #CCC; 
	-moz-box-shadow: 0 0 80px #CCC; 
	box-shadow:0 0 80px #CCC;
}

.input-icon { position: relative; }
.input-icon input { text-indent: 30px;}
.input-icon .fa-name { 
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 15px;
}

.header{
	font-size: 18px;
	text-align: center;
	font-weight: bold;
	margin-bottom: 40px;
}

.form-input{
	display: block;
	margin-top: 20px;
	width: 100%;
	font-size: 14px;
	height: 50px;
	border-radius: 10px;
	border:1px solid #ededed;
	background: #ededed;
}

#btn-subscriber{
	background: url("../images/subscribe_btn.png") no-repeat scroll 0 0 transparent;
	  color: #000000;
	  cursor: pointer;
	  font-weight: bold;
	  height: 52px;
	  width: 150px;
	  border: none;
	  margin-top: 20px;
}

.alert {
	border-radius: .25rem;
	border: 1px solid transparent;
	margin-bottom: 1rem;
	padding: .75rem 1.25rem;
}
.alert-success{
	background-color: #dff0d8;
	border-color: #d0e9c6;
	color: #3c763d;
}

.alert-danger{
	background-color: #f2dede;
	border-color: #ebcccc;
	color: #a94442;
}

.alert-info{
	background-color: #d9edf7;
	border-color: #bcdff1;
	color: #31708f;
}
```

### JS (custom.js)
After we design and make style the form, we need to add interaction when the form subscriber is submitted. This will submit the form and an message will show to users if there data are submitted or not.
```
$('#form-subscribe').on('submit', function(e){
	e.preventDefault();
	var formdata = $(this).serialize();
	var url = $(this).attr("action");
	$.ajax(url, {
        method: "POST",
        dataType: "JSON",
        data: formdata,
        beforeSend: function(){
        	$('#msg').html("<div class='alert alert-info'>Please wait...</div>");
        }
    }).done(function (result) {
        if(result.success){
            $('#msg').html("<div class='alert alert-success'>" + result.message + "</div>");
            $('#form-subscribe')[0].reset();
        }else {
            $('#msg').html("<div class='alert alert-danger'>" + result.message + "</div>");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        $('#msg').html("<div class='alert alert-danger'>An unexpected error occured</div>");
    });
});
```

### Setup Database Connection (database.class.php)
To make the subscriber feature interact to database, we need to make a connection in our database. We will use mysqli comnponents as more security to sql injections with adding prepared statements.
```
<?php 
DEFINE('HOSTNAME',      'localhost');
DEFINE('USERNAME',      'root');
DEFINE('PASSWORD',      '');
DEFINE('DATABASE',      'subscribers');

class Database{ 

    public $db; 

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
```

### Data Submission (submit.php)
When the subscriber form is submitted it will redirect to submit.php or whatever you want filename. 
```
<?php 
require_once 'class/subscriber.class.php';
$subscriber = new Subscriber();

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');

$subscriber->setName($name);
$subscriber->setEmail($email);
$result = $subscriber->save_subscriber();
echo json_encode($result);
```


### Data Insertion and Validation (subscriber.class.php)
Now we need to catch and save the data from the form and do some validation and the most important is avoiding of sql injection. By using prepared statement we can avoid sql injections.
```
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
            $data['message'] = "Hi ".$this->name."<br />Thank you for submitting your information.";
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
```

## And Now we have complete and secure subsciber features for our websites.
