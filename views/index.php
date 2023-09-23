<?php 
session_start();
if (empty($_SESSION['username'])) {
  header('location: login.php');
}


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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <h1>PEMBAYARAN SPP</h1>
        <p>
          <strong>Selamat datang di Dashboard Pembayaran SPP kami!</strong> Di sini Anda dapat dengan mudah mengakses dan mengelola semua informasi terkait pembayaran SPP Anda. Dashboard kami dirancang untuk memberikan kemudahan dan kenyamanan bagi Anda sebagai orang tua dalam mengurus pembayaran SPP secara efisien.</p>


<br><br><br><br><br>
      </div>
    </section>


  </main><!-- End #main -->

<!-- footer -->
<?php include "V_footer.php"; ?>
<!-- end footer -->

