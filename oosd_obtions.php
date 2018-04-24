<?php 
session_start();
?>	

<html>
<body>
<h1>Voccational Training Center </h1>
<link rel="stylesheet" href="oosd_main.css">

<header>
	<div class="appname">Voccational Training Center</div>
	<div class="loggedin">Welcome <?php echo $_SESSION['user_name'];?>
	           !<a href="oosd_logout.php">Log Out</a></div><br><br>
			   
	<?php 
	$conn = mysqli_connect('localhost', 'root', '', 'dd');
	$query = "SELECT * FROM dd1 WHERE id = {$_SESSION['user_id']} ";
	$result_set = mysqli_query($conn, $query);

	if($result_set)
	{
		while($result = mysqli_fetch_assoc($result_set))
		{
			$job = $result['job'];
			
			if ($job == 'OOSD' || $job =='OS' || $job == 'Graph')
			{
				$_SESSION['tablename'] = '_'.$result['NIC'];
				echo"<a href='oosd_enter_list.php'>Enter Quiz</a><br><br>";
				echo"<a href='oosd_customer_list.php'>Check student list</a><br><br>";
				//echo"<a href="oosd_order_state.php">Check order state</a><br><br>";
			}
			if($job == 'student')
			{
				echo"<a href='oosd_selecting_customer_type.php'>Quiz </a><br><br>";
				
			}
		}
	}

	?>
	<a href="oosd_edit_profile.php">Edit my profile</a><br><br>
	<a href="oosd_user_profile.php">View my profile</a><br><br>
	
	
	
	
</header>

</body>
</html>