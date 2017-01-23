<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>List of companies</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
	<div class="wrap">
		<div class="form-wrap">
			<form action="add.php" method="post" autocomplete="off" id="myForm">
				<label for="name">Company name</label>
				<input type="text" name="name" id="name" placeholder="Type company name" required />
				<input type="submit" value="Add" />
				<p class="help-block"></p>
			</form>
		</div>

		<div class="render"></div>
	</div>
	<script src="main.js"></script>
</body>
</html>
