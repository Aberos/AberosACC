<?php
include("../database.php");

	if(isset($_POST["nick"]) && isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["nick"]) && !empty($_POST["email"]) && !empty($_POST["password"]))
	{
		if(isset($_POST["password"][5]))
		{
			$sql = "SELECT id FROM accounts WHERE name = ?";
			$carrega_nicks = $pdo->prepare($sql);
			$carrega_nicks->execute(array($_POST["nick"]));												
			$result = $carrega_nicks->fetchAll(PDO::FETCH_ASSOC);
			
			if(!isset($result[0]))
			{
				if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
				{	
					$sql = "SELECT id FROM accounts WHERE email = ?";
					$carrega_email = $pdo->prepare($sql);
					$carrega_email->execute(array($_POST["email"]));												
					$result = $carrega_email->fetchAll(PDO::FETCH_ASSOC);
					
					if(!isset($result[0]))
					{
						//$sql = "INSERT INTO accounts (name, password, premdays, lastday, email, accounts.key, blocked, warnings, group_id) VALUES (?, SHA1(?), '0', '0', ?, '0', '0', '0', '1');";
						$sql = "INSERT INTO accounts (name, password, premdays, lastday, email, creation) VALUES (?, SHA1(?), 0, 0, ?, 1);";
						$create_account = $pdo->prepare($sql);
						$create_account->execute(array($_POST["nick"], $_POST["password"], $_POST["email"]));
						
						if(($create_account->rowCount()) > 0)
						{
							echo 'Conta Criada <script type="text/javascript">carregar("accountManager.php");</script>';
						}else{
							echo "Verifique seu nick e senha, tente mais tarde!";
						}
					}else
					{
						echo "Email ja cadastrado";
					}
				}else{
					echo "Email Invalido";
				}
			}else{
				echo "Ja existe uma conta com esse nick";
			}
		}else{
			echo "Senha Invalida";
		}	
	}else{
		echo "Preencha todos os campos!";
	}
?>