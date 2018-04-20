
<?php ?>
<?php
session_start();
$host='localhost';
$user='root';
$password='';
$db ='dd';
echo "<h1>Door Delivery</h1>";
$connection = mysqli_connect('localhost', 'root', '', 'dd');
if (@mysql_connect($host,$user,$password))
{	
	if(@mysql_select_db('dd'))
	{
		$ddquery="SELECT * FROM `dd1` ";
		if($is_ddquery_run=mysql_query($ddquery))
		{
			$raw_id = trim($_POST["customer_id"]); /// uese function
			$clean_id = filter_var($raw_id,FILTER_VALIDATE_INT);
			
			$raw_password = trim($_POST["customer_password"]);
			$clean_password = filter_var($raw_password,FILTER_VALIDATE_INT);
			
			if($clean_id && $clean_password)
			{
				
				$loopcount=0;
				while($ddquery_execute=mysql_fetch_assoc($is_ddquery_run))
				{
					/*echo '<table border="5" style="width:330px">
					<tr><td>'.$ddquery_execute['id'].
					'</td><td>'.$ddquery_execute['password']
					.'</td><tr><table>';*/
				
					if($_POST["customer_id"]===$ddquery_execute['id'])
					{
						
						if($_POST["customer_password"]===$ddquery_execute['password'])
						{
							
							$_SESSION['user_id'] = $ddquery_execute['id'];
							$_SESSION['user_name'] = $ddquery_execute['name'];
							$_SESSION['tablename'] = '_'.$ddquery_execute['NIC'];
							
							echo 'welcome'." ".$ddquery_execute['name'].'<br>';
							
							// updating last login
							$query = "UPDATE dd1 SET last-login = NOW() ";
							$query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";
							
							$result_set = mysqli_query($connection,$query);
							
							//if(!$result_set){
							//die("daTabase query failed.");}
							
							// redirect to obtions
							header('Location: dd_obtions.php');
						}
						else
						{
							//echo 'invalid password';
							//session_start();
							header('Location: dd_login.php?loginf');
							echo 'wrong password';
						}
					}
					$loopcount+=1;
				}
				echo "loopcount =".$loopcount.'<br>';////// if id not found
			}
			else
			{
				if(!($clean_id)){   /// not includes all cases
					echo " wrong ID " .'<br>';
				}
				else{
				echo " wrong password" .'<br>';}
			}
		}
		else
		{
			echo 'wrong table';
		}
	}
}

/*if (!isset("customer_id"))
{
	header('Location: dd_login.php');
}*/





/*$raw_name =trim($_POST["customer_id"]);
$clen_name = filter_var($raw_name,FILTER_VALIDATE_INT); /////validate

if(( $clen_name))
{
	echo "ID is = ".$clen_name;
}*/
	
/*function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$name = test_input($_POST["customer_id"]);

echo "ID is = ".$name;*/

?>



