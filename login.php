<?php
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
  $mypassword = "123123";
  $myemail = "test@test.de";
  if(trim($_POST['email']) === ''){
    $errors['email'] = "Geben Sie einen Wert ein";
  } elseif (strlen($_POST['email']) <= 5) {
    $errors['email'] = "Ihre Eingabe ist nicht korrekt";
  } elseif ($_POST['email'] !== $myemail) {
    $errors['email'] = "Ihre Email oder Ihr Passwort ist falsch";
    $errors['password'] = "Ihre Email oder Ihr Passwort ist falsch";
  }
  if(trim($_POST['password']) === ''){
    $errors['password'] = "Geben Sie einen Wert ein";
  } elseif (strlen($_POST['password']) < 6) {
    $errors['password'] = "Ihre Eingabe muss 6 Zeichen haben";
  } elseif ($_POST['password'] !== $mypassword) {
    $errors['password'] = "Ihre Email oder Ihr Passwort ist falsch";
    $errors['email'] = "Ihre Email oder Ihr Passwort ist falsch";
  }
  if(count($errors) === 0){
    if(session_id() == '' || !isset($_SESSION)) {
        session_start();
    }
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['firstname'] = "Sieghard";
    header('Location: shop.php');
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
