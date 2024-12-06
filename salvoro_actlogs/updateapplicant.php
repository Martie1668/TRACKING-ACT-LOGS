<?php  
require_once 'core/models.php'; 
require_once 'core/handleforms.php'; 

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
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
	<?php include 'navbar.php'; ?>

	<?php $getapplicantByID = getapplicantByID($pdo, $_GET['applicantid']); ?>
	<form action="core/handleforms.php?applicantid=<?php echo $_GET['applicantid']; ?>" method="POST">
		<p>
			<label for="address">First name</label>
			<input type="text" name="address" value="<?php echo $getapplicantByID['firstname']; ?>"></p>
		<p>
        <p>
			<label for="address">Last name</label>
			<input type="text" name="address" value="<?php echo $getapplicantByID['lastname']; ?>"></p>
		<p>
        <p>
			<label for="address">Email</label>
			<input type="text" name="address" value="<?php echo $getapplicantByID['email']; ?>"></p>
		<p>
        <p>
			<label for="address">Phone number</label>
			<input type="text" name="address" value="<?php echo $getapplicantByID['phonenumber']; ?>"></p>
		<p>
        <p>
			<label for="address">Position</label>
			<input type="text" name="address" value="<?php echo $getapplicantByID['position']; ?>"></p>
		<p>
			<label for="address">Status applicants </label>
			<input type="text" name="contact_number" value="<?php echo $getapplicantByID['status_applicants']; ?>">
			<input type="submit" name="updateapplicantBtn" value="Update">
		</p>
	</form>
</body>
</html>