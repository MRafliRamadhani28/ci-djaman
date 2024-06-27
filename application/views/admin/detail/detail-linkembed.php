          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Detail Link Embed (Pada Home Klien)</span></h4>
              
              <div class="row">
                <div class="col-lg-4">
                  <div class="card mb-3">
                        <div class="mt-4 mb-2 d-flex justify-content-center">
                        <h5 for="firstName" class="">Tampilan Link pada Home:</h5>
                        </div>
                        <div class="justify-content-center align-items-center">
                            <?= $detail_link->link?>
                        </div>

                        <hr class="m-0" />

                  </div>
                </div>
                <div class="col-lg">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="mb-3 col">
                        <?php if ($this->session->flashdata("success")): ?>
                            <div class="row justify-content-center ">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="alert alert-success alert-dismissible">
                                        <?php echo $this->session->flashdata("success"); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($this->session->flashdata("successReset")): ?>
                            <div class="row justify-content-center ">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="alert alert-warning alert-dismissible">
                                        <?php echo $this->session->flashdata("successReset"); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        <!-- Tampilkan pesan error -->
                        <?php elseif ($this->session->flashdata("error")): ?>
                            <div class="row justify-content-center mt-4">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="alert alert-danger alert-dismissible">
                                        <?php echo $this->session->flashdata("error"); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                          <h5 for="link" class="mb-4">Detail Link:</h5>
                          <form action="<?= base_url() ?>index.php/Admin/editLink/<?= $detail_link->id_link ?>" method="post">
                            <textarea
                                type="text"
                                class="form-control"
                                id="link"
                                name="link"
                                rows="12"
                              ><?= htmlentities($detail_link->link) ?>
                            </textarea>
                            <div class="row">
                              <div class="mt-4">
                                  <button type="submit" class="btn btn-primary ">Perbarui Link</button>
                                  <a href="<?= base_url()?>index.php/Admin/resetLink/<?=  $detail_link->id_link?>" class="btn btn-outline-warning">Reset Link</a>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <!-- / Content --