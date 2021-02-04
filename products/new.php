<?php
require_once('../config/init.php');
require_once('../config/config.php');
require_once "../config/db.php";
include_once "../content/header.php";

$errors = [];


if(isset($_POST['newProduct'])){
$productName = filter_var($_POST['productName'], FILTER_SANITIZE_STRING);
$productPublisher = filter_var($_POST['productPublisher'], FILTER_SANITIZE_STRING);
$productDate = $_POST['productDate'];
$productGenre = $_POST['productGenre'];
$productPrice = filter_var($_POST['productPrice'], FILTER_SANITIZE_NUMBER_FLOAT);
$productAmount = filter_var($_POST['productAmount'], FILTER_VALIDATE_INT);
$productUSK = $_POST['productUSK'];
if (!file_exists("../assets/productIMG")){
  mkdir("../assets/productIMG",0777,true);
}
/*
if (!is_dir("../assets/productIMG")){
  mkdir("../assets/productIMG",0777,true);
}
*/
$path = $_FILES['productIMG']['name'];
var_dump($path);
move_uploaded_file($_FILES['productIMG']['tmp_name'], "../assets/productIMG/". $path);

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
/*
if($productIMG ===''){
  $errors['productIMG'] = "Geben Sie einen Wert ein";
}
*/
#var_dump($productIMG);
#copy($productIMG,"files");


if(count($errors)===0){
  $_POST = [];
  $insert = "INSERT INTO products (
    name, publisher, release_date, genre_id, price, amount, usk_id, img_path)
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
    'productGenre' => $productGenre,
    'productPrice' => $productPrice,
    'productAmount' => $productAmount,
    'productUSK' => $productUSK,
    'productIMG' => $path
  ]);
} catch(PDOException $e){
    if ($e->getCode() == 23000) {
         $errors['productName'] = "Game ist bereits vorhanden";
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
      <form method="post" class="form-inline" enctype="multipart/form-data">
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
      <input type="number" step=".01" name="productPrice" class="form-control  mb-3 form-group" id="product" aria-describedby="Genre" placeholder="Preis">
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
      <?= isset($errors['productName'])?'<div class="error">'. $errors['productName'] . '</div>':''?>
      </form>
    </div>
  </section>
</main>
<?php
include_once "../content/footer.php";
?>
