<?php
  session_start();
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(isset($_POST['submit']))
	{
		$userid = rand(1000,9999);
		$username = mysqli_real_escape_string($connection, $_POST['user']);
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$phone = mysqli_real_escape_string($connection, $_POST['phone']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		
		if(isset($_POST['submit']))
		{
			$sql = "INSERT INTO user(user_id,username,email,phone,password) VALUES('$userid','$username','$email','$phone','$password')";
			$result = mysqli_query($connection, $sql);
			
			if(!$result)
			{
				die("database query fail!" . mysqli_error($connection));
			}
			
			$_SESSION['message'] = "Registration Success!";
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $userid;
			header("location: login.php");
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign up</title>
<link href="signup.css" rel="stylesheet" type="text/css">
</head>

<body class="body">
	<div class="top_background">
		<nav>
			<a class="home" href="index.html">Home |</a>
			<a class="login" href="login.php">Have an account? Log in</a>
		</nav>
	</div>
	<div class="join">
	<h1 class="h1">Join Coffee Corner today.</h1>
	<form class="input" method="post" action="signup.php">
		<input type="text" class="username" placeholder="Username" name="user" required> <br><br>
		<input type="email" class="email" placeholder="Email" name="email" required> <br><br>
		<input type="text" class="phone" placeholder="Phone Number" name="phone" required> <br><br>
		<input type="password" class="password" placeholder="Password" name="password" required> <br><br>
		<input class="submit" type="submit" value="Sign up" name="submit">
	</form>
	</div>
</body>
</html>


<?php
	mysqli_close($connection);
?>