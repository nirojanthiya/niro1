<?php
session_start();
$table = $_SESSION['tablename'];

$conn = mysqli_connect("localhost", "root", "", "dd");

if(isset($_POST['submito']))
{
	$query = "SELECT * FROM $table WHERE state = 'shopping' LIMIT 1 ";
	$result_set = mysqli_query($conn, $query);
	
	if($result_set)
	{
	
		if(mysqli_num_rows($result_set) == 1)
		{
			// update status
			$sql = "UPDATE $table SET ";
			$sql .= "state = 'delivered'";
			$sql .= "WHERE state= 'shopping' ";
			if(mysqli_query($conn,$sql))	// send message to customer
			{
				echo "sucessfully done";
			}
		}
		else{
			echo "Quiz already done";}
	}
	else{
	echo " already done";}
}
else{
	echo " wrong one";}

?>

<html>
<body>
<form>
<button type = "submit" name = "home" ><a href ="oosd_obtions.php">
				Home</a></button>


</form>
</body>
</html>