          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row0">
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Data Anggota Organisasi</h5>
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
                <div class="table-responsive text-nowrap">
                  <?php
                    $this->load->library('table');

                    $template = array(
                        'table_open' => '<table class="table">',
                        'tbody_open' => '<tbody class="table-border-bottom-0" >',
                        'tbody_colse' => '</tbody>',
                        'thead_open' => '<thead>',
                        'thead_close' => '</thead>',
                        'heading_row_start' => '<tr>',
                        'heading_row_end' => '</tr>',
                        'th_open' => '<th>',
                        'th_close' => '</th>',
                        'tbody_open' => '<tbody>',
                        'tbody_close' => '</tbody>',
                        'row_start' => '<tr>',
                        'row_end' => '</tr>',
                        'cell_start' => '<td >',
                        'cell_end' => '</td>',
                        'table_close' => '</table>'
                    );
                    
                    $this->table->set_template($template);
                    $this->table->set_heading('Foto Anggota', 'ID Anggota', 'Nama Anggota', 'Jabatan', 'Email', 'Aksi');
                    
                    foreach ($data_organisasi as $item) {
                        $foto = 
                          '<a href="' . base_url() . 'index.php/Organisasi/detailOrganisasi/' . $item->id_anggota . '">' .
                          '<img style="max-width: 100%; height: auto; width: 50px;" src="' . base_url('/assets/img/anggota/' . $item->foto) . '" alt="Avatar" class="avatar" />' .
                          '</a>';
                  
                        $edit_link = site_url('Organisasi/editOrganisasi/' . $item->id_anggota);
                        $dropdown_menu = '
                          <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                  <a class="dropdown-item" href="' . site_url('Organisasi/detailOrganisasi/' . htmlentities($item->id_anggota)) . '">
                                      <i class="bx bx-detail me-1"></i> Detail Anggota
                                  </a>
                                  <a class="dropdown-item" href="' . site_url('Organisasi/editOrganisasi/' . $item->id_anggota) . '">
                                      <i class="bx bx-edit-alt me-1"></i> Edit Anggota
                                  </a>
                              </div>
                          </div>
                      ';
                    
                        $this->table->add_row(
                          $foto, 
                          $item->id_anggota, 
                          $item->nama, 
                          $item->jabatan, 
                          $item->email, 
                          $dropdown_menu);
                    }
                    
                    echo $this->table->generate();
                    
                  
                  ?>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->
              </div>
              <!-- <div class="row">
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2 py-3 mb-4">
                    <a href="inputProduk">
                        <button type="button" class="btn btn-primary ">Tambah Data</button>
                    </a>
                </div>
              </div> -->
            </div>
            <!-- / Content -->