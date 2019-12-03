<?php
	global $mysqli;
	define('HOST','127.0.0.1');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','shades_db');
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE)
	or die("Couldn't connect to the database!");
?>
