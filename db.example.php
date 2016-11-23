<?php

function db(){
	//Connect to db using MySQLi
	$sv = "server.host.name.com";
	$un = "username";
	$conn = new mysqli($sv, $un, "password", "database-name");
	if ($conn->connect_error) die("Could not connect to database: " . $conn->connect_error);
	return $conn;
}

?>