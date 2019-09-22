<?php
	$dbhost 	= "localhost";
	$dbuser 	= "root";
	$dbpass 	= "root";
	$connection = new mysqli($dbhost, $dbuser, $dbpass);

	if ($connection->connect_error) {
		die("Database connection failed!" .
			"(" . mysqli_connect_errno() . ")"
		);
	}

	$dbname = "test";
	$query = "CREATE SCHEMA IF NOT EXISTS " . $dbname;

	if ($connection->query($query) !== TRUE) {
	    die($connection->error);
    }

	$connection->connect($dbhost, $dbuser, $dbpass, $dbname);

	$dbtable = "users";
	$query = "CREATE TABLE IF NOT EXISTS " . $dbtable . " (
	            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	            username VARCHAR(30) NOT NULL,
	            password VARCHAR(30) NOT NULL
	) DEFAULT CHARSET=utf8";

	if ($connection->query($query) !== TRUE) {
	    die($connection->error);
    } else {
	    echo "<h1 style=\"font-family: sans-serif; font-size: 60px; color: rgba(180, 100, 207, 0.7); text-align: center\">Have done!</h1>";
    }
