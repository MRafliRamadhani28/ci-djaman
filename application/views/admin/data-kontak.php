
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row0">
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Data Kontak</h5>
                <div class="table-responsive text-nowrap">
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
                      $this->table->set_heading('ID Kontak', 'Alamat', 'No. Telepon', 'Email', 'Maps', 'Aksi');
                      
                      foreach ($data_kontak as $item) {
                        $id_kontak = anchor(base_url() . 'index.php/Kontak/detailKontak/' . $item->id_kontak, $item->id_kontak);

                          $edit_link = site_url('Kontak/editKontak/' . $item->id_kontak);
                          $dropdown_menu = '
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . site_url('Kontak/detailKontak/' . htmlentities($item->id_kontak)) . '">
                                        <i class="bx bx-detail me-1"></i> Detail Kontak
                                    </a>
                                    <a class="dropdown-item" href="' . site_url('Kontak/editKontak/' . $item->id_kontak) . '">
                                        <i class="bx bx-edit-alt me-1"></i> Edit Kontak
                                    </a>
                                </div>
                            </div>
                        ';
                      
                          $this->table->add_row(
                            $id_kontak , 
                            $item->alamat, 
                            $item->phone, 
                            $item->email, 
                            $item->maps, 
                            $dropdown_menu);
                      }
                      
                      echo $this->table->generate();
                      
                    
                    ?>
                  </div>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->