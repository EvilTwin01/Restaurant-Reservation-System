<?php 
	//session_start();
	//if(session_id()=='' || isset($_SESSION['username'])){
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Dashboard</title>
<link href="user_dash.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h2 class="h2">Coffee Corner</h2>

<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a>Dashboard</a></li>
	  <li class="add"><a>Make a reservation</a></li>
	  <li class="view"><a>View Reservation</a></li>
	  <li class="update"><a>Update Reservation</a></li>
	  <li class="delete"><a>Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
<div>
	<h3 class="h3">Welcome <?php //echo $_SESSION['username']. "."; ?></h3>
</div>
	<p class="credential">Logged in as : <?php //echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
</body>

<?php 
 //} 
 //else
 //{ 
	//header("location: login.php");
 //}
?>
</html>