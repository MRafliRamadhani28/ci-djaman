          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Edit Kontak</h5>
                      <?php echo $this->session->flashdata("error"); ?>

                      <div class="card-body">
                        <form action="<?php echo site_url('Kontak/update/'.$data_kontak->id_kontak); ?>" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="id_kontak" class="form-label">ID Kontak</label>
                            <input
                              type="text"
                              class="form-control"
                              id="id_kontak"
                              name="id_kontak"
                              value="<?php echo $data_kontak->id_kontak; ?>"
                              readonly
                            />
                          </div>
                          <div class="mb-3">
                              <label for="alamat" class="form-label">Alamat</label>
                              <input
                                type="text"
                                class="form-control"
                                id="alamat"
                                name="alamat"
                                value="<?php echo $data_kontak->alamat; ?>"
                              />
                          </div>

                          <div class="mb-3">
                              <label for="phone" class="form-label">No. Telepon (gunakan angka "62")</label>
                              <input
                                type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                                oninput="formatPhoneNumber(this)"
                                value="<?php echo $data_kontak->phone; ?>"
                              />
                          </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                              type="email"
                              class="form-control"
                              id="email"
                              name="email"
                              value="<?php echo $data_kontak->email; ?>"

                            />
                          </div>
                          <div class="mb-3">
                            <label for="maps" class="form-label">Maps</label>
                            <textarea type="text" class="form-control" id="maps" name="maps" rows="5"><?php echo $data_kontak->maps; ?> </textarea>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Simpan Perubahan</button>
                        <a href="<?= base_url()?>index.php/Kontak/detailKontak/KNTK1" class="btn btn-outline-primary">Batalkan</a>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            <!-- / Content --