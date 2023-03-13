<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Komunikasi Data</title>
    <link rel="stylesheet" href="https://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Perputakaan Dunia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php?halaman=data_buku">Buku-Buku</a>
                    </li>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <?php
        if (isset($_GET['halaman'])) {
            $halaman = $_GET['halaman'];

            switch ($halaman) {
                case 'data_buku':
                    include 'frontend/data_buku.php';
                    break;
                default:
                    echo "Whoooppss Anda Sepertinya Tersesat? Yukk kembalii";
            }
        } else {
            include "frontend/data_buku.php";
        }
        ?>
        <!--Modal Tambah Buku-->
        <div class="modal fade" id="modalBuku" tabindex="-1" aria-labelledby="modalBuku" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTitle">Form Tambah Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="mt-3" id="formTambah">
                            <label class="mb-2">Judul:</label>
                            <input class="form-control" type="text" name="judul" id="judul"><br>
                            <label class="mb-2">Deskripsi:</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                            <div id="jumlah-text"></div><br>
                            <label class="mb-2">Tahun Terbit:</label>
                            <input class="form-control" type="date" name="tahun_terbit" id="tahun_terbit"><br>
                            <label class="mb-2">Penulis</label>
                            <input class="form-control" type="text" name="penulis" id="penulis"><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit">Simpan Buku</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal Edit Buku-->
        <div class="modal fade" id="modalEditBuku" tabindex="-1" aria-labelledby="modalEditBuku" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTitle">Form Ubah Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="mt-3" id="formUbah">
                            <input type="hidden" id="id_bukus" name="id_buku">
                            <label class="mb-2">Judul:</label>
                            <input class="form-control" type="text" name="judul" id="juduls"><br>
                            <label class="mb-2">Deskripsi:</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsis"></textarea>
                            <div id="jumlah-text"></div><br>
                            <label class="mb-2">Tahun Terbit:</label>
                            <input class="form-control" type="date" name="tahun_terbit" id="tahun_terbits"><br>
                            <label class="mb-2">Penulis</label>
                            <input class="form-control" type="text" name="penulis" id="penuliss"><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="ubahBuku">Ubah Buku</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal Lihat Buku-->
        <div class="modal fade" id="modalLihatBuku" tabindex="-1" aria-labelledby="modalLihatBuku" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTitle">Form Lihat Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="mt-3" id="formLihat">
                            <input type="hidden" id="id_bukul" name="id_buku">
                            <label class="mb-2">Judul:</label>
                            <input class="form-control" type="text" name="judul" id="judull"><br>
                            <label class="mb-2">Deskripsi:</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsil"></textarea>
                            <div id="jumlah-text"></div><br>
                            <label class="mb-2">Tahun Terbit:</label>
                            <input class="form-control" type="date" name="tahun_terbit" id="tahun_terbitl"><br>
                            <label class="mb-2">Penulis</label>
                            <input class="form-control" type="text" name="penulis" id="penulisl"><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="hapusBuku">Hapus Buku</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="vendor/script.js"></script>
</body>

</html>