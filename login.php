<?php
require_once('config/init.php');
require_once "config/db.php"; # schmeist ein Fatal Error
include_once "content/header.php";
#Arbeitsauftrag:
#1. Erstelle ein Login Formular mit Email und Passwort
#2. Prüffe mit var_dump ob die Daten auf dem Server ankommen
#3. Validiere die Daten und gebe eine Fehlermeldung aus, wenn ein Feld leer ist.
#4. Überprüfft euere Anmeldedaten. Übergangslösung Variable mit euren Passwort anlegen
#5. Wenn es keinen Fehler gibt, dann starte die Session und speichere folgende Wert darin ab:
#     - email
#     - firstname = euer Name (Übergangslösung bis wir die Datenbank starten)
$errors = [];
if(isset($_POST['login'])){

  if(trim($_POST['email']) === ''){
    $errors['email'] = "Geben Sie einen Wert ein";
  } elseif (strlen($_POST['email']) <= 5) {
    $errors['email'] = "Ihre Eingabe ist nicht korrekt";
  } else {
    $email = $_POST['email'];
  }

  if(trim($_POST['password']) === ''){
    $errors['password'] = "Geben Sie einen Wert ein";
  } elseif (strlen($_POST['password']) < 6) {
    $errors['password'] = "Ihre Eingabe muss 6 Zeichen haben";
  } else {
    $password = $_POST['password'];
  }

  if(count($errors) === 0){
    #mysqli_real_escape_string
    # filter
    # prepare
    # execute
    $query = mysqli_query($con, "SELECT id, email, firstname, lastname, password FROM users WHERE email = '$email'") or die(mysqli_error($con));
    $data = mysqli_fetch_assoc($query);

    if(mysqli_num_rows($query) === 1){
      $passwordVerify = password_verify($password, $data['password']);
    } else {
      $passwordVerify = false;
    }

    if($passwordVerify){
      if(session_id() == '' || !isset($_SESSION)) {
          session_start();
      }
      $_SESSION['id'] = $data['id'];
      $_SESSION['email'] = $data['email'];
      $_SESSION['firstname'] = $data['firstname'];
      $_SESSION['lastname'] = $data['lastname'];

      header('Location: shop.php');
    } else {
      $errors['email'] = "Ihr Benutzername oder Ihr Passwort ist falsch";
      $errors['password'] = "Ihr Benutzername oder Ihr Passwort ist falsch";
    }
  } else {
    session_unset();
    session_destroy();
    $_SESSION = [];
  }
}
?>
<main class="container">
<h1>Melde dich mit deinen Daten an</h1>
<form method="post">
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
    <button type="submit" name="login" class="btn btn-primary">Anmelden</button>
</form>
</main>

<?php
include_once "content/footer.php";
?>
