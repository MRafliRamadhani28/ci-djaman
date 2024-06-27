          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Perbarui Produk Terlaris</h5>
                      <?php echo $this->session->flashdata("error"); ?>

                      <div class="card-body">
                        <form action="<?php echo site_url('Produk/updateTerlaris/'.$produk_terlaris->id_produk); ?>" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="id_produk" class="form-label">ID Produk</label>
                            <input
                              type="text"
                              class="form-control"
                              id="id_produk"
                              name="id_produk"
                              value="<?php echo $produk_terlaris->id_produk; ?>"
                              placeholder="PJM001"
                              readonly
                            />
                          </div>
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Nama Jamu</label>
                              <input
                                type="text"
                                class="form-control"
                                id="nama_jamu"
                                name="nama_jamu"
                                value="<?php echo $produk_terlaris->nama_jamu; ?>"
                                readonly
                              />
                          </div>
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Harga Asli</label>
                              <input
                                type="text"
                                class="form-control"
                                id="hargaAsli"
                                name="hargaAsli"
                                value="Rp. <?php echo $produk_terlaris->harga; ?>"
                                readonly
                              />
                              <input
                                type="text"
                                class="form-control"
                                id="hargaProduk"
                                name="harga_asli"
                                value="<?php echo $produk_terlaris->harga; ?>"
                                hidden
                              />
                          </div>
                          <div class="mb-3">
                              <label for="diskon" class="form-label">Diskon</label>
                              <input
                                type="text"
                                class="form-control"
                                id="diskon"
                                name="diskon"
                                placeholder="Mis 30 tanpa memasukkan persen"
                              />
                          </div>
                          <div class="mb-3">
                              <label for="diskon" class="form-label">Harga Setelah Diskon</label>
                              <input
                                type="text"
                                class="form-control"
                                id="hargaDiskon"
                                name="hargaDiskon"
                                placeholder=""
                                readonly
                              />
                              <input
                                type="text"
                                id="hargaDiskonInteger"
                                name="harga_diskon"
                                placeholder=""
                                hidden
                              />
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Berakhir Diskon (Format Tanggal Bulan/Hari/Tahun)</label>
                            <input class="form-control" type="date" name="date" value="2023-07-15" id="html5-date-input">
                            <!-- <div id="defaultFormControlHelp" class="form-text">
                              Format Tanggal Hari/Bulan/Tahun
                            </div> -->
                          </div>
                          <hr class="m-0">
                          
                          <!-- Foto -->
                          <div class="mt-4">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                              <img style="max-width: 100%; height: auto; width: 100px;"
                                src="<?php echo base_url('/assets/img/produk/'.$produk_terlaris->foto); ?>"
                                alt="foto-produk"
                                class="d-block rounded "

                                id="uploadedAvatar"
                              />
                              <div class="button-wrapper">
                              <p class="text-muted mb-2">Nama Foto Produk</p>
                                  <input
                                    type="text"
                                    class="form-control"
                                    name="foto"
                                    accept="image/png, image/jpeg"
                                    value="<?php echo $produk_terlaris->foto; ?>"
                                    readonly
                                  />


                              </div>
                              
                            </div>
                          </div>

                          
                      </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Simpan Perubahan</button>
                        <a href="<?= base_url()?>index.php/Produk/tampilDataProduk" class="btn btn-outline-primary">Batalkan</a>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://reyhanadr.epizy.com" target="_blank" class="footer-link fw-bolder">Reyhanadr</a>
                </div>

              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url()?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url()?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url()?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url()?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= base_url()?>/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url()?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url()?>/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url()?>/assets/js/dashboards-analytics.js"></script>
    <script src="<?= base_url()?>/assets/js/pages-account-settings-account.js"></script>


    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        // Mengambil elemen input
        var hargaProdukInput = document.getElementById('hargaProduk');
        var diskonInput = document.getElementById('diskon');
        var hargaDiskonIntegerInput = document.getElementById('hargaDiskonInteger');
        var hargaDiskonInput = document.getElementById('hargaDiskon');

        // Menambahkan event listener untuk input diskon
        diskonInput.addEventListener('input', function() {
          // Mendapatkan nilai harga produk dan diskon
          var hargaProduk = parseFloat(hargaProdukInput.value);
          var diskon = parseFloat(diskonInput.value);

          // Memastikan nilai yang valid
          if (isNaN(hargaProduk) || isNaN(diskon)) {
            hargaDiskonInput.value = '';
            hargaDiskonIntegerInput.value = '';
          } else {
            // Melakukan perhitungan diskon
            var hargaDiskon = hargaProduk - (hargaProduk * (diskon / 100));

            // Format harga diskon ke dalam format Rp.15.000
            var formattedHargaDiskon = 'Rp. ' + hargaDiskon.toLocaleString('id-ID');

            // Menampilkan hasil perhitungan
            hargaDiskonInput.value = formattedHargaDiskon;
            hargaDiskonIntegerInput.value = hargaDiskon.toFixed(0); // Mengambil nilai integer
          }
        });
      </script>
  </body>
</html>
