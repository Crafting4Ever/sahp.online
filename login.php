<?php

$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else {
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
		$_SESSION['role'] = $user['role'];
		$_SESSION['stat'] = $user['status'];
		$_SESSION['id'] = $user['id'];
		$stat = $_SESSION['status'];
		$role = $_SESSION['role'];
		$roletext = "DEFAULT";
		if ($role == 0) {
			$roletext = "Recruit";
		} else if ($role == 1) {
			$roletext = "FTA";
		} else if ($role == 2) {
			$roletext = "FTO";
		} else if ($role == 3) {
			$roletext = "ADMIN";
		}
		$_SESSION['roletext'] = $roletext;
		if($stat != 0) {
			$id = $_SESSION['id'];
			$sql =  $mysqli->query("UPDATE users SET status='0' WHERE id=$id");
		}
		$_SESSION['status'] = $user['status'];
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

