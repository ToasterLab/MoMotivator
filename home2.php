<? 
	require_once 'php.php';
	require_once "authenticate.php";
?>
<html>
	<head>
		<?=WEBSITE_STYLES?>
		<style>
			.leftBar{
				background-color:#eee;
				padding-left:3%;
				padding-top:1.5%;
			}
			.leftBar>legend{
				font-size:300% !important;
			}
			p.lead{
				font-size:150%;
				font-family:HelveticaNueu;
			}
			.mood{
				font-size:130%;
				font-family:HelveticaNueu;
				text-align:center;
				margin-top:2%;
			}
		</style>
	</head>
	<body>
		<div class='container-fluid'>
			<div class='row-fluid'>
				<div class='col-md-4 leftBar'>
					<legend>Mo the Motivator.</legend>
					<p class="lead"><? $mood=1; require_once("get_rnd_msg.php");?></p>
					<div id="face">
						<div id="leftEye"></div>
						<div id="rightEye"></div>
					</div>
					<p class="mood">Mood: <b>Happy</b></p>
					<hr />
				</div>
				<div class='col-md-8'>
				</div>
			</div>
		</div>
		<?=WEBSITE_SCRIPTS?>
		<script type="text/javascript">
		</script>
	</body>
</html>