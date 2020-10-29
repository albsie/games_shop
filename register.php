<?php
include_once "content/header.php";
# Aufgabe 1: Erhalte alle Werte der Formularfelder mit var_dump
$errors = [];
if(isset($_POST['register'])){
  $role = 1;
  if($_POST['email'] === 'sigi@ifb.de'){ #euren eigenen alias verwenden
    $role = 2;
  }
  # Aufgabe 2: Validiere alle Daten und gebe eine Fehlermeldung aus wenn:
  # - ein Feld leer ist
  # - firstname & lastname kleiner sind als 2 Zeichen
  # - email kleiner ist als 5 Zeichen
  # - password kleiner ist als 6 Zeichen
  # - passwordRpt nicht mit password zusammenstimmt
  # - chkbox nicht geklickt wurde
  # - gib jeweils eine Fehlermeldung aus
  # Aufgabe 3: bei Fehlerhafter Registrierung sollen die eingegebenen Werte enthalten bleiben.
  # Aufgabe 4: wenn alles richtig ist öffne die shop.php
  # Aufgabe 5: login.php mit email und password erstellen und Aufgaben 1,2,3,4 wiederholen
if($_POST['firstname'] === ''){
  $errors['firstname'] = "Geben Sie einen Wert ein";
} elseif (strlen($_POST['firstname']) < 3) {
  $errors['firstname'] = "Ihre Eingabe ist zu klein";
}
if($_POST['lastname'] === ''){
  $errors['lastname'] = "Geben Sie einen Wert ein";
} elseif (strlen($_POST['lastname']) < 3) {
  $errors['lastname'] = "Ihre Eingabe ist zu klein";
}
if(trim($_POST['email']) === ''){
  $errors['email'] = "Geben Sie einen Wert ein";
} elseif (strlen($_POST['email']) < 5) {
  $errors['email'] = "Ihre Eingabe ist nicht korrekt";
}
if(trim($_POST['password']) === ''){
  $errors['password'] = "Geben Sie einen Wert ein";
} elseif (strlen($_POST['password']) <= 6) {
  $errors['password'] = "Ihre Eingabe muss 6 Zeichen haben";
}
if($_POST['password'] !== $_POST['passwordRpt']){
  $errors['passwordRpt'] = "Ihre Passwörter stimmen nicht überein";
}
if($_POST['chkbox']=== 'off'){
  $errors['chkbox'] = "Bitte bestätigen Sie die AGB's";
}
if(count($errors)===0){
  header('shop.php');
}
}
?>
<main class="container">

<h1>Registriere dich für den Games Shop</h1>
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
<?php
include_once "content/footer.php";
?>
