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

<h1>Door Delivery</h1>
<form action="dd_get.php" method="post">
<b>Name : <b> <input type="text" name="customer_name">
<b>ID :<b> <input type="int" name="customer_id">
<b>Password : <b> <input type="password" name="customer_password">

<br>
<br>

<button type="submit"  name="Login">Login</button>
</form>

<?php

//require 'dd_get.php';
$SESSION = array();
?>


</body>
</html>
