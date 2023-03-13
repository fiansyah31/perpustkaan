<?php

include "koneksi.php";

$id = $_GET['id'];
//tampilkan data buku sesuai id
$getbuku = $conn->prepare("SELECT * FROM buku WHERE id_buku = :id");
$getbuku->bindValue("id", $id);
$getbuku->execute();
$databuku = $getbuku->fetch();

echo json_encode($databuku);
