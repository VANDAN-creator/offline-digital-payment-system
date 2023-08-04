<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$password = validate($_POST['password']);

	if (empty($email) && empty($password)) {
		header("Location: vendor_login.php?error=Email and password are required");
	    exit();
	} else if (empty($email)) {
		header("Location: vendor_login.php?error=Email is required");
	    exit();
	} else if (empty($password)) {
        header("Location: vendor_login.php?error=Password is required");
	    exit();
	} else {
		$sql = "SELECT * FROM vendor_ids WHERE email='$email' AND password='$password'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $password) {
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: user_verify_after_vendor_login.php");
		        exit();
            } else {
				header("Location: vendor_login.php?error=Incorrect Email or password");
		        exit();
			}
		} else {
			header("Location: vendor_login.php?error=Incorrect Email or password");
	        exit();
		}
	}
} else {
	header("Location: vendor_login.php");
	exit();
}
