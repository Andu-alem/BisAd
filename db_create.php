<?php
	//database connection mysqli_connect(server,username,password,databasename)
	$cnct = mysqli_connect('localhost','root','');

	if(mysqli_connect_errno($cnct)){
  		echo "Failed to connect".mysqli_connect_error();
	}
	echo "connected success";

	$sql = "CREATE DATABASE BisAdWeb";
	$cre_qry = mysqli_query($cnct,$sql);
	if(mysqli_connect_errno($cre_qry)){
  		echo "Failed to connect".mysqli_connect_error();
	}
	echo "created success";

	mysqli_select_db($cnct,'BisAdDb');


	function checkError($msg){
		if(mysqli_connect_errno($msg)){
  			echo "Failed to connect".mysqli_connect_error();
		}	
	}
	

	//creating admin users table
	$table_admin = "CREATE TABLE user(
			u_id INT NOT NULL AUTO_INCREMENT, 
			u_name VARCHAR(50) NOT NULL, 
			phone VARCHAR(50) NOT NULL, 
			email VARCHAR(50) NOT NULL, 
			password VARCHAR(150) NOT NULL, 
			primary key(u_id), 
			UNIQUE(email))";
	$table_admin_qry = mysqli_query($cnct,$table_admin);
	//checkError($table_vote_qry);
	if(mysqli_connect_errno($table_admin_qry)){
  		echo "Failed to connect".mysqli_connect_error();
	}

	//creating business category
	$table_cat = "CREATE TABLE businesscategory(
			cat_id INT NOT NULL AUTO_INCREMENT,
			cat_name VARCHAR(50) NOT NULL,
			primary key(cat_id))";
	$table_cat_qry = mysqli_query($cnct,$table_cat);
	checkError($table_cat_qry);

	//creating business table
	$table_business = "CREATE TABLE business(
			b_id INT NOT NULL AUTO_INCREMENT, 
			b_name VARCHAR(300) NOT NULL, 
			admin INT NOT NULL, 
			cat_id INT NOT NULL, 
			firm_kind INT NOT NULL, 
			primary key(b_id), 
			FOREIGN KEY(admin) REFERENCES user(u_id), 
			FOREIGN KEY(cat_id) REFERENCES businesscategory(cat_id))";
	$table_b_qry = mysqli_query($cnct,$table_business);
	checkError($table_b_qry);
	echo "table created success";


	//creating address table
	$table_address = "CREATE TABLE location(
			l_id INT NOT NULL AUTO_INCREMENT, 
			b_id INT NOT NULL, 
			region VARCHAR(50) NOT NULL, 
			city VARCHAR(30) NOT NULL, 
			subcity VARCHAR(50) NOT NULL, 
			additional_detail VARCHAR(100) NOT NULL, 
			primary key(l_id), 
			FOREIGN KEY(b_id) REFERENCES business(b_id))";
	$table_adr_qry = mysqli_query($cnct,$table_address);
	checkError($table_adr_qry);


	//creating institution kind table
	$table_inst = "CREATE TABLE institution(
			i_id INT NOT NULL AUTO_INCREMENT, 
			inst_kind VARCHAR(50) NOT NULL, 
			primary key(i_id))";
	$table_inst_qry = mysqli_query($cnct,$table_inst);
	checkError($table_inst_qry);


	//creating geolocation table 
	$table_geol = "CREATE TABLE coordinate(
			latitude VARCHAR(20) NOT NULL, 
			loc_id INT NOT NULL, 
			longtude VARCHAR(20) NOT NULL)";
	$table_geol_qry = mysqli_query($cnct,$table_geol);
	checkError($table_geol_qry);


	//creating an image table
	$table_pics = "CREATE TABLE image(
			img_id INT NOT NULL AUTO_INCREMENT, 
			b_id INT NOT NULL, 
			img_name VARCHAR(200) NOT NULL, 
			primary key(img_id), 
			FOREIGN KEY (b_id) REFERENCES business(b_id))";
	$table_pics_qry = mysqli_query($cnct,$table_pics);
	checkError($table_pics_qry);


	//creating profile table
	$table_pro = "CREATE TABLE profile(
			b_id INT NOT NULL, 
			img_id INT NOT NULL, 
			profile_text VARCHAR(1000) NOT NULL, 
			FOREIGN KEY (b_id) REFERENCES business(b_id))";
	$table_pro_qry = mysqli_query($cnct,$table_pro);
	checkError($table_pro_qry);


	//creating posts table
	$table_post = "CREATE TABLE post(
			p_id INT NOT NULL AUTO_INCREMENT, 
			post_text VARCHAR(1000) NOT NULL, 
			b_id INT NOT NULL, 
			post_date INT NOT NULL, 
			primary key(p_id), 
			FOREIGN KEY (b_id) REFERENCES business(b_id))";
	$table_post_qry = mysqli_query($cnct,$table_post);
	checkError($table_post_qry);

	$table_post_img = "CREATE TABLE post_img(
			postimg_id INT NOT NULL AUTO_INCREMENT, 
			business_id INT NOT NULL, 
			post_id INT NOT NULL, 
			img_id INT NOT NULL, 
			primary key(postimg_id), 
			FOREIGN KEY (business_id) REFERENCES business(b_id), 
			FOREIGN KEY (img_id) REFERENCES image(img_id), 
			FOREIGN KEY (post_id) REFERENCES post(p_id))";
	$table_postimg_qry = mysqli_query($cnct,$table_post_img);
	checkError($table_postimg_qry);

	mysqli_close($cnct);
?>