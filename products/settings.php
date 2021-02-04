<?php
require_once "../config/db.php";
require_once "../config/config.php";
include_once "../content/header.php";

if(isset($_POST['newGenre'])){
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
$select = "SELECT * FROM genre";
?>
<main class="container">
<section>
  <h2>Genre verwalten</h2>
  <?php foreach ($con->query($select) as $key => $value): ?>
    <div class="">
      <?= $value['name'] ?>
    </div>
  <?php endforeach ?>
  <div class="genre">
    <form method="post" class="form-inline">
    <input type="text" name="genre" class="form-control  mb-3 form-group" id="genre" aria-describedby="Genre" placeholder="Action">
    <button type="submit" name="newGenre" class="btn btn-primary mx-sm-5 mb-3 form-group">Speichern</button>
    </form>
  </div>
</section>
<select class="" name="">
  <?php foreach ($con->query($select) as $key => $valueu): ?>
    <option value="<?=$valueu['name'];?>">
      <?=$valueu['name'];?>
    </option>
  <?php endforeach ?>
</select>
</main>
<?php
include_once "../content/footer.php";
?>
