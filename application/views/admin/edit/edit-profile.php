          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan Akun /</span> <?php echo $admin->nama; ?></h4>
              <div class="row">
                <div class="col">
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    <?php endif; ?>
                    <!-- Account -->
                    <form id="formAccountSettings" method="POST"action="<?= base_url()?>index.php/Profile/update/<?= $admin->id_admin; ?>" enctype="multipart/form-data">
                    <hr class="my-0" />
                    
                    <div class="card-header">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img style="max-width: 100%; height: auto; width: 100px;"
                          src="<?= base_url()?>/assets/img/admin/<?php echo $admin->foto; ?>"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="80"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              name="foto"
                              accept="image/png, image/jpeg, image/jpg, image/webp"
                            />
                          </label>

                          <p class="text-muted mb-0">Format Gambar .jpg, .png, .webp dan ukuran Gambar Maksimal 10MB.</p>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input class="form-control" type="text" name="nama" id="namalengkap" value="<?php echo $admin->nama; ?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="email"
                              id="email"
                              name="email"
                              value="<?php echo $admin->email; ?>"
                              placeholder="john.doe@example.com"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="Username" class="form-label">Username</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                              name="username"
                              value="<?php echo $admin->username; ?>"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Password</label>
                            <input type="Password" class="form-control" id="Password" name="password" placeholder="Isi Jika Ingin Mengganti Password"/>
                          </div>
                          <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                            <a href="<?= base_url()?>index.php/Admin" class="btn btn-outline-secondary"> Batalkan </a>
                          </div>
                    </div>
                    </form>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
          </div>

            <!-- / Content -->