<h1>
<?php

require 'DAL.php';

//Get name (required)
$name = $_GET['Name'];
if ($name == null)
{
	echo "No Name!";
	die();
}

//Get description (required)
$description = $_GET['Description'];
if ($description == null)
{
	echo "No Description!";
	die();
}

//Get font or default to Arial
$font = !empty($_GET['Font'])
	? $_GET['Font']
	: 'fonts/ARIAL.TTF';
	
//Get font size or default to 16
$fontSize = !empty($_GET['FontSize'])
	? $_GET['FontSize']
	: 16;
	
//Get colour in RGB or default to (10,10,10) (that's dark grey)
$r = !empty($_GET['R'])
	? $_GET['R']
	: 10;
	
$g = !empty($_GET['G'])
	? $_GET['G']
	: 10;
	
$b = !empty($_GET['B'])
	? $_GET['B']
	: 10;

//Create counter in the database and get success/fail
$result = createCounter($name, $description, $font, $fontSize, $r, $g, $b);

//Return success message
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