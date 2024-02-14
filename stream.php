
<?php
if(!isset($_POST['eps'])){
  header("Location: index.php");
}
$id = $_POST['judul'];
// Baca file JSON
$json_data = file_get_contents('anime_data.json');

// Konversi JSON menjadi array atau objek PHP
$data = json_decode($json_data, true);

// Ambil id anime dari URL


// Cari anime sesuai id
$anime = null;
foreach ($data as $item) {
    if ($item['judul'] == $id) {
        $anime = $item;
        break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <title></title>
</head>
<body>
  <div class="ratio ratio-16x9">
    <iframe src="<?= $_POST['eps'] ?>" allowfullscreen></iframe>
  </div>
<div class="container-fluid" style="width: 100%;">
  <center>
    
    <h3 class="modal-title fs-5"><?= $_GET['id']; ?></h3>
    <hr>
    <br>
    <a href="eps/episode.php?id=<?= $id; ?>" class="btn btn-primary">Kembali</a>
    <a href="index.php" class="btn btn-primary">Home</a>
    
  </center>
  <br>
<div class="container">
  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" colspan="2">Episode</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach(array_reverse($anime['episodes']) as $episode) : ?>
          <tr>
            <td>
              
              
              <?= $episode['judul_episode'];  ?></td>
            <td class="text-end">
              <form action="?id=<?= $episode['judul_episode'] ?>" method="POST">
                
                <input type="hidden" name="judul" value="<?= $anime['judul']; ?>">
                <input type="hidden" name="eps" value="<?= $episode['link_video'] ?>">
                
                <button type="submit" class="btn btn-primary">Tonton</button>
              </form>
              </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>