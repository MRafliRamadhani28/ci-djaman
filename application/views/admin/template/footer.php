            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                  <div class="mb-2 mb-md-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    <a href="https://reyhanadr.epizy.com" target="_blank" class="footer-link fw-bolder">PKMPI Team</a>
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

      <!-- Iconify -->
      <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

      <!-- Custom for Input Produk -->
      <script>
      $(document).ready(function() {
        $('#harga').on('input', function() {
          var inputHarga = $(this).val();
          var angka = inputHarga.replace(/\D/g, '');
          var hargaFormatted = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          
          // Hapus tanda titik pemisah ribuan sebelum mengirim data
          var hargaInt = parseInt(angka.replace(/\./g, ''));
          
          // Set nilai input dengan format harga
          $(this).val(hargaFormatted);
          
          // Set nilai input tersembunyi (hidden input) dengan harga integer
          $('#hidden_harga').val(hargaInt);
        });

        $('#no_resi').on('input', function() {
          var noResi = $(this).val();
          var angka = noResi.replace(/\D/g, '');
          
          $(this).val(angka);
        });
      });
    </script>
    <!-- Custom untuk Edit Produk -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Ambil nilai harga dari input harga
        var harga = document.getElementById("harga").value;

        // Hapus tanda titik dan koma dari harga (format ribuan)
        var hargaTanpaFormat = harga.replace(/\D/g, "");

        // Set nilai harga_hidden dengan harga dalam format integer
        document.getElementById("hidden_harga").value = hargaTanpaFormat;
      });
    </script>
    
    <!-- Custom for Update Terlaris -->
    <!-- Custom for No Telp in Edit Kontak-->
    <script>
        function formatPhoneNumber(input) {
            // Menghapus semua karakter kecuali angka
            var phoneNumber = input.value.replace(/\D/g, '');

            // Memeriksa panjang nomor telepon
            if (phoneNumber.length === 0) {
                input.value = ''; // Tidak ada input, biarkan kosong
            } else {
                // Memformat nomor telepon menjadi +XX XX XXXX XXXX (sesuaikan dengan format Anda)
                input.value = '+' + phoneNumber.substring(0, 2) + ' ' + phoneNumber.substring(2, 5) + ' ' + phoneNumber.substring(5, 9) + ' ' + phoneNumber.substring(9);
            }
        }
    </script>
  </body>
  </html>