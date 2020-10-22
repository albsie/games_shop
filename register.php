<?php
include_once "content/header.php";
# Erhalte alle Werte der Formularfelder mit var_dump
var_dump($_POST);
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
