<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// add config file
require_once 'config.php';

// select all from company
$query_pages = "SELECT * FROM COMPANY ORDER BY ID DESC;";
$output = '';

// query out the result
$result = $db->query($query_pages);

// get pages from url variable if it is present
$pages = filter_input(INPUT_GET, 'pages');
if (isset($pages))
{
	// replace all except numbers
	$pn = preg_replace('/[^0-9]/i', '', $pages);
} else {
	// if pages variable not set then assign 1
	$pn = 1;
}

// display data per page
$display_count = 10;
// count the total rows
$matchCount = $result->num_rows;
// get last_page dividing matchCount by $display_count
$last_page = ceil($matchCount/$display_count);

// be sure URL variable is no lower than page 1 and no higher than $lastpage
if ($pn < 1) // if it is less than 1
{
	$pn = 1; // force it to be 1
}
else if ($pn > $last_page) // if it is higher than last page
{
	$pn = $last_page; // force it to be last page
}

// This creates the numbers to click in between the next and back button
$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;

$ps = filter_input(INPUT_SERVER, 'PHP_SELF');

if ($pn === 1)
{
	$centerPages .= '&nbsp; <span class="pageNumActive">'. $pn .'</span>&nbsp;';
	$centerPages .= '&nbsp; <a href="javascript:render('. $add1 .')">'. $add1 .'</a>&nbsp;';
}
else if ($pn === $last_page)
{
	$centerPages .= '&nbsp; <a href="javascript:render('. $sub1 .')">'. $sub1 .'</a>&nbsp;';
	$centerPages .= '&nbsp; <span class="pageNumActive">'. $pn .'</span>&nbsp;';
}
else if ($pn > 2 && $pn < ($last_page - 1))
{
	$centerPages .= '&nbsp; <a href="javascript:render('. $sub2 .')">'. $sub2 .'</a>&nbsp;';
	$centerPages .= '&nbsp; <a href="javascript:render('. $sub1 .')">'. $sub1 .'</a>&nbsp;';
	$centerPages .= '&nbsp; <span class="pageNumActive">'. $pn .'</span>&nbsp;';
	$centerPages .= '&nbsp; <a href="javascript:render('. $add1 .')">'. $add1 .'</a>&nbsp;';
	$centerPages .= '&nbsp; <a href="javascript:render('. $add2 .')">'. $add2 .'</a>&nbsp;';
}
else if ($pn > 1 && $pn < $last_page)
{
	$centerPages .= '&nbsp; <a href="javascript:render('. $sub1 .')">'. $sub1 .'</a>&nbsp;';
	$centerPages .= '&nbsp; <span class="pageNumActive">'. $pn .'</span>&nbsp;';
	$centerPages .= '&nbsp; <a href="javascript:render('. $add1 .')">'. $add1 .'</a>&nbsp;';
}


// This line sets the limit range...the 2 values we place to choose
// a range of rows from database in a query

$limit = 'LIMIT ' . ($pn -1) * $display_count . ', ' . $display_count;

$query = "SELECT * FROM COMPANY ORDER BY ID DESC $limit;";

$result2 = $db->query($query);

// pagination display
$paginationDisplay = ""; // initialize the pagination output variable

if ($last_page != "1")
{
	// this shows the user what page they are on, and the total number of pagess
	$paginationDisplay .= 'Page <strong>'. $pn .'</strong> of '.$last_page;
	//if we are not on page 1 we can place the back button
	if ($pn != 1)
	{
		$previous = $pn -1;
		$paginationDisplay .= '&nbsp; <a href="javascript:render('. $previous.')">Back</a>';
	}

	// Lay in the clickable numbers display here between the Back and Next links

	$paginationDisplay .= '<span class="paginationNumbers">'. $centerPages .'</span>';

	// if we are not on the very last page we can place the next button
	if ($pn != $last_page)
	{
		$nextPage = $pn + 1;
		$paginationDisplay .= '&nbsp; <a href="javascript:render('. $nextPage.')">Next</a>';
	}
}


if ($matchCount < 1)
{
	echo "Sorry, there is no more data on system.";
	exit();
}

while ($row = $result2->fetch_assoc()) 
{
	$output .= '<tr id="editForm_'. $row['ID'] .'">
		<td>'. $row['ID'] .'</td>
		<td>'. $row['NAME'] .'</td>
		<td>'. strftime("%d %b, %Y", strtotime($row['DATE_CREATED'])) .'</td>
		<td><a href="javascript:display_edit_form('. $row['ID'] .');" class="edit_link">Edit</a> |
		<a href="javascript:delComp('. $row['ID'] .', \''. $row['NAME'] .'\');">Delete</a></td>
	</tr>';
}

?>

<div class="pagination"><?php echo $paginationDisplay; ?></div>

<table class="company-table">
<tr>
	<th>ID</th>
	<th>Company name</th>
	<th>Last added</th>
	<th>Action</th>
</tr>
<?php echo $output; ?>
</table>
