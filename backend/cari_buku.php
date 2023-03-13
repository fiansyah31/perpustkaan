<?php

include "koneksi.php";


//cari buku
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    try {
        $data_cari = $_GET['search'];
        $query = $conn->prepare("SELECT * FROM buku WHERE judul LIKE :search");
        $query->bindValue("search", "%$data_cari%");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $data = array();
            foreach ($result as $row) {
                $data[] = array(
                    'id_buku' => $row['id_buku'],
                    'judul' => $row['judul'],
                    'tahun_terbit' => $row['tahun_terbit'],
                    'penulis' => $row['penulis'],
                );
            }
            $response = array(
                'status' => 'success',
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 'error',
                'pesan' => 'Buku tidak ditemukan.'
            );
        }
        echo json_encode($response);
    } catch (\PDOException $e) {
        echo "Terjadi Kesalahan: " . $e->getMessage();
    }
}
