          <!-- Content wrapperr -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row0">
              <!-- Basic Bootstrap Tablee -->
              <div class="card">
                <h5 class="card-header">Data Admin</h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                          <form action="<?= site_url('Admin/searchAdmin') ?>" method="GET">
                            <div class="input-group">
                              <input type="text" name="keyword" class="form-control" placeholder="Cari Admin" aria-describedby="button-addon2" value="<?php echo $this->input->get('keyword'); ?>">
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
                        'cell_start' => '<td>',
                        'cell_end' => '</td>',
                        'table_close' => '</table>'
                    );
                    
                    $this->table->set_template($template);
                    $this->table->set_heading('Foto Admin', 'ID Admin', 'Nama Admin', 'Username', 'Email', 'Role', 'Status', 'Aksi');
                    
                    foreach ($data_admin as $item) {
                        $foto = 
                          '<a href="' . base_url() . 'index.php/Admin/detailAdmin/' . $item->id_admin . '">' .
                          '<img style="max-width: 100%; height: auto; width: 50px; " src="' . base_url('/assets/img/admin/' . $item->foto) . '" alt="Avatar" class="avatar " />' .
                          '</a>';
                  
                        $edit_link = site_url('Admin/editOrganisasi/' . $item->id_admin);
                        $dropdown_menu = '
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . site_url('Admin/detailAdmin/' . htmlentities($item->id_admin)) . '">
                                        <i class="bx bxs-user-detail me-1"></i> Detail Admin
                                    </a>
                                    ';
                        
                          // Buat dropdown menu berdasarkan status_aktif
                          if ($item->status_aktif === "Aktif" && $item->nama_role == "Admin") {
                            $dropdown_menu .= '
                                <a class="dropdown-item" href="' . site_url('Admin/tampilEditAdmin/' . $item->id_admin) . '">
                                  <i class="bx bx-edit-alt me-1"></i> Edit Admin
                                </a>
                                <button class="dropdown-item button" 
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalBlokir"
                                    data-id-admin="' .  $item->id_admin . '"
                                    data-namaadmin="' .  $item->nama  . '">
                                    <i class="bx bx-block me-1"></i> Blokir Admin
                                </button>
                            ';
                          } elseif ($item->status_aktif === "Blokir" && $item->nama_role == "Admin") {
                            $dropdown_menu .= '
                                <a href="'.base_url().'index.php/Admin/aktifkanAdmin/'.$item->id_admin.'" class="dropdown-item" >
                                    <i class="bx bx-check me-1"></i> Aktifkan Admin
                                </a>
                            ';
                          }

                          if ($item->status_aktif === "Blokir"){
                            $status = '<span class="badge rounded-pill bg-danger">Blokir</span>';
                          }else{
                            $status = '<span class="badge rounded-pill bg-success">Aktif</span>';
                          }
                        
                    
                        $dropdown_menu .= '</div></div>';
                    
                    
                        $this->table->add_row(
                          $foto, 
                          $item->id_admin, 
                          $item->nama,
                          $item->username,  
                          $item->email, 
                          $item->nama_role, 
                          $status, 
                          $dropdown_menu);
                    }
                    
                    echo $this->table->generate();
                    
                  
                  ?>





                </div>
              </div>
              <!--/ Basic Bootstrap Table -->
              </div>
              <div class="row">
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2 py-3 mb-4">
                    <a href="inputDataAdmin">
                        <button type="button" class="btn btn-primary ">Tambah Data Admin</button>
                    </a>
                </div>
              </div>
            </div>
            <!-- / Content -->