<?php
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}
require_once("../config/init.php");

$path_parts = pathinfo($_SERVER['REQUEST_URI']);
$filename = $path_parts['filename'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <link rel="stylesheet" href="<?= ROOT_PATH . 'css/master.css?t=' . time()?>">
    <title>Spiele Shop</title>
  </head>
  <body>
  <header>
    <nav class="navbar navbar-expand navbar-dark bg-primary">
      <a class="navbar-brand" href="<?= ROOT_PATH . 'index.php'?>">
        <img src="<?= ROOT_PATH . 'assets/image/games.png'?>" alt="games">
      </a>
       <div class="collapse navbar-collapse row" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
           <li class="nav-item <?=$filename==='index'||$filename===ROOT_URL?'active':''?>">
             <a class="nav-link" href="<?= ROOT_PATH . 'index.php'?>">Home</a>
           </li>
           <li class="nav-item <?=$filename==='shop'?'active':''?>">
             <a class="nav-link" href="<?= ROOT_PATH . 'shop.php'?>">Shop</a>
           </li>
           <li class="nav-item <?=$filename==='new'?'active':''?>">
             <a class="nav-link" href="<?= ROOT_PATH . 'products/new.php'?>">Produkte anlegen</a>
           </li>
           <li class="nav-item <?=$filename==='edit'?'active':''?>">
             <a class="nav-link" href="<?= ROOT_PATH . 'products/edit.php'?>">Produkte verwalten</a>
           </li>
           <li class="nav-item <?=$filename==='settings'?'active':''?>">
             <a class="nav-link" href="<?= ROOT_PATH . 'products/settings.php'?>">Einstellungen</a>
           </li>
         </ul>
         <ul class="navbar-nav mr-right">
           <?php if(isset($_SESSION['email'])): ?>
             <li class="nav-item active">
               <span class="nav-link">Hallo <?=isset($_SESSION['firstname'])?$_SESSION['firstname']:'';?></span>
             </li>
           <li class="nav-item <?=$filename==='shoppingcart'?'active':''?>">
             <a class="nav-link" href="<?= ROOT_PATH . 'shoppingcart.php'?>">Warenkorb</a>
           </li>
           <li class="nav-item <?=$filename==='logout'?'active':''?>">
              <a class="nav-link" href="<?= ROOT_PATH . 'logout.php'?>">Abmelden</a>
           </li>
            <?php else:?>
           <li class="nav-item <?=$filename==='login'?'active':''?>">
             <a class="nav-link" href="<?= ROOT_PATH . 'login.php'?>">Anmelden</a>
           </li>
           <li class="nav-item <?=$filename==='register'?'active':''?>">
             <a class="nav-link" href="<?= ROOT_PATH . 'register.php'?>">Registrieren</a>
           </li>
           <?php endif?>
         </ul>
       </div>
   </nav>
  </header>
