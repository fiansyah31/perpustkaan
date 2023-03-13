<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $id_buku = $_POST['id'];

        $query = $conn->prepare("DELETE FROM buku WHERE id_buku = :id");
        $query->bindParam(':id', $id_buku);

        if (!$query->execute()) {
            $response = array(
                'status' => 'failed',
                'pesan' => 'Data Gagal dihapus'
            );
        } else {
            $response = array(
                'status' => 'success',
                'pesan' => 'Data Berhasil dihapus'
            );
        }
        echo json_encode($response);
    } catch (\PDOException $e) {
        echo json_encode(['error', $e->getMessage()]);
    }
}
