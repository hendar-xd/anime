<?php
// Baca file JSON
$json_data = file_get_contents('anime_data.json');

// Konversi JSON menjadi array atau objek PHP
$data = json_decode($json_data, true);

// Ambil kata kunci pencarian dari query string
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Filter data sesuai dengan kata kunci pencarian
$searchResults = array_filter($data, function ($anime) use ($searchTerm) {
    // Cocokkan judul anime dengan kata kunci pencarian (case-insensitive)
    return stripos($anime['judul'], $searchTerm) !== false;
});

// Kembalikan hasil pencarian dalam format JSON
echo json_encode(array_values($searchResults));
?>
