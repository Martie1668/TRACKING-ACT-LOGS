<?php

require_once 'dbConfig.php';

function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $firstname, $lastname, $passwords) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, firstname, lastname, passwords) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $firstname, $lastname, $passwords])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_accounts";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllapplicant($pdo) {
	$sql = "SELECT * FROM applicants";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllapplicantBySearch($pdo, $search_query) {
	$sql = "SELECT * FROM applicants WHERE 
			CONCAT(firstname,
                lastname,
				email,
				phonenumber,
                position,
				status_applicants,
				created_by,
                date_added,
                last_updated) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$search_query."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getapplicantByID($pdo, $applicantid) {
	$sql = "SELECT * FROM applicants WHERE applicantid = ?";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute([$applicantid])) {
		return $stmt->fetch();
	}
}

function insertAnActivityLog($pdo, $userid, $operation, $applicantid, 
		$search_query) {

	$sql = "INSERT INTO activity_logs (userid, operation, applicantid, 
		search_query) VALUES(?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$userid, $operation, 
		$applicantid, $search_query]);

	if ($executeQuery) {
		return true;
	}

}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs 
			ORDER BY date_added DESC";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

function insertAApplicants($pdo, $firstname, $lastname, $email, $phonenumber, $position,) {
	$response = array();
	$sql = "INSERT INTO applicants (firstname, lastname, email, phonenumber, position) VALUES(?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$insertapplicant = $stmt->execute([$firstname, $lastname, $email, $phonenumber, $position]);

	if ($insertapplicant) {
		$findInsertedItemSQL = "SELECT * FROM applicants ORDER BY date_added DESC LIMIT 1";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute();
		$getapplicantID = $stmtfindInsertedItemSQL->fetch();

		$insertAnActivityLog = insertAnActivityLog($pdo, "INSERT", $getapplicantID['applicantsid'], 
			$getapplicantID['firstname'], $getapplicantID['lastname'], 
			$getapplicantID['email'],$getapplicantID['phonenumber'],$getapplicantID['position'], $_SESSION['username']);

		if ($insertAnActivityLog) {
			$response = array(
				"status" =>"200",
				"message"=>"Applicants addedd successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
		
	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"Insertion of data failed!"
		);

	}

	return $response;
}

function updateapplicants($pdo, $firstname, $lastname, $email, 
	$phonenumber, $positon,$statusapplicants,$created_by, $applicantid) {

	$response = array();
	$sql = "UPDATE applicants
			SET firstname = ?,
				lastname = ?,
				email = ?, 
				phonenumber = ?, 
				positon = ?,
                statusapplicants = ?,
                created_by,
			WHERE applicantid = ?
			";
	$stmt = $pdo->prepare($sql);
	$updateapplicants = $stmt->execute([$firstname, $lastname, $email, 
	$phonenumber, $positon,$statusapplicants,$created_by, $applicantid]);

	if ($updateapplicants) {

		$findInsertedItemSQL = "SELECT * FROM applicants WHERE applicantid = ?";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute([$applicantid]);
		$getapplicantsID = $stmtfindInsertedItemSQL->fetch(); 

		$insertAnActivityLog = insertAnActivityLog($pdo, "UPDATE", $getapplicantsID['applicantid'], 
			$getapplicantsID['firstname'],
            $getapplicantsID['lastname'], 
			$getapplicantsID['email'],
            $getapplicantsID['phonenumber'],
            $getapplicantsID['position'],
            $getapplicantsID['status_applicants'],
            $getapplicantsID['created_by'],
            $_SESSION['username']);

		if ($insertAnActivityLog) {

			$response = array(
				"status" =>"200",
				"message"=>"Updated the applicants successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}

	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;

}

function deleteAApplicant($pdo, $applicantid) {
	$response = array();
	$sql = "SELECT * FROM applicants WHERE applicantid = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$applicantid]);
	$getapplicantbyID = $stmt->fetch();

	$insertAnActivityLog = insertAnActivityLog($pdo, "DELETE", $getapplicantbyID['applicantid'], 
		$getapplicantbyID['firstname'], $getapplicantbyID['lastname'], 
		$getapplicantbyID['email'],$getapplicantbyID['phonenumber'],$getapplicantbyID['position'],$getapplicantbyID['status_applicants'], $_SESSION['username']);

	if ($insertAnActivityLog) {
		$deleteSql = "DELETE FROM applicants WHERE applicantid = ?";
		$deleteStmt = $pdo->prepare($deleteSql);
		$deleteQuery = $deleteStmt->execute([$applicantid]);

		if ($deleteQuery) {
			$response = array(
				"status" =>"200",
				"message"=>"Deleted the applicant successfully!"
			);
		}
		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
	}
	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;
}


// $getAllapplicantsBySearch = getAllapplicantsBySearch($pdo, "Dasma");
// echo "<pre>";
// print_r($getAllapplicantBySearch);
// echo "<pre>";



?>

?>