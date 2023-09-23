<?php 
session_start();
if (empty($_SESSION['username'])) {
  header('location: login.php');
}


 ?>
<?php 
  include "../back/koneksi.php";

  $kelas = $_GET['kelas'];

  $query = "SELECT * FROM siswa WHERE id_kelas = '$kelas'";
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
          <li class="breadcrumb-item "><a href="kelas_iuran.php?angkatan=<?= $_GET['angkatan']; ?>">Jurusan</a></li>
          <li class="breadcrumb-item active">Siswa</li>
        </ol>
      </nav>
      
    </div><!-- End Page Title -->
  	<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-header py-3">
          		<h5><strong>Data Siswa</strong></h5>
              <button class="btn btn-primary" type="button" onclick="handelTambah()">Tambah siswa</button>
          	</div>
            <div class="card-body mt-3">
              <div class="table-responsive">
                 <!-- Table with stripped rows -->
              <table class="table table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                    
                  </tr>
                </thead>
                <tbody>

                  <?php while ($result = mysqli_fetch_assoc($sql)) {?>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $result['nisn']; ?></td>
                    <td><?= $result['nama']; ?></td>
                    <td><?= $result['alamat']; ?></td>
                    <td><?= $result['telepon']; ?></td>
                      <td><?= $result['jenis_kelamin']; ?></td>
                    

                    <td>
                      <?php if ($_SESSION['jabatan'] == 'admin'): ?>
                        <a href="transaksi.php?siswa=<?= $result['nisn']; ?>&kelas=<?= $result['id_kelas']; ?>&angkatan=<?= $result['id_angkatan']; ?>" class=" btn btn-primary">bayar</a>
                      <?php endif ?>
                      
                      <a href="riwayat_pembayaran.php?nisn=<?= $result['nisn']; ?>" class=" btn btn-warning">Riwayat</a>
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
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../back/handle-transaksi.php" method="post">
          <div class="col-12">
            <label for="namaSiswa" class="form-label">nama:</label>
            <input class="form-control" type="text" name="namaSiswa" id="namaSiswa">
          </div>
          <div class="col-12">
              <label for="jenisKelamin" class="form-label">Jenis kelamin:</label>
              <select class="form-select" aria-label="Default select example" id="jenisKelamin">
                  <option selected value="">Pilih jenis kelamin</option>
                  <option  value="LAKI-LAKI">LAKI-LAKI</option>
                  <option  value="PEREMPUAN">PEREMPUAN</option>
              </select>
          </div>
          <div class="col-12">
              <label for="alamat" class="form-label">alamat:</label>
              <textarea class="form-control" name="alamat" id="alamat"></textarea>
          </div>
          <div class="col-12">
            <label for="noTelepon" class="form-label">No. Telepon:</label>
            <input class="form-control" type="text" name="noTelepon" id="noTelepon">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">batal</button>
        <button type="button" class="btn btn-primary" onclick="simpanSiswa()">simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  function bukaModal(){
        $('#staticBackdrop').modal('show');
    }
  function tutupModal(){
        $('#staticBackdrop').modal('hide');
    }

  function handelTambah() {
    bukaModal()
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


  function simpanSiswa() {
    var id_angkatan = GetURLParameter('angkatan');
    var id_kelas = GetURLParameter('kelas');

    var namaSiswa = $('#namaSiswa').val();
    var jenisKelamin = $('#jenisKelamin').val();
    var alamat = $('#alamat').val();
    var noTelepon = $('#noTelepon').val();

    if (namaSiswa == "" ) {
      Swal.fire("Peringatan","Harap isi kolom nama siswa","warning");
      return;
    }
    if (jenisKelamin == "" ) {
      Swal.fire("Peringatan","Harap isi kolom jenis kelamin","warning");
      return;
    }
    if (alamat == "" ) {
      Swal.fire("Peringatan","Harap isi kolom alamat","warning");
      return;
    }
    if (noTelepon == "" ) {
      Swal.fire("Peringatan","Harap isi kolom nomer telepon","warning");
      return;
    }


    var url = "<?= BASE_URL; ?>back/handleSimpanSiswa.php";

    $.ajax({
      url:url,
      method: 'post',
      data:{
        id_angkatan:id_angkatan,
        id_kelas:id_kelas,
        namaSiswa:namaSiswa,
        jenisKelamin:jenisKelamin,
        alamat:alamat,
        noTelepon:noTelepon
      },
      success:function(res) {
        console.log(res)
        Swal.fire("info!",res,"info");
        tutupModal()
      },
      error:function(res){
        console.log(err);
      }


    });



  }

</script>


  <!-- footer -->
<?php include "V_footer.php"; ?>
<!-- end footer -->