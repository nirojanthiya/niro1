<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dd");

if(isset($_POST['submi']))
{
	
	$list=$_SESSION['list'];
	
	$table = $_SESSION['tablename'];	
	
	$sql = "INSERT INTO $table (list, date, state)
		VALUES('$list', '2018', 'ordered')";
	if (mysqli_query($conn, $sql))
	{
		echo "new quiz uploaded sucessfuly".'<br><br>';
		
	}
}


?>

<html>
<body>

<button type = "submit" name = "home" ><a href ="oosd_obtions.php">
				Home</a></button>

<header>
		<a href="oosd_logout.php">Log Out</a> 
</header>

</body>
</html>