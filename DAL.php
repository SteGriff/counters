<?php

require 'db.php';

$db_now = 'utc_timestamp()';
$db = db();

function sqlName($s){
	global $db;
	//Allow a set of characters in names/descriptions, including:
	// @ ! : _ - ? . , ' # /
	$result = preg_replace("/[^a-zA-Z0-9@!: _\-\?\.\,\'\#\/]+/", "", $s);
	return trim($db->real_escape_string($result));
}

function sqlInt($i){
	global $db;
	return $db->real_escape_string((int)$i);
}

function getNamedCounter($name, $db){
	global $db;
	$result = $db->query("select * from page_counters where Name = '$name'");
	return $result->fetch_object();
}

function trackVisit($id, $db){
	global $db, $db_now;
	
	//Increment counter (page_counters)
	$db->query("update page_counters set Counter = Counter + 1 where ID = '$id'");
	
	//Add tracking entry (page_visits)
	$ip = $_SERVER['REMOTE_ADDR'];
	$db->query("insert into page_visits(CounterID, Visited, IP) values($id, $db_now, '$ip')");
}

function createCounter($name, $description, $font, $fontSize, $r, $g, $b){
	global $db;
	
	$font = "fonts/ARIAL.TTF";
	
	$name = sqlName($name);
	$description = sqlName($description);
	$font = sqlName($font);
	$fontSize = sqlName($fontSize);
	$r = sqlName($r);
	$g = sqlName($g);
	$b = sqlName($b);
	
	$sql = "insert into 
	page_counters (Name, Description, Counter, FontFile, FontSize, Red, Green, Blue)
	values ('$name','$description', 1, '$font', $fontSize, $r, $g, $b)";

	$r = $db->query($sql);
	
	if ($r){
		return $db->insert_id;
	}
	return false;
}

function getFontList()
{
	return glob('fonts/*');
}

?>