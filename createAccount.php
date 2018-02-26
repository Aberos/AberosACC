<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<script src="scripts/jquery.js"></script>
		<script src="scripts/bootstrap.js" ></script>
		<script src="scripts/bootstrap.min.js" ></script>
		<script type="text/javascript">
			function criar(){
				$.ajax({
					url: "/api/createAcc.php",
					type: "POST",
					data: $("#form_create").serialize(),
					timeout: 30000,
					beforeSend: function(){
						$("#btnCreate").attr("disabled", true).html("carregando");
					},
					success: function(retorno){
						$("#retornoCriar").html('<div class="alert alert-info" role="alert">'+retorno+'</div>');
						$("#btnCreate").attr("disabled", false).html("Login");
					},
					error: function(retorno){
						$("#retornoCriar").html('<div class="alert alert-danger" role="alert">Por favor verifique sua conexão e tente novamente</div>');
						console.log(retorno);
						$("#btnCreate").attr("disabled", false).html("Login");
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
							<form class="form-horizontal"id="form_create" action="javascript:criar()">
								<fieldset>
									<h2 style="text-align: center" >Sign Up</h2>
									<div class="form-group">
										<label class="col-md-4 control-label" >NICK</label>
										<div class="col-md-6">
											<input type="text" name="nick" class="form-control input-md">
										</div>
									</div >
				
									<div class="form-group">
										<label class="col-md-4 control-label" >Email Address</label>
										<div class="col-md-6">
											<input type="email" name="email" class="form-control input-md">
										</div>
									</div >
				
									<div class="form-group">
										<label class="col-md-4 control-label" >Password</label>
										<div class="col-md-6">
											<input type="password" name="password" class="form-control input-md">
										</div>
									</div >
									
									<div class="form-group">
										<label class="col-md-4 control-label" >Confirm Password</label>
										<div class="col-md-6">
											<input type="password" name="confirm_password" class="form-control input-md">
										</div>
									</div >
									
									<div style="text-align: center;">
										<button id="btnCreate" type="submit" class="btn btn-lg btn-success" style="width: 90%">Create</button>
									</div>
									
									<div id="retornoCriar">
												
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

