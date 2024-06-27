          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Tambah Kategori Produk</h5>
                      

                      <div class="card-body">
                        <?php echo $this->session->flashdata("error"); ?>
                        <form action="<?php echo site_url('Produk/simpanKategori'); ?>" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input
                              type="text"
                              class="form-control"
                              id="nama_kategori"
                              name="nama_kategori"
                              placeholder="cth: Jamu Segar"
                              required
                            />
                          </div>

                          <div>
                              <label for="deskripsi" class="form-label">Deskripsi Kategori</label>
                              <textarea class="form-control" id="deskripsi_kategori" name="deskripsi_kategori" rows="3" required placeholder="Deksripsi Detail Tentang Kategori Produk"></textarea>
                          </div>
                         
                      </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Simpan Kategori</button>
                        <a href="<?= base_url()?>index.php/Produk/tampilDataKategori" class="btn btn-outline-primary">Kembali</a>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            <!-- / Content -->
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

        $("#nama_kategori").on("invalid", function(event) {
          event.target.setCustomValidity("Silakan isi Nama Kategori.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#nama_kategori").on("input", function(event) {
          event.target.setCustomValidity("");
        });

        // Mengganti pesan validasi "required" untuk Nama Jamu
        $("#deskripsi_kategori").on("invalid", function(event) {
          event.target.setCustomValidity("Silakan isi Deskripsi Kategori.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#deskripsi_kategori").on("input", function(event) {
          event.target.setCustomValidity("");
        });
      });
    </script>
