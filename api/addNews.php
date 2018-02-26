<?php
session_start();
include("../database.php");

	if($_SESSION["GROUP_ID"] === '6'){
		if(isset($_POST["title"]) && isset($_POST["description"]) && !empty($_POST["title"]) && !empty($_POST["description"])){
			$sql = "INSERT INTO news (title, description) VALUES (?,?);";
			$add_news = $pdo->prepare($sql);
			$add_news->execute(array($_POST["title"],$_POST["description"])); 
			if(($add_news->rowCount()) > 0)
			{
				echo "<script type=\"text/javascript\"> $('#newsModal').modal('hide'); location.reload();</script>";
			}else{
				echo "Verifique as informacoes, tente mais tarde!";
			}
		}else{
			echo 'Tente novamente';
		}
		
	}else{
		echo 'Voce nao possui permissao';
	}
?>