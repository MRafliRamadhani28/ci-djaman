          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Data Anggota dari:</span> <?php echo $data_anggota->nama; ?></h4>
              <div class="row">
                <div class="col-lg-4">
                  <div class="card mb-3">
                    <div class="card-body d-flex justify-content-center align-items-center">
                      <img style="max-width: 100%; height: auto; width: 200px;"
                        src="<?= base_url() ?>/assets/img/anggota/<?= htmlentities($data_anggota->foto) ?>"
                        alt="user-avatar"
                        class="d-block rounded"
                        id="uploadedAvatar"
                      />
                    </div>

                    <hr class="m-0" />

                  </div>
                </div>
                <div class="col-lg">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">ID Anggota:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $data_anggota->id_anggota?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Nama Anggota:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $data_anggota->nama?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Jabatan Anggota:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $data_anggota->jabatan?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Email Anggota:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $data_anggota->email?>
                            </p>
                          </td>
                        </div>
                        
                        <div class="row">
                          <div class="mt-2">
                            <a href="<?= base_url()?>index.php/Organisasi/tampilDataOrganisasi" class="btn btn-icon btn-outline-primary">
                              <span class="tf-icons bx bx-left-arrow-alt"></span>
                            </a>
                              <a href="<?= base_url()?>index.php/Organisasi/editOrganisasi/<?=  $data_anggota->id_anggota?>" class="btn btn-primary">Edit Anggota</a>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <!-- / Content -->