<?php
require_once "../config/init.php";
require_once "../config/db.php";
require_once "../config/config.php";
include_once "../content/header.php";

$select = "SELECT * FROM products";

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
          <label for="products">Produkt auswählen: </label>
          <select id="products" name="products">
            <?php foreach ($con->query($select) as $key => $value): ?>
              <option value=<?=$value['id']?> <?=isset($_POST['id']) && $_POST['id'] == $value['id']  ? "selected='selected'": ""?>>
                <?= $value['name'] ?>
              </option>
                <?php endforeach ?>
          </select>
          <button type="submit" name="register" class="btn btn-primary mx-sm-5 mb-3 form-group">Speichern</button>
          </div>
          <table>
            <tr>
              <td>Name</td>
              <td>
                <?php foreach ($con->query($select) as $key => $value): ?>
                  <?php if ($value['id'] == "1"): ?>
                    <option>
                      <?= $value['name'] ?>
                    </option>
                  <?php endif; ?>
                <?php endforeach ?>
              </td>
            </tr>

            <tr>
              <td>Publisher</td>
              <td>
                <?php foreach ($con->query($select) as $key => $value): ?>
                  <?php if ($value['id'] == "1"): ?>
                    <option>
                      <?= $value['publisher'] ?>
                    </option>
                  <?php endif; ?>
                <?php endforeach ?>
              </td>
            </tr>

            <tr>
              <td>release</td>
              <td>
                <?php foreach ($con->query($select) as $key => $value): ?>
                  <?php if ($value['id'] == "1"): ?>
                    <option>
                      <?= $value['release_date'] ?>
                    </option>
                  <?php endif; ?>
                <?php endforeach ?>
              </td>
            </tr>

            <tr>
              <td>Price</td>
              <td>
                <?php foreach ($con->query($select) as $key => $value): ?>
                  <?php if ($value['id'] == "1"): ?>
                    <option>
                      <?= $value['price'] ?>
                    </option>
                  <?php endif; ?>
                <?php endforeach ?>
              </td>
            </tr>

            <tr>
              <td>Amount</td>
              <td>
                <?php foreach ($con->query($select) as $key => $value): ?>
                  <?php if ($value['id'] == "1"): ?>
                    <option>
                      <?= $value['amount'] ?>
                    </option>
                  <?php endif; ?>
                <?php endforeach ?>
              </td>
            </tr>

            <tr>
              <td>USK</td>
              <td>
                <?php foreach ($con->query($select) as $key => $value): ?>
                  <?php if ($value['id'] == "1"): ?>
                    <option>
                      <?= $value['usk_id'] ?>
                    </option>
                  <?php endif; ?>
                <?php endforeach ?>
              </td>
            </tr>
          </table>
    </form>

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
