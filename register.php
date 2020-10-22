<?php
include_once "content/header.php";
# Aufgabe 1: Erhalte alle Werte der Formularfelder mit var_dump
if(isset($_POST['register'])){
  echo "<pre>";
  var_dump($_POST);
  echo "</pre>";
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
}
?>
<main class="container">

<h1>Registriere dich für den Games Shop</h1>
<form method="post">
  <div class="form-group">
    <label for="firstname">Vorname</label>
    <input type="firstname" name="firstname" class="form-control" id="firstname">
    </div>
    <div class="form-group">
      <label for="lastname">Nachname</label>
      <input type="lastname" name="lastname" class="form-control" id="lastname">
      </div>
  <div class="form-group">
    <label for="email">Email Adresse</label>
    <input type="email" name="email" class="form-control" id="email">
    </div>
  <div class="form-group">
    <label for="password">Passwort</label>
    <input type="password" name="password" class="form-control" id="password">
  </div>
  <div class="form-group">
    <label for="passwordRpt">Passwort Wiederholen</label>
    <input type="password" name="passwordRpt" class="form-control" id="passwordRpt">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" name="chkbox" class="form-check-input" id="chkbox">
    <label class="form-check-label" for="chkbox">Bestätige die AGB's</label>
  </div>
  <button type="submit" name="register" class="btn btn-primary">Registrieren</button>
</form>
</main>
<?php
include_once "content/footer.php";
?>
