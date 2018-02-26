<?php
session_start();

if(isset($_SESSION["LOGIN"]) && !empty($_SESSION["LOGIN"]))
{
	echo '<script type="text/javascript">carregar("accountManager.php");</script>';
}

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<script src="/scripts/jquery.js"></script>
		<script src="/scripts/bootstrap.js" ></script>
		<script src="/scripts/bootstrap.min.js" ></script>
		
		<script type="text/javascript"> 
			function logar(){
				$.ajax({
					url: "/api/login.php",
					type: "POST",
					data: $("#form_login").serialize(),
					timeout: 30000,
					beforeSend: function(){
						$("#btnLogin").attr("disabled", true).html("carregando");
					},
					success: function(retorno){
						$("#retorno").html('<div class="alert alert-info" role="alert">'+retorno+'</div>');
						$("#btnLogin").attr("disabled", false).html("Login");
					},
					error: function(retorno){
						$("#retorno").html('<div class="alert alert-danger" role="alert">Por favor verifique sua conexão e tente novamente</div>');
						console.log(retorno);
						$("#btnLogin").attr("disabled", false).html("Login");
					},
				})
			}
		</script>
	</head>
	<body>
		<div class="container" style="">
		<div class="row">
			<div class="col-md-12">
				<div class="modal-dialog" style="margin-bottom:0">
					<div class="modal-content">
						<div class="panel-heading">
							<h3 class="panel-title" style="text-align: center">Sign In</h3>
						</div>
						<div class="panel-body">
							<form role="form" id="form_login" action="javascript:logar()">
										<fieldset>
											<div class="form-group">
												<input class="form-control" placeholder="Login" name="login" type="login" autofocus="">
											</div>
											<div class="form-group">
												<input class="form-control" placeholder="Password" name="password" type="password" value="">
											</div>
											<div class="checkbox">
												<label>
													<input name="remember" type="checkbox" value="Remember Me">Remember Me
												</label>
											</div>
											<!-- Change this to a button or input when using this as a form -->
											<button id="btnLogin" type="submit" class="btn btn-lg btn-success" style="width: 100%">Login</button>
											
											<div class="form-group" style="margin-top: 10px">
												<label>
													<a onclick="carregar('createAccount.php')" href="#">Create Account</a>	
												</label>
											</div>
											
											<div class="form-group" style="margin-top: -10px">
												<label>
													<a href="#">Recover Account</a>	
												</label>
											</div>
											
											<div id="retorno">
												
											</div>
										</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>

