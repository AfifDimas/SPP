<?php 
session_start();
if (empty($_SESSION['username'])) {
  header('location: login.php');
}


 ?>
<?php 

  include "../back/koneksi.php";

  $angkatan = $_GET['angkatan'];
  $query = "SELECT * FROM kelas WHERE id_angkatan = '$angkatan'";
  $sql = mysqli_query($conn, $query);
  $no = 1;

 ?>


<?php include "V_head.php"; ?>

  <!-- ======= Header ======= -->
  <?php include "V_header.php"; ?>
  <!-- ======End Header====== -->

  <!-- ======= Sidebar ======= -->
  <?php include "V_sidebar.php"; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">
  	<div class="pagetitle">
      <h1>Data Master</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="data_angkatan.php">Kelas</a></li>
          <li class="breadcrumb-item active">Jurusan</li>
        </ol>
      </nav>
      
    </div><!-- End Page Title -->
  	<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-header py-3">
          		<h5><strong>Data Kelas</strong></h5>
              <button class="btn btn-primary" type="button" onclick="handleInputSiswa()">input siswa massal</button>
              <button class="btn btn-secondary" type="button" onclick="handleBuatKelas()">Buat Kelas</button>
          	</div>
            <div class="card-body mt-3">
              <div class="table-responsive">
                <!-- Table with stripped rows -->
              <table class="table table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php while ($result = mysqli_fetch_assoc($sql)) {?>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $result['kelas']; ?> <?= $result['jurusan']; ?></td>
                    <td>
                      <a href="siswa_iuran.php?kelas=<?= $result['id']; ?>&angkatan=<?= $result['id_angkatan'] ?>" class=" btn btn-primary">Lihat</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
              </div>
              

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>


  <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">input siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="../assets/tamplates/tamplate-input-siswa.xlsx" id="unduhTombol">Unduh Tamplate File</a>
        <form action="../back/handle-transaksi.php" method="post">
          <div class="col-12">
            <label for="jabatan" class="form-label">File</label>
            <input class="form-control" type="file" name="file" id="file">
            <label for="jabatan" class="form-label">Kelas</label>
              <select class="form-select" aria-label="Default select example" id="kelas">
                <option selected value="">Pilih Kelas</option>
                <?php

                  $kelas =(mysqli_query($conn, "SELECT * FROM kelas WHERE id_angkatan = '$angkatan'"));
                  while($selKelas = mysqli_fetch_assoc($kelas)) {
                 ?>
                  <option value="<?= $selKelas['id']; ?>"><?= $selKelas['jurusan']; ?></option>
                <?php } ?>
              </select>
          <div class="invalid-feedback">Please enter your jabatan!</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">batal</button>
        <button type="button" class="btn btn-primary" onclick="simpanExcel()">simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>


  <!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../back/handle-transaksi.php" method="post">
          <div class="col-12">
            <label for="jabatan" class="form-label">nama Kelas</label>
            <input class="form-control" type="text" name="namaKelas" id="namaKelas">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal2()">batal</button>
        <button type="button" class="btn btn-primary" onclick="simpanKelas()">simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

  <script type="text/javascript">


    $(document).ready(function() {
    $("#unduhTombol").click(function() {
        // Tentukan URL file yang akan diunduh
        var fileUrl = "../assets/tamplates/tamplate-input-siswa.xlsx";
        
        // Buka file di tab atau jendela baru
        window.open(fileUrl, '_blank');
    });
});
    
  function bukaModal(){
        $('#staticBackdrop').modal('show');
    }
  function tutupModal(){
        $('#staticBackdrop').modal('hide');
    }

  function bukaModal2(){
        $('#staticBackdrop2').modal('show');
    }
    function tutupModal2(){
        $('#staticBackdrop2').modal('hide');
    }


  function GetURLParameter(sParam) {
      var sPageURL = window.location.search.substring(1);
      var sURLVariables = sPageURL.split('&');
      for (var i = 0; i < sURLVariables.length; i++)
      {
          var sParameterName = sURLVariables[i].split('=');
          if (sParameterName[0] == sParam)
          {
              return decodeURIComponent(sParameterName[1]);
          }
    }
  }




  function handleInputSiswa() {
    $('#file').val("")
    $('#kelas').val("")
    bukaModal()
  }

  function handleBuatKelas() {
    $('#namaKelas').val("")
    bukaModal2();
  }

  function simpanKelas() {
    var id_angkatan = GetURLParameter('angkatan');
    var namaKelas =  $('#namaKelas').val();

    if (namaKelas == "") {
        Swal.fire("Peringatan","Harap isi kolom nama kelas","warning");
        return;
      }

    var url = "<?= BASE_URL; ?>back/simpan_kelas.php";

    $.ajax({
      url:url,
      method:'post',
      data:{
        namaKelas:namaKelas,
        id_angkatan:id_angkatan
      },
      success:function(res) {
        console.log(res);
        if (res == "Kelas ini telah ada") {
          Swal.fire("Info!",res,"warning");

        }
        if (res == "kelas berhasil ditambahkan") {
          Swal.fire("Info!",res,"success");
          tutupModal2();
        }
        
      },
      error:function(res){
        console.log(err);
      }
    });
  }

  function simpanExcel(){
        let file = $("#file")[0]['files'];
        if (file.length == 0) {
            console.log(file)
            Swal.fire("Peringatan","Silahkan Upload File Excel","warning");
            return
        }
        var name = document.getElementById("file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if (ext != 'xlsx') {
        Swal.fire("peringatan","file hrus berformat xlsx","warning");
        return;
      }
       
       var id_kelas = $('#kelas').val();
      var id_angkatan = GetURLParameter('angkatan');
       console.log(id_kelas);
        
       form_data.append("file",file[0])
       form_data.set("id_kelas", id_kelas);
       form_data.set("id_angkatan", id_angkatan);
       if (kelas == "") {
          Swal.fire("Peringatan","Silahkan pilih kelas yang ada","warning");
            return
       }

        
        var url           = "<?= BASE_URL; ?>back/excel/handle_Input_siswa_massal.php";
        // if (file == "") {
        //     Swal.fire("Peringatan","File tidak boleh kosong","warning");
        //     return;
        // }
        $.ajax({
            url:url,
            method:"post",
            data:form_data,
            processData: false,
              contentType: false,
            cache: false,
            success:function(res){
                console.log(res);
                Swal.fire("Info!",res,"info");
                tutupModal()
            },
            error:function(res){
                console.log(err);
            }
        })
    }



  </script>

  <!-- footer -->
<?php include "V_footer.php"; ?>
<!-- end footer -->