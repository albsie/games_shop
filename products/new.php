<?php
require_once('../config/config.php');
require_once "../config/db.php";
include_once "../content/header.php";

$errors = [];

if(isset($_POST['newProduct'])){
$productName = filter_var($_POST['productName'], FILTER_SANITIZE_STRING);
$productPublisher = filter_var($_POST['productPublisher'], FILTER_SANITIZE_STRING);
#$productDate = filter_var($_POST['productDate'], FILTER_SANITIZE_INT);
$productGenre = filter_var($_POST['productGenre'], FILTER_SANITIZE_INT);
$productPrice = filter_var($_POST['productPrice'], FILTER_SANITIZE_INT);
$productAmount = filter_var($_POST['productAmount'], FILTER_VALIDATE_INT);
$productUSK = filter_var($_POST['productUSK'], FILTER_VALIDATE_INT);
$productIMG = $_POST['productIMG'];


if($productName === ''){
  $errors['productName'] = "Geben Sie einen Wert ein";
}
if($productPublisher === ''){
  $errors['productPublisher'] = "Geben Sie einen Wert ein";
}
if($productDate ===''){
  $errors['productPublisher'] = "Geben Sie einen Wert ein";
}
if($productGenre ===''){
  $errors['productGenre'] = "Geben Sie einen Wert ein";
}
if($productPrice ===''){
  $errors['productPrice'] = "Geben Sie einen Wert ein";
}
if($productAmount ===''){
  $errors['productAmount'] = "Geben Sie einen Wert ein";
}
if($productUSK ===''){
  $errors['productUSK'] = "Geben Sie einen Wert ein";
}
if($productIMG ===''){
  $errors['productIMG'] = "Geben Sie einen Wert ein";
}

#var_dump($productIMG);
copy($productIMG,"files");


if(count($errors)===0){
  $insert = "INSERT INTO products (
    productName, productPublisher, productDate, productGenre, productPrice, productAmount, productUSK, productIMG)
  VALUES (
    :productName,
    :productPublisher,
    :productDate,
    :productGenre,
    :productPrice,
    :productAmount,
    :productUSK,
    :productIMG
  )";
try {
  $state = $con->prepare($insert);
  $state->execute([
    'productName' => $productName,
    'productPublisher' => $productPublisher,
    'productDate' => $productDate,
    'productGenre' => $procutGenre,
    'productPrice' => $productPrice,
    'productAmount' => $productAmount,
    'productUSK' => $productUSK,
    'productIMG' => $productIMG
  ]);
} catch(PDOException $e){
    if ($e->getCode() == 23000) {
         $errors['email'] = "Email Adresse ist bereits vorhanden";
   } else {
        $errors['other'] = "Etwas hat nicht funktioniert, versuchen Sie es noch einmal";
   }
}
}
}

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
      <select id="genre" name="productGenre" class="form-control  mb-3 form-group">
        <?php foreach ($genreItems as $key => $value): ?>
          <option value="<?= $value['id'] ?>">
            <?= $value['name'] ?>
          </option>
        <?php endforeach ?>
      </select>
      <input type="number" name="productPrice" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Preis">
      <input type="number" name="productAmount" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Anzahl">
      <select id="usk" name="productUSK" class="form-control  mb-3 form-group">
        <?php foreach ($uskItems as $key => $value): ?>
          <option value="<?= $value['id'] ?>">
            <?= $value['usk'] ?>
          </option>
        <?php endforeach ?>
      </select>
      <input type="file" name="productIMG" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Bildpfad">
      <button type="submit" name="newProduct" class="btn btn-primary mx-sm-5 mb-3 form-group">Speichern</button>
      </form>
    </div>
  </section>
</main>
<?php
include_once "../content/footer.php";
?>
