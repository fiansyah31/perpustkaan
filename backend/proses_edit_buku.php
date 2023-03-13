<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $id_buku = $_POST['id_buku'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $penulis = $_POST['penulis'];

        $query = $conn->prepare("UPDATE buku SET judul=:judul, deskripsi=:deskripsi, tahun_terbit=:tahun_terbit, penulis=:penulis WHERE id_buku=:id_buku");
        $query->bindParam(':judul', $judul);
        $query->bindParam(':deskripsi', $deskripsi);
        $query->bindParam(':tahun_terbit', $tahun_terbit);
        $query->bindParam(':penulis', $penulis);
        $query->bindParam(':id_buku', $id_buku);

        if (!$query->execute()) {
            $response = array(
                'status' => 'failed',
                'pesan' => 'Data Gagal diubah'
            );
        } else {
            $response = array(
                'status' => 'success',
                'pesan' => 'Data Berhasil diubah'
            );
        }
        echo json_encode($response);
    } catch (\PDOException $e) {
        echo json_encode(['error', $e->getMessage()]);
    }
}
