<?php
include("config.php");
	try
	{
		$pdo = new PDO('mysql:host='.$host_database.';dbname='.$name_database, $user_database, $pass_database);
	}catch(Exception $e){
		die("NAO FOI POSSIVEL SE CONECTAR COM O BANCO DE DADOS");
	}

?>