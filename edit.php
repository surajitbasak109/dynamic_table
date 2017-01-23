<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// add config file
require_once 'config.php';

// check to see if the form has been submitted
$company_id = filter_input(INPUT_POST, 'id');
$company_name = filter_input(INPUT_POST, 'editname');
if (isset($company_id) && isset($company_name))
{
	$company_id = $db->real_escape_string(preg_replace('/[^0-9]/i', '', $company_id));
	$company_name = $db->real_escape_string(preg_replace('/[^0-9a-zA-Z]/i', ' ', $company_name));
	
	if (!$db->query("UPDATE COMPANY SET NAME = '$company_name' WHERE ID = '$company_id';"))
	{
		echo "Failed to update:(". $db->errno .")" .$db->error;
	}
	else
	{
		echo "$company_name successfully updated.";
	}
	$db->close();
	
} else {
	header('location: index.php');
	exit();
}
