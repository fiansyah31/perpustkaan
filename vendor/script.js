$(document).ready(function() {
    
      //menampilkan semua buku
      tampilBuku();

    //datepicker tahun
    $("#tahun").datepicker( {
        format: " yyyy",
        viewMode: "years", 
        minViewMode: "years",
        orientation: 'auto top'
    });

    //tambah Data
    tambahData();

    //ubah buku
    ubahBuku();
    
    //batasi ketikan saat input data buku
    BatasiKetikan();

    //filter tahun
    filterTahun();


    //search live buku
    SearchLiveBuku();


    //proses ubah buku
    prosesUbahBuku();


    //lihat buku per id
    lihatBukuId();

    //proses hapus buku
    hapusBuku();
});
function tambahData(){
    //tambah data
    $("#tambahBuku").click(function () {
        $("#formTambah :input").val('');
        $("#modalTitle").text('Form Tambah Buku');
      });
    $("#submit").click(function() {
        var judul = $("#judul").val();
        var deskripsi = $("#deskripsi").val();
        var tahun_terbit = $("#tahun_terbit").val();
        var penulis = $("#penulis").val();

        $.ajax({
            url: "http://localhost/belajarkomunikasidatafebe/backend/proses_tambah_buku.php",
            type: "POST",
            data: {
                judul: judul,
                deskripsi: deskripsi,
                tahun_terbit: tahun_terbit,
                penulis: penulis
            },
            success: function(response) {
                if(response.status == 'success'){
                    $(".alert").addClass("alert-success show");
                    $("#pesan").html(response.pesan);
                    $("#modalBuku").modal('hide');
                } 
                 else if(response.status == 'failed') {
                    $(".alert").addClass("alert-warning show");
                    $("#pesan").html(response.pesan);
                    $("#modalBuku").modal('hide');
                 }
                 else if(response.error){
                    alert(response.error);
                 }  
                 $("#formTambah :input").val('');
                 tampilBuku();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Terjadi kesalahan: " + textStatus, errorThrown);
            }
        })
    })
}
function SearchLiveBuku() {
     //form pencarian
     $("#search-input").keyup(function(even) {
        even.preventDefault();
        //melakukan pencarian
        var search = $("#search-input").val();
        // console.log(search);
        //kirim request pencarian ke server
        $.ajax({
            url: "http://localhost/belajarkomunikasidatafebe/backend/cari_buku.php",
            type: "GET",
            dataType: "json",
            data: {
                search: search
            },
            success: function(response) {
                if (response.status == 'success') {
                    var resultBuku = "";
                    $.each(response.data, function(index, buku) {
                        resultBuku += "<tr>";
                        resultBuku += "<td>" + buku.id_buku + "</td>";
                        resultBuku += "<td>" + buku.judul + "</td>";
                        resultBuku += "<td>" + buku.tahun_terbit + "</td>";
                        resultBuku += "<td>" + buku.penulis + "</td>";
                        resultBuku += "<td><a class='btn btn-warning py-2 px-3' id='editBuku' data-id='"+buku.id_buku+"' data-bs-toggle='modal' data-bs-target='#modalEditBuku' href='index.php?halaman=edit_buku?id=" + buku.id_buku + "'>Edit</a> | <a class='btn btn-info py-2 px-3' href='index.php?halaman=edit_buku?id=" + buku.id_buku + "'>Lihat</a></td>";
                        resultBuku += "</tr>";
                    });
                    $("#table-buku tbody").html(resultBuku);
                } else if (response.status == 'error') {
                    $("#table-buku tbody").html(response.pesan);
                }
            },
        })

    })
  }
    //tampilkan semua data
     // Mengambil data dari back-end dan menampilkan dalam tabel
     function tampilBuku(){
        $.ajax({
           url: "http://localhost/belajarkomunikasidatafebe/backend/data_buku.php",
           dataType: "json",
           success: function(data) {
               var bukuHTML = "";
               $.each(data, function(index, buku) {
                   bukuHTML += "<tr>";
                   bukuHTML += "<td>" + buku.id_buku + "</td>";
                   bukuHTML += "<td>" + buku.judul + "</td>";
                   bukuHTML += "<td>" + buku.tahun_terbit + "</td>";
                   bukuHTML += "<td>" + buku.penulis + "</td>";
                   bukuHTML += "<td class='aksi'><a class='btn btn-warning py-2 px-3 editBuku' id='editBuku' data-id='"+buku.id_buku+"' data-bs-toggle='modal' data-bs-target='#modalEditBuku' href='backend/proses_edit_buku.php?id=" + buku.id_buku + "'>Edit</a> | <a class='btn btn-info py-2 px-3' id='lihatBuku' data-id='"+buku.id_buku+"' data-bs-toggle='modal' data-bs-target='#modalLihatBuku' href='index.php?halaman=edit_buku?id=" + buku.id_buku + "'>Lihat</a></td>";
                   bukuHTML += "</tr>";
               });
               $("#table-buku tbody").html(bukuHTML);
           },
           error: function(jqXHR, textStatus, errorThrown) {
               console.log("Terjadi kesalahan: " + textStatus, errorThrown);
           }
       });
    }
function filterTahun(){
    //filter berdasarkan tahun
    $("#filter-tahun").click(function(e){
        e.preventDefault();
        var tahun = $("#tahun").val();
        $.ajax({
            url: "http://localhost/belajarkomunikasidatafebe/backend/filter_buku.php",
            type: "GET",
            dataType: "json",
            data: {tahun: tahun},
            success: function(response){
                if (response.status == 'success') {
                    var hasilBuku = "";
                    $.each(response.tahun, function(index, bukus) {
                        hasilBuku += "<tr>";
                        hasilBuku += "<td>" + bukus.id_buku + "</td>";
                        hasilBuku += "<td>" + bukus.judul + "</td>";
                        hasilBuku += "<td>" + bukus.tahun_terbit + "</td>";
                        hasilBuku += "<td>" + bukus.penulis + "</td>";
                        hasilBuku += "<td><a class='btn btn-warning py-2 px-3 editBuku' id='editBuku' data-id='"+bukus.id_buku+"' data-bs-toggle='modal' data-bs-target='#modalEditBuku' href='index.php?halaman=edit_buku?id=" + bukus.id_buku + "'>Edit</a> | <a class='btn btn-info py-2 px-3' href='index.php?halaman=edit_buku?id=" + bukus.id_buku + "'>Lihat</a></td>";
                        hasilBuku += "</tr>";
                    });
                    $("#table-buku tbody").html(hasilBuku);
                } else if (response.status == 'error') {
                    $("#table-buku tbody").html(response.pesan);
                }
            }
        })
    })
}
function BatasiKetikan() {
    //mengatur maksimal ketikan dideskripsi tambah buku
    var maxLength = 200 //jumlah karakter maksimum
    $("#deskripsi").keyup(function(){
        var length = $(this).val().length;
        var length = maxLength - length;
        console.log(length);
        $('#jumlah-text').addClass('charcount').text(length + ' karakter tersisa');
        if(length < 0){
            $("#jumlah-text").addClass('charcount').text('0 karakter tersisa');
            var value = $(this).val();
            $(this).val(value.substr(0, maxLength));
        }
    })
  }

  //form ubah
  function ubahBuku(){
    $("body").on("click" , "#editBuku", function () {
      
        var id = $(this).data('id');
        $.ajax({
            url: "http://localhost/belajarkomunikasidatafebe/backend/data_buku_id.php?id="+ id +"",
            data: {id : id},
            method: "GET",
            dataType: "json",
            success: function (data) {
                $("#id_bukus").val(data.id_buku);
                $("#juduls").val(data.judul);
                $("#deskripsis").val(data.deskripsi);
                $("#tahun_terbits").val(data.tahun_terbit);
                $("#penuliss").val(data.penulis);
              }
        })
      });

  }

  //proses ubah buku 
  function prosesUbahBuku(){
    $("#ubahBuku").click(function() {
        var id_buku = $("#id_bukus").val();
        var judul = $("#juduls").val();
        var deskripsi = $("#deskripsis").val();
        var tahun_terbit = $("#tahun_terbits").val();
        var penulis = $("#penuliss").val();

        $.ajax({
            url: "http://localhost/belajarkomunikasidatafebe/backend/proses_edit_buku.php",
            method: "POST",
            dataType: "json",
            data: {
                id_buku: id_buku,
                judul: judul,
                deskripsi: deskripsi,
                tahun_terbit: tahun_terbit,
                penulis: penulis
            },
            success: function(response) {
                if(response.status == 'success'){
                    $(".alert").addClass("alert-success show");
                    $("#pesan").html(response.pesan);
                    $("#modalEditBuku").modal('hide');
                } 
                 else if(response.status == 'failed') {
                    $(".alert").addClass("alert-warning show");
                    $("#pesan").html(response.pesan);
                    $("#modalEditBuku").modal('hide');
                 }
                 else if(response.error){
                    alert(response.error);
                 }  
                 $("#formUbah")[0].reset();
                 tampilBuku();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Terjadi kesalahan: " + textStatus, errorThrown);
            }
        })
    })
  }

  //lihat buku per id 
  function lihatBukuId() {
     //form ubah
    $("body").on("click" , "#lihatBuku", function () {
      
        var id = $(this).data('id');
        $.ajax({
            url: "http://localhost/belajarkomunikasidatafebe/backend/data_buku_id.php?id="+ id +"",
            data: {id : id},
            method: "GET",
            dataType: "json",
            success: function (data) {
                $("#id_bukul").val(data.id_buku);
                $("#judull").val(data.judul);
                $("#deskripsil").val(data.deskripsi);
                $("#tahun_terbitl").val(data.tahun_terbit);
                $("#penulisl").val(data.penulis);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                console.log("Terjadi kesalahan: " + textStatus, errorThrown);
            }
        })
      });

  }

  //proses hapus buku 
  function hapusBuku(){
    $("#hapusBuku").click(function(){
        var id =$("#id_bukul").val();
        $.ajax({
            url: "http://localhost/belajarkomunikasidatafebe/backend/proses_hapus_buku.php",
            data: {id: id},
            method: "POST",
            dataType: "json",
            success: function (response) {
                if(response.status == 'success'){
                    $(".alert").addClass("alert-success show");
                    $("#pesan").html(response.pesan);
                    $("#modalLihatBuku").modal('hide');
                } 
                 else if(response.status == 'failed') {
                    $(".alert").addClass("alert-warning show");
                    $("#pesan").html(response.pesan);
                    $("#modalLihatBuku").modal('hide');
                 }
                 else if(response.error){
                    alert(response.error);
                 } 
                 $("#formLihat")[0].reset();
                 tampilBuku(); 
              },
              error: function(jqXHR, textStatus, errorThrown) {
                console.log("Terjadi kesalahan: " + textStatus, errorThrown);
            }
        })
    })
  }
