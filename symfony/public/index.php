<?php
    $db_host    = "localhost";
    $db_user    = "root";
    $db_pass    = "root";
    $connection = new mysqli($db_host, $db_user, $db_pass);

    if ($connection->connect_error) {
        die("Database connection failed!" .
            "(" . mysqli_connect_errno() . ")"
        );
    }

    $db_name = "test";
    $query = "CREATE SCHEMA IF NOT EXISTS " . $db_name;

    if ($connection->query($query) !== TRUE) {
        die($connection->error);
    }

    $connection->connect($db_host, $db_user, $db_pass, $db_name);

    $db_table = "users";
    $query = "CREATE TABLE IF NOT EXISTS " . $db_table . " (
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    username VARCHAR(30) NOT NULL,
                    password VARCHAR(30) NOT NULL
            ) DEFAULT CHARSET=utf8";

    if ($connection->query($query) !== TRUE) {
        die($connection->error);
    } else {
        echo "<h1 style=\"font-family: sans-serif; font-size: 60px; color: rgba(180, 100, 207, 0.7); text-align: center\">Have done!</h1>";
    }
