<?php
session_start();
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "dd";

// create connection_aborted

$conn = mysqli_connect($servername,$username,$password,$dbname);
$user_list='';
  

// geting the list of users
$query = "SELECT * FROM dd1 WHERE id={$_SESSION['user_id']}  ";
$users = mysqli_query($conn, $query);

if($users)
{
	while ($user = mysqli_fetch_assoc($users))
	{
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['name']}</td>";
		$user_list .= "<td>{$user['email']}</td>";
		$user_list .= "<td>{$user['NIC']}</td>";
		$user_list .= "<td>{$user['TPno']}</td>";
		$user_list .= "<td>{$user['address']}</td>";
		$user_list .= "<td>{$user['section']}</td>";
		
		
		//$user_list .= "<td>{$user['last-login']}</td>";
		//$user_list .= "<td><a href=\"dd_edit_profile.php?
	                   //user_id={$_SESSION['user_id']}\">Edit</a></td>";
				  
		/*$user_list .= "<td><a href=\"dd_delete_user.php?
				  user_id={$user['id']}\">Delete</a></td>";*/
		$user_list .= "</tr>";
		
	}
}

else
{
	echo "database query failed";
}

//if(isset($_POST['submit']))
//{


?>
				  
<html>

<body>



<main>
	<h1>Voccational Training Center</h1>
	<table class="masterlist">
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>NIC</th>
			<th>TPno</th>
			<th>Address</th>
			<th>Section</th>
			
			
			
			
		</tr>
		
		<?php echo $user_list; ?>
		
	</table>
</main>

<form action="oosd_user_profile.php" method="post">
<button type = "submit" name = "back"><a href="oosd_edit_profile.php">
				Edit</a></button>
<button type = "submit" name = "home" ><a href ="oosd_change_password.php">
				Change Password</a></button>
<button type = "submit" name = "home" ><a href ="oosd_obtions.php">
				Home</a></button>
</form>

</body>
</html>