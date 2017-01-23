<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// add config file
require_once 'config.php';

$delid = filter_input(INPUT_GET, 'delid');

if (!isset($delid))
{
	header('location: index.php');
	exit();
}

$delid = preg_replace('/[^0-9]/i', '', $delid);
	
if ($delid === "")
{
	header('location: index.php');
	$db->close();
	exit();
}

$result = $db->query("SELECT * FROM COMPANY WHERE ID = '$delid';");

$matchCount = $result->num_rows;

if ($matchCount === 0)
{
	echo "That company is not exist. Cannot proceed.";
	$db->close();
	exit();
}

$company_name = '';

while ($row = $result->fetch_assoc())
{
	$company_name = $row['NAME'];
}	

$result = $db->query("DELETE FROM COMPANY WHERE ID = '$delid' LIMIT 1;");

echo "<strong>&lsquo;$company_name&rsquo;</strong> has been deleted.";
$db->close();

