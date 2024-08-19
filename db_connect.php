<?php
	//database connection mysqli_connect(server,username,password,databasename)
	global $cnct;

	$cnct = mysqli_connect('localhost','root','','BisAdDb');
	
	/*function connectionError($errno, $errstr){
		include 'db_create.php';
	}
	set_error_handler('connectionError');
	//$cnct = mysqli_connect('localhost','root','','BisAdWeb');*/
	if(mysqli_connect_errno($cnct)){
  		echo "Failed to connect".mysqli_connect_error();
	}else{
		// echo "connected success";
	}
?>
