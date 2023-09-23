<?php 
session_start();
if (empty($_SESSION['username'])) {
  header('location: login.php');
}


 ?>
<?php 
  include "../back/koneksi.php";

  $nisn = $_GET['siswa'];

  $query = "SELECT * FROM pembayaran WHERE nisn = '$nisn'";
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
          <li class="breadcrumb-item "><a href="siswa_iuran.php?kelas=<?= $_GET['kelas']; ?>&angkatan=<?= $_GET['angkatan']; ?>">Siswa</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
        </ol>
      </nav>
      
    </div><!-- End Page Title -->
  	<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-header py-3">
          		<h5><strong>Transaksi Pembayaran</strong></h5>
              <button class="btn btn-primary" type="button" onclick="handleInputiuran()">input Iuran</button>
              
          	</div>
            <div class="card-body mt-3">
              <div class="table-responsive">
                <!-- Table with stripped rows --> 
              <table class="table table-bordered" id="dataTable" >
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th>Nama Iuran</th>
                    <th>Terakhir bayar</th>
                    <th>Total dibayar</th>
                    <th>Sisa</th>
                    <th>total Iuran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php while ($result = mysqli_fetch_assoc($sql)) { ?>

                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $result['nama_iuran']; ?></td>
                    <td><?= $result['tanggal_pembayaran']; ?></td>
                    <td><?= number_format($result['total_dibayar']); ?></td>
                    <td><?= number_format($result['total_pembayaran'] - $result['total_dibayar']); ?></td>
                    <td><?= number_format($result['total_pembayaran']); ?></td>
                    <td><?= $result['status']; ?></td>

                    <td>
                      <button class="btn btn-primary" onclick="handleBayar('<?= $result['id_pembayaran']; ?>')">Bayar</button>
                    	
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
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pembayaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../back/handle-transaksi.php" method="post">
          <input type="hidden" name="id" id="jumlah_iuran">
          <label>masukan jumlah bayar :</label>
          <input class="form-control" type="number" name="total_bayar" id="total_bayar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">batal</button>
        <button type="button" class="btn btn-primary" onclick="simpanIuran()">simpan</button>
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
        <h1 class="modal-title fs-5" id="staticBackdropLabel">iuran baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../back/handle-transaksi.php" method="post">
          <label>masukan nama iuran :</label>
          <input class="form-control" type="text" name="namaIuran" id="namaIuran">
          <label>masukan jumlah bayar :</label>
          <input class="form-control" type="number" name="jumlah_bayar" id="jumlah_bayar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal2()">batal</button>
        <button type="button" class="btn btn-primary" onclick="simpanIuranBaru()">simpan</button>
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
    function bukaModal2(){
        $('#staticBackdrop2').modal('show');
    }
    function tutupModal2(){
        $('#staticBackdrop2').modal('hide');
    }

  function handleBayar(id_pembayaran) {
     id_pembayaran1 = id_pembayaran;
        console.log(id_pembayaran1)
        bukaModal();
  }

  function handleInputiuran() {
    bukaModal2();
  }

  function simpanIuran() {
    console.log(id_pembayaran1)
    var total_bayar = $('#total_bayar').val();

    if (total_bayar == "") {
      Swal.fire("Peringatan","Kolom wajib di isi","warning");
      return;
    }


    var url = "<?= BASE_URL; ?>back/bayar_iuran.php";



     $.ajax({
            url:url,
            method:"post",
            data:{
                id_pembayaran:id_pembayaran1,
                total_bayar:total_bayar
                
            },
            success:function(res){
                console.log(res);
                Swal.fire("Info!",res,"success");
                tutupModal()

            },
            error:function(res){
                console.log(err);
            }
        })

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


  function simpanIuranBaru() {
    var nisn = GetURLParameter('siswa');
    var namaIuran = $('#namaIuran').val();
    var jumlah_bayar = $('#jumlah_bayar').val();

    if (namaIuran == "") {
      Swal.fire("Peringatan","Kolom wajib di isi","warning");
      return;
    }
    if (jumlah_bayar == "") {
      Swal.fire("Peringatan","Kolom wajib di isi","warning");
      return;
    }

    var url = "<?= BASE_URL; ?>back/simpan_iuran_siswa.php";


    $.ajax({
      url:url,
      method:'post',
      data:{
        nisn:nisn,
        namaIuran:namaIuran,
        jumlah_bayar:jumlah_bayar
      },
      success:function(res) {
        console.log(res)
        Swal.fire("Info",res,"info");
        tutupModal2()
      },
      error:function(res) {
        console.log(err);
      }
    });


  }



</script>

  <!-- footer -->
<?php include "V_footer.php"; ?>
<!-- end footer -->