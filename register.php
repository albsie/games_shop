<?php
include_once "content/header.php";
# Erhalte alle Werte der Formularfelder mit var_dump
var_dump();
?>
<main class="container">

<h1>Registriere dich für den Games Shop</h1>
<form>
  <div class="form-group">
    <label for="firstname">Vorname</label>
    <input type="firstname" class="form-control" id="firstname">
    </div>
    <div class="form-group">
      <label for="lastname">Nachname</label>
      <input type="lastname" class="form-control" id="lastname">
      </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email">
    </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password">
  </div>
  <div class="form-group">
    <label for="passwordRpt">Password Wiederholen</label>
    <input type="passwordRpt" class="form-control" id="passwordRpt">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="chkbox">
    <label class="form-check-label" for="chkbox">Bestätige die AGB's</label>
  </div>
  <button type="submit" class="btn btn-primary">Registrieren</button>
</form>
</main>
<?php
include_once "content/footer.php";
?>
