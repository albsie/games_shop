<?php
require_once('../config/config.php');
include_once "../content/header.php";


$errors = [];

if(isset($_POST['newProduct'])){
$productName = filter_var($_POST['productName'], FILTER_SANITIZE_STRING);
$productPublisher = filter_var($_POST['productPublisher'], FILTER_SANITIZE_STRING);
$productDate = filter_var($_POST['productDate'], FILTER_SANITIZE_STRING);
$productGenre = filter_var($_POST['productGenre'], FILTER_SANITIZE_INT);
$productPrice = filter_var($_POST['productPrice'], FILTER_SANITIZE_STRING);
$productAmount = filter_var($_POST['productAmount'], FILTER_VALIDATE_INT);
$productUSK = filter_var($_POST['productUSK'], FILTER_VALIDATE_INT);


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
        $errors['other'] = "Etwas hat nicht funktioniert, versuchen Sie es noch einmal";
   }
}
}
}
var_dump($insert)
?>
<main class="container">
<section>
  <h2>Neue Produkte</h2>
  <div class="neueProdukte">
    <form class="form-Inline" method="post">
      <input type="text" name="productName" value="">
        <input type="text" name="productPublisher" value="">
          <input type="date" name="productDate" value="">
            <input type="text" name="productGenre" value="">
              <input type="text" name="productPrice" value="">
                <input type="number" name="productAmount" value="">
                  <input type="number" name="productUSK" value="">
                    <input type="text" name="productIMG" value="">
                    <button type="submit" name="newProduct" class="btn btn-primary mx-sm-5 mb-3 form-group"></button>
    </form>
  </div>
</section>
</main>
<?php
include_once "../content/footer.php";
?>
