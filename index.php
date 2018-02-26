
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ruby Server </title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<script src="scripts/jquery.js"></script>
		<script src="scripts/bootstrap.js" ></script>
		<script src="scripts/bootstrap.min.js" ></script>
	</head>
	<body style="background-color: #222; !important">
		
		<div  class="container">
		

			<div class="bgimg">
				  
			</div>
			
			<nav class="navbar navbar-default" style="margin-top: 10px" >
				<ul class="nav nav-pills" style="margin-top:5px; margin-left: 5px">
					<li role="presentation"><a onclick="carregar('news.php')" href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbspNEWS </a></li>
					<li role="presentation"><a onclick="carregar('account.php')" href="#"><i class="fa fa-id-card" aria-hidden="true"></i>&nbspCONTA </a></li>
					<li role="presentation"><a onclick="carregar('download.php')" href="#"><i class="fa fa-download" aria-hidden="true"></i>&nbspDownload </a></li>
					<li role="presentation"><a href="#"><i class="fa fa-life-ring" aria-hidden="true"></i>&nbspSuporte </a></li>
				</ul>
			</nav>
			
			<div id="divCont" class="renderbody">
			
			</div>
			
		</div>
		
			
	<script>
		function carregar(pagina){
			$("#divCont").load(pagina);
		}
	</script>
	<?php
		session_start();

		if(isset($_SESSION["LOGIN"]) && !empty($_SESSION["LOGIN"]))
		{
			echo '<script type="text/javascript">carregar("accountManager.php");</script>';
		}else{
			echo '<script type="text/javascript">carregar("news.php");</script>';
		}
	?>
	</body>
</html>