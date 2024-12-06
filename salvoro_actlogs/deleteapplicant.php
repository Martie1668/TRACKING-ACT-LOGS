<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php';
 
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
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
	<h1>Are you sure you want to delete this ?</h1>
	<?php $getapplicantByID = getapplicantByID($pdo, $_GET['applicantid']); ?>
	<div class="container" style="border-style: solid; border-color: red; background-color: #ffcbd1;height: 500px;">
		<h2>first name: <?php echo $getapplicantByID['firstname']; ?></h2>
		<h2>Last name: <?php echo $getapplicantByID['lastname']; ?></h2>
		<h2>Email: <?php echo $getapplicantByID['email']; ?></h2>
        <h2>Phone number: <?php echo $getapplicantByID['phonenumber']; ?></h2>
        <h2>Position: <?php echo $getapplicantByID['position']; ?></h2>
        <h2>Status applicants: <?php echo $getapplicantByID['status_applicants']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleforms.php?applicantid=<?php echo $_GET['applicantid']; ?>" method="POST">
				<input type="submit" name="deleteBtn" value="Delete" style="background-color: #f69697; border-style: solid;">
			</form>			
		</div>	

	</div>
</body>
</html>