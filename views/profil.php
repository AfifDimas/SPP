<?php 

  include "../back/koneksi.php";
  session_start();

  $id = $_SESSION['id_user'];
  $query = "SELECT * FROM users WHERE id_user = '$id'";
  $sql = mysqli_query($conn, $query);
  $result = mysqli_fetch_assoc($sql);

 ?>


<?php include "V_head.php"; ?>

  <!-- ======= Header ======= -->
  <?php include "V_header.php"; ?>
  <!-- ======End Header====== -->

  <!-- ======= Sidebar ======= -->
  <?php include "V_sidebar.php"; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle mb-4">
      <h1>Profil</h1>
      
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../assets/img/img_profil/<?php if($_SESSION['foto'] == "") {echo "profile-img.jpg";} else{echo $_SESSION['foto'];} ?>" alt="Profile" class="rounded-circle">
              <h2 class=""><?= $result['nama']; ?></h2>
              <h3>Jabatan : <?= $result['jabatan']; ?></h3>
              
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Detail Profil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nama</div>
                    <div class="col-lg-9 col-md-8"><?= $result['nama']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jabatan</div>
                    <div class="col-lg-9 col-md-8"><?= $result['jabatan']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">No. Telepon</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $result['email']; ?></div>
                  </div>

                </div>





                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <!-- Profile Edit Form -->
                  <form method="post" action="../back/profil_edit.php">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="../assets/img/img_profil/<?php if($_SESSION['foto'] == "") {echo "profile-img.jpg";} else{echo $_SESSION['foto'];} ?>" alt="Profile">
                        <div class="pt-2">
                          <input type="file" name="yourFoto" id="yourFoto">
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?= $result['nama']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?= $result['email']; ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" onclick="profilEdit('<?= $result['id_user']; ?>')">Simpan Perubahan</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="../back/ubah_password.php" method="post">
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" onclick="ubahPassword('<?= $result['id_user']; ?>')">Ubah</button>
                    </div>
                  </form>
                    

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script>
  function ubahPassword(id) {
    var id = id;
    console.log(id)
    var passLama = $('#currentPassword').val();
    var passBaru = $('#newPassword').val();
    var konfirmasiPass = $('#renewPassword').val();

    if( passLama == "") {
      Swal.fire("Peringatan","isi tidak boleh kosong","warning");
      return;
    }
    if( passBaru == "") {
      Swal.fire("Peringatan","isi tidak boleh kosong","warning");
      return;
    }
    if( konfirmasiPass == "") {
      Swal.fire("Peringatan","isi tidak boleh kosong","warning");
      return;
    }

    var url = "<?= BASE_URL; ?>back/ubah_password.php";



    $.ajax({
      url:url,
      method:'post',
      data:{
        id:id,
        passLama:passLama,
        passBaru:passBaru,
        konfirmasiPass:konfirmasiPass
      },
      success:function(res){
        console.log(res)
        Swal.fire("info",res,"info");
      },
      error:function(res){
        console.log(err);
        exit();
      }
    })

  }

  function profilEdit(id) {
    var id = id;
    let foto = $('#yourFoto')[0]['files'];
    if (foto.length ==  0) {
        console.log(foto)
        Swal.fire("peringatan","silahkan Upload foto anda!!","warning");
        return;
        
      }else {
        var file = document.getElementById("yourFoto").files[0].name;
        var form_data = new FormData();
        var ext = file.split('.').pop().toLowerCase();
        if (ext != 'jpg' && ext != 'png' && ext != 'jpeg') {
          Swal.fire("peringatan","file harus berformat jpg/png/jpeg","warning");
          return;
        }
      }
    


    var fullName = $('#fullName').val();
    var Email = $('#Email').val();

    form_data.append("foto",foto[0]);

    form_data.set("fullName", fullName);
    form_data.set("Email", Email);

    if (fullName == "") {
      Swal.fire("Peringatan","nama tidak boleh kosong","warning");
      return;
    }
    if (Email == "") {
      Swal.fire("Peringatan","nama tidak boleh kosong","warning");
      return;
    }
    
    var url = "<?= BASE_URL; ?>back/profil_edit.php";

    $.ajax({
      url: url,
        method: 'post',
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success:function(res) {
          console.log(res);
          Swal.fire("Info!",res,"info");
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

