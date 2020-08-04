<?php
	include_once "db_connection.php";
	session_start();
	$database = new Connection();
	$conn = $database->openConnection();
	$username = $_SESSION["username"];
	$statement = $conn->prepare("SELECT * FROM adventurers WHERE username = :username");
	$statement->bindValue(":username",$username, PDO::PARAM_STR);
	$statement->execute();
	$result = $statement->fetch();
	$state = $result['state_id'];
	$module = $result['module_id'];
	$conn = $database->openConnection();
	$statement = $conn->prepare("SELECT * FROM modules WHERE module_id = :module");
	$statement->bindValue(":module",$module, PDO::PARAM_INT);
	$statement->execute();
	$result = $statement->fetch();
	$module_name = $result['module_name'];
	
	if(isset($_POST['continue'])){
		$statement = $conn->prepare("SELECT * FROM options WHERE option_id = :option_id");
		$statement->bindValue(":option_id",$_POST['option'], PDO::PARAM_INT);
		$statement->execute();
		$result = $statement->fetch();
		$chance = $result['chance'];
		$check_id = $result['check_id'];
		if($chance == 1){
			$statement = $conn->prepare("SELECT * FROM checks WHERE check_id = :check_id");
			$statement->bindValue(":check_id",$check_id, PDO::PARAM_INT);
			$statement->execute();
			$result = $statement->fetch();
			$stat = $result['stat'];
			$thresh = $result['threshold'];
			$pass = $result['pass'];
			$fail = $result['fail'];
			$statement = $conn->prepare("SELECT character_id FROM adventurers WHERE username = :username");
			$statement->bindValue(":username",$username, PDO::PARAM_STR);
			$statement->execute();
			$result = $statement->fetch();
			$character_id = $result['character_id'];
			$statement = $conn->prepare("SELECT :stat FROM characters WHERE character_id = :character_id");
			$statement->bindValue(":stat",$stat, PDO::PARAM_STR);
			$statement->bindValue(":character_id",$character_id, PDO::PARAM_STR);
			$statement->execute();
			$stat_to_check = $statement->fetch();
			if($thresh > $stat_to_check){
				$state = $fail;
			}
			else{
				$state = $pass;
			}	
		}
		else{
			$statement = $conn->prepare("SELECT state_id FROM options WHERE option_id = :option_id");
			$statement->bindValue(":option_id",$_POST['option'], PDO::PARAM_INT);
			$statement->execute();
			$result = $statement->fetch();
			$state = $result['state_id'];
		}
		$statement = $conn->prepare("UPDATE adventurers SET state_id = :state WHERE username = :username;");
		$statement->bindValue(":username",$_SESSION["username"], PDO::PARAM_STR);
		$statement->bindValue(":state",$state,PDO::PARAM_INT);
		$statement->execute();
	}
	else {
		$conn = $database->openConnection();
		$statement = $conn->prepare("SELECT * FROM adventurers WHERE username = :username");
		$statement->bindValue(":username",$username, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetch();
		$state = $result['state_id'];
		$module = $result['module_id'];
		$conn = $database->openConnection();
		$statement = $conn->prepare("SELECT * FROM modules WHERE module_id = :module");
		$statement->bindValue(":module",$module, PDO::PARAM_INT);
		$statement->execute();
		$result = $statement->fetch();
		$module_name = $result['module_name'];
	}
	$conn = $database->openConnection();
	$statement = $conn->prepare("SELECT * FROM states WHERE state_id = :state");
	$statement->bindValue(":state",$state, PDO::PARAM_INT);
	$statement->execute();
	$result = $statement->fetch();
	$state_text = $result['state_text'];
	$op_1 = $result['option_1'];
	$op_2 = $result['option_2'];
	$op_3 = $result['option_3'];
	$op_4 = $result['option_4'];
	$state_image = $result['state_image'];
	if($op_1 != NULL){
		$conn = $database->openConnection();
		$statement = $conn->prepare("SELECT option_text FROM options WHERE option_id = :op_1");
		$statement->bindValue(":op_1",$op_1, PDO::PARAM_INT);
		$statement->execute();
		$result = $statement->fetch();
		$op_1_text = $result['option_text'];
	}
	if($op_2 != NULL){
		$conn = $database->openConnection();
		$statement = $conn->prepare("SELECT option_text FROM options WHERE option_id = :op_2");
		$statement->bindValue(":op_2",$op_2, PDO::PARAM_INT);
		$statement->execute();
		$result = $statement->fetch();
		$op_2_text = $result['option_text'];

	}
	if($op_3 != NULL){
		$conn = $database->openConnection();
		$statement = $conn->prepare("SELECT option_text FROM options WHERE option_id = :op_3");
		$statement->bindValue(":op_3",$op_3, PDO::PARAM_INT);
		$statement->execute();
		$result = $statement->fetch();
		$op_3_text = $result['option_text'];

	}
	if($op_4 != NULL){
		$conn = $database->openConnection();
		$statement = $conn->prepare("SELECT option_text FROM options WHERE option_id = :op_4");
		$statement->bindValue(":op_4",$op_4, PDO::PARAM_INT);
		$statement->execute();
		$result = $statement->fetch();
		$op_4_text = $result['option_text'];
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
		</style>
	</head>
	
	<body>	
	<?php include "logout_bar.php" ?>
	<h1>
		<img class="img-fluid d-none d-lg-inline" src="images/dragon3.png">
		<?php echo $module_name ?>
		<img class="img-fluid d-none d-lg-inline" src="images/dragon4.png">
	</h1>
		
		<form method="post">
			<div>
			<?php if($state_image != ""){ ?>
			<img class="img-fluid" src="<?php echo $state_image ?>">
			<?php } ?>
			</div>
			<div>
				<p class="text"><?php echo $state_text ?></p>			
			</div>
			<div class = "col">
				<?php if($op_1 != NULL){ ?>
				<input type="radio" id = "option" name="option" value="<?php echo $op_1; ?>"><?php echo $op_1_text; ?><br>
				<?php } ?>
				<?php if($op_2 != NULL){ ?>
				<input type="radio" id = "option" name="option" value="<?php echo $op_2; ?>"><?php echo $op_2_text; ?><br>
				<?php } ?>
				<?php if($op_3 != NULL){ ?>
				<input type="radio" id = "option" name="option" value="<?php echo $op_3; ?>"><?php echo $op_3_text; ?><br>
				<?php } ?>
				<?php if($op_4 != NULL){ ?>
				<input type="radio" id = "option" name="option" value="<?php echo $op_4; ?>"><?php echo $op_4_text; ?><br>
				<?php } ?>
			</div>
		<?php if($op_1 != NULL){ ?>
		<button type="submit" name="continue" class="btn btn-dark">Continue</button>
		<?php } ?>
		<?php if($op_1 == NULL){ ?>
		<a href="dnd_select.php?" class="btn btn-dark">Try Again?</a>
		<?php } ?>
		</form>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>

<html>
