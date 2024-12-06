<?php
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertNewUserBtn'])) {
	$username = trim($_POST['username']);
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
    $passwords = trim($_POST['passwords']);
	$confirm_password = trim($_POST['confirm_password']);

	if (!empty($username) && !empty($firstname) && !empty($lastname) && !empty($passwords)&& !empty($confirm_password)) {

		if ($passwords == $confirm_password) {

			$insertQuery = insertNewUser($pdo, $username, $firstname, $lastname, password_hash($passwords, PASSWORD_DEFAULT));
			$_SESSION['message'] = $insertQuery['message'];

			if ($insertQuery['status'] == '200') {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../login.php");
			}

			else {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../register.php");
			}

		}
		else {
			$_SESSION['message'] = "Please make sure both passwords are equal";
			$_SESSION['status'] = '400';
			header("Location: ../register.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
    $username = trim($_POST['username']);
    $passwords = trim($_POST['passwords']);

    if (!empty($username) && !empty($passwords)) {
        $loginQuery = checkIfUserExists($pdo, $username);

        // Check if the user exists
        if ($loginQuery && isset($loginQuery['userInfoArray'])) {
            $userIDFromDB = $loginQuery['userInfoArray']['userid'];
            $usernameFromDB = $loginQuery['userInfoArray']['username'];
            $passwordFromDB = $loginQuery['userInfoArray']['passwords'];

            // Verify the password
            if (password_verify($passwords, $passwordFromDB)) {
                $_SESSION['userid'] = $userIDFromDB;
                $_SESSION['username'] = $usernameFromDB;
                header("Location: ../index.php");
                exit();  // Don't forget to exit after header redirection
            } else {
                $_SESSION['message'] = "Username/password invalid";
                $_SESSION['status'] = "400";
                header("Location: ../login.php"); // Redirect to the login page here
                exit();
            }
        } else {
            $_SESSION['message'] = "Username/password invalid"; // Handle the case where the user is not found
            $_SESSION['status'] = "400";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = '400';
        header("Location: ../login.php"); // Redirect to login for empty fields
        exit();
    }
}
if (isset($_POST['insertNewApplicantBtn'])) {
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    $position = trim($_POST['position']);
    $status_applicants = trim($_POST['status_applicants']);

	if (!empty($firstname) && !empty($lastname) && !empty($email)&& !empty($phonenumber)&& !empty($position)&& !empty($status_applicants)) {
		$insertAApplicants = insertAApplicants($pdo, $firstname, $lastname, $email,$phonenumber,$position,$status_applicants,
        $_SESSION['username']);
		$_SESSION['status'] =  $insertAApplicant['status']; 
		$_SESSION['message'] =  $insertAApplicant['message']; 
		header("Location: ../index.php");
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../index.php");
	}

}

if (isset($_POST['updateApplicantBtn'])) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
    $email = $_POST['email'];
	$phonenumber = $_POST['phonenumber'];
    $position = $_POST['position'];
    $status_applicants = $_POST['status_applicants'];
	$date = date('Y-m-d H:i:s');

	if (!empty($firstname) && !empty($lastname) && !empty($email)&& !empty($phonenumber)&& !empty($position)&& !empty($status_applicants)) {

		$updateapplicants = updateapplicants($pdo, $firstname, $lastname, $email,$phonenumber,$position,$status_applicants,
			$date, $_SESSION['username'], $_GET['applicantid']);

		$_SESSION['message'] = $updateApplicant['message'];
		$_SESSION['status'] = $updateApplicant['status'];
		header("Location: ../index.php");
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}

}

if (isset($_POST['deleteapplicantBtn'])) {
	$applicantid = $_GET['applicantid'];

	if (!empty($applicantid)) {
		$deleteaApplicant = deleteaApplicant($pdo, $applicantid);
		$_SESSION['message'] = $deleteaApplicant['message'];
		$_SESSION['status'] = $deleteaApplicant['status'];
		header("Location: ../index.php");
	}
}

if (isset($_GET['logoutUserBtn'])) {
	unset($_SESSION['username']);
	header("Location: ../login.php");
}

?>