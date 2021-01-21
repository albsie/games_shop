<?php
require_once "config/db.php"; # schmeist ein Fatal Error
include_once "content/header.php"; # schmeist es ein Warning

# Aufgabe 1: Erhalte alle Werte der Formularfelder mit var_dump
$errors = [];

if(isset($_POST['register'])){
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$passwordRpt = filter_var($_POST['passwordRpt'], FILTER_SANITIZE_STRING);
$conditions = filter_var($_POST['chkbox'], FILTER_VALIDATE_BOOLEAN);
// $email = escapeString($con, $email);
// $firstname = escapeString($con, $firstname);
// $lastname = escapeString($con, $lastname);

if($firstname === ''){
  $errors['firstname'] = "Geben Sie einen Wert ein";
} elseif (strlen($firstname) < 3) {
  $errors['firstname'] = "Ihre Eingabe ist zu kurz";
}
if($_POST['lastname'] === ''){
  $errors['lastname'] = "Geben Sie einen Wert ein";
} elseif (strlen($_POST['lastname']) < 3) {
  $errors['lastname'] = "Ihre Eingabe ist zu kurz";
}
if(!$email){
  $errors['email'] = "Ihre Eingabe ist nicht korrekt";
}
if(trim($password) === ''){
  $errors['password'] = "Geben Sie einen Wert ein";
} elseif (strlen($password) < 6) {
  $errors['password'] = "Ihre Eingabe muss 6 Zeichen haben";
}
if($password !== $passwordRpt){
  $errors['passwordRpt'] = "Ihre Passwörter stimmen nicht überein";
}
if(!$conditions){
  $errors['chkbox'] = "Bitte bestätigen Sie die AGB's";
}
if(count($errors)===0){
  $password = password_hash($password, PASSWORD_BCRYPT);
  $insert = "INSERT INTO users (
    firstname, lastname, email, password, conditions)
  VALUES (
    :firstname,
    :lastname,
    :email,
    :password,
    :conditions
  )";
try {
  $state = $con->prepare($insert);
  $state->execute([
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email,
    'password' => $password,
    'conditions' => $conditions
  ]);
} catch(PDOException $e){
    if ($e->getCode() == 23000) {
         $errors['email'] = "Email Adresse ist bereits vorhanden";
   } else {
        $errors['other'] = "Etwas hat nicht funktioniert, versuchen Sie es noch einmal";
   }
}

  //mysqli_query($con, $insert) or die(mysqli_error($con));
  //start Session
  if(count($errors)===0){
    if(session_id() == '' || !isset($_SESSION)) {
        session_start();
    }
    $_SESSION['id'] = $con->lastInsertId();
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;
    header('Location: shop.php');
  } else{
    session_unset();
    session_destroy();
    $_SESSION = [];
  }
  }
}
function escapeString($connection, $data){
  return $connection->mysqli_escape_string(trim($data));
}
?>
<main class="container">

<h1>Registriere dich für den Games Shop</h1>
<?= isset($errors['other'])?'<div class="error">'. $errors['other'] . '</div>':''?>
<form method="post">
  <div class="form-group">
    <label for="firstname">Vorname</label>
    <input type="firstname" name="firstname" value="<?= isset($_POST['firstname'])?$_POST['firstname']:'';?>" class="form-control" id="firstname">
<?= isset($errors['firstname'])?'<div class="error">'. $errors['firstname'] . '</div>':''?>
    </div>
    <div class="form-group">
      <label for="lastname">Nachname</label>
      <input type="lastname" name="lastname" value="<?= isset($_POST['lastname'])?$_POST['lastname']:'';?>" class="form-control" id="lastname">
<?= isset($errors['lastname'])?'<div class="error">'. $errors['lastname'] . '</div>':''?>
      </div>
  <div class="form-group">
    <label for="email">Email Adresse</label>
    <input type="email" name="email" value="<?= isset($_POST['email'])?$_POST['email']:'';?>" class="form-control" id="email">
<?= isset($errors['email'])?'<div class="error">'. $errors['email'] . '</div>':''?>
    </div>
  <div class="form-group">
    <label for="password">Passwort</label>
    <input type="password" name="password" class="form-control" id="password">
<?= isset($errors['password'])?'<div class="error">'. $errors['password'] . '</div>':''?>
  </div>
  <div class="form-group">
    <label for="passwordRpt">Passwort Wiederholen</label>
    <input type="password" name="passwordRpt" class="form-control" id="passwordRpt">
<?= isset($errors['passwordRpt'])?'<div class="error">'. $errors['passwordRpt'] . '</div>':''?>
  </div>
  <div class="form-group form-check">
    <input type="hidden" name="chkbox" value="off">
    <input type="checkbox" name="chkbox" class="form-check-input" id="chkbox"
    <?=isset($_POST['chkbox'])&& $_POST['chkbox']==='on'?'checked': ''?>>
    <label class="form-check-label" for="chkbox">Bestätige die AGB's</label>
<?= isset($errors['chkbox'])?'<div class="error">'. $errors['chkbox'] . '</div>':''?>
  </div>
  <button type="submit" name="register" class="btn btn-primary">Registrieren</button>
</form>
</main>
