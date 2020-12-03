<?php

# Database Connection
$host = "localhost";
$dbname = "games_shop";
$username = "root";
$password = "";

$con = mysqli_connect($host, $username, $password, $dbname) or die(mysqli_connect_error());
