<h1>
<?php

require 'DAL.php';

$name = $_GET['Name'];
if ($name == null)
{
	echo "No Name!";
	die();
}

$description = $_GET['Description'];
if ($description == null)
{
	echo "No Description!";
	die();
}
	
$font = !empty($_GET['Font'])
	? $_GET['Font'] : 'fonts/ARIAL.TTF';
$fontSize = !empty($_GET['FontSize'])
	? $_GET['FontSize'] : 16;
	
$r = !empty($_GET['R'])
	? $_GET['R'] : 10;
$g = !empty($_GET['G'])
	? $_GET['G'] : 10;
$b = !empty($_GET['B'])
	? $_GET['B'] : 10;

$result = createCounter($name, $description, $font, $fontSize, $r, $g, $b);

if ($result !== false)
{
	echo "Created counter $result!";
}
else{
	echo "Failed to create counter :(";
}

?>
</h1>
<a href="new.htm">&larr; Back</a>