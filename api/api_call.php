<?php
	function die_with_error($msg)
	{
		echo $msg;
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
	function api_call($mysqli,$arr)
	{
		session_start();
		//Login Command
		$email=$arr["email"];
		$pass=$arr["pass"];
		$arr["userid"]=$_SESSION["userid"];
		//echo "User: ".$email.",Pass: ".$pass."<br/>";
		//echo $email;
		//$login=false;
		$sql="select * from mo_users where email=\"".$email."\" AND pass=\"".$pass."\";";
		//echo "<br/>".$sql."<br/>";
		$res=do_sqli($mysqli,$sql);
		//echo var_dump($res);
		$login=0;
		//echo "Login: ".$login."<br/>";
		//echo "<br/>".mysqli_num_rows($res)." rows<br/>";
		while ($r=mysqli_fetch_array($res))
		{
			$login=1;
			$_SESSION["email"]=$email;
			$_SESSION["pass"]=$pass;
			$_SESSION["userid"]=$r[0];
			$_SESSION["name"]=$r[1];
			$user_id=$r[0];
			$lvl=$r[4];
			$exp=$r[5];
		}
		//echo "Login: ".$login."<br/>";
		$comm=$arr["comm"];
		if ($comm=="login")
		{
			//Check for login success
			if ($login==1)
			{
				//Success :D
				echo $user_id;
			}
			else
			{
				echo "-1";
			}
		}
		else
		{
			
			switch($comm)
			{
				case "auth":
					if ($login==0)
					{
						die("Unauthorised Access");
					}
				break;
				case "reg":
					//echo $comm." Registering\n";
					$name=$arr["name"];
					//Try to register
					if (!isset($name)){die_with_error("Incomplete Registration Information");}
					//Insert hash here
					$hash_pw=$pass;
					$sql="insert into mo_users(name,email,pass,level,experience) values('".$name."','".$email."','".$pass."','1','0');";
					do_sqli($mysqli,$sql);
				break;
				case "g_level":
					echo $lvl;
				break;
				case "g_exp":
					echo $exp;
				break;
				case "a_lists":
					$userid=$arr["userid"];
					$listname=$arr["listname"];
					if (!isset($userid) || !isset($listname)){die_with_error("Incomplete Information");};
					//Try to add
					$sql="insert into mo_lists(name,user_id) values('".$listname."','".$userid."');";
					do_sqli($mysqli,$sql);
					$sql="select * from mo_lists where name='".$listname."' AND user_id='".$userid."';";
					$res=do_sqli($mysqli,$sql);
					while ($r=mysqli_fetch_array($res))
					{
						echo $r[0];
					}
				break;
				case "g_lists":
					//Find the lists in $list
					$userid=$arr["userid"];
					if (!isset($userid)){die_with_error("Incomplete Information");};
					$cnt=0;
					$list=array();
					$sql="select * from mo_lists;";
					//echo $sql."<br/>";
					$res=do_sqli($mysqli,$sql);
					//echo mysqli_num_rows($res)." rows<br/>";
					while ($r=mysqli_fetch_array($res))
					{
						if ($r[1]==$userid)
						{
							$list[$cnt]=$r[0];
							$cnt+=1;
							$list[$cnt]=$r[2];
							$cnt+=1;
						}
					}
					return $list;
				break;
				case "u_lists":
					$listid=$arr["listid"];
					$listname=$arr["listname"];
					if (!isset($listid) || !isset($listname)){die_with_error("Incomplete Update Information");}
					$sql="update mo_lists set name='".$listname."' where id='".$listid."';";
					do_sqli($mysqli,$sql);
				break;
				case "d_lists":
					$listid=$arr["listid"];
					//Delete List itself
					$sql="delete from mo_lists where id='".$listid."';";
					do_sqli($mysqli,$sql);
					//Delete List Children
					$sql="delete from mo_tasks where list_id='".$listid."';";
					do_sqli($mysqli,$sql);
				break;
				case "a_tasks":
					$taskname=$arr["taskname"];
					$listid=$arr["taskid"];
					$sql="insert into mo_tasks(list_id,name) values('".$listid."','".$taskname."');";
					do_sqli($mysqli,$sql);
					$sql="select * from mo_tasks where name='".$taskname."' AND list_id='".$listid."';";
					$res=do_sqli($mysqli,$sql);
					while ($r=mysqli_fetch_array($res))
					{
						echo $r[0];
					}
				break;
				case "g_tasks":
					//Find the lists in $list
					$listid=$arr["taskid"];
					if (!isset($listid)){die_with_error("Incomplete Information");};
					$cnt=0;
					$list=array();
					$sql="select * from mo_tasks;";
					//echo $sql."<br/>";
					$res=do_sqli($mysqli,$sql);
					//echo mysqli_num_rows($res)." rows<br/>";
					while ($r=mysqli_fetch_array($res))
					{
						if ($r[1]==$userid)
						{
							$list[$cnt]=$r[0];
							$cnt+=1;
							$list[$cnt]=$r[2];
							$cnt+=1;
						}
					}
					return $list;
				break;
				case "u_tasks":
					$listid=$arr["taskid"];
					$listname=$arr["taskname"];
					if (!isset($listid) || !isset($listname)){die_with_error("Incomplete Update Information");}
					$sql="update mo_tasks set name='".$listname."' where id='".$listid."';";
					do_sqli($mysqli,$sql);
				break;
				case "d_tasks":
					$listid=$arr["taskid"];
					//Delete Task itself
					$sql="delete from mo_tasks where id='".$listid."';";
					do_sqli($mysqli,$sql);
				break;
			}
		}
	}
?>