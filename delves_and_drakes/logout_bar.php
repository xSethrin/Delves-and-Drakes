<?php
	if(isset($_POST["logout"])){
		unset($_SESSION["username"]);
		header("Location: dnd_login.php");
	}
?>
<form method="post">
<nav class="navbar navbar-expand-lg mb-5 bg-dark">
	<span class="navbar-brand">Adventurer: <?php if(isset($_SESSION["username"])) { echo $_SESSION["username"]; } ?></span>
	<div class="collapse navbar-collapse" id="navbarContent">
	
		<ul class="navbar-nav ml-auto">
			<button type="submit" name="logout" class="btn btn-dark">Logout</button>

		</ul>
	</div>
</nav>
</form>