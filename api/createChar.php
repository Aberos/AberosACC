<?php
include("../database.php");
include("../config.php");
session_start();
	if(isset($_POST["nick"]) && isset($_POST["gender"]) && isset($_POST["world"]) && isset($_POST["city"]) && !empty($_POST["nick"]) && !empty($_POST["city"]))
	{
		if(isset($_POST["nick"][5]))
		{
			$sql = "SELECT id FROM players WHERE name = ?";
			$carrega_nicks = $pdo->prepare($sql);
			$carrega_nicks->execute(array($_POST["nick"]));												
			$result = $carrega_nicks->fetchAll(PDO::FETCH_ASSOC);
			
			if(!isset($result[0]))
			{
				
				if(isset($cidades[$_POST["city"]]))
				{
					if(isset($mundos[$_POST["world"]]))
					{
						if($_POST["gender"] === "0" or $_POST["gender"] === "1") // if(in_array($_POST['gender'], array(0,1,2,3,4,5,6,8, "ola")))
						{	
							$pos_x = $cidades[$_POST["city"]]["pos_x"];
							$pos_y = $cidades[$_POST["city"]]["pos_y"];
							$pos_z = $cidades[$_POST["city"]]["pos_z"];
							$conditions = '';
							
							$sql = "INSERT INTO players (name, group_id, account_id, level, vocation, town_id, posx, posy, posz, conditions, cap, sex) VALUES (?, '1', ?, '10', '0', ?, ?, ?, ?, ?, '400', ?);";
							$create_account = $pdo->prepare($sql);
							$create_account->execute(array($_POST["nick"], $_SESSION["ID"], $_POST["city"], $pos_x, $pos_y, $pos_z, $conditions, $_POST["gender"]));
							
							if(($create_account->rowCount()) > 0)
							{
								echo "<script type=\"text/javascript\"> $('#charModal').modal('hide'); location.reload();</script>";
							}else{
								echo "Verifique seu nick, tente mais tarde!";
							}
						}else{
							echo "Sexo Nao existe";
						}
					}else{
						echo "mundo nao existente";
					}

					
				}else{
					echo "cidade nao existe";
				}

			}else{
				echo "nick ja existe";
			}
			
		}else{
			echo "nick invalido";
		}
	}else{
		echo "Tente Novamente";
	}	
?>