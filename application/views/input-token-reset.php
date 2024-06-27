<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Forgot Password | Djaman Pembeli</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    
    <link rel="icon" type="image/x-icon" href="<?= base_url()?>/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url()?>/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    
    <link rel="stylesheet" href="<?= base_url()?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url()?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url()?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url()?>/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="<?= base_url()?>/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url()?>/assets/js/config.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Forgot Password -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img
                      width="25"
                      viewBox="0 0 25 42"
                      version="1.1"
                      src="<?= base_url()?>/assets/img/icons/brands/djaman.webp"
                    />
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">Djaman Pembeli</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Ganti Password 🔒</h4>
              <p class="mb-4">Masukkan Password Baru Anda</p>
              <?php if ($this->session->userdata("error")): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <?php echo $this->session->userdata("error"); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php elseif ($this->session->userdata("success")): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <?php echo $this->session->userdata("success"); ?>    
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <?php 
              // Waktu saat ini
              $currentTime = new DateTime();
              
              if ($data_token != NULL){
                // Waktu created_at dari database (gantilah ini dengan nilai sesungguhnya)
                $createdAt = new DateTime($data_token->created_at);

                // Selisih waktu antara created_at dan waktu saat ini
                $timeDifference = $currentTime->getTimestamp() - $createdAt->getTimestamp();

                // Batas waktu kadaluarsa (dalam detik)
                $expirationTime = 15 * 60; // 15 menit * 60 detik/menit
              


                if ($data_token->token === NULL || $timeDifference > $expirationTime) {
                  // Token NULL atau kadaluarsa, tampilkan pesan
                  echo '<div class="alert alert-warning alert-dismissible" role="alert">';
                  echo 'Token Telah Digunakan atau Kadaluarsa';
                  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                  echo '</div>';
                } elseif ($data_token->token) {
                  // Token masih berlaku, tampilkan form
                  ?>

                  <form id="formAuthentication" class="mb-3" action="<?= base_url() ?>index.php/ForgetPassword/resetPasswordPembeli" method="POST">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="token" name="token" autofocus value="<?= $data_token->token ?>" hidden />
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" autofocus value="<?= $data_token->email ?>" readonly />
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Password Baru</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus />
                    </div>
                    <button class="btn btn-primary d-grid w-100">Ganti Password</button>
                  </form>

              <?php 
                } 
              }else{
                  // Token NULL atau kadaluarsa, tampilkan pesan
                  echo '<div class="alert alert-warning alert" role="alert">';
                  echo 'Token Telah Digunakan atau Kadaluarsa';
                  echo '</div>';
              }?>

              <div class="text-center">
                <a href="<?= base_url()?>index.php/Home/loginPage" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Kembali ke halaman Login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
    </div>
    
    <!-- Core JS -->
    <!-- build:js admin/assets/vendor/js/core.js -->
    <script src="<?= base_url()?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url()?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url()?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url()?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= base_url()?>/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= base_url()?>/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
  </body>
</html>
