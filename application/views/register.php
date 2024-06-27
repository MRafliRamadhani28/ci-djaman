<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register Page - Djaman</title>

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

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="col-md-8">
          <!-- Register -->
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
                  <span class="app-brand-text demo text-body fw-bolder">Djaman - Register</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Pendaftaran! 👋</h4>
              <p class="mb-2">Silahkan isi data untuk pendaftaran</p>
              <?php if ($this->session->userdata("error")): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <?php echo $this->session->userdata("error"); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php elseif($this->session->userdata("success")): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <?php echo $this->session->userdata("success"); ?>    
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <form class="mb-3" action="<?php echo site_url('Home/register');?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                placeholder="Masukkan nama lengkap"
                                autofocus
                                required
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Masukkan Email"
                                autofocus
                                required
                            />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input
                                type="number"
                                class="form-control"
                                id="no_telp"
                                name="no_telp"
                                placeholder="Masukkan nomor telepon"
                                autofocus
                                required
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <input
                                type="text"
                                class="form-control"
                                id="kota"
                                name="kota"
                                placeholder="Masukkan Kota"
                                autofocus
                                required
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="provinsi"
                                name="provinsi"
                                placeholder="Masukkan Provinsi"
                                autofocus
                                required
                            />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" class="form-control" rows="5" placeholder="Masukkan Alamat Lengkap" required></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Kode Pos</label>
                          <input
                            type="text"
                            class="form-control"
                            id="kode_pos"
                            name="kode_pos"
                            placeholder="Masukkan Kode Pos"
                            autofocus
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Foto</label>
                          <input
                            type="file"
                            class="form-control"
                            id="foto"
                            name="foto"
                            placeholder="Masukkan Foto"
                            autofocus
                          />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                placeholder="Masukkan username"
                                autofocus
                                required
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                <!-- <a href="<?=base_url()?>index.php/ForgetPassword">
                                <small>Lupa Password?</small>
                                </a> -->
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                required
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <!-- Tambahkan reCAPTCHA di sini -->
                    <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                </div>
                <div class="mb-3">
                    <button 
                        class="btn btn-primary d-grid w-100"
                        type="submit">
                        Daftar
                    </button>
                </div>
              </form>

              <p class="text-center">
                <span>Sudah punya akun?</span>
                <a href="<?= base_url('index.php/Home/loginPage') ?>">
                  <span>Masuk</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
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