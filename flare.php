<?php

function getFlare($text, $counter){
	$name = $counter->Name;
	
	switch($name)
	{
		case 'Wedding':
			return "{$text}-ish visitors";
			break;
		default:
			return $text;
	}

}

?>