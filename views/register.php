<?php 
include "../back/koneksi.php"; 
session_start();
if (empty($_SESSION['jabatan'] == 'admin')) {
  header('location: login.php');
  exit;
}
?>



<?php include "V_head.php"; ?>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <i class="bi bi-bank2 h2 me-2"></i>
                  <span class="d-none d-lg-block">PEMBAYARAN SPP</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required autocomplete="off">
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    
                    <div class="col-12">
                      <label for="yourFoto" class="form-label">Foto</label>
                      <input type="file" name="file" class="form-control" id="yourFoto" required autocomplete="off">
                      <div class="invalid-feedback">Please choose your foto</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required autocomplete="off">
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required autocomplete="off">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <label for="jabatan" class="form-label">jabatan</label>
                      <select class="form-select" aria-label="Default select example" id="jabatan">
                          <option selected value="">Open this select menu</option>
                          <option value="admin">admin</option>
                          <option value="petugas">petugas</option>
                          <option value="user">user</option>
                        </select>
                      <div class="invalid-feedback">Please enter your jabatan!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required autocomplete="off">
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="button" onclick="register()">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Created by <a href="#">Rekayasa Perangkat Lunak</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/jquery.js"></script>


  <script type="text/javascript">
    function register() {
      
      let foto = $('#yourFoto')[0]['files'];

      if (foto.legth == 0) {
        console.log(foto)
        Swal.fire("peringatan","silahkan Upload foto anda!!","warning");
        return;
      }
      var file = document.getElementById("yourFoto").files[0].name;
      var form_data = new FormData();
      var ext = file.split('.').pop().toLowerCase();
      if (ext != 'jpg' && ext != 'png' && ext != 'jpeg') {
        Swal.fire("peringatan","file hrus berformat jpg/png/jpeg","warning");
        return;
      }
      var nama = $('#yourName').val();
      var email = $('#yourEmail').val();
      var username = $('#yourUsername').val();
      var password = $('#yourPassword').val();
      var jabatan = $('#jabatan').val();

      form_data.append("foto",foto[0])

      form_data.set("nama", nama);
      form_data.set("email", email);
      form_data.set("username", username);
      form_data.set("password", password);
      form_data.set("jabatan", jabatan);



      if (nama == "") {
        Swal.fire("Peringatan","nama tidak boleh kosong","warning");
        return;
      }
      if (email == "") {
        Swal.fire("Peringatan","email tidak boleh kosong","warning");
        return;
      }
      if (foto == "") {
        Swal.fire("Peringatan","foto tidak boleh kosong","warning");
        return;
      }
      if (username == "") {
        Swal.fire("Peringatan","username tidak boleh kosong","warning");
        return;
      }
      if (password == "") {
        Swal.fire("Peringatan","password tidak boleh kosong","warning");
        return;
      }
       if (jabatan == "") {
        Swal.fire("Peringatan","harap pilih jabatan","warning");
        return;
      }

      var url = "<?= BASE_URL; ?>back/handle_register.php";

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

</body>

</html>