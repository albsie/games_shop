<?php

# Database Connection
$host = "localhost";
$dbname = "games_shop";
$username = "root";
$password = "";

// $con = mysqli_connect($host, $username, $password, $dbname) or die(mysqli_connect_error());

$con = new PDO('mysql:host=localhost;dbname=gamees_shop',$username, $password) or die("Verbindung fehlgeschlagen");
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
