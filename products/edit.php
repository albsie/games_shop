<?php
require_once "../config/init.php";
require_once "../config/db.php";
require_once "../config/config.php";
include_once "../content/header.php";

$select = "SELECT * FROM products";

?>
<main class="container">
<section>
  <h2>Produkte verwalten</h2>
  <div class="products">
      <form method="post" class="form-inline">
          <label for="products">Produkt auswählen: </label>
          <select id="products" name="products">
            <?php foreach ($con->query($select) as $key => $value): ?>
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
<?php
include_once "../content/footer.php";
?>
