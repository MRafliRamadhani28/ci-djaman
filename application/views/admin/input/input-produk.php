          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Tambah Produk</h5>
                      

                      <div class="card-body">
                        <?php if ($this->session->flashdata("error")): ?>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="alert alert-danger alert-dismissible">
                                        <?php echo $this->session->flashdata("error"); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo site_url('Produk/simpanProduk'); ?>" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="id_produk" class="form-label">ID Produk</label>
                            <input
                              type="text"
                              class="form-control"
                              id="id_produk"
                              name="id_produk"
                              placeholder="PJM001"
                              value="<?php echo $newProductID; ?>"
                              readonly
                              required
                            />
                          </div>
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Nama Jamu</label>
                              <input
                                type="text"
                                class="form-control"
                                id="nama_jamu"
                                name="nama_jamu"
                                placeholder="Cth: Beras Kencur"
                                required title="Formulir Tidak Boleh Kosong."
                              />
                          </div>
                          <div class="mb-2">
                              <label for="deskripsi" class="form-label">Deskripsi Jamu</label>
                              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required placeholder="Deksripsi Detail Tentang Produk Jamu"></textarea>
                              
                          </div>
                          <div class="mb-3">
                              <label for="kategori" class="form-label">Kategori Jamu</label>
                              <select class="form-select" id="kategori" name="kategori" aria-label="Default select example" required>
                                  <option selected disabled>Pilih Kategori</option>
                                  <?php foreach ($kategori as $row) { ?>
                                      <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Satuan (cth: PCS/Pack/botol/dll)</label>
                              <input
                                type="text"
                                class="form-control"
                                id="satuan"
                                name="satuan"
                                placeholder="Cth: Pcs/Pack/Botol"
                                required
                              />
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Harga per Satuan</label>
                            <input
                              type="text"
                              class="form-control"
                              id="harga"
                              name="harga_varchar"
                              placeholder="Cth: 10.000"
                              required
                            />
                            <input
                              type="text"
                              id="hidden_harga"
                              name="harga"
                              hidden
                            />
                          </div>
                          <div class="mb-3">
                            <label for="manfaat1" class="form-label">Manfaat 1</label>
                            <input
                              type="text"
                              class="form-control"
                              id="manfaat1"
                              name="manfaat1"
                              placeholder="Cth: Meningkatkan Daya Tahan Tubuh"
                              required
                            />
                          </div>
                          <div class="mb-3">
                            <label for="manfaat2" class="form-label">Manfaat 2</label>
                            <input
                              type="text"
                              class="form-control"
                              id="manfaat2"
                              name="manfaat2"
                              placeholder="Cth: Menjaga Kesehatan Organ Tubuh"
                              required
                            />
                          </div>
                          <div class="mb-3">
                            <label for="manfaat3" class="form-label">Manfaat 3</label>
                            <input
                              type="text"
                              class="form-control"
                              id="manfaat3"
                              name="manfaat3"
                              placeholder="Cth: Meningkatkan sistem pencernaan"
                              required title="Silakan isi nama Anda."
                            />
                          </div>
                          <div>
                              <label for="deskripsi" class="form-label">Link Marketplace</label>
                              <textarea class="form-control" id="deskripsi" name="link_marketplace" rows="3"  placeholder="Link Shopee/Tokopedia/Dll"></textarea>
                          </div>
                          <hr class="m-0">

                          

                          <!-- Foto -->
                          <div class="mt-4">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                              <img style="max-width: 100%; height: auto; width: 200px;"
                                src="<?= base_url()?>/assets/img/produk/default.webp"
                                alt="foto-produk"
                                class="d-block rounded "
                                id="uploadedAvatar"
                              />
                              <div class="button-wrapper">

                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                  <span class="d-none d-sm-block">Upload Foto Produk</span>
                                  <i class="bx bx-upload d-block d-sm-none"></i>
                                  <input
                                    type="file"
                                    id="upload"
                                    class="account-file-input"
                                    hidden
                                    name="foto"
                                    accept="image/png, image/jpeg, image/webp"
                                  />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                  <i class="bx bx-reset d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <p class="text-muted mb-0">Format Gambar .jpg, .png, .webp dan ukuran Gambar Maksimal 5MB.</p>
                              </div>
                              
                            </div>
                          </div>

                          
                      </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Simpan Produk</button>
                        <a href="<?= base_url()?>index.php/Produk/tampilDataProduk" class="btn btn-outline-primary">Kembali</a>
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
      });
    </script>
    <script>
        $(document).ready(function() {
            // Mengganti pesan validasi "required" untuk ID Produk
            $("#id_produk").on("invalid", function(event) {
                event.target.setCustomValidity("Silakan isi ID Produk.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#id_produk").on("input", function(event) {
                event.target.setCustomValidity("");
            });

            // Mengganti pesan validasi "required" untuk Nama Jamu
            $("#nama_jamu").on("invalid", function(event) {
                event.target.setCustomValidity("Silakan isi Nama Jamu.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#nama_jamu").on("input", function(event) {
                event.target.setCustomValidity("");
            });

            // Mengganti pesan validasi "required" untuk Deskripsi Jamu
            $("#deskripsi").on("invalid", function(event) {
                event.target.setCustomValidity("Silakan isi Deskripsi Jamu.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#deskripsi").on("input", function(event) {
                event.target.setCustomValidity("");
            });

            // Mengganti pesan validasi "required" untuk Kategori Jamu
            $("#kategori").on("invalid", function(event) {
                event.target.setCustomValidity("Pilih Kategori Jamu.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#kategori").on("input", function(event) {
                event.target.setCustomValidity("");
            });

            // Mengganti pesan validasi "required" untuk Satuan
            $("#satuan").on("invalid", function(event) {
                event.target.setCustomValidity("Silakan isi Satuan.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#satuan").on("input", function(event) {
                event.target.setCustomValidity("");
            });

            // Mengganti pesan validasi "required" untuk Harga per Satuan
            $("#harga").on("invalid", function(event) {
                event.target.setCustomValidity("Silakan isi Harga per Satuan.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#harga").on("input", function(event) {
                event.target.setCustomValidity("");
            });

            // Mengganti pesan validasi "required" untuk Manfaat 1
            $("#manfaat1").on("invalid", function(event) {
                event.target.setCustomValidity("Silakan isi Manfaat 1.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#manfaat1").on("input", function(event) {
                event.target.setCustomValidity("");
            });

            // Mengganti pesan validasi "required" untuk Manfaat 2
            $("#manfaat2").on("invalid", function(event) {
                event.target.setCustomValidity("Silakan isi Manfaat 2.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#manfaat2").on("input", function(event) {
                event.target.setCustomValidity("");
            });

            // Mengganti pesan validasi "required" untuk Manfaat 3
            $("#manfaat3").on("invalid", function(event) {
                event.target.setCustomValidity("Silakan isi Manfaat 3.");
            });

            // Mengembalikan pesan validasi ke default jika input valid
            $("#manfaat3").on("input", function(event) {
                event.target.setCustomValidity("");
            });
        });
    </script>