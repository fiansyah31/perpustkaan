<?php
include "koneksi.php";

header('Content-Type: application/json');

//input data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $penulis = $_POST['penulis'];

        //simpan
        $save = $conn->prepare("INSERT INTO buku(judul, deskripsi, tahun_terbit, penulis) VALUES(?,?,?,?)");
        $save->execute([$judul, $deskripsi, $tahun_terbit, $penulis]);
        if (!$save) {
            $response = array(
                'status' => 'failed',
                'pesan' => 'Buku Gagal Ditambahkan, periksa koneksi anda'
            );
        } else {
            $response = array(
                'status' => 'success',
                'pesan' => 'Buku Berhasil Ditambahkan'
            );
        }
        echo json_encode($response);
    } catch (\PDOException $e) {

        echo json_encode(['error', $e->getMessage()]);
    }
}
