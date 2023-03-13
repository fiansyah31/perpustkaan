<?php

include "koneksi.php";
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $tahun = $_GET["tahun"];
        $query = $conn->prepare("SELECT * FROM buku WHERE YEAR(tahun_terbit) = :tahun");
        $query->bindValue(":tahun", $tahun);
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
                'tahun' => $data
            );
        } else {
            $response = array(
                'status' => 'error',
                'pesan' => 'Buku belum diterbitkan.'
            );
        }
        echo json_encode($response);
    } catch (\PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
