<?php

function verify_query($result_set)
{
	global $connetion;
	
	if(!result_set)
	{
		die("Database query failed: ".mysqli_error());
	}
}

function check_reg_fields($reg_fields)
{
	// checks required fields
	$errors = array();
	
	foreach ($reg_fields as $field)
	{
		if(empty(trim($_POST[$field]))){
		$errors[] = $field.' is required';}
	}
	return $errors;
}

// email validation
//function is_email($email){}
?>