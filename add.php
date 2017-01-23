<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// add config file
require_once 'config.php';

// check to see if the form has been submitted
if (isset($_POST['name'])) 
{
	$name = preg_replace('/[^0-9a-zA-Z]/i', ' ', $_POST['name']);

	if ($name === "")
	{
		echo "Sorry, you are trying to add empty string.";
		exit();
	}

	$name = $db->real_escape_string(ucfirst($name));	

	$query = "SELECT * FROM COMPANY WHERE NAME = '$name' LIMIT 1;";
	$result = $db->query($query);

	$matchCount = $result->num_rows;

	if ($matchCount > 0)
	{
		echo "You are trying to add duplicate company, the company name is already exists.";
		exit();
	}

	$query = "INSERT INTO COMPANY (NAME, DATE_CREATED) VALUES ('$name', NOW());";

	if (!$db->query($query))
	{
		$output = "Failed to add $name: (". $db->errno .") " . $db->error;
	} else {
		$output = "$name Successfully added.";
	}
	

	echo $output;	
} else {
	header('location: index.php');
	exit();
}
