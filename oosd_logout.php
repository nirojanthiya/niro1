<?php

session_start();
$SESSION = array();

/*if(isset($_COOKIE[session_name()]))
{
	setcookie(session_name(), '', time()-86400, '/');
}

session_destroy();*/

header('Location: oosd_login.php?logout');

?>