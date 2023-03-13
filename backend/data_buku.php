<?php

include "koneksi.php";


header('Content-Type: application/json');

//tampilkan semua buku
$getbuku = $conn->query("SELECT * FROM buku ORDER BY id_buku DESC");
$databuku = $getbuku->fetchAll();

echo json_encode($databuku);
