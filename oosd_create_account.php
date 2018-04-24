
<?php
session_start();
require 'oosd_functions.php';

///dd_add_customer.php
$errors = array();

$servername = "localhost";
		$username   = "root";
		$password_db   = "";
		$dbname     = "dd";

		// create connection_aborted

		$conn = mysqli_connect($servername,$username,$password_db,$dbname);

$name = '';
$id = '';
$password = '';
$email = '';
$nic = '';
$tp = '';
$address = '';
$section = '';
$character = '';

if(isset($_POST['submit']))
{
	$name = $_POST['customer_name'];
	$id = $_POST['customer_id'];
	$password = $_POST['customer_password'];
	$address = $_POST['customer_address'];
	$email = $_POST['customer_email'];
	$nic = $_POST['customer_nic'];
	$tp = $_POST['customer_tp'];
	$section = $_POST['customer_section'];
	$character = $_POST['user_character'];
	
	//checking required fields
	$reg_fields = array('customer_name', 'customer_password',
			 'customer_email', 'customer_nic',
		     'customer_tp','customer_address', 'customer_section', 
				'user_character');
				  
	$errors = array_merge($errors, check_reg_fields($reg_fields));
	
	//checking max length
	$max_len_fields = array('customer_name' => 5,
	         'customer_password' => 50,'customer_email' => 15, 
			 'customer_nic' => 50,'customer_tp' => 50,
             'customer_address' => 50, 'customer_section' => 50);
				  
	foreach($max_len_fields as $field => $max_len) 
	{
		if(strlen(trim($_POST[$field]))>$max_len)
		{
			$errors[] = $field . ' must be less than '. $max_len.' characters';
		}
	}
	
	// checking if email is already exists
	$email = mysqli_real_escape_string($conn, $_POST['customer_email']);
	$query = "SELECT * FROM dd1 WHERE email = '{$email}' LIMIT 1";
	$result_set = mysqli_query($conn,$query);
	
	if($result_set)
	{
		if(mysqli_num_rows($result_set) == 1 ){
		$errors[] = 'Email address already exists';}
	}
}


if(isset($_POST['submit']))
{
	if (empty($errors))   ////  opposie to !
	{
		
		// check connection 
		if (!$conn)
		{
			die ("connection failed : ". mysqli_connect_error());
		}
		
		// save password as encripted variables
		$password = mysqli_real_escape_string($conn,$_POST['customer_password']);
		//$hasshed_password = shal($password);

		$sql = "INSERT INTO dd1 (id, password, email, name, NIC, TPno, address, section, job)
				VALUES ('$_POST[customer_id]', '$_POST[customer_password]',
				'$_POST[customer_email]','$_POST[customer_name]',
				'$_POST[customer_nic]','$_POST[customer_tp]',
				'$_POST[customer_address]', '$_POST[customer_section]', '$_POST[user_character]')";
			
		$tablename='_'.$_POST['customer_nic'];
		//$_SESSION['tablename'] = $tablename;
		
		$sqltable =sprintf( "CREATE table %s (ID INT auto_increment, 
				list VARCHAR(200), date datetime, state TEXT, primary key(ID) )",$tablename);
				
		if (mysqli_query($conn, $sql))
		{
			if(mysqli_query($conn, $sqltable)){
			echo "new record created sucessfuly";}
			header('Location: oosd_first_login.php');
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
<form action="oosd_create_account.php" method="post">

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
 ID :    <input   type = "INT"   name = "customer_id"
          <?php echo 'value="' . $id. '"'; ?>><br><br>
 Password: <input type = "password" name = "customer_password" required><br><br>
 Email: <input type = "email" name = "customer_email" 
          <?php echo 'value="' . $email . '"'; ?> ><br><br>
 NIC :   <input   type = "text"  name =  "customer_nic"
           <?php echo 'value="' . $nic . '"'; ?>><br><br>
 TP.no : <input   type = "INT"   name = "customer_tp"
           <?php echo 'value="' . $tp . '"'; ?>><br><br>
 Address: <textarea name="customer_address" rows="5" cols="30"
           <?php echo 'value="' . $address . '"'; ?>></textarea><br><br>
 Course: <input  type = "text"  name = "customer_section"
              <?php echo 'value="' . $section . '"'; ?>><br><br>
Job: <input  type = "text"  name = "user_character"
              <?php echo 'value="' . $character . '"'; ?>><br><br>
			  
 Gender: <input   type = "radio" name = "gender" value = "male"> male
         <input   type = "radio" name = "gender" value = "female"> female
<br>
<br>

<button type = "submit" name = "submit">Save</button>
</form>

</body>
</html>

