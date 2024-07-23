<?php
	if (isset($_SESSION['user_email'])){
		header("Location: home.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>REGISTER</title>
	<link rel="stylesheet" href="../css/login_system.css">
	<link rel="icon" type="image/x-icon" href="../resources/images/new.png" />
</head>
<body>
     <form action="process_reg.php" method="post">
     	<h2>REGISTER</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Email</label>
     	<input type="text" name="uemail" placeholder="Enter your email"><br>
         <label>Name</label>
     	<input type="text" name="uname" placeholder="Enter your name"><br>
         <label>Age</label>
     	<input type="number" name="uage" placeholder="Enter your age"><br>
     	<label>Password</label>
     	<input type="password" name="password" placeholder="Enter your password"><br>

     	<button type="submit">Register</button>
		 <h2 id="direction"><a href="login.php">Go to Login</a></h2>
     </form>
</body>
</html>