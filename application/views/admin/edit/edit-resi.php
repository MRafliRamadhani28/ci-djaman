          <!-- Content wrapper -->
          <div class="content-wrapper">
              <!-- Content -->

              <div class="container-xxl flex-grow-1 container-p-y">
                  <div class="row">
                      <div class="col">
                          <div class="card mb-4">
                              <h5 class="card-header">Edit Resi</h5>
                              <?php echo $this->session->flashdata("error"); ?>

                              <div class="card-body">
                                <form action="<?php echo site_url('Resi/updateResi/' . $data_resi->id); ?>" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="no_resi" class="form-label">No. Resi</label>
                                    <input type="number" class="form-control" id="no_resi" name="no_resi" value="<?php echo $data_resi->no_resi; ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="kode_transaksi" class="form-label">Kode Transaksi & Pembeli</label>
                                    <select class="form-select" id="kode_transaksi" name="kode_transaksi" aria-label="Default select example">
                                        <option disabled>Pilih Kode Transaksi</option>
                                        <?php foreach ($resi as $row) { ?>
                                            <option value="<?php echo $row['transaksi_id'] . '-' . $row['pembeli_id']; ?>" <?php echo ($row['transaksi_id'] . '-' . $row['pembeli_id'] == $data_resi->transaksi_id . '-' . $data_resi->pembeli_id) ? 'selected' : ''; ?>>
                                                <?php echo $row['kode_transaksi'] . ' - ' . $row['pembeli']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                             </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="mt-1">
                              <button type="submit" class="btn btn-primary ">Perbarui Data</button>
                              <a href="<?= base_url() ?>index.php/Resi/tampilResi" class="btn btn-outline-primary">Kembali</a>
                          </div>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
          <!-- / Content -->