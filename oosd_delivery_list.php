<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dd");
if(isset($_POST['submit']))
{
	$_SESSION['list']=$_POST['delivery_list'];
	echo ($_POST['delivery_list']).'<br><br>';
}

if(isset($_POST['submi']))
{
	
	$list=$_SESSION['list'];
	
	$table = $_SESSION['tablename'];	
	
	$sql = "INSERT INTO $table (list, date)
		VALUES('$list', '2018')";
	if (mysqli_query($conn, $sql))
	{
		echo "new list send sucessfuly".'<br><br>';
		
	}
}


?>

<html>
<body>
<form action = "oosd_delivery_list.php" method = "post">

<button type = "submit" name = "submi">
				Confirm</button>

<button type = "submit" name = "back"><a href="oosd_enter_list.php">
				Edit</a></button>
<button type = "submit" name = "home" ><a href ="oosd_obtions.php">
				Home</a></button>
</form>

<header>
		<a href="oosd_logout.php">Log Out</a> 
</header>

</body>
</html>