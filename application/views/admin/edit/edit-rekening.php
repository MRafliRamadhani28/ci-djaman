          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Edit Rekening</h5>
                      <?php echo $this->session->flashdata("error"); ?>

                      <div class="card-body">
                        <form action="<?php echo site_url('Transaksi/updateRekening/'.$data_rekening->id); ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_rekening" class="form-label">Nama Rekening</label>
                                <input
                                type="text"
                                class="form-control"
                                id="nama_rekening"
                                name="nama_rekening"
                                value="<?php echo $data_rekening->nama_rekening; ?>"
                                />
                            </div>
                                <div class="mb-3">
                                <label for="no_rekening" class="form-label">No. Rekening</label>
                                <input
                                type="number"
                                class="form-control"
                                id="no_rekening"
                                name="no_rekening"
                                value="<?php echo $data_rekening->no_rekening; ?>"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input
                                type="text"
                                class="form-control"
                                id="bank"
                                name="bank"
                                value="<?php echo $data_rekening->bank; ?>"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Perbarui Data</button>
                        <a href="<?= base_url()?>index.php/Transaksi/tampilDataRekening" class="btn btn-outline-primary">Kembali</a>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            <!-- / Content -->