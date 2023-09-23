<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?Dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="data_angkatan.php">
          <i class="bi bi-cash-coin"></i>
          <span>Transaksi</span>
        </a>
      </li><!-- End transaksi Page Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="iuran.php">
          <i class="bi bi-card-list"></i>
          <span>Iuran</span>
        </a>
      </li><!-- End iuran Page Nav -->


      <?php if ($_SESSION['jabatan'] == 'admin'): ?>
        <li class="nav-item ">
        <a class="nav-link collapsed" href="laporan.php">
          <i class="bi bi-graph-up"></i>
          <span>Laporan</span>
        </a>
      </li><!-- End record Page Nav -->

      <?php endif ?>

    </ul>

  </aside>