<?php 
session_start();
if(session_id()=='' || isset($_SESSION['username'])){
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		
  $user = $_SESSION['username'];	
	
  $sql  = "(SELECT * FROM add_reservation WHERE username like '$user')";
  $result = mysqli_query($connection, $sql);
	
  if(!$result)
  {
	 die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
  }
  //header("location: user_dashboard.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete | Dashboard</title>
<link href="user_delete.css" rel="stylesheet" type="text/css">
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
	<h3 class="h3">Cancel Your Reservation</h3>
</div>
	<p class="credential">Logged in as : <?php //echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
	<div class="delete1">
    <?php	
	// table reservation details
	echo "<table width=\"1200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"50px\">";
    echo     "<tr>";
    echo     "<th>Username</th>";
	echo     "<th>Reservation ID</th>";
    echo     "<th>Total Person</th>";
    echo     "<th>Date</th>";
	echo     "<th>Time</th>";
	echo     "<th>Edit</th>"; 
    echo "</tr>";
    echo "<tr>";
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['reserve_id']; ?></td>  
            <td><?php echo $row['no_of_people']; ?></td> 
            <td><?php echo date('d/m/Y', strtotime($row['date'])); ?></td> 
            <td><?php echo date('h:i a', strtotime($row['time'])); ?></td>
			<td>
     			<form method="post" action="user_delete.php">	
				<input type="checkbox" name="arrayValue[]"><br>
				</form>
       		</td>
        </tr>
        <?php
    }
}
     echo         "</tr>";
     echo  "</table>";
	// end table reservation details
  ?>
  <?php
	if(isset($_REQUEST['deleteFile']))  
	{var_dump($_REQUEST);
    if(isset($_POST['checkbox']))
    {

        print_r($_POST);
    }
}
?>
	</div>
</body>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>
</html>