
<div class="greeting">
	<h1>Hello there! Welcome, <span style="color: blue;"><?php echo $_SESSION['username']; ?></span></h1>
</div>

<div class="navbar">
	<h3>
		<a href="index.php">Home</a> <br>
		<a href="insertapplicant.php">Add new Applicant</a><br>
		<a href="allusers.php">All Users</a><br>
		<a href="activitylogs.php">Activity Logs</a><br>
		<a href="core/handleforms.php?logoutUserBtn=1">Logout</a>	
	</h3>	
</div>
