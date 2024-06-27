          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Edit Anggota</h5>
                      <?php echo $this->session->flashdata("error"); ?>

                      <div class="card-body">
                        <form action="<?php echo site_url('Organisasi/update/'.$data_organisasi->id_anggota); ?>" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="id_anggota" class="form-label">ID Anggota</label>
                            <input
                              type="text"
                              class="form-control"
                              id="id_anggota"
                              name="id_anggota"
                              value="<?php echo $data_organisasi->id_anggota; ?>"
                              placeholder="PJM001"
                              readonly
                            />
                          </div>
                          <div class="mb-3">
                              <label for="nama" class="form-label">Nama Anggota</label>
                              <input
                                type="text"
                                class="form-control"
                                id="nama"
                                name="nama"
                                value="<?php echo $data_organisasi->nama; ?>"
                              />
                          </div>
                          <div class="mb-3">
                              <label for="jabatan" class="form-label">Jabatan</label>
                              <input
                                type="text"
                                class="form-control"
                                id="jabatan"
                                name="jabatan"
                                value="<?php echo $data_organisasi->jabatan; ?>"
                              />
                          </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                              type="email"
                              class="form-control"
                              id="email"
                              name="email"
                              value="<?php echo $data_organisasi->email; ?>"

                            />
                          </div>
                          <hr class="m-0">

                          <!-- Foto -->
                          <div class="mt-4">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                              <img style="max-width: 100%; height: auto; width: 100px;"
                                src="<?php echo base_url('/assets/img/anggota/'.$data_organisasi->foto); ?>"
                                alt="foto-anggota"
                                class="d-block rounded "
                                id="uploadedAvatar"
                              />
                              <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                  <span class="d-none d-sm-block">Upload Foto Anggota</span>
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
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Simpan Perubahan</button>
                        <a href="<?= base_url()?>index.php/Organisasi/tampilDataOrganisasi" class="btn btn-outline-primary">Batalkan</a>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            <!-- / Content -->