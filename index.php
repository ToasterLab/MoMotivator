<? 
	require_once 'php.php';
?>
<html>
	<head>
		<title>Mo-The Motivator</title>
		<?=WEBSITE_STYLES?>
		<style>
			body{
				background-color:#eee;
				height:100% !important;
			}
			input[type='password']{margin-top:10px;}
			
			#loginButton{margin-top:10px;}
			.container{
				width:70% !important;
				height:100%;
			}
			@media all and (max-width: 976px) {
				#register{margin-top:10px;}
				.container{width:100% !important;}
			}
			hr{
				color:#BCD9F3;
				background-color: #BCD9F3;
				height:2px;
			}
			img.mo{
				height:200px;
				width:200px;
			}
			.featurette-image{
				width:350px;
			}
		</style>
		<?=WEBSITE_SCRIPTS?>
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='col-md-8 col-md-offset-2'>
					<?=MO?>
					<h1 class='tlt welcomeText' data-in-effect="fadeIn">Welcome. Meet Mo.</h1>
					<h2 class='tlt welcomeBlurb' data-in-effect="fadeInRight">The most personal To-Do list manager.</h2>
					<hr />
					<div class='row'>
						<div class='col-md-8 col-md-offset-2'>
							<input type='email' class="form-control input-lg" placeholder='email' id='email' name='email'/>
						</div>
						<div class='col-md-8 col-md-offset-2'>
							<input type='password' class="form-control input-lg" placeholder='password' id='pass' name='pass'/>
						</div>
						<div class='col-md-6 col-md-offset-3'>
							<button class="btn btn-primary btn-lg btn-block" id='loginButton'  data-loading-text="Logging in...">LOGIN</button>
						</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-md-5 col-md-offset-1">
							<button class="btn btn-primary btn-lg btn-block" id="loginFB">sign in with Facebook</button>
						</div>
						<div class="col-md-5">
							<button class="btn btn-primary btn-lg btn-block" id="register">create a new account</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 whatIsMo">
					<h1 class="center-block animated boundIn">What is Mo?</a>
				</div>
				<div class="col-md-8 col-md-offset-2 ">
					<blockquote>
					  <p>We are stuck with technology when what we really want is just stuff that works.</p>
					  <small>Douglas Adams <cite title="Source Title">in The Salmon of Doubt</cite></small>
					</blockquote>
					<hr class="featurette-divider">
					<div class="row featurette">
						<div class="col-md-7">
							<h2 class="featurette-heading">A Sentient To-Do List. <br /><span class="text-muted">It'll blow your mind.</span></h2>
							<p class="lead">Mo hates slackers. Miss a deadline and you'll be endlessly berated.</p>
						</div>
						<div class="col-md-5">
							<i class="fa fa-eye" style="font-size:250px"></i>
						</div>
					</div>
					<hr class="featurette-divider">
					<div class="row featurette">
						<div class="col-md-5">
							<img class="featurette-image img-responsive" src="images/Angry Open.png">
						</div>
						<div class="col-md-7">
							<h2 class="featurette-heading">Never Miss Another Deadline. <span class="text-muted">Or Else.</span></h2>
							<p class="lead">You won't like an angry Mo. Prepare your self-esteem for a through thrashing.</p>
						</div>
					</div>
					<hr class="featurette-divider">
					<div class="row featurette">
						<div class="col-md-7">
							<h2 class="featurette-heading">Anywhere. <span class="text-muted">Anytime.</span></h2>
							<p class="lead">Nowhere is safe. <strike>Big Brother</strike> Mo is monitoring you. Mo's power knows no bounds across the boundaries of device screens.</p>
						</div>
						<div class="col-md-5">
							<i class="fa fa-globe" style="font-size:250px"></i>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<script type="text/javascript">
			function login(){
				email = $('#email').val();
				password = $('#pass').val();
				$lgn = $.ajax({type: "POST",
								url: "api/api.php",
								data: {email:email,pass:password,comm:'login'},
								success: function(data){
									if(data === '-1'){
										$('<div class="alert alert-danger"><b>Oops!&nbsp;</b>Something\'s wrong with your login information</div>').insertBefore($('#email'));
									} else {
										location.assign("home.php");
									}
								},
								dataType: "text"
				});
			}
			$('#loginButton').click(function(){login();});
			$("#register").click(function(){location.assign("register.php");});
			$('.container').css({'height':(($(document).height())+300)+'px !important'});
			$(document).ready(function(){
				$('*').hide();
				$("*").each(function(index) {
					if($(this).hasClass('mo') != true){
						$(this).delay(100*index).fadeIn(300);
					}
				});
				$(".openEye."+moodString).slideDown();
				//$(".openEye."+moodString).hide();
				//$(".openEye."+moodString).slideUp();
				//toggle("bounce",{times:3},1000).show()
			});
			
		</script>
	</body>
</html>