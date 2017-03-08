<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['user'])){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
	    $dbname = "coffeecorner";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(isset($_GET['save']))
	{
		$id = mysqli_real_escape_string($connection, $_GET['aa']);
		
		$sql1 = "UPDATE add_reservation SET status = 'Approved' WHERE reserve_id = '$id'";
		$result1 = mysqli_query($connection, $sql1);
		
		if(!$result1)
		{
			die("database query fail!" . mysqli_error($connection));
		}
	
		header("location: admin_view.php");
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Dashboard</title>
<link href="status2.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h2 class="h2">Coffee Corner</h2>

<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a href="admin.php">Dashboard</a></li>
	  <li class="add"><a href="user_addreservation.php">Make a reservation</a></li>
	  <li class="view"><a href="user_view.php">View Reservation</a></li>
	  <li class="update"><a href="reservation_status.php">Update Reservation</a></li>
	  <li class="delete"><a>Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
<div>
	<h3 class="h3">Reservation Status</h3>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
	
	<?php
	//$identifier =  '';
	if(isset($_GET['form']))
{
	//echo $_POST['Reservation_ID'];
	//print_r($_POST);
	$identifier = $_GET['Reservation_ID']; 
	$sql = "SELECT * FROM add_reservation WHERE reserve_id LIKE '$identifier'";
	$result = mysqli_query($connection, $sql);
	// table reservation
	echo "<div class=\"table\">";
	echo "<table width=\"1200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"50px\">";
    echo     "<tr>";
	echo     "<th>Reservation ID</th>";
    echo     "<th>Total Person</th>";
    echo     "<th>Date</th>";
	echo     "<th>Time</th>";
	echo     "<th>Status</th>";
    echo "</tr>";
    echo "<tr>";
    if (mysqli_num_rows($result) > 0) 
	{
    	while ($row = mysqli_fetch_array($result)) {
?>
        <tr>
            <td><?php echo $row['reserve_id']; ?></td>  
            <td><?php echo $row['no_of_people']; ?></td> 
            <td><?php echo date('d/m/Y', strtotime($row['date'])); ?></td> 
            <td><?php echo date('h:i a', strtotime($row['time'])); ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
<?php
    	}
  	}
     echo         "</tr>";
     echo  "</table>";
	echo "</div>";
	//end table
	echo "<div class=\"addform\">";
	echo "<h3>Are you confirm?:</h3>";
	echo "<form method=\"get\" action=\"status2.php\">";
	echo    "Reservation ID: ";
	echo    "<input type=\"text\" value=\"$identifier\" disabled><br><br>";
	echo    "<input type=\"hidden\" name=\"aa\" value=\"$identifier\">";
	echo	"<input type=\"submit\" name=\"save\" value=\"Approved\"><br><br>";
	echo	"</form>";	
	echo "</div>";
}
?>
</body>
<?php 
 } 
 else
 { 
	header("location: admin_login.php");
 }
?>
</html>