<?php
require_once "../config/init.php";
require_once "../config/db.php";
require_once "../config/config.php";
include_once "../content/header.php";

$select = "SELECT * FROM products";


// returns the result of a prepared query as a PDO Statement object.
// if an error occurs the error is returned (either as String or False depending on the error)
function prepare_query(string $query_string, array $query_items){
  global $con;
  try {
    $statement = $con->prepare($query_string);
    $statement->execute($query_items);
    return $statement; // that's stupid
  } catch(PDOException $e){
    return $e;
  }
}

// returns the querys next row as an assoc array
function query_as_array(PDOStatement $query): array{
  return $query->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['register'])) {
  $SQL_String = "UPDATE products SET price = :price, amount = :amount WHERE id = :id";
  $price = $_POST['price'];
  $amount = $_POST['amount'];
  $id = $_POST['id'];

  try {
    $state = $con->prepare($SQL_String);
    $state->execute([
      'price' => $price,
      'amount' => $amount,
      'id' => $id
    ]);
  } catch(PDOException $e){
  }
  
}
// creates an assoc array containing all the necessary values
if (isset($_POST['id'])){
    $select_str = "SELECT * FROM products WHERE id = :id LIMIT 1;"; // Limit limits the amount of rows in the query result
    $id = $_POST['id'];
    $items = ["id" => $id];
    $query_result = prepare_query($select_str, $items);

    // the mentioned array
    $query_result = query_as_array($query_result);
}
 ?>
<main class="container" id="editMain">
<section>
  <h2>Produkte verwalten</h2>
  <div class="products">
      <form method="post" class="form-inline">
          <label for="products">Produkt auswählen: </label>
          <select id="products" name="id">
            <?php if (!isset($_POST["id"])): ?>
              <option value=-1 disabled selected>
              </option>
            <?php endif; ?>

            <?php foreach ($con->query("SELECT id, name FROM products;") as $key => $value): ?>
              <option value=<?=$value['id']?> <?=isset($_POST['id']) && $_POST['id'] == $value['id']  ? "selected": ""?>>
                <?= $value['name'] ?>
              </option>
                <?php endforeach ?>
          </select>
          <?php if (isset($_POST["id"])): ?>
            <label for="price">Preis:  </label>
            <input id="price" type="text" name="price" value="<?=isset($_POST['id']) ? $query_result['price'] : "" ?>">
            <label for="amount"> Anzahl: </label>
            <input id="amount" type="text" name="amount" value="<?=isset($_POST['id']) ? $query_result['amount'] : "" ?>">
          <button type="submit" name="register" class="btn btn-primary mx-sm-5 mb-3 form-group">Speichern</button>
          <?php endif; ?>
        </form>
      </div>

          <table>
            <tr>
              <td>Name</td>
              <td>
                <?php if (isset($_POST['id'])): ?>
                    <?= $query_result['name'] ?>
                <?php endif; ?>
              </td>
            </tr>

            <tr>
              <td>Publisher</td>
              <td>
                <?php if (isset($_POST['id'])): ?>
                    <?= $query_result['publisher'] ?>
                <?php endif; ?>
              </td>
            </tr>

            <tr>
              <td>release</td>
              <td>
                <?php if (isset($_POST['id'])): ?>
                    <?= $query_result['release_date'] ?>
                <?php endif; ?>
              </td>
            </tr>

            <tr>
              <td>Price</td>
              <td>
                <?php if (isset($_POST['id'])): ?>
                    <?= $query_result['price'] ?>
                <?php endif; ?>
              </td>
            </tr>

            <tr>
              <td>Amount</td>
              <td>
                <?php if (isset($_POST['id'])): ?>
                    <?= $query_result['amount'] ?>
                <?php endif; ?>
              </td>
            </tr>

            <tr>
              <td>USK</td>
              <td>
                <?php if (isset($_POST['id'])): ?>
                    <?= $query_result['usk_id'] ?>
                <?php endif; ?>
              </td>
            </tr>
          </table>
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
