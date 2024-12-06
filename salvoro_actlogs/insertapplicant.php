
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

	<form action="core/handleforms.php" method="POST">
		<p>
			<label for="address">First name</label>
			<input type="text" name="firstname"></p>
		<p>
			<label for="address">Last name</label>
			<input type="text" name="lastname">
		</p>
		<p>
			<label for="address">Email</label>
			<input type="text" name="email">
		</p>
        <p>
			<label for="address">Phone number</label>
			<input type="text" name="phonenumber"></p>
		<p>
        <p>
			<label for="address">Position</label>
			<input type="text" name="position"></p>
		<p>
        <p>
			<label for="address">Status applicant</label>
			<input type="text" name="status_applicants"></p>
            <input type="submit" name="insertNewapplicantBtn" value="Create">
		<p>
	</form>

	<div class="tableClass">
		<table style="width: 100%;" cellpadding="20">
			<tr>
				<th>First name</th>
				<th>Last name</th>
				<th>Email</th>
				<th>Phone number</th>
				<th>Position</th>
				<th>Status applicant</th>
				<th>Created by</th>
                <th>Date added</th>
                <th>Last Updated</th>
				<th>Action</th>
			</tr>
			<?php if (!isset($_GET['searchBtn'])) { ?>
				<?php $getAllapplicant = getAllapplicant($pdo); ?>
				<?php foreach ($getAllapplicant as $row) { ?>
				<tr>
					<td><?php echo $row['firstname']; ?></td>
					<td><?php echo $row['lastname']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['phonenumber']; ?></td>
					<td><?php echo $row['position']; ?></td>
					<td><?php echo $row['status_applicants']; ?></td>
					<td><?php echo $row['created_by']; ?></td>
                    <td><?php echo $row['date_added']; ?></td>
                    <td><?php echo $row['last_updated']; ?></td>
					<td>
						<a href="updateapplicant.php?applicantid=<?php echo $row['applicantid']; ?>">Update</a>
					</td>
				</tr>
				<?php } ?>
			<?php } else { ?>
				<?php $getAllapplicantBySearch = getAllapplicantBySearch($pdo, $_GET['searchQuery']); ?>
				<?php foreach ($getAllapplicantBySearch as $row) { ?>
				<tr>
                    <td><?php echo $row['firstname']; ?></td>
					<td><?php echo $row['lastname']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['phonenumber']; ?></td>
					<td><?php echo $row['position']; ?></td>
					<td><?php echo $row['status_applicants']; ?></td>
					<td><?php echo $row['created_by']; ?></td>
                    <td><?php echo $row['date_added']; ?></td>
                    <td><?php echo $row['last_updated']; ?></td>
					<td>
						<a href="updateapplicant.php?applicantid=<?php echo $row['applicantid']; ?>">Update</a>
					</td>
				</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>

</body>
</html>
