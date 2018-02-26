<?php
include("database.php");

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=11" /> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<script src="scripts/jquery.js"></script>
		<script src="scripts/bootstrap.js" ></script>
		<script src="scripts/bootstrap.min.js" ></script>
	</head>
	<body>
		<div class="container" style="">
			<div class="row" style="margin-left: 1%">
				<h1>News About Server</h1>
			</div>
			<hr style="margin-right: 3%">
			<div style="margin-right: 3%">
				<?php
					$sql = "SELECT * FROM news;";
					$carrega_news = $pdo->prepare($sql);
					$carrega_news->execute();
					
					$result = $carrega_news->fetchAll(PDO::FETCH_ASSOC);
					foreach($result as $ret)
					{
						echo '<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="panel-title">
										<i class="fa fa-newspaper-o" aria-hidden="true"></i> '.$ret["title"].'</h3>
									</div>
								</div>
								<div class="panel-body">
									'.$ret["description"].'
								</div>
							</div>';
					}
				?>
			</div>
		</div>
	</body>
</html>