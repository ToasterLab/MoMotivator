<?php
	function die_with_error($msg)
	{
		$_SESSION["error"]=$msg;
		header("Location: index.php");
	}
	function do_sqli($link,$sql)
	{
		$res=mysqli_query($link,$sql);
		if (mysqli_error($link))
		{
			die_with_error("Error: ".mysqli_error($link));
		}
		return $res;
	}
	//echo "Helloooo";
	require_once("api/db_conn.php");
	//echo "Helloooo";
	session_start();
	//echo "Helloooo";
	if (!isset($_SESSION["email"]) || !isset($_SESSION["pass"]))
	{
		die_with_error("Unauthorised Access");
	}
	
	//Provide Username, Password
	$email=$_SESSION["email"];
	$pass=$_SESSION["pass"];
	//echo "User: ".$email.",Pass: ".$pass."<br/>";
	//Login Command
	$login=false;
	$sql="select * from mo_users where email=\"".$email."\" AND pass=\"".$pass."\";";
	$res=do_sqli($mysqli,$sql);
	while ($r=mysqli_fetch_array($res))
	{
		//echo "Login!!!";
		$login=true;
	}
	//Gimme Command
	if (!$login)
	{
		$_SESSION["error"]="Unauthorised Access";
		header("Location: index.php");
	}
?>