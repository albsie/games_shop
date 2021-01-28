<?php
require_once('../config/config.php');
require_once "../config/db.php";
include_once "../content/header.php";

/*
if(isset($_POST['newProduct'])){
  $genre = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);
  if(strlen($genre) > 0){
    $insert = "INSERT INTO genre (name) VALUES (:name)";
try{
      $state = $con->prepare($insert);
      $state->execute(['name' => $genre]);
    } catch (Exception $e) {
    echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
    }
  }
}
*/
$select = "SELECT * FROM genre";
$genreItems = $con->query($select) or die(mysqli_error($con));
$select = "SELECT * FROM usk";
$uskItems = $con->query($select) or die(mysqli_error($con));
?>
<main>
  <section>
    <h2>Neue Produkte</h2>
    <div class="newProduct">
      <form method="post" class="form-inline">
      <input type="text" name="productName" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Produktname">
      <input type="text" name="productPublisher" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Publisher">
      <input type="date" name="productDate" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Erscheinungsdatum">
      <select id="genre" name="genre" class="form-control  mb-3 form-group">
        <?php foreach ($genreItems as $key => $value): ?>
          <option value="<?= $value['id'] ?>">
            <?= $value['name'] ?>
          </option>
        <?php endforeach ?>
      </select>
      <input type="decimal" name="productPrice" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Preis">
      <input type="number" name="productAmount" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Anzahl">
      <select id="usk" name="usk" class="form-control  mb-3 form-group">
        <?php foreach ($uskItems as $key => $value): ?>
          <option value="<?= $value['id'] ?>">
            <?= $value['usk'] ?>
          </option>
        <?php endforeach ?>
      </select>
      <input type="text" name="productIMG" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Bildpfad">
      <button type="submit" name="newProduct" class="btn btn-primary mx-sm-5 mb-3 form-group">Speichern</button>
      </form>
    </div>
  </section>
</main>
<?php
include_once "../content/footer.php";
?>
