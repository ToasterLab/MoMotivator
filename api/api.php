<?php
	function die_with_error($msg)
	{
		die($msg);
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
	require_once("db_conn.php");
	session_start();
	if (!isset($_POST["email"]) || !isset($_POST["pass"]) || !isset($_POST["comm"]))
	{
		//echo "email:".$_POST["email"]." pass: ".$_POST["pass"]." comm: ".$_POST["comm"]."<br/>";
		die_with_error("Incomplete API Information");
	}
	//Provide Username, Password
	$email=mysqli_real_escape_string($mysqli,$_POST["email"]);
	$pass=mysqli_real_escape_string($mysqli,$_POST["pass"]);
	//echo "email: ".$email." pass: ".$pass."<br/>";
	//Login Command
	$login=false;
	$sql="select * from mo_users where email=\"".$email."\" AND pass=\"".$pass."\";";
	//echo $sql."<br/>";
	$res=do_sqli($mysqli,$sql);
	while ($r=mysqli_fetch_array($res))
	{
		//echo var_dump($r);
		$login=true;
		$_SESSION["email"]=$email;
		$_SESSION["pass"]=$pass;
		$_SESSION["userid"]=$r[0];
		$_SESSION["name"]=$r[1];
		$user_id=$r[0];
		$lvl=$r[4];
		$exp=$r[5];
	}
	//Gimme Command
	$comm=$_POST["comm"];
	if ($comm=="login")
	{
		//Check for login success
		if ($login)
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
			case "reg":
				//Try to register
				if (!isset($_POST["name"])){die_with_error("Incomplete Registration Information");}
				//Insert hash here
				$hash_pw=$pass;
				$sql="insert into mo_users(name,email,pass,level,experience) values('".$_POST["name"]."','".$email."','".$pass."','1','0');";
				do_sqli($mysqli,$sql);
				//Login
				$sql="select * from mo_users where email=\"".$email."\" AND pass=\"".$pass."\";";
				//echo $sql."<br/>";
				$res=do_sqli($mysqli,$sql);
				while ($r=mysqli_fetch_array($res))
				{
					echo var_dump($r);
					$_SESSION["email"]=$email;
					$_SESSION["pass"]=$pass;
					$_SESSION["userid"]=$r[0];
					$_SESSION["name"]=$r[1];
					$user_id=$r[0];
					$lvl=$r[4];
					$exp=$r[5];
				}
				$listname="General";
				$sql="insert into mo_lists(name,user_id) values('".$listname."','".$user_id."');";
				do_sqli($mysqli,$sql);
				$listname="Completed";
				$sql="insert into mo_lists(name,user_id) values('".$listname."','".$user_id."');";
				do_sqli($mysqli,$sql);
				//Redirect
				$_SESSION["error"]="Registration Successful";
				header("Location: http://guanqun.cep12y3.riicc.sg/Mo/home.php");
			break;
			case "g_level":
				echo $lvl;
			break;
			case "g_exp":
				echo $exp;
			break;
			case "u_exp":
				$sql="update mo_users set experience='".$_POST["exp"]."' where id='".$_POST["userid"]."';";
				do_sqli($mysqli,$sql);
			break;
			case "a_lists":
				if (!isset($_POST["userid"]) || !isset($_POST["listname"])){die_with_error("Incomplete Information");};
				//Try to add
				$sql="insert into mo_lists(name,user_id) values('".$_POST["listname"]."','".$_POST["userid"]."');";
				do_sqli($mysqli,$sql);
				$sql="select * from mo_lists where name='".$_POST["listname"]."' AND user_id='".$_POST["userid"]."';";
				//echo $sql."\n";
				$res=do_sqli($mysqli,$sql);
				while ($r=mysqli_fetch_array($res))
				{
					echo $r[0];
				}
			break;
			case "g_lists":
				//Find the lists in $list
				if (!isset($_POST["userid"])){die_with_error("Incomplete Information");};
				$sql="select * from mo_lists;";
				$res=do_sqli($mysqli,$sql);
				$cnt=0;
				while ($r=mysqli_fetch_array($res))
				{
					if ($r[1]==$_POST["userid"])
					{
						if ($cnt==0)
						{
							echo "<script>fir=".$r[0].";$(\"#list\"+fir).click();</script><a href=\"javascript:\" class=\"list-group-item active\" id=\"list".$r[0]."\" onclick=\"load_task(".$r[0].",'".$r[2]."')\">".$r[2]."<span class=\"pull-right\">"; if ($r[2]!="Completed"){echo "<i class=\"fa fa-trash-o\" onclick=\"del_list(".$r[0].")\"></i>";} echo "</span></a>";
							$cnt=1;
						}
						else if ($r[2]=="Completed")
						{
							echo "<a href=\"javascript:\" class=\"list-group-item\" id=\"list".$r[0]."\" onclick=\"load_task(".$r[0].",'".$r[2]."')\">".$r[2]."</a><script>completed_id=".$r[0]."; </script>";
						}
						else
						{
							echo "<a href=\"javascript:\" class=\"list-group-item\" id=\"list".$r[0]."\" onclick=\"load_task(".$r[0].",'".$r[2]."')\">".$r[2]."<span class=\"pull-right\"><i class=\"fa fa-trash-o\" onclick=\"del_list(".$r[0].")\"></i></span></a>";
						}
					}
				}
			break;
			case "u_lists":
				if (!isset($_POST["listid"]) || !isset($_POST["listname"])){die_with_error("Incomplete Update Information");}
				$sql="update mo_lists set name='".$_POST["listname"]."' where id='".$_POST["listid"]."';";
				do_sqli($mysqli,$sql);
			break;
			case "d_lists":
				//Delete List itself
				$sql="delete from mo_lists where id='".$_POST["listid"]."';";
				//echo $sql."<br/>";
				do_sqli($mysqli,$sql);
				//Delete List Children
				$sql="delete from mo_tasks where list_id='".$_POST["listid"]."';";
				//echo $sql."<br/>";
				do_sqli($mysqli,$sql);
			break;
			case "a_tasks":
					$taskname=mysqli_real_escape_string($mysqli,$_POST["taskname"]);
					$listid=mysqli_real_escape_string($mysqli,$_POST["taskid"]);
					//echo $_POST["timestamp"];
					if (isset($_POST["timestamp"]))
					{
						$duedate=mysqli_real_escape_string($mysqli,$_POST["timestamp"]);
						$sql="insert into mo_tasks(list_id,name,duedate) values('".$listid."','".$taskname."','".$duedate."');";
					}
					else
					{
						$sql="insert into mo_tasks(list_id,name) values('".$listid."','".$taskname."');";
					}
					do_sqli($mysqli,$sql);
					$sql="select * from mo_tasks where name='".$taskname."' AND list_id='".$listid."';";
					$res=do_sqli($mysqli,$sql);
					while ($r=mysqli_fetch_array($res))
					{
						echo $r[0];
					}
				break;
				case "g_tasks":
					$anger=0;
					$cnt=0;
					//Find the lists in $list
					$listid=mysqli_real_escape_string($mysqli,$_POST["listid"]);
					$completeid=mysqli_real_escape_string($mysqli,$_POST["completeid"]);
					if (!isset($listid)){die_with_error("Incomplete Information");};
					$sql="select * from mo_tasks where list_id='".$listid."';";
					//echo $sql."<br/>";
					$res=do_sqli($mysqli,$sql);
					//echo mysqli_num_rows($res)." rows<br/>";
					while ($r=mysqli_fetch_array($res))
					{
						echo "<tr id='task".$r[0]."'>";
						if ($listid==$completeid)
						{
							echo "<td><i class=\"fa fa-check-square-o checkTask\" onclick='checkTask(".$r[0].")'></i></td>";
						}
						else
						{
							echo "<td><i class=\"fa fa-square-o checkTask\" onclick='checkTask(".$r[0].")'></i></td>";
						}
						echo "<td>".$r[2]."</td>
							<td class=\"dueData\">";
						$dt1=new DateTime($r[3]);
						$dt1=date_timestamp_get($dt1);
						$dt2=time();
						if ($dt1!=-62170008925)
						{
							$dt1=$dt1-$dt2;
							$day_left=floor($dt1/(60*60*24));
							$anger+=max(0,(3-$day_left)*25);
							$cnt+=1;
							if ($listid==$completeid)
							{
								echo -$day_left;
								echo " Days Ago";
							}
							else
							{
								echo (floor($dt1/(60*60*24)));
								echo " Days Left";
							}
						}
						else
						{
						}
						echo "</td>
						</tr>";
					}
					$mood=0;
					$anger=floor($anger/$cnt);
					$anger=min(100,$anger);
					if ($listid==$completeid)
					{
						$anger=0;
					}
					if ($anger<=30){$mood=1;}
					else if ($anger<=70){$mood=2;}
					else if ($anger<=100){$mood=3;}
					echo "<script> anger=".$anger."; mood=".$mood.";update_mood();</script>";
					//return $list;
				break;
				case "u_tasks":
					$listid=mysqli_real_escape_string($mysqli,$_POST["taskid"]);
					$listname=mysqli_real_escape_string($mysqli,$_POST["taskname"]);
					if (!isset($listid) || !isset($listname)){die_with_error("Incomplete Update Information");}
					$sql="update mo_tasks set name='".$listname."' where id='".$listid."';";
					do_sqli($mysqli,$sql);
				break;
				case "d_tasks":
					$listid=mysqli_real_escape_string($mysqli,$_POST["taskid"]);
					$completeid=mysqli_real_escape_string($mysqli,$_POST["completeid"]);
					$sql="select * from mo_tasks where id='".$listid."';";
					$res=do_sqli($mysqli,$sql);
					$formerlist=0;
					while ($r=mysqli_fetch_array($res))
					{
						$formerlist=$r[1];
						$form=$r[4];
					}
					if ($formerlist!=$completeid)
					{
						//Update Task
						$sql="update mo_tasks set former_id='".$formerlist."',list_id='".$completeid."' where id='".$listid."';";
						echo $sql."<br/>";
						do_sqli($mysqli,$sql);
					}
					else
					{
						$sql="update mo_tasks set former_id='".$completeid."',list_id='".$form."' where id='".$listid."';";
						do_sqli($mysqli,$sql);
					}
				break;
				case "g_leaderboard":
					$anger=0;
					$cnt=0;
					//Find the lists in $list
					$sql="select * from mo_users order by experience desc limit 30;";
					//echo $sql."<br/>";
					$res=do_sqli($mysqli,$sql);
					//echo mysqli_num_rows($res)." rows<br/>";
					echo "<tr><th>Rank</th><th>Name</th><th>Experience</th></tr>";
					$cnt=1;
					while ($r=mysqli_fetch_array($res))
					{
						echo "<tr><td>";
						echo $cnt;
						echo "</td><td>".$r[1]."</td><td>".$r[5]."</td></tr>";
						$cnt+=1;
					}
					//return $list;
				break;
				case "g_search":
					$anger=0;
					$cnt=0;
					//Find the lists in $list
					$completeid=mysqli_real_escape_string($mysqli,$_POST["completeid"]);
					$searchstr=mysqli_real_escape_string($mysqli,$_POST["searchstr"]);
					if (!isset($completeid) || !isset($searchstr)){die_with_error("Incomplete Information");};
					$sql="select * from mo_tasks where name like'%".$searchstr."%';";
					//echo $sql."<br/>";
					$res=do_sqli($mysqli,$sql);
					//echo mysqli_num_rows($res)." rows<br/>";
					while ($r=mysqli_fetch_array($res))
					{
						echo "<tr id='task".$r[0]."'>";
						if ($listid==$completeid)
						{
							echo "<td><i class=\"fa fa-check-square-o checkTask\" onclick='checkTask(".$r[0].")'></i></td>";
						}
						else
						{
							echo "<td><i class=\"fa fa-square-o checkTask\" onclick='checkTask(".$r[0].")'></i></td>";
						}
						echo "<td>".$r[2]."</td>
							<td class=\"dueData\">";
						$dt1=new DateTime($r[3]);
						$dt1=date_timestamp_get($dt1);
						$dt2=time();
						if ($dt1!=-62170008925)
						{
							$dt1=$dt1-$dt2;
							$day_left=floor($dt1/(60*60*24));
							$anger+=max(0,(3-$day_left)*25);
							$cnt+=1;
							if ($listid==$completeid)
							{
								echo -$day_left;
								echo " Days Ago";
							}
							else
							{
								echo (floor($dt1/(60*60*24)));
								echo " Days Left";
							}
						}
						else
						{
						}
						echo "</td>
						</tr>";
					}
					//return $list;
				break;
		}
	}
?>