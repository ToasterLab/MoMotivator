<?php
	require_once '../connect.php';
	require_once '../user.php';
	require_once '../question.php';
	require_once 'checkIfAjax.php';
	
	session_start();
	
	$registeremail = $_POST['register_email'];
	$registerpassword = $_POST['register_password'];
	$registername = $_POST['register_name'];

	if(!isset($registeremail) || empty($registeremail) || strlen($registeremail)>100 || strlen($registeremail)<3){
		die("Invalid email address");
	}
	if(!isset($registerpassword) || empty($registerpassword) || strlen($registerpassword)>100 || strlen($registerpassword)<3){
		die("Invalid password");
	}
	if(!isset($registername) || empty($registername) || strlen($registername)>100 || strlen($registername)<3){
		die("Invalid name");
	}

	$email = htmlentities($link->real_escape_string($registeremail));
	$randomString = bin2hex(openssl_random_pseudo_bytes(22));
	$password = $link->real_escape_string($registerpassword);
	$password = crypt($password, "$2y$05$".$randomString."$");
	$name = htmlentities($link->real_escape_string($registername));

	$newVictim = new User();
	$register = $newVictim->register($name,$email,$password,$link);
	if($register === "User Already Exists"){
	
		//user already exists
		echo 'User Already Exists';
		
	} else {
		//Great Success! yet another victim to be upgraded
		$_SESSION["user_id"] = $newVictim->id;
		echo 'Great Success';
	}
?>