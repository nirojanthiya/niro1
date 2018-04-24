<?php
session_start();
$table = $_SESSION['tablename'];

$conn = mysqli_connect("localhost", "root", "", "dd");

if (isset($_POST['submittype1']))
{
	$querytablename = "SELECT * FROM dd1 WHERE job = 'customer1' ";
	$result_set = mysqli_query($conn, $querytablename);

	if($result_set)
	{
		while($result = mysqli_fetch_assoc($result_set))
		{
			$_SESSION['tablename'] = '_'.$result['NIC'];
		}
	}
}

if (isset($_POST['submittype2']))
{
	$querytablename = "SELECT * FROM dd1 WHERE job = 'customer2' ";
	$result_set = mysqli_query($conn, $querytablename);

	if($result_set)
	{
		while($result = mysqli_fetch_assoc($result_set))
		{
			$_SESSION['tablename'] = '_'.$result['NIC'];
		}
	}
}

if (isset($_POST['submittype3']))
{
	$querytablename = "SELECT * FROM dd1 WHERE job = 'customer3' ";
	$result_set = mysqli_query($conn, $querytablename);

	if($result_set)
	{
		while($result = mysqli_fetch_assoc($result_set))
		{
			$_SESSION['tablename'] = '_'.$result['NIC'];
		}
	}
}
			
$query = "SELECT * FROM $table WHERE state = 'ordered' || 
					state = 'shopping' LIMIT 1 ";
$result_sets = mysqli_query($conn, $query);
	
if($result_sets)
{
	
	if(mysqli_num_rows($result_sets) == 1)
	{
		// display list
		while($order = mysqli_fetch_assoc($result_sets))
		{
			$list = $order['list'];
			echo ($list);
		}
		
		// update status
		$sql = "UPDATE $table SET ";
		$sql .= "state = 'shopping'";
		$sql .= "WHERE state= 'ordered' ";
		mysqli_query($conn,$sql);   // send message to customer
		
	}
	else
	{
		echo " Can't access quiz";
	}	
}
else{
	echo " Quiz already done";}

?>


<html>
<body>
<form action = "oosd_finish_delivery.php" method = "post">

<button type = "submit" name = "submito">
				Submited</button>

<button type = "submit" name = "home" ><a href ="oosd_obtions.php">
				Home</a></button>
</form>
</body>
</html>