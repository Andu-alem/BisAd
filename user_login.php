<?php 
	
	include 'db_connect.php';
	function user_login($cnct){
		if(!empty($_POST["email"]) && !empty($_POST["password"])){		
			$password = md5($_POST['password']);
			$email = $_POST["email"];
			$id_qry = "SELECT u_id FROM user WHERE email = '$email' AND password = '$password'";
			$count_qry = mysqli_query($cnct,$id_qry);
			$number_of_row = mysqli_num_rows($count_qry);
			if($number_of_row > 0){
				$u_id = mysqli_fetch_array($count_qry)[0];
				session_start();
				$_SESSION['user_id'] = $u_id;

				$b_id_qry = "SELECT b_id FROM business WHERE admin = '$u_id'";
				$bid_qry = mysqli_query($cnct,$b_id_qry);
				$number_of_bid_row = mysqli_num_rows($bid_qry);
				$b_id = mysqli_fetch_array($bid_qry);
				$_SESSION['business_id'] = $b_id[0];

				return true;
			} else {
				return false;
			}	
		} else{
			return false;
		}
	}
 ?>