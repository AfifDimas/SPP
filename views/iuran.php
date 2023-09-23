
<?php 
session_start();
if (empty($_SESSION['username'])) {
  header('location: login.php');
}


 ?>
<?php 
  include "../back/koneksi.php";

  $nisn = $_GET['siswa'];

  $query = "SELECT id_pembayaran as id, nama_iuran as label, total_pembayaran as value FROM pembayaran GROUP BY nama_iuran;";
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
          		<h5><strong>Data Iuran</strong></h5>
              <?php if ($_SESSION['jabatan'] == 'admin'): ?>
                <button class=" btn btn-primary" type="button" onclick="handleInputIuran()">masukan</a>
              <?php endif ?>
          	</div>
            <div class="card-body mt-3">

              <div class="table-responsive">
                <!-- Table with stripped rows -->
              <table class="table table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th>Nama Iuran</th>
                    <th>Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php while ($result = mysqli_fetch_assoc($sql)) { ?>

                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $result['label']; ?></td>
                    <td>Rp. <?= number_format($result['value']); ?></td>

                    <td>
                      <?php if ($_SESSION['jabatan'] == 'admin'): ?>
                        <button class="btn btn-danger" type="button" onclick="handleHapus('<?= $result['label']; ?>')">Hapus</button>
                      <?php endif ?>
                      
                      <button class="btn btn-primary" type="button" onclick="handleDetail('<?= $result['label']; ?>')">Detail</button>
                      <!-- <button class="btn btn-secondary" type="button" onclick="handleEdit()">Edit</button> -->
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
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../back/handle-transaksi.php" method="post">
          <label>masukan nama pembayaran :</label>
          <input class="form-control" type="text" name="nama_iuran" id="nama_iuran">
          <label>masukan angkatan ke- :</label>
          <input class="form-control" type="number" name="angkatan" id="angkatan">
          <label>masukan jumlah bayar :</label>
          <input class="form-control" type="number" name="jumlah_iuran" id="jumlah_iuran">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">batal</button>
        <button type="button" class="btn btn-primary" onclick="simpanIuran()">simpan</button>
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

  function handleInputIuran() {
        bukaModal()
  }

  function simpanIuran() {
    var angkatan = $('#angkatan').val();
    console.log(angkatan)
    var nama_iuran = $('#nama_iuran').val();
    var jumlah_iuraninput = $('#jumlah_iuran').val();

    if (nama_iuran == "") {
      Swal.fire("Peringatan","Nama iuran tidak boleh kosong","warning");
      return;
    }
    if (angkatan == "") {
      Swal.fire("Peringatan","Angkatan tidak boleh kosong","warning");
      return;
    }
    if (jumlah_iuraninput == "") {
      Swal.fire("Peringatan","Jumlah iuran tidak boleh kosong","warning");
      return;
    }


    var url = "<?= BASE_URL; ?>back/input_iuran_massal.php";



     $.ajax({
            url:url,
            method:"post",
            data:{
                angkatan:angkatan,
                nama_iuran:nama_iuran,
                jumlah_iuraninput:jumlah_iuraninput
                
            },
            success:function(res){
                console.log("iuran berhasil di tambahkan");
                Swal.fire("Info!",res,"info");
                tutupModal()
            },
            error:function(res){
                console.log(err);
            }
        })

  }

  function handleHapus(nama_iuran) {
  	var nama_iuran = nama_iuran;
  	Swal.fire({
  title: 'Apa Anda Yakin?',
  text: "Anda tidak dapat mengembalikannya lagi!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus Pembayaran!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Dihapus!',
      'Pembayaran telah dihapus!',
      'success'
    )
     $.ajax({
                    url:"<?= BASE_URL; ?>back/hapus_iuran_massal.php",
                    method:"post",
                    data:{
                        nama_iuran:nama_iuran
                    },
                    success:function(res){
                        console.log(res);
                        window.table.destroy();
                        initTable()
                        tutupModal()
                    },
                    error:function(res){
                        console.log(err);
                    }
                })
            }
        })
  }

</script>

  <!-- footer -->
<?php include "V_footer.php"; ?>
<!-- end footer -->