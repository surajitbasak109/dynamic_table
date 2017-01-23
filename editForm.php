<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// add config file
require_once 'config.php';

$editid = filter_input(INPUT_GET, 'editid');
$output = '';
if (!isset($editid))
{
	header('location: index.php');
	exit();
}

$editid = preg_replace('/[^0-9]/i', '', $editid);
	
if ($editid === "")
{
	header('location: index.php');
	$db->close();
	exit();
}

$result = $db->query("SELECT * FROM COMPANY WHERE ID = '$editid';");

$matchCount = $result->num_rows;

if ($matchCount === 0)
{
	echo "That company is not exist. Cannot proceed.";
	$db->close();
	exit();
}

// check to see if the form has been submitted
$company_id = filter_input(INPUT_POST, 'id');
$company_name = filter_input(INPUT_POST, 'editname');
if (isset($company_id) && isset($company_name))
{
	
	if (!$db->query("UPDATE COMPANY SET NAME = '$company_name' WHERE ID = '$company_id';"))
	{
		echo "Failed to update:(". $db->errno .")" .$db->error;
	}
	else
	{
		echo "$company_name successfully updated.";
	}
	
}


while ($row = $result->fetch_assoc())
{
	$output .= '<form action="edit.php" method="post" autocomplete="off"
	id="editForm" target="_blank">
			<label for="name">Company name</label>
			<input type="text" name="editname" id="name" value="'. $row['NAME'] .'" required />
			<input type="submit" value="Edit" />
			<input type="hidden" value="'. $row['ID'] .'" name="id" />
			<p class="help-block"></p>
		</form>';
}

echo $output;

