          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Tambah Data Admin</h5>
                      

                      <div class="card-body">
                        <?php echo $this->session->flashdata("error"); ?>
                        <form action="<?php echo site_url('Admin/simpanAdmin'); ?>" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="id_produk" class="form-label">ID Admin</label>
                            <input
                              type="text"
                              class="form-control"
                              id="id_admin"
                              name="id_admin"
                              placeholder="PJM001"
                              value="<?php echo $newAdminId; ?>"
                              readonly
                            />
                          </div>
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Nama Admin</label>
                              <input
                                type="text"
                                class="form-control"
                                id="nama"
                                name="nama"
                                required
                              />
                          </div>
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Email Admin</label>
                              <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                required
                              />
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Username Admin</label>
                            <input
                              type="text"
                              class="form-control"
                              id="username"
                              name="username"
                              required
                            />
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password Admin</label>
                            <input
                              type="password"
                              class="form-control"
                              id="password"
                              name="password"
                              required
                            />
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Role Admin</label>
                            <input
                              type="text"
                              class="form-control"
                              id="namarole"
                              name="namarole"
                              readonly
                              value="<?= $data_roles->nama_role?>"
                            />
                            <input
                              type="text"
                              class="form-control"
                              id="role_id"
                              name="role_id"
                              hidden
                              value="<?= $data_roles->role_id?>"
                            />
                          </div>
                          <hr class="m-0">

                          <!-- Foto -->
                          <div class="mt-4">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                              <img style="max-width: 100%; height: auto; width: 150px;"
                                src="<?= base_url()?>/assets/img/avatars/1.png"
                                alt="user-avatar"
                                class="d-block rounded "
                                id="uploadedAvatar"
                              />
                              <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                  <span class="d-none d-sm-block">Upload Foto Admin</span>
                                  <i class="bx bx-upload d-block d-sm-none"></i>
                                  <input
                                    type="file"
                                    id="upload"
                                    class="account-file-input"
                                    hidden
                                    name="foto"
                                    accept="image/png, image/jpeg"
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
                            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2 mb-4 ">
                                <button type="submit" class="btn btn-primary ">Simpan Admin</button>
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
        // Mengganti pesan validasi "required" untuk ID Admin
        $("#id_admin").on("invalid", function(event) {
            event.target.setCustomValidity("Silakan isi ID Admin.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#id_admin").on("input", function(event) {
            event.target.setCustomValidity("");
        });

        // Mengganti pesan validasi "required" untuk Nama Admin
        $("#nama").on("invalid", function(event) {
            event.target.setCustomValidity("Silakan isi Nama Admin.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#nama").on("input", function(event) {
            event.target.setCustomValidity("");
        });

        // Mengganti pesan validasi "required" untuk Email Admin
        $("#email").on("invalid", function(event) {
            event.target.setCustomValidity("Silakan isi Email Admin.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#email").on("input", function(event) {
            event.target.setCustomValidity("");
        });

        // Mengganti pesan validasi "required" untuk Username Admin
        $("#username").on("invalid", function(event) {
            event.target.setCustomValidity("Silakan isi Username Admin.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#username").on("input", function(event) {
            event.target.setCustomValidity("");
        });

        // Mengganti pesan validasi "required" untuk Password Admin
        $("#password").on("invalid", function(event) {
            event.target.setCustomValidity("Silakan isi Password Admin.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#password").on("input", function(event) {
            event.target.setCustomValidity("");
        });
      });
    </script>

