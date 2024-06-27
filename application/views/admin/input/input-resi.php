          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Tambah Resi</h5>
                      

                      <div class="card-body">
                        <!-- Tampilkan pesan error -->
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
                        <form action="<?php echo site_url('Resi/simpanResi'); ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="no_resi" class="form-label">No Resi</label>
                                <input
                                type="text"
                                class="form-control"
                                id="no_resi"
                                name="no_resi"
                                placeholder="Masukkan No Resi"
                                required
                                />
                            </div>

                            <div class="mb-3">
                                <label for="kode_transaksi" class="form-label">Kode Transaksi & Pembeli</label>
                                <select class="form-select" id="kode_transaksi" name="kode_transaksi" aria-label="Default select example" required>
                                    <option selected disabled>Pilih Kode Transaksi</option>
                                    <?php foreach ($resi as $row) { ?>
                                        <option value="<?php echo $row['transaksi_id'] . '-' . $row['pembeli_id']; ?>"><?php echo $row['kode_transaksi'] . ' - ' . $row['pembeli']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Simpan Resi</button>
                        <a href="<?= base_url()?>index.php/Resi/tampilResi" class="btn btn-outline-primary">Kembali</a>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            <!-- / Content -->
    <script>
      $(document).ready(function() {
        // Mengganti pesan validasi "required" untuk No Resi
        $("#no_resi").on("invalid", function(event) {
          event.target.setCustomValidity("Silakan isi No Resi.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#no_resi").on("input", function(event) {
          event.target.setCustomValidity("");
        });

        // Mengganti pesan validasi "required" untuk Kode Transaksi
        $("#kode_transaksi").on("invalid", function(event) {
          event.target.setCustomValidity("Silakan isi Kode Transaksi.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#kode_transaksi").on("input", function(event) {
          event.target.setCustomValidity("");
        });
      });
    </script>
