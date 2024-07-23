<?php 
session_start(); 
include "conn.php";

if (isset($_POST['uemail']) && isset($_POST['password']) && isset($_POST['uage']) && isset($_POST['uname'])) {
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$uemail = validate($_POST['uemail']);
    $uname = validate($_POST['uname']);
    $uage = validate($_POST['uage']);
	$pass = validate($_POST['password']);

	if (empty($uemail)) {
		header("Location: register.php?error=User email is required");
	    exit();
    }else if(empty($uname)){
        header("Location: register.php?error=User Name is required");
	    exit();
    }else if(empty($uage)){
        header("Location: register.php?error=User Age is required");
	    exit();
	}else if(empty($pass)){
        header("Location: register.php?error=Password is required");
	    exit();
	}else{
		$check = "SELECT * FROM user_info WHERE user_email='$uemail'";
        $result = mysqli_query($conn, $check);
        if (mysqli_num_rows($result) > 0) {
			header("Location: login.php?error=User already exists. Please Login");
		    exit();
		}
		$pass=md5($pass);
        $sql= "INSERT INTO user_info VALUES('$uemail','$uname','$uage','$pass');";
        $conn->query($sql);
        header("Location: login.php");
        exit();
	}
	
}else{
	header("Location: login.php");
	exit();
}