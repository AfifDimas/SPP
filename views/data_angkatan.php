<?php 
session_start();
if (empty($_SESSION['username'])) {
  header('location: login.php');
}


 ?>
<?php 
  include "../back/koneksi.php";
  date_default_timezone_set('asia/jakarta');

  $query = "SELECT * FROM angkatan";
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
          <li class="breadcrumb-item active bold">kelas</li>
        </ol>
      </nav>
      
    </div><!-- End Page Title -->
  	<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-header py-3">
              <?php 
                $tanggal = date("Y-m-d");
                $resultP = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah_dibayar) FROM pembayaranrecord WHERE tanggal_bayar LIKE '%$tanggal%'"));

               ?>

          		<h5><strong>Data Angkatan</strong></h5>
              <div class="mt-3">
                Total uang hari ini : Rp.<?= number_format($resultP['SUM(jumlah_dibayar)']); ?>
              </div>
          	</div>
            <div class="card-body mt-3">
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
                  <tr>
                    <th scope="row"><?= $no++;  ?></th>
                    <td><?= $result['angkatan_tahun'];  ?></td>
                    <td>
                      <a href="kelas_iuran.php?angkatan=<?= $result['id']; ?>" class=" btn btn-primary">Lihat</a>

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


  



<script type="text/javascript">



</script>

  <!-- footer -->
<?php include "V_footer.php"; ?>
<!-- end footer -->