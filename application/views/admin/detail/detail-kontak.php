          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail dari Menu: </span>Kontak Kami / Data Kontak</h4>
                                  <!-- Tampilkan pesan alert success -->
                    <?php if ($this->session->flashdata("success")): ?>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 col-lg-6">
                                <div class="alert alert-success alert-dismissible">
                                    <?php echo $this->session->flashdata("success"); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
              <div class="row">
                <div class="col-lg">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">ID Kontak:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $data_kontak->id_kontak?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Nomer Telepon:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $data_kontak->phone?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Email:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $data_kontak->email?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Alamat:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $data_kontak->alamat?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-12">
                          <h5 for="firstName" class="mb-2">Link Maps</h5>
                          <td class="py-2">
                            <a target="_blank" href="#">
                              <?= htmlspecialchars($data_kontak->maps) ?>

                            </a>
                          </td>
                        </div>
                        
                        <div class="row">
                          <div class="mt-2">
                              <a href="<?= base_url()?>index.php/Kontak/editKontak/<?=  $data_kontak->id_kontak?>" class="btn btn-primary">Edit </a>
                              <a href="<?= base_url()?>index.php/Kontak/resetKontak/<?=  $data_kontak->id_kontak?>" class="btn btn-warning">Reset Kontak</a>
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