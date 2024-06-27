          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Jam Operasional untuk hari: <?=$data_jam_operasional->hari?></h5>
                      <?php echo $this->session->flashdata("error"); ?>

                      <div class="card-body">
                        <form action="<?php echo site_url('Admin/updateJamOperasional/'.$data_jam_operasional->id_jamoperasional); ?>" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                              <label for="jam_buka" class="form-label">Jam Buka (format jam:menit:detik)</label>
                              <input
                                type="text"
                                class="form-control"
                                id="jam_buka"
                                name="jam_buka"
                                value="<?php echo $data_jam_operasional->jam_buka; ?>"
                              />
                          </div>
                          <div class="mb-3">
                              <label for="jam_tutup" class="form-label">Jam Tutup (format jam:menit:detik)</label>
                              <input
                                type="text"
                                class="form-control"
                                id="jam_tutup"
                                name="jam_tutup"
                                value="<?php echo $data_jam_operasional->jam_tutup; ?>"
                              />
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Simpan Perubahan</button>
                        <?php if ($data_jam_operasional->isBuka !== 'Tutup'): ?>
                            <a href="<?= base_url()?>index.php/Admin/tutupJamOperasional/<?= $data_jam_operasional->id_jamoperasional?>" class="btn btn-danger">Tutup Jam Operasional</a>
                        <?php endif; ?>
                        <a href="<?= base_url()?>index.php/Admin/tampilJamOperasional" class="btn btn-outline-primary">Batalkan</a>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            <!-- / Content -->

          