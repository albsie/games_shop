<?php
require_once("config/init.php");
session_start();
session_unset();
session_destroy();
$_SESSION = [];
header('Location: index.php');
 ?>
