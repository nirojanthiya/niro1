
<?php
require 'dd_functions.php';
session_start();

$name = '';
$email = '';
$nic = '';
$tp = '';
$address = '';
$section = '';


// show previous profile
$conn = mysqli_connect("localhost", "root", "", "dd");

$query = "SELECT * FROM dd1 WHERE id={$_SESSION['user_id']}  ";
$users = mysqli_query($conn, $query);

if($users)
{
	while ($user = mysqli_fetch_assoc($users))
	{
		$name=$user['name'];
		$email=$user['email'];
		$address=$user['address'];
		$nic=$user['NIC'];
		$tp=$user['TPno'];
		$section=$user['section'];
	}
}

///dd_add_customer.php
$errors = array();

if(isset($_POST['submit']))
{
	$name = $_POST['customer_name'];
	//password
	$address = $_POST['customer_address'];
	$email = $_POST['customer_email'];
	$nic = $_POST['customer_nic'];
	$tp = $_POST['customer_tp'];
	$section = $_POST['customer_section'];
	
	//checking required fields
	$reg_fields = array('customer_name', 'customer_email', 
			'customer_nic','customer_tp','customer_address',
			'customer_section');
				  
	$errors = array_merge($errors, check_reg_fields($reg_fields));
	
	//checking max length
	$max_len_fields = array('customer_name' => 5,'customer_email' => 15, 
			 'customer_nic' => 50,'customer_tp' => 50,
             'customer_address' => 50, 'customer_section' => 50);
				  
	foreach($max_len_fields as $field => $max_len) 
	{
		if(strlen(trim($_POST[$field]))>$max_len)
		{
			$errors[] = $field . ' must be less than '. $max_len.' characters';
		}
	}
	
	/*// checking if email is already exists
	$email = mysqli_real_escape_string($conn, $_POST['customer_email']);
	$query = "SELECT * FROM dd1 WHERE email = '{$email}' LIMIT 1";
	$result_set = mysqli_query($conn,$query);
	
	if($result_set)
	{
		if(mysqli_num_rows($result_set) == 1 ){
		$errors[] = 'Email address already exists';}
	}*/
}



if(isset($_POST['submit']))
{
	if (empty($errors))   ////  opposie to !
	{
		

		// create connection_aborted

		//$conn = mysqli_connect($servername,$username,$password_db,$dbname);
		// check connection 
		if (!$conn)
		{
			die ("connection failed : ". mysqli_connect_error());
		}
		
		

		/*$sql = "UPDATE  dd1 SET( email, name, NIC, TPno, address, section)
				VALUES ('{$_POST['customer_email']}','{$_POST['customer_name']}',
				'{$_POST['customer_nic']}','{$_POST['customer_tp']}',
				'{$_POST['customer_address']}', '{$_POST['customer_section']}') 
				WHERE id={$_SESSION['user_id']}";*/
				
		$sql = "UPDATE dd1 SET ";
		$sql .= "name = '{$_POST['customer_name']}', ";
		$sql .= "email = '{$_POST['customer_email']}', ";
		$sql .= "NIC = '{$_POST['customer_nic']}', ";
		$sql .= "TPno = '{$_POST['customer_tp']}', ";
		$sql .= "address = '{$_POST['customer_address']}', ";
		$sql .= "section = '{$_POST['customer_section']}' ";
		$sql .= "WHERE id= {$_SESSION['user_id']} ";

		if (mysqli_query($conn, $sql))
		{
			//echo "new record created sucessfuly";
			header ('Location: dd_user_profile.php');
		}
		else
		{
			echo "Error: ".$sql ."<br>". mysqli_error($conn);
		}
	}
}



?>

<html>
<body>

<h1>Voccational Training Center</h1>
<form action="oosd_edit_profile.php" method="post">

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
 Name :  <input   type = "text"  name = "customer_name" maxlength="10"
         <?php echo 'value="' . $name. '"'; ?>><br><br>
 
 <p> <label for="">Password:</label>
 <span>******</span> | <a href="oosd_change_password.php">
             Change Password</a></p>
 Email: <input type = "email" name = "customer_email" 
          <?php echo 'value="' . $email . '"'; ?> ><br><br>
 NIC :   <input   type = "text"  name =  "customer_nic"
           <?php echo 'value="' . $nic . '"'; ?>><br><br>
 TP.no : <input   type = "INT"   name = "customer_tp"
           <?php echo 'value="' . $tp . '"'; ?>><br><br>
 Address: <textarea name="customer_address" rows="5" cols="30"
           <?php echo 'value="' . $address . '"'; ?>></textarea><br><br>
 Section: <input  type = "text"  name = "customer_section"
              <?php echo 'value="' . $section . '"'; ?>><br><br>
 Gender: <input   type = "radio" name = "gender" value = "male"> male
         <input   type = "radio" name = "gender" value = "female"> female
<br>
<br>

<button type = "submit" name = "submit">Save</button>
<button type = "submit" name = "back"><a href="oosd_user_profile.php">
				My Profile</a></button>
<button type = "submit" name = "home" ><a href ="oosd_obtions.php">
				Home</a></button>
</form>

</body>
</html>

