<?php

require 'DAL.php';

$fontFiles = getFontList();
foreach($fontFiles as $f)
{
	echo "<option>$f</option>";
}

?>