          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row0">
                <!-- Basic Bootstrap Table -->
                <div class="card">
                  <h5 class="card-header">Data Produk</h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                          <form action="<?= site_url('produk/search') ?>" method="GET">
                            <div class="input-group">
                              <input type="text" name="keyword" class="form-control" placeholder="Cari Produk" aria-describedby="button-addon2" value="<?php echo $this->input->get('keyword'); ?>">
                              <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
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

                    <!-- Tampilkan pesan error -->
                    <?php if ($this->session->flashdata("error")): ?>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 col-lg-6">
                                <div class="alert alert-danger alert-dismissible">
                                    <?php echo $this->session->flashdata("error"); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                  <div class="table-responsive text-nowrap">
                  <?php
                    $no = 1;
                    $template = array(
                        'table_open' => '<table class="table display" id=" "',
                        'tbody_open' => '<tbody class="table-border-bottom-0" >',
                        'tbody_colse' => '</tbody>',
                        'heading_row_start' => '<tr>',
                        'heading_row_end' => '</tr>',
                        'heading_cell_start' => '<th>',
                        'heading_cell_end' => '</th>',
                        'row_start' => '<tr>',
                        'row_end' => '</tr>',
                        'cell_start' => '<td>',
                        'cell_end' => '</td>',
                        'row_alt_start' => '<tr>',
                        'row_alt_end' => '</tr>',
                        'cell_alt_start' => '<td>',
                        'cell_alt_end' => '</td>',
                        'table_close' => '</table>'
                    );

                    $this->table->set_template($template);
                    $this->table->set_heading('No.', 'Terlaris', $this->session->userdata("role_id") == 1 ? 'Penjual' : '', 'Foto Produk', 'Nama Produk', 'Satuan', 'Harga', 'Deskripsi', 'Manfaat 1', 'Manfaat 2', 'Manfaat 3', 'Kategori', 'Link Whatsapp Bisnis', 'link_marketplace', 'Aksi');

                    foreach ($data_produk as $item) {
                        $no_tampil = '<strong >' . $no++ . '.</strong>';
                        $terlaris_btn= '
                        <a class="dropdown-item" href="' . site_url('Produk/UpdateDataTerlaris/' . htmlentities($item->id_produk)) . '">
                            <i class="bx bx-star me-1"></i> 
                        </a>
                        ';
                        $id_jamu= '<strong data-id="$item->id_produk">' . htmlentities($item->id_produk) . '</strong>';
                        $foto_produk = '
                            <a href="' . site_url('Produk/DetailProduk/' . htmlentities($item->id_produk)) . '">
                                <img style="max-width: 100%; height: auto; width: 100px;" src="' . base_url() . 'assets/img/produk/' . htmlentities($item->foto) . '" alt="fotoProduk" class="avatar">
                            </a>';
                        $dropdown_menu = '
                          <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="' . site_url('Produk/detailProduk/' . htmlentities($item->id_produk)) . '">
                                    <i class="bx bx-detail me-1"></i> Detail Produk
                                </a>
                                  <a class="dropdown-item" href="' . site_url('Produk/editProduk/' . htmlentities($item->id_produk)) . '">
                                      <i class="bx bx-edit-alt me-1"></i> Edit
                                  </a>
                                  <button
                                      class="dropdown-item button"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modalHapusProduk"
                                      data-id-produk="' . htmlentities($item->id_produk) . '"
                                      data-namaproduk="' . htmlentities($item->nama_jamu) . '"
                                  >
                                      <i class="bx bx-trash me-1"></i> Hapus
                                  </button>
                                  <a class="dropdown-item" href="' . site_url('Produk/UpdateDataTerlaris/' . htmlentities($item->id_produk)) . '">
                                      <i class="bx bx-star me-1"></i> Jadikan Terlaris
                                  </a>
                              </div>
                          </div>';
                          $link_marketplace = $item->link_marketplace ? $item->link_marketplace : 'Tidak Ada Link Marketplace';


                        $this->table->add_row(
                          $no_tampil,
                          $terlaris_btn,
                          ($this->session->userdata("role_id") == 1) ? $item->nama_kategori : "",
                          $foto_produk,
                          strlen($item->nama_jamu) > 20 ? substr(htmlentities($item->nama_jamu), 0, 20) . '...' : htmlentities($item->nama_jamu),
                          strlen($item->satuan) > 10 ? substr(htmlentities($item->satuan), 0, 10) . '...' : htmlentities($item->satuan),
                          htmlentities($item->harga),
                          strlen($item->deskripsi) > 25 ? substr(htmlentities($item->deskripsi), 0, 30) . '...' : htmlentities($item->deskripsi),
                          strlen($item->manfaat1) > 30 ? substr(htmlentities($item->manfaat1), 0, 30) . '...' : htmlentities($item->manfaat1),
                          strlen($item->manfaat2) > 30 ? substr(htmlentities($item->manfaat2), 0, 30) . '...' : htmlentities($item->manfaat2),
                          strlen($item->manfaat3) > 30 ? substr(htmlentities($item->manfaat3), 0, 30) . '...' : htmlentities($item->manfaat3),
                          $item->kategori,
                          strlen($item->link_wa) > 5 ? substr(htmlentities($item->link_wa), 0, 30) . '...' : htmlentities($item->link_wa),
                          strlen($link_marketplace) > 5 ? substr(htmlentities($link_marketplace), 0, 30) . '...' : htmlentities($link_marketplace),
                          $dropdown_menu
                        );
                    }

                    echo $this->table->generate();
                    ?>
                  </div>
                </div>
                <!--/ Basic Bootstrap Table -->
              </div>
              <div class="row">
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2 py-3 mb-4">
                    <a href="inputProduk">
                        <button type="button" class="btn btn-primary ">Tambah Produk</button>
                    </a>
                </div>
              </div>
            </div>
            <!-- / Content -->