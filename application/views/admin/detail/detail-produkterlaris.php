          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk Terlaris Saat Ini:</span> <?php echo $data_produk_terlaris->nama_jamu; ?></h4>
              <div class="row">
                <div class="col-lg-4">
                  <div class="card mb-3">
                    <div class="card-body d-flex justify-content-center align-items-center">
                      <img
                        src="<?= base_url() ?>/assets/img/produk/<?= htmlentities($data_produk_terlaris->foto) ?>"
                        alt="user-avatar"
                        class="d-block rounded"
                        height="200"
                        width="310"
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
                          <h5 for="firstName" class="mb-2">Nama Produk:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $data_produk_terlaris->nama_jamu?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Diskon:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $data_produk_terlaris->diskon?> %
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-12">
                          <h5 for="firstName" class="mb-2">Harga Asli:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                              <?php echo $data_produk_terlaris->harga_asli?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                          <h5 for="firstName" class="mb-2">Harga Setelah Diskon:</h5>
                          <td class="py-6">
                            <p class="lead mb-0">
                            <?php echo $data_produk_terlaris->harga_diskon?>
                            </p>
                          </td>
                        </div>
                        <div class="mb-3 col-md-6">
                            <h5 for="firstName" class="mb-2">Diperbarui Oleh:</h5>
                            <td class="py-6">
                                <p class="lead mb-0">
                                    <?= $data_produk_terlaris->admin_update?>
                                </p>
                            </td>
                        </div>
                        <div class="mb-3 col-md-6">
                            <h5 for="firstName" class="mb-2">Tanggal Berakhir Diskon:</h5>
                            <td class="py-6">
                                <p class="lead mb-0">
                                    <?= $data_produk_terlaris->date ?>
                                </p>
                            </td>
                        </div>
                        <div class="mb-3 col-md-6">
                            <h5 for="firstName" class="mb-2">Diperbarui Tanggal:</h5>
                            <td class="py-6">
                                <p class="lead mb-0">
                                    <?= $data_produk_terlaris->updated_at ?>
                                </p>
                            </td>
                        </div>

                        
                        <div class="row">
                          <div class="mt-2">
                              <a href="<?= base_url()?>#Terlaris" target="_blank" class="btn btn-outline-primary">Lihat Tampilan Produk Terlaris</a>
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