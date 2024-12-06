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
	<div class="searchForm">
		<form action="index.php" method="GET">
			<p>
				<input type="text" name="searchQuery" placeholder="Search here">
				<input type="submit" name="searchBtn" value="Search">
				<h3><a href="index.php">Search Again</a></h3>	
			</p>
		</form>
	</div>

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

	<div class="tableClass">
		<table style="width: 100%;" cellpadding="20"> 
			<tr>
				<th>First name</th>
				<th>Last name</th>
				<th>Email</th>
				<th>Phone number</th>
				<th>Position</th>
				<th>Status applicants</th>
				<th>Created by</th>
                <th>Date added</th>
                <th>Last updated</th>
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
						<a href="deleteapplicant.php?applicantid=<?php echo $row['applicantid']; ?>">Delete</a>
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
						<a href="deleteapplicant.php?applicantid=<?php echo $row['applicantid']; ?>">Delete</a>
					</td>
				</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
	
</body>
</html>