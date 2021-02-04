<?php
require_once('../config/init.php');
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
$genreItems = $con->query($select) or die(mysqli_error($con));

if(isset($_POST['newUSK'])){
    $usk = filter_var($_POST['usk'], FILTER_SANITIZE_STRING);
    if(strlen($usk) > 0){
        $insert = "INSERT INTO usk (usk) VALUES (:usk)";
        try{
            $state = $con->prepare($insert);
            $state->execute(['usk' => $usk]);
        } catch (Exception $e) {
            echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
        }
    }
}
$select = "SELECT * FROM usk";
$USKItems = $con->query($select) or die(mysqli_error($con));

if(isset($_POST['delGenre'])){
    var_dump($_POST['delgenre']);
    $delgenre = filter_var($_POST['delgenre'], FILTER_SANITIZE_STRING);
        $del = "DELETE FROM genre WHERE id = (:delgenre)";
        try{
            $state = $con->prepare($del);
            $state->execute(['delgenre' => $delgenre]);
        } catch (Exception $e) {
            echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
        }
}
$select2 = "SELECT * FROM genre";
$genreItems2 = $con->query($select2) or die(mysqli_error($con));

if(isset($_POST['delUSK'])){
    $delusk = filter_var($_POST['delusk'], FILTER_SANITIZE_STRING);
    if(strlen($delusk) > 0){
        $del2 = "DELETE FROM usk WHERE id = (:delusk)";
        try{
            $state = $con->prepare($del2);
            $state->execute(['delusk' => $delusk]);
        } catch (Exception $e) {
            echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
        }
    }
}
$select3 = "SELECT * FROM usk";
$USKItems2 = $con->query($select3) or die(mysqli_error($con));
?>
<main class="container">
<section>
  <h2>Genre verwalten</h2>
  <?php foreach ($genreItems as $key => $value): ?>
    <div class="">
      <?= $value['name'] ?>
    </div>
  <?php endforeach ?>
  <div class="genre">
    <form method="post" class="form-inline">
    <input type="text" name="genre" class="form-control  mb-3 form-group" id="genre" aria-describedby="Genre" placeholder="Action">
    <button type="submit" name="newGenre" class="btn btn-primary mx-sm-5 mb-3 form-group">Speichern</button>
        <select name="delgenre">
            <?php foreach ($genreItems2 as $key => $valueu): ?>
                <option value="<?= $valueu['id']; ?>"><?= $valueu['name']; ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="delGenre" class="btn btn-primary mx-sm-5 mb-3 form-group">Löschen</button>
    </form>
  </div>
</section>
    <section>
        <h2>USK verwalten</h2>
        <?php foreach ($USKItems as $key => $value): ?>
            <div class="">
                <?= $value['usk'] ?>
            </div>
        <?php endforeach ?>
        <div class="usk">
            <form method="post" class="form-inline">
                <input type="text" name="usk" class="form-control  mb-3 form-group" id="usk" aria-describedby="usk" placeholder="Action">
                <button type="submit" name="newUSK" class="btn btn-primary mx-sm-5 mb-3 form-group">Speichern</button>
                <select name="delusk">
                    <?php foreach ($USKItems2 as $key => $usk2): ?>
                        <option value="<?= $usk2['id']; ?>"><?= $usk2['usk']; ?></option>
                    <?php endforeach ?>
                </select>
                <button type="submit" name="delUSK" class="btn btn-primary mx-sm-5 mb-3 form-group">Löschen</button>
            </form>
        </div>
    </section>
</main>
<?php
include_once "../content/footer.php";
?>
