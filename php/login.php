<?php
	if (isset($_SESSION['user_email'])){
		header("Location: home.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" href="../css/login_system.css">
	<link rel="icon" type="image/x-icon" href="../resources/images/new.png" />
</head>
<body>
     <form action="process_login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Email</label>
     	<input type="text" name="uemail" placeholder="Enter your email"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Enter your password"><br>

     	<button type="submit">Login</button><br>

		 <h2 id="direction"><a href="register.php">Go back to Register</a></h2>
     </form>
	 
</body>
</html>