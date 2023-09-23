



<?php 

session_start();
if (empty($_SESSION['username'])) {
  header('location: login.php');
}


 ?>
<?php 
  include "../back/koneksi.php";

  $nisn = $_GET['siswa'];

  $query = "SELECT * FROM pembayaranrecord ";
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
      
    </div><!-- End Page Title -->
  	<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-header py-3">
          		<h5><strong>Riwayat Pembayaran</strong></h5>
              <button class=" btn btn-warning" type="button" onclick="handleLaporan()">laporan pembayaran</button>
          	</div>
            <div class="card-body mt-3">
              <div class="table-responsive">
                <!-- Table with stripped rows -->
              <table class="table table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th>Nama Iuran</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>

                  <?php while ($result = mysqli_fetch_assoc($sql)) { ?>

                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $result['nama_iuran']; ?></td>
                    <td><?= number_format($result['jumlah_dibayar']); ?></td>
                    <td><?= $result['tanggal_bayar']; ?></td>
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
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../back/handle-laporan.php" method="post">
          <label>Tanggal Awal :</label>
          <input class="form-control" type="date" name="tanggal_awal" id="tanggal_awal">
          <label>Tanggal Akhir :</label>
          <input class="form-control" type="date" name="tanggal_akhir" id="tanggal_akhir">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">batal</button>
        <button type="button" class="btn btn-primary" onclick="laporan()">simpan</button>
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

  function handleLaporan() {
        $('#tanggal_awal').val('');
        $('#tanggal_akhir').val('');
        bukaModal()
  }

  function laporan() {
    var tanggal1 = $('#tanggal_awal').val();
    var tanggal2 = $('#tanggal_akhir').val();

    if (tanggal1 == "") {
      Swal.fire("Peringatan","isi tidak boleh kosong","warning");
      return;
    }
    if (tanggal2 == "") {
      Swal.fire("Peringatan","isi tidak boleh kosong","warning");
      return;
    }


    var url = "<?= BASE_URL; ?>back/handle-laporan.php";



     $.ajax({
            url:url,
            method:"post",
            data:{
                tanggal1:tanggal1,
                tanggal2:tanggal2
                
            },
            success:function(res){
                console.log(res);
                Swal.fire("Info!","laporan berhasil dibuat","info");
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