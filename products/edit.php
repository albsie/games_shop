<?php
require_once "../config/db.php";
require_once('../config/config.php');
include_once "../content/header.php";
var_dump($_POST);
$select = "SELECT * FROM products";
$productItems = $con->query($select) or die(mysqli_error($con));
?>
<?php

###  update Befehl für den Button

if (isset($_POST['register'])) {
  $SQL_String = "UPDATE products SET price = :price, amount = :amount WHERE id = :id";
  try {
    $state = $con->prepare($insert);
    $state->execute([
      'price' => $price,
      'amount' => $amount,
      'id' => $id
    ]);
  } catch(PDOException $e){
  }
}

 ?>
<main class="container">
  <section>
    <h2>Produkte verwalten</h2>
    <div class="products">
      <form method="post" class="form-inline">
        <label for="products">Produkt auswählen</label>
        <select id="products" name="products">

          <!-- fills select box with names -->
          <?php foreach ($productItems as $key => $value): ?>
            <option value=<?=$value['id']?> <?=isset($_POST['id']) && $_POST['id'] == $value['id']  ? "selected='selected'": ""?>>
              <?= $value['name'] ?>
            </option>
          <?php endforeach ?>

        </select>


        <button type="submit" name="register" class="btn btn-primary mx-sm-5 mb-3 form-group">Speichern</button>
      </form>
    </div>
  </section>
</main>

<script type="text/javascript">
  "use strict";

  function post(path, params, method='post') {

  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}
var select = document.getElementById("products");
select.addEventListener("change", () =>{
  post('', {'id': select.value});
});
</script>
<?php
include_once "../content/footer.php";
?>
