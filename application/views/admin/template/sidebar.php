<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
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

    <link rel="stylesheet" href="<?= base_url()?>/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= base_url()?>/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url()?>/assets/js/config.js"></script>
    <!-- reCaptcha Enterprise Google -->
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6Lf8M04nAAAAAMpRiYuWw87cLuk1LV1Zl5H4oqFM"></script>
</head>
<body>
    <!-- Menu -->
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="<?= base_url()?>index.php/Admin" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img
                  width="25"
                  viewBox="0 0 25 42"
                  version="1.1"
                  src="<?= base_url()?>/assets/img/icons/brands/djaman.webp"
                />

              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Page</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item <?php if ($active_menu === 'dashboard') echo 'active'; ?>">
              <a href="<?= base_url()?>index.php/Admin" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Data Transaksi</span>
            </li>
            <li class="menu-item <?php if ($active_menu === 'data_transaksi') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url()?>index.php/Transaksi/tampilDataTransaksi" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-money"></i>
                  <div data-i18n="Basic">Data Transaksi</div>
                </a>
              <?php endif; ?>
            </li>
            <li class="menu-item <?php if ($active_menu === 'data_transaksi_riwayat') echo 'active'; ?>">
              <a href="<?= base_url()?>index.php/Transaksi/riwayatDataTransaksi" class="menu-link">
                <i class="menu-icon tf-icons bx bx-refresh"></i>
                <div data-i18n="Basic">Riwayat Transaksi</div>
              </a>
            </li>
            <li class="menu-item <?php if ($active_menu === 'data_rekening') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url()?>index.php/Transaksi/tampilDataRekening" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home"></i>
                  <div data-i18n="Basic">Data Rekening</div>
                </a>
              <?php endif; ?>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Data Terkait Produk</span>
            </li>
            <li class="menu-item <?php if ($active_menu === 'data_produk') echo 'active'; ?>">
              <a href="<?= base_url()?>index.php/Produk/tampilDataProduk" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Basic">Data Produk</div>
              </a>
            </li>
            <li class="menu-item <?php if ($active_menu === 'data_kategori') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url()?>index.php/Produk/tampilDataKategori" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-category"></i>
                  <div data-i18n="Basic">Kategori Penjual</div>
                </a>
              <?php endif; ?>
            </li>

            
            <li class="menu-item <?php if ($active_menu === 'produk_terlaris') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url()?>index.php/Produk/detailProdukTerlaris" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-star"></i>
                  <div data-i18n="Basic">Produk Terlaris</div>
                </a>
              <?php endif; ?>
            </li>

            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Terkait Situs, Organisasi, Pertanyaan dan Saran</span></li>
            <li class="menu-item <?php if ($active_menu === 'data_linkEmbed') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url()?>index.php/Admin/tampilLinkEmbed" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-link"></i>
                  <div data-i18n="Basic">Link Embed Instagram</div>
                </a>
              <?php endif; ?>
            </li>
            <li class="menu-item <?php if ($active_menu === 'data_organisasi') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url() ?>index.php/Organisasi/tampilDataOrganisasi" class="menu-link">
                  <iconify-icon class="menu-icon tf-icons" icon="clarity:organization-solid"></iconify-icon>
                  <div data-i18n="Basic">Data Anggota Organisasi</div>
                </a>
              <?php endif; ?>
            </li>

            <li class="menu-item <?php if ($active_menu === 'data_kontak') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url() ?>index.php/Kontak/detailKontak/KNTK1" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-contact"></i>
                  <div data-i18n="Basic">Data Kontak</div>
                </a>
              <?php endif; ?>
            </li>

            <li class="menu-item <?php if ($active_menu === 'resi') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url() ?>index.php/Admin/tampilResi" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-package"></i>
                  <div data-i18n="Basic">Data Resi</div>
                </a>
              <?php endif; ?>
            </li>

            <li class="menu-item <?php if ($active_menu === 'jam_operasional') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url() ?>index.php/Admin/tampilJamOperasional" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-time"></i>
                  <div data-i18n="Basic">Jam Operasional</div>
                </a>
              <?php endif; ?>
            </li>

            <li class="menu-item <?php if ($active_menu === 'data_admin') echo 'active'; ?>">
              <?php if ($this->session->userdata('role_id') == 1) : ?>
                <a href="<?= base_url()?>index.php/Admin/tampilDataAdmin" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-user-account"></i>
                  <div data-i18n="Basic">Data Admin</div>
                </a>
              <?php endif; ?>
            </li>
            
            <li class="menu-item <?php if ($active_menu === 'asknsugest') echo 'active'; ?>">
              <a href="<?= base_url()?>index.php/Asknsugest/tampilAsknsugest" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Basic">Kumpulan Pertanyaan & Saran</div>
              </a>
            </li>
            <li class="menu-item <?php if ($active_menu === 'data-email') echo 'active'; ?>">
              <a href="<?= base_url()?>index.php/Asknsugest/tampilDataEmail" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Basic">Kumpulan Email Subscription</div>
              </a>
            </li>
          </ul>
        </aside>
