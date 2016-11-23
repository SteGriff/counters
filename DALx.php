<?php

$db_now = 'utc_timestamp()';

function db(){
	//Connect to db using MySQLi
	$sv = "db425111171.db.1and1.com";
	$un = "dbo425111171";
	$conn = new mysqli($sv, $un, "password", "db425111171");
	if ($conn->connect_error) die("Could not connect to database: " . $conn->connect_error);
	return $conn;
}

function getNamedCounter($name, $db){
	$result = $db->query("select * from page_counters where Name = '$name'");
	return $result->fetch_object();
}

function trackVisit($id, $db){
	global $db_now;
	
	//Increment counter (page_counters)
	$db->query("update page_counters set Counter = Counter + 1 where ID = '$id'");
	
	//Add tracking entry (page_visits)
	$ip = $_SERVER['REMOTE_ADDR'];
	$db->query("insert into page_visits(CounterID, Visited, IP) values($id, $db_now, '$ip')");
}

?>