<? 
	require_once "api/db_conn.php";
	require_once 'php.php';
	//echo "Hai";
	//echo "Bye";
	//require_once "authenticate.php";
	require_once "api/api_call.php";
	session_start();
	$arr=array(
		"email" => $_SESSION["email"],
		"pass" => $_SESSION["pass"],
		"userid" => $_SESSION["userid"],
		"name" => $_SESSION["name"]
	);
	$arr["comm"]="auth";
	api_call($mysqli,$arr);
?>
<html>
	<head>
		<title>Mo-The Motivator</title>
		<?=WEBSITE_STYLES?>
		<style>
			img.mo{
				width:100px;
				height:100px;
			}
			.leftBar{
				background-color:#eee;
				padding-left:5%;
				padding-right:5%;
			}
			.leftBar>h1{
				font-size:200% !important;
				margin-bottom:0;
				margin-top:35px;
			}
			hr:first-of-type{margin-top:10px;}
			p.lead{
				font-size:170%;
				font-family: HelveticaNeueBd;
				text-align:center;
				margin-bottom:10px;
			}
			.mood{
				font-size:130%;
				font-family:HelveticaNeue;
				text-align:center;
				margin-top:3%;
				margin-bottom:2%;
			}
			hr{height:2px;background-color:#B0B0B0;margin-top:10px;}
			.todo-lists{
				margin-top:2%;
				margin-bottom:0;
				font-family:HelveticaNeue;
				font-size:150%;
			}
			.todo-lists>a{padding: 5 10px;}
			.list-group-item>.pull-right>.fa-trash-o{font-size:150%;}
			.input-group:first-of-type{
				margin-top:20px;
				margin-bottom:10px;
				height:24px;
			}
			.progress{
				height:10px;
				width:90%;
				margin-left:5%;
				padding:0;
			}
			.progress-bar{margin:0;padding:0;}
			#createListField{margin-top:10px;margin-bottom:30px;}
			.list-name{margin-left:20px;font-family:Helveticaneue;margin-top:0px;}
			.taskTable{
				font-family:Helveticaneue;
				font-size:150%;
				text-align:center;
			}
			th{text-align:center;}
			.taskTable>tr>td>i{line-height:1.5 !important;}
			.taskTable>tbody>tr>td{text-align:left !important;}
			.checkTask{line-height:1.5 !important;}
			.rightBar{
				background-color:#eee;
				text-align:center;
			}
			.noTasks{text-align:center;margin-top:5%;}
			.moreButtons{
				font-size:300%;
				position: fixed; bottom: 0;
			}
			.moreButtons>div{
				margin-left:25%;
				margin-bottom:20px;
			}
			.moreButtons>div:hover{
				color:#000;
			}
			#levelUp{
				padding-left:6%;
				padding-top:5px;
			}
			.taskSection{
				width:90%;
				padding-left:3%;
			}
			.table-responsive{
				margin-left:3%;
				width:94%;
			}
			#addTask{
				display:block;
				margin-left:auto;
				margin-right:auto;
				margin-top:10px;
			}
			#deadlineDiv{
				margin-top:0;
			}
		</style>
	</head>
	<body>
		<div class='container-fluid'>
			<div class='row' style="margin-left:0;margin-right:0;">
				<div class='col-md-4 leftBar'>
					<h1>Mo the Motivator.<?php $arr["comm"]="g_lists";$listarr=api_call($mysqli,$arr);?></h1>
					<hr style="margin-top:2px;" />
					<p class="lead" id='rnd_msg'><?  $mood=1; require_once("get_rnd_msg.php");?></p>
					
					<?=MO?>
					<p class="mood" id='mood_disp'>Mood: <b>Happy</b></p>
					<hr />
					<h1 style='margin-top:10px'>Lists</h1>
					<div class="list-group todo-lists">
						
					</div>
					<button class="btn btn-link" id="addList"><i class="fa fa-plus"></i> Add New List</button>
					<div class="input-group" id="createListField">
						<input class="form-control" placeholder="list name" id="listName" name="listName">
						<span class="input-group-btn">
							<button class="btn" id="createList">Create</button>
						</span>
					</div>
				</div>
				<div class='col-md-7 mainBar'>
					<div class='row'>
						<div class='col-md-7' id="levelUp">
							<h3>Level 999 <small>1 point to the next level</small></h3>
						</div>
						<div class='col-md-4 col-md-offset1'>
							<form id="searchForm">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-search"></i>
								</span>
								<input class="form-control" type="search" id="searchBox" placeholder="search for tasks">
							</div>
							</form>
						</div>
					</div>
					<div class='row'>
						<div class="col-md-12 progress">
							<div class="progress-bar progress-bar-info" id="levelBar" role="progressbar" style="width: 99%">
								<span class="sr-only">20% Complete</span>
							</div>
						</div>
					</div>
					<div class='row taskSection'><h1 class='list-name'>General</h1></div>
					<div class='table-responsive'>
						<table class="table table-hover taskTable" id='da_table'>
						</table>
						<span id='abc'><div class="row">
							<div class="col-md-8">
								<input class="form-control" id="taskName" type="text" placeholder="Task At Hand">
							</div>
							<div class="col-md-4">
								<div id="deadlineDiv" class="input-group date">
									<input class="form-control" type="text" name="deadline" placeholder="Deadline" id="deadline" data-format="YYYY/MM/DD"></input>
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</span>
								</div>
							</div>
						</div>
						<button class='btn btn-primary btn-lg' id='addTask'>ADD TASK</button></span>
					</div>
					
				</div>
				<div class='col-md-1 rightBar'>
					<div class="moreButtons">
						<div data-toggle="tooltip" data-placement="left" title="" data-original-title="Log Out">
							<i class="fa fa-power-off" id="logOut"></i>
						</div>
						<div data-toggle="tooltip" data-placement="left" title="" data-original-title="View Leaderboards">
							<i class="fa fa-trophy" id="achievements"></i>
						</div>
						<div data-toggle="tooltip" data-placement="left" title="" data-original-title="Settings">
							<i class="fa fa-cogs" id="settings" ></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?=LEVELUP?>
		<?=WEBSITE_SCRIPTS?>
		<?php require_once("js/lvl.php");?>
		<script type="text/javascript">
			var anger=0;
			var mood=1;
			var list_id;
			var list_name;
			var max = -1;
			var expp;
			var can_del=0;
			var completed_id = -1;
			var cache;
			var message_count = 0;
			var can_shake=1;
			var exp_to_nxt_lvl=500;
			var nl;
			var at_lb=0;
			
			console.log("Haii");
			console.log(mood);
			update_mood();
			console.log(mood);
			
			function load_task(listid,listname){
				list_id = listid;
				list_name = listname;
				viewTasks();
				at_lb=0;
				if (list_id==completed_id)
				{
					cache=$("#abc").html();
					$("#abc").html("");
				}
				else
				{
					$("#abc").html(cache);
				}
				$(".todo-lists>.list-group-item").removeClass("active");
				$("#list"+listid).addClass("active");
				$(".list-name").text(list_name);
			}
			$(document).ready(function(){
				$(".moreButtons>div").tooltip();
				$('#createListField').hide();
				$('#deadlineDiv').datetimepicker({
				  pickTime: false
				});
				viewLists();
				viewTasks();
				update_mood();
				setInterval(function(){if (anger-5>=0){anger-=5;}else{anger=0;};update_mood();},5000);
				console.log(moodString);
				var moodStrings=['happy','fedUp','angry'];
				for (var i=0; i<3; i++)
				{
					//console.log(moodStrings[i]);
					$(".mo."+moodStrings[i]).click(function(){
						$(".mo.closeEye").hide();
						$(".mo.openEye."+moodStrings[i]).show();
						if (can_shake==1)
						{
							can_shake=0;
						}
						else
						{
							return;
						}
						clicks++;
						console.log(clicks+" Clicks");
						/*if(clicks > 5){
							mood=7;
							update_mood(7);
							changeMood('angry');
						} else if (clicks > 2){
							mood=7;
							update_mood(7);
							changeMood('fedUp');
						}*/
						anger+=10;
						$(this).effect("shake");
						setTimeout(function(){update_mood();can_shake=1;},500);
						message_count = 0;
					});
				}
			});
			$("#addList").click(function(){
				$("#createListField").show();
				$(this).hide();
			});
			$("#achievements").click(function(){
					viewLeaderboard();
				});
			$("#searchForm").submit(function(){
				event.preventDefault();
				if($("#searchBox").val().length > 0){
					search = $.ajax({type: "POST",
									url: "api/api.php",
									data: {comm:'g_search',
										   searchstr:$("#searchBox").val(),
										   completeid:completed_id,
										   email:'<?=$_SESSION['email']?>',
										   pass:'<?=$_SESSION['password']?>'},
										success: function(data){
										$(".taskTable").fadeOut(function(){
											$(this).html(data).slideDown();
										});
										equalizeColumns();
									},
									dataType: "text"
					});
				}
			});
			$("#createList").click(function(){
				listName = $("#listName").val();
				if(listName.length > 0){
					create = $.ajax({type: "POST",
								url: "api/api.php",
								data: {userid:'<?=$_SESSION['userid']?>',
									   listname:listName,
									   comm:'a_lists',
									   email:'<?=$_SESSION['email']?>',
									   pass:'<?=$_SESSION['password']?>'},
								success: function(data){
									list_id = data;
								},
								dataType: "text"
					});
					viewLists();
				}
				$("$listName").val('');
				$("#addList").show();
				$("#createListField").hide();
			});
			$("#addTask").click(function(){addTask();});
			$("#logOut").click(function(){location.assign("index.php")});
			
			$('#levelUpModal').on('hidden.bs.modal', function (e) {
				mood = 20;
				update_mood();
			});
			
			function viewLists(){
				create = $.ajax({type: "POST",
								url: "api/api.php",
								data: {userid:'<?=$_SESSION['userid']?>',
									   comm:'g_lists',
									   email:'<?=$_SESSION['email']?>',
									   pass:'<?=$_SESSION['password']?>'},
								success: function(data){
									$(".todo-lists").fadeOut(function(){
										$(this).html(data).slideDown();
									});
									equalizeColumns();
								},
								dataType: "text"
				});
				if(list_id === 'undefined'){$('a:first').click();}
			}
			function viewTasks(){
				view = $.ajax({type: "POST",
								url: "api/api.php",
								data: {comm:'g_tasks',
										completeid:completed_id,
									   listid:list_id,
									   email:'<?=$_SESSION['email']?>',
									   pass:'<?=$_SESSION['password']?>'},
								success: function(data){
									if(data.length > 50){
										$(".taskTable").fadeOut(function(){
											$(this).html(data).fadeIn();
										});
									} else {
										mood=6;
										$(".taskTable").fadeOut(function() {
										  $(this).html("<h1 class='noTasks'>No Tasks!</h1>").fadeIn();
										});
									}
									equalizeColumns()
								},
								dataType: "text"
				});
			}
			function addTask(){
				console.log($("#deadline").val());
				if($("#taskName").val().length>0){
					add = $.ajax({type: "POST",
									url: "api/api.php",
									data: {taskname:$("#taskName").val(),
										   taskid:list_id,
										   comm:'a_tasks',
										   timestamp:$("#deadline").val(),
										   email:'<?=$_SESSION['email']?>',
										   pass:'<?=$_SESSION['password']?>'},
									success: function(data){
										if(data.length > 5){
											$('#taskName').val(data);
										} else {
											viewTasks();
											$('#taskName').val('');
											$('#deadline').val('');
										}
									},
									dataType: "text"
					});
				}
			}
			function update_exp(){
				add = $.ajax({type: "POST",
								url: "api/api.php",
								data: {userid:'<?=$_SESSION['userid']?>',
									   comm:'u_exp',
									   email:'<?=$_SESSION['email']?>',
									   pass:'<?=$_SESSION['password']?>',
									   exp: expp.toString()},
								success: function(data){
									//alert(data);
								},
								dataType: "text"
				});
			}
			function checkTask(taskid){
				checkbox = $("#task"+taskid+">td>i.fa");
				if(checkbox.hasClass("fa-square-o")){
					 $("#task"+taskid+">td>i.fa-square-o").removeClass("fa-square-o").addClass('fa-check-square-o');
					 if (list_id!=completed_id)
					 {
						setTimeout(function(){del_task(taskid)},1000);
					 }
					 expp+=250;
					 //Check if next level
					 if (exp_to_nxt_lvl<=250)
					 {
						//console.log("nl: "+nl);
						nl=parseInt(nl);
						nl+=1;
						$("#curLevel").text("Level "+nl);
						$("#levelUpModal").modal('show');
					 }
					 hai(expp);
				} else if(checkbox.hasClass("fa-check-square-o")){
					$("#task"+taskid+">td>i.fa-check-square-o").removeClass("fa-check-square-o").addClass('fa-square-o');
					if (list_id==completed_id)
					{
						setTimeout(function(){del_task(taskid)},1000);
					}
					expp-=250;
					//
					hai(expp);
				}
				//alert(list_id);
				//alert(completed_id);

				update_exp();
			}
			
			function del_task(taskid){
				del = $.ajax({type: "POST",
								url: "api/api.php",
								data: {comm:'d_tasks',
									   email:'<?=$_SESSION['email']?>',
									   pass:'<?=$_SESSION['password']?>',
									   taskid: taskid,
									   completeid:completed_id},
								success: function(data){
									//alert(data);
									can_del=0;
									$("#task"+taskid+">td").slideUp();
								},
								dataType: "text"
				});
			}
			
			function del_list(thelistid){
				console.log("Deleting");
				del = $.ajax({type: "POST",
								url: "api/api.php",
								data: {comm:'d_lists',
									   email:'<?=$_SESSION['email']?>',
									   pass:'<?=$_SESSION['password']?>',
									   listid: thelistid},
								success: function(data){
									//alert(data);
									$("#list"+thelistid).slideUp();
									$("#list"+thelistid).html("<button type='btn'>UNDO</button>");
								},
								dataType: "text"
				});
			}
			
			function equalizeColumns(){
				var heights = ['0',$(window).height()];
				$(".leftBar,.mainBar,.rightBar").each(function(){
					heights.push($(this).height());
				});
				$(".leftBar,.mainBar,.rightBar").each(function(){
					$(this).height(Math.max.apply( null, heights ));
				});
			}
			
			function update_mood()
			{
				console.log(mood);
				console.log(anger);
				var prev_mood=mood;
				if (anger<=30)
				{
					//alert("Anger: "+anger+", I'm happy");
					$("#mood_disp").html("Mood: Happy");
					if (at_lb)
					{
						mood=4;
					}
					else
					{
						mood=1;
					}
					changeMood('happy');
				}
				else if (anger<=70)
				{
					//alert("Anger: "+anger+", I'm fed up");
					$("#mood_disp").html("Mood: Fed Up");
					if (at_lb)
					{
						mood=4;
					}
					else
					{
						mood=2;
					}
					changeMood('fedUp');
				}
				else if (anger<=100)
				{
					//alert("Anger: "+anger+", I'm angry");
					$("#mood_disp").html("MOOD: VERY ANGRY!!!");
					if (at_lb)
					{
						mood=9;
					}
					else
					{
						mood=3;
					}
					changeMood('angry');
				} 
				if (prev_mood==6 && mood==1)
				{
					mood=6;
				}
				mod = $.ajax({type: "POST",
								url: "get_rnd_msg.php",
								data: {mood:mood},
								success: function(data){
									//alert(data);
									$("#rnd_msg").fadeOut(function() {
									  $(this).html(data).fadeIn();
									});
								},
								dataType: "text"
				});
			}

			function viewLeaderboard(){
				at_lb=1;
				update_mood();
				add = $.ajax({type: "POST",
								url: "api/api.php",
								data: {comm:'g_leaderboard',
									   email:'<?=$_SESSION['email']?>',
									   pass:'<?=$_SESSION['password']?>'},
								success: function(data){
									$("#da_table").fadeOut(function() {
										$(this).html(data).fadeIn();
									});
									$(".list-name").text("Global Leaderboards");
									cache=$("#abc").html();
									$("#abc").html("");
								},
								dataType: "text"
				});
			}
			
		$(document).on('dblclick doubletap','.taskTable>tbody>tr>td:nth-of-type(2),.touch',function(){
			var editableText = $('<input type="text" name="editTask"/>');
			var task = $(this).text();
			editableText.val(task.trim());
			editableText.attr('class','form-control');
			$(this).replaceWith($("<td></td>").append(editableText));
			editableText.focus();
			$(editableText).blur(function() {
				var html = $(this).val();
				var viewableText = $('<td>');
				viewableText.text(html.trim());
				$(this).parent().replaceWith(viewableText);
				ajax = $.ajax({type: 'POST',
								url: 'api/api.php',
								data: {comm:'u_tasks',
									   email:'<?=$_SESSION['email']?>',
									   pass:'<?=$_SESSION['password']?>',
									   taskid:viewableText.parent().attr('id').substring(4),
									   taskname:html},
								success: function(data){
								},
								dataType: 'text'
							});
			});
		});
				
		</script>
		
	</body>
</html>