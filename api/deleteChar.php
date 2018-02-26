<?php
session_start();
include("../database.php");

	if(isset($_POST["idChar"]) && isset($_SESSION["ID"]) && !empty($_POST["idChar"]) && !empty($_SESSION["ID"])){
		$sql = "UPDATE players SET deletion = 1 WHERE id = ? AND account_id = ?";
		$delete_player = $pdo->prepare($sql);
		$delete_player->execute(array($_POST["idChar"],$_SESSION["ID"])); 
		
		if(($delete_player->rowCount()) > 0){
			echo "<script type=\"text/javascript\"> location.reload();</script>"; 
		}else{
			echo "Nao foi possivel deletar o Char";
		}
	}else{
		echo "Tente Novamente!";
	}	
?>