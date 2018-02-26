<?php
session_start();

	if(isset($_SESSION["LOGIN"]) && !empty($_SESSION["LOGIN"]))
	{	
		session_destroy();
		echo '<script type="text/javascript">carregar("account.php");</script>';
	}
?>