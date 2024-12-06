<?php  
require_once 'core/models.php'; 
require_once 'core/handleforms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
		font-family: "Arial";
	}
	input {
		font-size: 1.5em;
		height: 50px;
		width: 200px;
	}
	table, th, td {
		border:1px solid black;
	}
	</style>
</head>
<body>
	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

		if ($_SESSION['status'] == "200") {
			echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
		}

		else {
			echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
		}

	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>
	<h1>Login Now!</h1>
	<form action="core/handleforms.php" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="passwords" placeholder="Password" required>
    <button type="submit" name="loginUserBtn">Login</button>
</form>
	<p>Don't have an account? You may register <a href="register.php">here</a></p>
</body>
</html>
