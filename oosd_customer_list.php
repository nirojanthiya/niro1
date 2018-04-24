<?php
session_start();

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "dd";
require 'oosd_functions.php';
// create connection_aborted

$conn = mysqli_connect($servername,$username,$password,$dbname);

 $user_list ='';

// geting the list of users
$query = "SELECT * FROM dd1  ";
$users = mysqli_query($conn, $query);

if($users)
{
	while ($user = mysqli_fetch_assoc($users))
	{
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['name']}</td>";
		
		
		//$user_list .= "<td>{$user['last-login']}</td>";
		$user_list .= "<td><a href=\"dd_edit_profile.php?
				  user_id={$user['id']}\">Edit</a></td>";
		
		//$customer_id=$user['id'];  ///wrong achivement
	    //$_SESSION['$user_id'] = $customer_id ;	
		
		$user_list .= "<td><a href=\"dd_delete_user.php?
				  user_id={$user['id']}\">Delete</a></td>";
		$user_list .= "</tr>";
		
	}
	
}
else
{
	echo "database query failed";
}


?>
				  
<html>

<body>

<main>
	<h1>Door Delivery </h1>
	<table class="masterlist">
		<tr>
			<th>Name</th>
			
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		
		<?php echo $user_list; ?>
		
	</table>
	<br><a href="oosd_create_account.php"><b>Add New Customer<b></a><br><br>
</main>

<button type = "submit" name = "home" ><a href ="oosd_obtions.php">
				Home</a></button>

<button type = "submit" name = "home" ><a href ="oosd_display_list.php">
				Display Quiz</a></button>
</body>
</html>
