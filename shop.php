<?php
if(!isset($_SESSION['email'])){
  session_start();
}
var_dump($_SESSION);
require_once('config/config.php');
include_once "content/header.php";
?>
<main class="container">

</main>
<?php
include_once "content/footer.php";
?>
