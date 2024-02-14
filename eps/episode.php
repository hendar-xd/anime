<?php
// Baca file JSON
$json_data = file_get_contents('../anime_data.json');

// Konversi JSON menjadi array atau objek PHP
$data = json_decode($json_data, true);

// Ambil id anime dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Cari anime sesuai id
$anime = null;
foreach ($data as $item) {
    if ($item['judul'] == $id) {
        $anime = $item;
        break;
    }
}

// Jika anime tidak ditemukan
if (!$anime) {
    echo "Anime tidak ditemukan.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Episode - <?= $anime['judul']; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
  .card {
    border: none;
    margin-bottom: 20px; /* Memberi jarak antar card */
    max-width: 100%; /* Batasi lebar div agar mengikuti lebar tombol */
    word-wrap: break-word; /* Mengatur teks agar turun ke baris berikutnya jika melebihi lebar gambar */
  }
  .card-img-top {
    margin-top: 1rem;
    border-radius: 10px;
    max-width: 50%; /* Batasi lebar gambar menjadi maksimum 100% */
    height: auto; /* Atur tinggi gambar agar proporsi tetap terjaga */
  }
</style>
</head>
<body class="bg-secondary">
<div class="container bg-secondary text-light">
  <div class="row">
    <div class="col">
      <img src="<?= $anime['gambar']; ?>" class="card-img-top mx-auto d-block" alt="<?= $anime['judul']; ?>">
      <h1 class="text-center"><?= $anime['judul']; ?></h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Episode</th>
            <th scope="col">Tonton</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (array_reverse($anime['episodes']) as $episode) : ?>
          <tr>
       
            <td><?= $episode['judul_episode']; ?></td>
            <td>
              <form action="../stream.php?id=<?= $episode['judul_episode'] ?>" method="POST">
               
                <input type="hidden" name="judul" value="<?= $anime['judul']; ?>">
               
                <input name="eps" type="hidden" value="<?= $episode['link_video'] ?>">
                <button type="submit" class="btn btn-primary" name="sub">Tonton</button>
              </form>
            </td>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
