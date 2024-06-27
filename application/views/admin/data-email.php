          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row0">
                <!-- Basic Bootstrap Table -->
                <div class="card">
                  <h5 class="card-header">Data Email</h5>
                  <!-- <div class="card-body">
                      <div class="row">
                        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                          <form action="<?= site_url('produk/searchKategori') ?>" method="GET">
                            <div class="input-group">
                              <input type="text" name="keyword" class="form-control" placeholder="Cari Kategori" aria-describedby="button-addon2" value="<?php echo $this->input->get('keyword'); ?>">
                              <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div> -->
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
                    $this->table->set_heading('No.', 'Email', 'Aksi');

                    foreach ($data_email as $item) {
                        $no_tampil = '<strong >' . $no++ . '.</strong>';
                        $tombol_hapus = '
    

                                  <button
                                      class=" button btn"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modalHapusEmail"
                                      data-email="' . htmlentities($item->email) . '"
                                  >
                                      <i class="bx bx-trash me-1"></i> Hapus
                                  </button>
';

                    
                        $this->table->add_row(
                          $no_tampil,
                          $item->email,
                          $tombol_hapus
                        );
                    }

                    echo $this->table->generate();
                    ?>
                  </div>
                </div>
                <!--/ Basic Bootstrap Table -->
              </div>

            </div>
            <!-- / Content -->