<div class="row">
    <div class="col-12">
        <h3 class="text-center mb-5">Semua buku</h3>
        <hr>
        <div class="alert alert-dismissible fade" id="alert" role="alert">
            <div id="pesan"></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="d-flex justify-content-between mt-5 content-data-buku-header">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalBuku" id="tambahBuku" class="btn btn-primary py-2 px-3">Tambah Buku</a>
            <form id="search-form" class="d-flex w-60">
                <input type="text" class="form-control" id="search-input" name="search" placeholder="Cari...">
            </form>
            <div class="button-filter d-flex">
                <form id="filter-form" class="d-flex">
                    <input type="text" name="tahun" id="tahun" placeholder="Berdasarkan Tahun" class="form-control">
                    <input type="button" class="btn btn-dark py-2 px-3" value="Filter" id="filter-tahun">
                </form>
            </div>
        </div>
        <table class="table table-striped mt-3" id="table-buku">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Judul Buku</td>
                    <td>Tahun Terbit</td>
                    <td>Penulis</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>