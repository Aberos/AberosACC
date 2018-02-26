<?php
session_start();
include("database.php");
include("config.php");

if(empty($_SESSION["LOGIN"]))
{
	echo '<script type="text/javascript">carregar("account.php");</script>';
}

?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		

		
		<script type="text/javascript"> 
			function logout(){
				$.ajax({
					url: "/api/logout.php",
					type: "POST",
					timeout: 30000,
					success: function(retorno){
						$("#panel_manager").html(retorno);
					},
				})
			}
			
			function donate(){
				$.ajax({
					url: "/api/donate.php",
					type: "POST",
					data: $("#frmDonate").serialize(),
					timeout: 30000,
					success: function(retorno){
						$("#statusDonateModal").html(retorno);
						$("#donate").html("Create").attr("disabled", false);
					},
				})
			}
			
			function createAcc(){
				$.ajax({
					url: "/api/createChar.php",
					type: "POST",
					data: $("#frmCreateChar").serialize(),
					timeout: 30000,
					success: function(retorno){
						$("#statusModal").html(retorno);
						$("#createChar").html("Create").attr("disabled", false);
					},
					beforeSend: function(){
						$("#createChar").html("Criando Char").attr("disabled", true);
					},
					error: function(retorno){
						$("#createChar").html("Create").attr("disabled", false);
					},
				})
			}
			
			function addNews(){
				$.ajax({
					url: "/api/addNews.php",
					type: "POST",
					data: $("#frmAddNews").serialize(),
					timeout: 30000,
					success: function(retorno){
						$("#statusNews").html(retorno);
						$("#btnNews").html("Create").attr("disabled", false);
					},
					beforeSend: function(){
						$("#btnNews").html("Criando Char").attr("disabled", true);
					},
					error: function(retorno){
						$("#btnNews").html("Create").attr("disabled", false);
					},
				})
			}
			
			function deleteChar(id){
				$.ajax({
					url: "/api/deleteChar.php",
					type: "POST",
					data: "idChar="+id,
					timeout: 30000,
					success: function(retorno){
						$("#resultChar").html('<div class="alert alert-success" role="alert">'+retorno+'</div>');
						$("#deleButton").html("Create").attr("disabled", false);
					},
					beforeSend: function(){
						$("#deleButton").html("Criando Char").attr("disabled", true);
					},
					error: function(retorno){
						$("#deleButton").html("Create").attr("disabled", false);
					},
				})
			}
		</script>
	</head>
	<body>
		<div class="container" style="">
			<div class="row">
				<div style=" margin-left: 1%; margin-right: 4%">
					<div class="row" style="margin-top: 20px;">
						<div class="col-md-6">
							<div class="panel panel-primary" style="width: 100%;">
								<div class="panel-heading">
									<h3 class="panel-title" ><i class="fa fa-address-card-o" aria-hidden="true"></i> About Account</h3>
									<button class="btn btn-danger " type="button" id="deleButton" style="float: right; margin-top: -23px; margin-right: -10px" onclick="javascript:logout()">
										<i class="fa fa-sign-out" aria-hidden="true" data-toggle="tooltip" title="Logout!"></i>
									</button>
								</div>
								<div class="panel-body" id="panel_manager">
									<label>
										<i class="fa fa-user-circle-o" aria-hidden="true"></i> Nick: <?php echo $_SESSION["LOGIN"]; ?>
									</label>
									</br>
									<label>
										<i class="fa fa-envelope-o" aria-hidden="true"></i> Email: <?php echo $_SESSION["EMAIL"]; ?>
									</label>
									</br>
									<label>
										<i class="fa fa-free-code-camp" aria-hidden="true"></i> Account: <?php 
											if($_SESSION["VIPDAYS"] > 0)
											{
												echo "VIP";
											}else{
												echo "NORMAL";
											}
										?>
									</label>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="panel panel-success" style="width: 100%; min-height:145">
								<div class="panel-heading">
									<h3 class="panel-title" ><i class="fa fa-gift" aria-hidden="true"></i> Your Points</h3>
								</div>
								<div class="panel-body">
									<label>
										<i class="fa fa-diamond" aria-hidden="true"></i> Points: 10
									</label>
									</br>
									<button  type="button" class="btn btn-default">
										<i class="fa fa-cart-plus" aria-hidden="true" onclick="javascript: $('#donateModal').modal('show');"></i> SHOP
									</button>
									
									<button class="btn btn-primary " type="button" onclick="javascript: $('#donateModal').modal('show');"> SHOP
						            </button>
								</div>
							</div>
						</div>
					</div>
					<div id="resultChar">
						
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Characters List</h3>						
						</div>
						<table class="table">
							<thead>
								<tr>
									<th>Nick</th>
									<th>Level</th>
									<th>Commands</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($_SESSION["ID"]) && !empty($_SESSION["ID"]) && $_SESSION["ID"] > 0)
									{	
											$sql = "SELECT * FROM players WHERE  account_id = ? and deletion = 0";
											$carrega_chars = $pdo->prepare($sql);
											$carrega_chars->execute(array($_SESSION["ID"]));
											
											$result = $carrega_chars->fetchAll(PDO::FETCH_ASSOC);
											
											foreach($result as $ret)
											{
												echo '<tr>
														<td>'.$ret["name"].'</td>
														<td>'.$ret["level"].'</td>
														<td>
															<div style="margin-top: -6px">
																<button class="btn btn-danger " type="button" id="deleButton" style="margin-left: 10px" onclick="javascript:deleteChar('.$ret["id"].')">
																	<i class="fa fa-trash-o" aria-hidden="true"></i> Delete
																</button>
															</div>
														</td>
													</tr>';
											}
									}
								?>	
							</tbody>
						</table>
					</div>
					
					<div>
						<button class="btn btn-default " type="button" onclick="javascript: $('#charModal').modal('show');">
							Create Character
						</button>
						<?php if($_SESSION["GROUP_ID"] === '6') : ?>
						<button class="btn btn-primary " type="button" onclick="javascript: $('#newsModal').modal('show');">
							ADD NEWS
						</button>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		
	
		<div class="modal fade" tabindex="-1" role="dialog" id="charModal" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" style="text-align:center">Create Character</h4>
					</div>
					<form action="javascript:createAcc()" class="form-horizontal" id="frmCreateChar">
						<div class="modal-body">
							
							<fieldset>
								<div class="form-group">
									<label class="col-md-4 control-label" >Nick:</label>
									<div class="col-md-6">
										<input type="text" name="nick" class="form-control input-md">
									</div>
								</div >
			
								<div class="form-group">
									<label class="col-md-4 control-label" >Gender:</label>
									<div class="col-md-6">
										<select id="gender" name="gender" class="form-control">
												<option value="0">Female</option>
												<option value="1">Male</option>
										</select>
									</div>
								</div >				

								<div class="form-group">
									<label class="col-md-4 control-label" >World:</label>
									<div class="col-md-6">
										<select id="world" name="world" class="form-control">
											<?php
												foreach($mundos as $m => $val)
												{
													echo '<option value="'.$m.'">'.$val.'</option>';
												}
											?>
										</select>
									</div>
								</div >
			
								<div class="form-group">
									<label class="col-md-4 control-label" >City:</label>
									<div class="col-md-6">
										<select id="city" name="city" class="form-control">
											<?php
												foreach($cidades as $c => $val)
												{
													echo '<option value="'.$c.'">'.$val["name"].'</option>';
												}
											?>
										</select>
									</div>
								</div >
								
								<div id="statusModal">
								
								</div>
							</fieldset>
								
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-success" id="createChar">Create</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		
		
		
		
		
		
		
		<div class="modal fade" tabindex="-1" role="dialog" id="donateModal" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" style="text-align:center">Donate</h4>
					</div>
					<form action="javascript:donate()" class="form-horizontal" id="frmDonate">
						<div class="modal-body">
							
							<fieldset>
								<div class="form-group">
									<label class="col-md-4 control-label" >Nick:</label>
									<div class="col-md-6">
										<input type="text" name="nick" class="form-control input-md">
									</div>
								</div >
			
								<div class="form-group">
									<label class="col-md-4 control-label" >Coins:</label>
									<div class="col-md-6">
										<select id="coins" name="coins" class="form-control">
												<option value="1">1</option>
												<option value="2">2</option>
										</select>
									</div>
								</div >
								
								<div id="statusDonateModal">
								
								</div>
							</fieldset>
								
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-success" id="donate">Donate</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		
		
		
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">ADD NEWS</h4>
			  </div>
			  <form action="javascript:addNews()" id="frmAddNews">
				  <div class="modal-body">
					<fieldset>
						<div class="form-group col-md-12">
							<label class="col-md-2 control-label" >TITLE:</label>
							<input type="text" name="title" class="form-control input-md">
						</div >
						<div class="form-group col-md-12">
							<label class="col-md-2 control-label" >Description:</label>
							<textarea  type="text" name="description" class="form-control input-md"></textarea>
						</div >
						<div id="statusNews">
								
						</div>
					</fieldset>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="btnNews">ADD</button>
				  </div>
			 </form>
			</div>
		  </div>
		</div>
	</body>
</html>