<?php
	include_once "db_connection.php";
	session_start();
	$database = new Connection();
	$conn = $database->openConnection();
	$statement = $conn->prepare("SELECT * FROM characters");
	$statement->execute();
	$heros = $statement->fetchAll();
	$conn = $database->openConnection();
	$statement = $conn->prepare("SELECT * FROM modules");
	$statement->execute();
	$modules = $statement->fetchAll();
	$error_msg = "";
	if(isset($_POST["start"])){
		if(!(isset($_POST['hero']))){
			$error_msg = "Adventurer! Please select a hero!";
		}
		elseif($_POST['story'] == ""){
			$error_msg = "Adventurer! Please select a story!";
		}
		else{
			$conn = $database->openConnection();
			$statement = $conn->prepare("UPDATE adventurers SET module_id = :story WHERE username = :username;");
			$statement->bindValue(":username",$_SESSION["username"], PDO::PARAM_STR);
			$statement->bindValue(":story",$_POST['story'],PDO::PARAM_INT);
			$statement->execute();
			$conn = $database->openConnection();
			$statement = $conn->prepare("UPDATE adventurers SET character_id = :hero WHERE username = :username;");
			$statement->bindValue(":username",$_SESSION["username"], PDO::PARAM_STR);
			$statement->bindValue(":hero",$_POST["hero"],PDO::PARAM_STR);
			$insert_success = $statement->execute();
			$statement = $conn->prepare("UPDATE adventurers SET state_id = 1 WHERE username = :username;");
			$statement->bindValue(":username",$_SESSION["username"], PDO::PARAM_STR);
			$statement->execute();
			header("Location: dnd_story.php");
		}

	}
?>


<!DOCTYPE html>

<html>

	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title>Delves & Drakes</title>
		<style>
			.error {
				color: red;
			}
			.success {
				color: green;
			}
			body {
				text-align: center;
				color: white;
				font-family: ariel, helvetica, sans-serif;
				background-color: black;
			}
			.charcard{
				background-color: black;
			}
			.warning{
				color: red;
			}
		</style>
	
	</head>
	
	<body>
	<?php include "top_bar.php" ?>
		<h1 class="head">
			<img class="img-fluid d-none d-lg-inline" src="images/dragon.png">
			Begin Your Adventure!
			<img class="img-fluid d-none d-lg-inline" src="images/dragon2.png">
		</h1>
		<form method="post">
			<div class="container">
			<?php if($error_msg != "") { ?>
			<p class="error"><?php echo $error_msg; ?></p>
			<?php } ?>
						
				<h2>Select a Hero: </h2>
				<div class="row">
							<?php foreach ($heros as $next_hero) { ?> 
							<div class="col-12 col-sm-6 col-md-4 ">
								<div class="card mb-3 charcard">
								<img class="card-img-top" src="images/hero<?php echo $next_hero['character_id']; ?>.png" />
									<div class="card-body">
										<h3 class="card-title"><?php echo $next_hero['character_name']; ?> </h3>
										<h4 class="card-subtitle"><?php echo $next_hero['character_race']; ?> <?php echo $next_hero['character_class']; ?></h4>
										<table>
											<tr>
											
												<td>STR: <?php echo $next_hero['strength']; ?></td> 
												<td>DEX: <?php echo $next_hero['dexterity']; ?></td>
												<td>CON: <?php echo $next_hero['constitution']; ?></td>  
												<td>INT: <?php echo $next_hero['intelligence']; ?></td>   
												<td>WIS: <?php echo $next_hero['wisdom']; ?></td>  
												<td>CHA: <?php echo $next_hero['charisma']; ?></td>  
											</tr>
										</table>
										<input type="radio" id = "hero" name="hero" value="<?php echo $next_hero['character_id']; ?>">Select Hero<br>
									</div>
								</div>
							</div>
							<?php } ?>
						
				</div>
				</br>
				</br>
				</br>
				<h2> Select a Story:  </h2>
				<p>
					<select id="story" name="story" value="">
						<option value=""></option>
						<?php foreach ($modules as $module) { ?>
						<option value="<?php echo $module['module_id'];?>"><?php echo $module['module_name'];?></option>
						<?php } ?>
					</select>
				</p>
				<button type="submit" name="start" class="btn btn-dark">Begin Adventure</button>
				</br>
				</br>
				</br>
				<p class="warning">Warning! Starting a new adventure will erase previous adventure!</p>
			</div>
		</form>
		</br>
		</br>
		</br>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>

<html>