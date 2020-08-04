<?php

	include_once "db_connection.php";
	session_start();
	$err_msg = "";
	$success_msg = "";
	
	$username = "";
	if(isset($_POST["username"])){
		$username = $_POST["username"];
	}
	
	$password = "";
	if(isset($_POST["password"])){
		$password = $_POST["password"];
	}
	
	if(isset($_POST["logout"])){
		unset($_SESSION["username"]);
		unset($_SESSION["module_id"]);
		unset($_SESSION["character_id"]);
		unset($_SESSION["state_id"]);
		
	} else if(isset($_POST["login"])){
		
		// check validity of login with database
		
		$database = new Connection();
		$conn = $database->openConnection();
		
		$statement = $conn->prepare("SELECT * FROM adventurers WHERE username = :username");
		$statement->bindValue(":username",$_POST["username"], PDO::PARAM_STR);
		$statement->execute();
		

		
		// fetch() returns only the next row in the result set, as opposed to fetchAll(), which returns all rows
		// in this case, unless we've screwed something up previously, we should only have 0 or 1 rows in the result set
		$result = $statement->fetch();
					
		if (!$result) {
			$err_msg = "No adventurer \"" . $username . "\" exists.";
		} else if (!password_verify($password,$result["password"])){
			$err_msg = "Incorrect password.";
		} else {
			$_SESSION["username"] = $username;
			header("Location: dnd_select.php");
		}
	} else if(isset($_POST["register"])){
		
			$num_lowercase = preg_match_all("~[a-z]~",$password);
			$num_uppercase = preg_match_all("~[A-Z]~",$password);
			$num_numeric = preg_match_all("~[0-9]~",$password);
			
			if (strlen($username) < 4 or strlen($username) > 31) {
				$err_msg = "Adventurer! Your username must be between 4 and 31 characters long.";
			} else if (preg_match("~[^A-Za-z0-9]~",$username)){
				$err_msg = "Adventurer! Your username must contain only numbers and letters.";
			} else if (strlen($password) < 8 or strlen($password) > 31) {
				$err_msg = "Adventurer! Your password must be between 8 and 31 characters long.";
			} else if ($num_lowercase == 0 or $num_uppercase == 0 or $num_numeric == 0){
				$err_msg = "Adventurer! Your password must contain lowercase letters, uppercase letters, and numbers.";
			} else {
				$database = new Connection();
				$conn = $database->openConnection();
				$statement = $conn->prepare("SELECT * FROM adventurers WHERE username = :username");
				$statement->bindValue(":username",$username, PDO::PARAM_STR);
				$statement->execute();
				$result = $statement->fetchAll();
				
				if (count($result) > 0){
					$err_msg = "Adventurer!  The username " . $username . " already exists.";
				} else {
					$statement = $conn->prepare("INSERT INTO adventurers (username, password) VALUES (:username, :password)");
					$statement->bindParam(":username",$username);
					$hashed_password = password_hash($password,PASSWORD_DEFAULT);
					$statement->bindParam(":password",$hashed_password);
					
					$statement->execute();
					
					$success_msg = "Gratz Adventurer! Account " . $username . " is created! Begin your delve!";
				}
				
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
		</style>
	</head>
	
	<body>	
		<h1>Welcome Adventurer, to Delves & Drakes</h1>

		<form method="post">
			<div class="container">
				<div class="row">
					<div class="col d-none d-md-block">
						<img class="img-fluid" src="images/fire.png">
					</div>
					<div class="col">
					</br>
					</br>
					</br>
					</br>
					</br>
						<p>Thoust Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username);?>"></input></p>

						<p>Thoust Password: <input type="password" name="password"></input></p>
						
						<button type="submit" name="login" class="btn btn-dark">Login</button>
						
						<button type="submit" name="register" class="btn btn-dark">Register</button>
						
						<?php if($err_msg != "") { ?>
						<p class="error"><?php echo $err_msg; ?></p>
						<?php } ?>
						
						<?php if($success_msg != "") { ?>
						<p class="success"><?php echo $success_msg; ?></p>
						<?php } ?>	
					</div>
					<div class="col col d-none d-md-block">
						<img class="img-fluid" src="images/fire.png">
					</div>
				</div>
			</div>
		
		</form>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>

<html>
