<?php
require_once "../config/db.php";
require_once('../config/config.php');
include_once "../content/header.php";

$select = "SELECT * FROM products";
$productItems = $con->query($select) or die(mysqli_error($con));

$tableselect = $con->query("SELECT * FROM products WHERE id =") or die(mysqli_error($con))
?>
<main class="container">
<section>
  <h2>Produkte verwalten</h2>
  <div class="products">
      <form method="post" class="form-inline">
          <label for="products">Produkt auswählen: </label>
          <select id="products" name="products">
            <?php foreach ($productItems as $key => $value): ?>
              <option value=<?=$value['id']?>>
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
                <?php foreach ($productItems as $key => $value): ?>

                <?php endforeach ?>?>
                </td>
            </tr>
            <tr>
              <td>Publisher</td>
            </tr>
            <tr>
              <td>release</td>
            </tr>
            <tr>
              <td>Price</td>
            </tr>
            <tr>
              <td>Amount</td>
            </tr>
            <tr>
              <td>USK</td>
            </tr>
          </table>

    </form>

</section>
</main>
<?php
include_once "../content/footer.php";
?>
