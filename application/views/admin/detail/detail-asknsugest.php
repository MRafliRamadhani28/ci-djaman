          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Produk dari Menu:</span>Kontak Kami</h4>
              <div class="row">
                <div class="col-lg">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Nama Pengirim:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $data_asknsugest->nama?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Email Pengirim:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $data_asknsugest->email?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">No. Telpon Pengirim:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $data_asknsugest->phone?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Subjek Pesan:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $data_asknsugest->subject?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-12">
                          <h5 for="firstName" class="mb-2">Isi Pesan</h5>
                          <td class="py-2">
                              <?= $data_asknsugest->message ?>
                          </td>
                        </div>
                        
                        <div class="row">
                          <div class="mt-2">
                              <a href="<?= base_url()?>index.php/Asknsugest/tampilAsknsugest" class="btn btn-outline-primary">Kembali</a>
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