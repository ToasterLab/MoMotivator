<? 
	require_once 'php.php';
?>
<html>
	<head>
		<title>Sign Up</title>
		<?=WEBSITE_STYLES?>
		<style>
			body{
				background-color:#eee;
				height:100% !important;
			}
			input[type='password']{margin-top:10px;}
			
			#registerButton{margin-top:10px;}
			.container{
				width:65% !important;
			}
			@media all and (max-width: 976px) {
				.container{width:100% !important;}
			}
			hr{
				color:#BCD9F3;
				background-color: #BCD9F3;
				height:2px;
			}
			img.mo{
				height:250px;
				width:250px;
			}
			input{margin-top:10px;}
			h1:first-of-type{text-align:center;}
			h2:first-of-type{text-align:center;}
		</style>
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='col-md-8 col-md-offset-2'>
					<h1><b>Mo is on the way!</b></h1>
					<h2>You and Mo were destined to meet on the <?php echo date("j");echo "th";echo date(" \of F Y");?></h2>
					<hr />
					<form name='register' id='register' action='http://guanqun.cep12y3.riicc.sg/Mo/api/api.php' method='post'>
						<div class='col-md-8 col-md-offset-2'>
							<input class='form-control input-lg' type='text' id='name' name='name' placeholder='name'/>
						</div>
						<div class='col-md-8 col-md-offset-2'>
							<input class='form-control input-lg' type='text' id='email' name='email' placeholder='e-mail'/>
						</div>
						<div class='col-md-8 col-md-offset-2'>
							<input class='form-control input-lg' type='password' id='pass' name='pass' placeholder='password'/>
						</div>
						<div class='col-md-8 col-md-offset-2'>
							<input class='form-control input-lg' type='password' id='confpass' name='confpass' placeholder='confirm password'/>
						</div>
						<input type='hidden' name='comm' value='reg'/>
						<div class='row'>
							<div class='col-md-6 col-md-offset-3'>
								<button id="registerButton" class='btn btn-primary btn-large btn-block' type='submit'>REGISTER</button>
							</div>
						</div>
						<hr />
					</form>
				</div>
			</div>
		</div>
		<?=WEBSITE_SCRIPTS?>
		<script type="text/javascript">
			$("#register").submit(function(){
				if ($("#pass").val()!=$("#confpass").val()){
					alert("Error: Password must match Confirm Password");
					return false;
				}
				if ($("#name").val()=='' || $("#email").val()=='' || $("#pass").val()==''){
					alert("Error: Cannot have empty email/password");
					return false;
				}
			});
		</script>
	</body>
</html>