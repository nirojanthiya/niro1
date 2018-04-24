<?php

session_start();

if (isset($_GET['logout']))
{
	echo '<p class="info">succesfully loged out</p>';
}

if (isset($_GET['loginf']))
{
	echo '<p class="error">invalid password or id</p>';
}

?>


<html>
<body>

<h1>Voccational Training Center</h1>
<form action="oosd_get.php" method="post">
<b>Name : <b> <input type="text" name="customer_name">
<b>ID :<b> <input type="int" name="customer_id">
<b>Password : <b> <input type="password" name="customer_password">

<br>
<br>

<button type="submit"  name="Login">Login</button><p>

<a href="oosd_create_account.php" >Create Account</a>
</form>

<?php

//require 'dd_get.php';
$SESSION = array();
?>


</body>
</html>
