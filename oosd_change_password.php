
<?php
require 'oosd_functions.php';
session_start();

$password = '';

// show previous profile
$conn = mysqli_connect("localhost", "root", "", "dd");

/*$query = "SELECT * FROM dd1 WHERE id={$_SESSION['user_id']}  ";
$users = mysqli_query($conn, $query);

if($users)
{
	while ($user = mysqli_fetch_assoc($users))
	{
		$name=$user['name'];
		
	}
}*/

///dd_add_customer.php
$errors = array();
if(isset($_POST['submit']))
{
	if (empty($errors))   ////  opposie to !
	{
		$conn = mysqli_connect("localhost", "root", "", "dd");
		// check connection 
		if (!$conn)
		{
			die ("connection failed : ". mysqli_connect_error());
		}
		
				
		$sql = "UPDATE dd1 SET ";
		$sql .= "password = '{$_POST['customer_password']}' ";
		$sql .= "WHERE id= {$_SESSION['user_id']} ";

		if (mysqli_query($conn, $sql))
		{
			echo "new password sucessfuly changed";
			//header ('Location: dd_user_profile.php');
		}
		else
		{
			echo "Error: ".$sql ."<br>". mysqli_error($conn);
		}
	}
}





if(isset($_POST['submit']))
{
	$password = $_POST['customer_password'];
	
	//checking required fields
	$reg_fields = array('customer_password');
				  
	$errors = array_merge($errors, check_reg_fields($reg_fields));
	
	//checking max length
	$max_len_fields = array('customer_password' => 10);
				  
	foreach($max_len_fields as $field => $max_len) 
	{
		if(strlen(trim($_POST[$field]))>$max_len)
		{
			$errors[] = $field . ' must be less than '. $max_len.' characters';
		}
	}
	
	//disabled other data
	//confirm password
	//back button
	// checking if email is already exists
	
}

?>

<html>
<body>

<h1>Voccational Training Center</h1>
<form action="oosd_change_password.php" method="post">

<?php 
if (!empty($errors))
{
	echo '<div class="errmsg">';
	echo '<b>There were error(s) on your form.</b><br>';
	foreach ($errors as $error){
		echo $error . '<br>';
	}
	echo'<div>';
}

?>
New Password :  <input   type = "password"  name = "customer_password" maxlength="10"
         <?php echo 'value="' . $password. '"'; ?>><br><br>
		 
<p><label for="">Show Password:</label>
	<input type="checkbox" name="showpassword" id="showpassword" 
	style="width:20px;height:20px"></p>
 
<button type = "submit" name = "submit">Update Password</button>

<p> <label for="">Password:</label>
 <span>******</span> | <a href="oosd_change_password.php">
             Change Password</a></p>
</form>

<script src="jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function()
{
	$('#showpassword').click(function(){
		if($('#showpassword').is(':checked')){
		$('#password').attr('type',text');
		}else{
			$('#password').attr('type','password');
		}
	});
});
</script>
	

</body>
</html>

