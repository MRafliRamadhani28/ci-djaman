          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col">
                    <div class="card mb-4">
                      <h5 class="card-header">Edit Produk: <?php echo $data_produk->nama_jamu; ?></h5>
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

                      <div class="card-body">
                        <form action="<?php echo site_url('Produk/update/'.$data_produk->id_produk); ?>" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="id_produk" class="form-label">ID Produk</label>
                            <input
                              type="text"
                              class="form-control"
                              id="id_produk"
                              name="id_produk"
                              value="<?php echo $data_produk->id_produk; ?>"
                              placeholder="PJM001"
                              readonly
                            />
                          </div>
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                              <input
                                type="text"
                                class="form-control"
                                id="nama_jamu"
                                name="nama_jamu"
                                value="<?php echo $data_produk->nama_jamu; ?>"
                              />
                          </div>
                          <div class="mb-2">
                              <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" ><?php echo $data_produk->deskripsi; ?></textarea>
                          </div>
                          <div class="mb-3">
                              <label for="kategori" class="form-label">Kategori</label>
                              <select class="form-select" id="kategori" name="kategori" aria-label="Default select example">
                                  <option disabled>Pilih Kategori</option>
                                  <?php foreach ($kategori as $row) { ?>
                                      <option value="<?php echo $row['id_kategori']; ?>" <?php echo ($row['id_kategori'] == $data_produk->id_kategori) ? 'selected' : ''; ?>>
                                          <?php echo $row['nama_kategori']; ?>
                                      </option>
                                  <?php } ?>
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Satuan (Pcs/Pack/Botol/Dll)</label>
                              <input
                                type="text"
                                class="form-control"
                                id="satuan"
                                name="satuan"
                                value="<?php echo $data_produk->satuan; ?>"
                              />
                          </div>
                          <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Harga</label>
                            <input
                              type="text"
                              class="form-control"
                              id="harga"
                              name="harga_varchar"
                              placeholder="10000"
                              value="<?php echo $data_produk->harga; ?>"
                            />
                            <input
                              type="text"
                              id="hidden_harga"
                              name="harga"
                              hidden
                            />
                          </div>
                          <div class="mb-3">
                            <label for="manfaat1" class="form-label">Manfaat 1</label>
                            <input
                              type="text"
                              class="form-control"
                              id="manfaat1"
                              name="manfaat1"
                              value="<?php echo $data_produk->manfaat1; ?>"
                              placeholder="Manfaat 1"
                            />
                          </div>
                          <div class="mb-3">
                            <label for="manfaat2" class="form-label">Manfaat 2</label>
                            <input
                              type="text"
                              class="form-control"
                              id="manfaat2"
                              name="manfaat2"
                              value="<?php echo $data_produk->manfaat2; ?>"

                            />
                          </div>
                          <div class="mb-3">
                            <label for="manfaat3" class="form-label">Manfaat 3</label>
                            <input
                              type="text"
                              class="form-control"
                              id="manfaat3"
                              name="manfaat3"
                              value="<?php echo $data_produk->manfaat3; ?>"

                            />
                          </div>
							            <?php if ($data_produk->link_marketplace):?>
                          <div>
                              <label for="deskripsi" class="form-label">Link Marketplace</label>
                              <textarea class="form-control" id="deskripsi" name="link_marketplace" rows="3"><?php echo $data_produk->link_marketplace; ?></textarea>
                          </div>
							            <?php else:?>
                            <div>
                              <label for="deskripsi" class="form-label">Link Marketplace</label>
                              <textarea class="form-control" id="deskripsi" name="link_marketplace" rows="3" placeholder="Link Marketplace (Shopee/Tokopedia/Dll)"></textarea>
                          </div>
							            <?php endif;?>

                          <hr class="m-0">
                          <!-- Foto -->
                          <div class="mt-4">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                              <img style="max-width: 100%; height: auto; width: 200px;"
                                src="<?php echo base_url('/assets/img/produk/'.$data_produk->foto); ?>"
                                alt="foto-produk"
                                class="d-block rounded "

                                id="uploadedAvatar"
                              />
                              <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                  <span class="d-none d-sm-block">Upload Foto Produk</span>
                                  <i class="bx bx-upload d-block d-sm-none"></i>
                                  <input
                                    type="file"
                                    id="upload"
                                    class="account-file-input"
                                    hidden
                                    name="foto"
                                    accept="image/png, image/jpeg, image/webp"
                                  />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                  <i class="bx bx-reset d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Reset Foto Produk</span>
                                </button>

                                <p class="text-muted mb-0">Format Gambar .jpg, .png, .webp dan ukuran Gambar Maksimal 5MB.</p>
                              </div>
                              
                            </div>
                          </div>

                          
                      </div>
                    </div>
                    <div class="row">
                      <div class="mt-1">
                        <button type="submit" class="btn btn-primary ">Perbarui Data</button>
                        <a href="<?= base_url()?>index.php/Produk/tampilDataProduk" class="btn btn-outline-primary">Kembali</a>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            <!-- / Content -->