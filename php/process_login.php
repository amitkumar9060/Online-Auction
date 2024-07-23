<?php 
session_start(); 
include "conn.php";

if (isset($_POST['uemail']) && isset($_POST['password'])) {
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$uemail = validate($_POST['uemail']);
	$pass = validate($_POST['password']);
	
	if (empty($uemail)) {
		header("Location: login.php?error=User email is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else{
		$pass = md5($pass);
		$sql = "SELECT * FROM user_info WHERE user_email='$uemail' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_email'] === $uemail && $row['password'] === $pass) {
            	$_SESSION['user_email'] = $row['user_email'];
            	$_SESSION['email'] = $row['email'];
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: login.php?error=Incorect User email or password");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect User email or password");
	        exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}