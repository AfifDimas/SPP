
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a class="logo d-flex align-items-center" href="index.php">
        <i class="bi bi-bank2 h2 me-2"></i>
        <span class="d-none d-lg-block">PEMBAYARAN SPP</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/img/img_profil/<?php if($_SESSION['foto'] == "") {echo "profile-img.jpg";} else{echo $_SESSION['foto'];} ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['nama']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $_SESSION['nama']; ?></h6>
              <span><?= $_SESSION['jabatan']; ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php if ($_SESSION['jabatan'] == 'admin' or $_SESSION['jabatan'] == 'petugas'): ?>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="profil.php?user=<?= $_SESSION['id_user'];?>">
                <i class="bi bi-person"></i>
                <span>Profil</span>
              </a>
            </li>
            <?php endif ?>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php if ($_SESSION['jabatan'] == 'admin'): ?>
              <li>
              <a class="dropdown-item d-flex align-items-center" href="kelola_akun.php">
                <i class="bi bi-gear"></i>
                <span>Kelola Akun</span>
              </a>
            </li>
            <?php endif ?>

            
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../back/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->


  </header>


