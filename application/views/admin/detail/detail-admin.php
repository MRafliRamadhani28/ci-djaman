          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Data Admin:</span> <?php echo $detail_admin->nama; ?></h4>
              <div class="row">
                <div class="col-lg-4">
                  <div class="card mb-3">
                    <div class="card-body d-flex justify-content-center align-items-center">
                      <img style="max-width: 100%; height: auto; width: 200px;"
                        src="<?= base_url() ?>/assets/img/admin/<?= htmlentities($detail_admin->foto) ?>"
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
                          <h5 for="firstName" class="mb-2">ID Admin:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $detail_admin->id_admin?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Nama Admin:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $detail_admin->nama?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Username Admin:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $detail_admin->username?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Email Admin:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $detail_admin->email?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Password Admin:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                                *****
                            </p>
                          </td>
                        </div>

                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Role Admin:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $detail_admin->nama_role?>
                            </p>
                          </td>
                        </div>

                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Status Admin:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php if ($detail_admin->status_aktif === "Blokir"):?>
                                <span class="badge rounded-pill bg-danger">Blokir</span>
                              <?php else:?>
                                <span class="badge rounded-pill bg-success">Aktif</span>
                              <?php endif;?>
                            </p>
                          </td>
                        </div>

                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Tindakan Untuk Admin:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php if ($detail_admin->status_aktif === "Aktif" && $detail_admin->nama_role == "Admin"):?>
                                <button 
                                  href=""
                                  class="btn btn-danger button"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modalBlokir"
                                  data-id-admin="<?=$detail_admin->id_admin?>"
                                  data-namaadmin="<?=$detail_admin->nama?>"
                                >
                                  Blokir Admin
                                </button>     
                                <?php endif;?>
                              <?php if ($detail_admin->status_aktif === "Blokir" && $detail_admin->nama_role == "Admin"): ?>
                                  <a href="<?= base_url() ?>index.php/Admin/aktifkanAdmin/<?= $detail_admin->id_admin ?>" class="btn btn-success">
                                    Aktifkan Admin
                                  </a>
                              <?php endif; ?>
                            </p>
                          </td>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-2 mt-2">
                              <a href="<?= base_url()?>index.php/Admin/tampilDataAdmin" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-left-arrow-alt"></span>
                              </a>
                              <?php if ($detail_admin->status_aktif === "Aktif" && $detail_admin->nama_role == "Admin"):?>
                                <a href="<?= base_url()?>index.php/Admin/tampilEditAdmin/<?=  $detail_admin->id_admin?>" class="btn btn-primary">Edit Admin</a>
                              <?php endif; ?>

                          </div>
                        </div>
                        
                        <!-- <div class="row">
                          <div class="mt-2">
                              <a href="<?= base_url()?>index.php/Admin/tampilDataAdmin" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-left-arrow-alt"></span>
                              </a>
                              <a href="<?= base_url()?>index.php/Admin/tampilEditAdmin/<?=  $detail_admin->id_admin?>" class="btn btn-primary">Edit Data Admin</a>
                              <?php if ($detail_admin->status_aktif === "Aktif" && $detail_admin->nama_role == "Admin"):?>
                                <button 
                                  href=""
                                  class="btn btn-danger button"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modalBlokir"
                                  data-id-admin="<?=$detail_admin->id_admin?>"
                                  data-namaadmin="<?=$detail_admin->nama?>"
                                >
                                  Blokir Admin
                                </button>     
                                <?php endif;?>
                                <?php if ($detail_admin->status_aktif === "Blokir" && $detail_admin->nama_role == "Admin"): ?>
                                    <a href="<?= base_url() ?>index.php/Admin/aktifkanAdmin/<?= $detail_admin->id_admin ?>" class="btn btn-success">
                                      Aktifkan Admin
                                    </a>
                                <?php endif; ?>
                          </div>
                        </div> -->


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <!-- / Content --