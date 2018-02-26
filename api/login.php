<?php

include("../database.php");

 if(isset($_POST["login"]) && isset($_POST["password"]) && !empty($_POST["login"]) && !empty($_POST["password"]))
 {
	$sql = "SELECT * FROM accounts WHERE name = ? and password = SHA1(?) ";
	$checar_conta = $pdo->prepare($sql);
	$checar_conta->execute(array($_POST["login"], $_POST["password"]));
	
	$result = $checar_conta->fetchAll(PDO::FETCH_ASSOC);
	
	if (count($result) > 0)
	{
		session_start();
		$_SESSION["ID"] = $result[0]["id"];
		$_SESSION["LOGIN"] = $result[0]["name"];
		$_SESSION["PASS"] = $result[0]["password"];
		$_SESSION["EMAIL"] = $result[0]["email"];
		$_SESSION["VIPDAYS"] = $result[0]["premdays"];
		$_SESSION["GROUP_ID"] = $result[0]["group_id"];
		
		echo '<script type="text/javascript">carregar("accountManager.php");</script>';
	}else{
		echo "Login ou Senha incorreto";
	}
	
 }else{
	 echo "Preencha todos os campos";
 }
?>