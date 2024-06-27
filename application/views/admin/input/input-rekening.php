          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Tambah Rekening</h5>
                      

                      <div class="card-body">
                        <?php echo $this->session->flashdata("error"); ?>
                        <form action="<?php echo site_url('Transaksi/simpanRekening'); ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_rekening" class="form-label">Nama Rekening</label>
                                <input
                                type="text"
                                class="form-control"
                                id="nama_rekening"
                                name="nama_rekening"
                                placeholder="Masukkan Nama Rekening"
                                required
                                />
                            </div>

                            <div class="mb-3">
                                <label for="no_rekening" class="form-label">No Rekening</label>
                                <input
                                type="number"
                                class="form-control"
                                id="no_rekening"
                                name="no_rekening"
                                placeholder="Masukkan No Rekening"
                                required
                                />
                            </div>

                            <div class="mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input
                                type="text"
                                class="form-control"
                                id="bank"
                                name="bank"
                                placeholder="Masukkan Bank"
                                required
                                />
                            </div>
                         
                      </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Simpan Rekening</button>
                        <a href="<?= base_url()?>index.php/Transaksi/tampilDataRekening" class="btn btn-outline-primary">Kembali</a>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            <!-- / Content -->
    <script>
      $(document).ready(function() {

        $("#nama_rekening").on("invalid", function(event) {
          event.target.setCustomValidity("Silakan isi Nama Rekening.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#nama_rekening").on("input", function(event) {
          event.target.setCustomValidity("");
        });

        // Mengganti pesan validasi "required" untuk Nama Jamu
        $("#no_rekening").on("invalid", function(event) {
          event.target.setCustomValidity("Silakan isi No Rekening.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#no_rekening").on("input", function(event) {
          event.target.setCustomValidity("");
        });

        // Mengganti pesan validasi "required" untuk Nama Jamu
        $("#bank").on("invalid", function(event) {
          event.target.setCustomValidity("Silakan isi Bank.");
        });

        // Mengembalikan pesan validasi ke default jika input valid
        $("#bank").on("input", function(event) {
          event.target.setCustomValidity("");
        });
      });
    </script>
