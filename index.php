<?php
// Baca file JSON
$json_data = file_get_contents('anime_data.json');

// Konversi JSON menjadi array atau objek PHP
$data = json_decode($json_data, true); // Jika ingin mengonversi menjadi array

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bootstrap demo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<style>
  body {
    width: 100%;
  }
  .navbar {
    width: 100%;
    max-width: 100%;
  }
  .card {
    position: relative;
  }
  
  .overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Warna overlay */
    color: white; /* Warna teks judul */
    padding: 10px; /* Padding untuk judul */
  }
  
  .card-title-hover {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: all 0.3s ease; /* Transisi efek */
  }
  
  .card:hover .card-title-hover {
    white-space: normal;
    overflow: visible;
    text-overflow: unset;
  }

</style>
</head>
<body>
<?php include 'navbar/navbar.php' ?>
<hr>


<div class="container-fluid" style="width: 100%;">
  <div id="animeList" class="row row-cols-2 row-cols-md-2 g-4">
    <?php 
    $items_per_page = 15; // Jumlah anime per halaman
    $total_items = count($data); // Total jumlah anime
    $total_pages = ceil($total_items / $items_per_page); // Jumlah total halaman
    
    // Mengambil nomor halaman dari URL, default 1 jika tidak ada
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    // Menghitung indeks awal dan akhir anime yang akan ditampilkan
    $start_index = ($current_page - 1) * $items_per_page;
    $end_index = min($start_index + $items_per_page, $total_items);
    
    // Loop untuk menampilkan anime sesuai dengan halaman yang aktif
    for ($i = $start_index; $i < $end_index; $i++) : ?>
      <div class="col-md-6">
        <div class="card position-relative">
          <a href="eps/episode.php?id=<?= $data[$i]['judul'] ?>">
            <img src="<?= $data[$i]['gambar']; ?>" class="card-img-top">
            <!-- Overlay untuk judul -->
            <div class="overlay">
              <div class="card-title-hover"><?= $data[$i]['judul']; ?></div>
            </div>
          </a>
        </div>
      </div>
    <?php endfor; ?>
  </div>
</div>




<div class="container-fluid" style="margin-top: 50px;" >
  <div class="row justify-content-center">
    <div class="col-md-auto">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php if ($current_page > 1) : ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?= $current_page - 1; ?>" aria-label="Previous">
                Back
              </a>
            </li>
          <?php endif; ?>
          <?php if ($current_page < $total_pages) : ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?= $current_page + 1; ?>" aria-label="Next">
                Next
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
  
  
  
  <div class="row justify-content-center">
    <div class="col-md-auto">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
            <?php if ($page % 9 == 1) : ?>
              </ul>
              <ul class="pagination justify-content-center ">
            <?php endif; ?>
            <li class="page-item <?php echo $page == $current_page ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?= $page; ?>"><?= $page; ?></a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="script.js"></script>
<script>
  document.getElementById('myform').addEventListener("submit", function(e) {
    e.preventDefault();
  } )
</script>
</body>
</html>
