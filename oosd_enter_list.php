<?php
session_start();
// checking if a user is logged in
if (!isset($_SESSION["user_id"]))
{
	header('Location: oosd_login.php');
}

?>

<html>
<body>
<h1>
Voccational Training Center
</h1>

	<header>
		<a href="oosd_logout.php">Log Out</a> 
	</header>

<form action = "oosd_confirm_list.php" method = "post">
Write the Quiz : <br>
<textarea name="delivery_list" rows="15" cols="60"></textarea>
<br><br>
<input type = "submit" name = "submit" value = "Upload">
</form>

<button type = "submit" name = "home" ><a href ="oosd_obtions.php">
				Home</a></button>

<button type = "submit" name = "home" ><a href ="oosd_order_state.php">
				Quiz state</a></button>
</body>
</html>