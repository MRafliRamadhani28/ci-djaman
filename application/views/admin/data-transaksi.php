          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row0">
                <!-- Basic Bootstrap Table -->
                <div class="card">
                  <h5 class="card-header">Data Transaksi</h5>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                          <form action="<?= site_url('Transaksi/searchTransaksi') ?>" method="GET">
                            <div class="input-group">
                              <input type="text" name="keyword" class="form-control" placeholder="Cari Transaksi" aria-describedby="button-addon2" value="<?php echo $this->input->get('keyword'); ?>">
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
                    $this->table->set_heading('No.', 'Kode Transaksi', 'Nama Pembeli', 'Alamat', 'Produk', 'Penjual', 'Jumlah', 'Total', 'Bukti Pembayaran', 'Ambil ditoko', 'Status', 'Aksi');

                    foreach ($data_transaksi as $item) {
                      if ($item->no_rekening <> 0) {
                        $foto = 
                          '<a href="' . base_url() . 'index.php/Transaksi/detailTransaksi/' . $item->kode_transaksi . '">' .
                          '<img style="max-width: 100%; height: auto; width: 50px; " src="' . base_url('/assets/img/bukti_pembayaran/' . $item->bukti_pembayaran) . '" alt="Avatar" class="avatar " /><br>' .
                          $item->nama_rekening.' - '.$item->no_rekening.' - '.$item->bank.
                          '</a>';
                      } else {
                        if ($item->bukti_pembayaran <> '') {
                          $foto = 
                            '<a href="' . base_url() . 'index.php/Transaksi/detailTransaksi/' . $item->kode_transaksi . '">' .
                            '<img style="max-width: 100%; height: auto; width: 50px; " src="' . base_url('/assets/img/bukti_pembayaran/' . $item->bukti_pembayaran) . '" alt="Avatar" class="avatar " /><br>' .
                            $item->nama_rekening.' - '.$item->bank.
                            '</a>';
                        } else {
                          $foto = 
                            '<a href="' . base_url() . 'index.php/Transaksi/detailTransaksi/' . $item->kode_transaksi . '">' .
                            $item->nama_rekening.' - '.$item->bank.
                            '</a>';
                        }
                      }
                        $no_tampil = '<strong >' . $no++ . '.</strong>';

                        $kode_transaksi = 
                          '<a href="' . base_url() . 'index.php/Transaksi/detailTransaksi/' . $item->kode_transaksi . '">' .
                          $item->kode_transaksi.
                          '</a>';

                        if($item->status == 'Konfirmasi Pembayaran') {
                            $actions_menu = '
                              <div class="btn-group">
                                  <button type="button" class="btn p-0 " onclick="location.href=\'' . site_url('Transaksi/konfirmasiTransaksi/' . htmlentities($item->kode_transaksi)) . '\'">
                                      <i class="bx bx-check"></i> Konfirmasi
                                  </button>
                                  <button type="button" class="btn p-0 mx-2" onclick="location.href=\'' . site_url('Transaksi/tolakTransaksi/' . htmlentities($item->kode_transaksi)) . '\'">
                                      <i class="bx bx-block"></i> Tolak
                                  </button>
                              </div>';
                        } elseif ($item->status == 'Menunggu Dikirim') {
                          if ($item->ambil_toko == 1) {
                            $actions_menu = '
                              <div class="btn-group">
                                  <button type="button" class="btn p-0 " onclick="location.href=\'' . site_url('Transaksi/kirimTransaksi/' . htmlentities($item->kode_transaksi)) . '\'">
                                      <i class="bx bxs-hand"></i> Diambil
                                  </button>
                              </div>';
                          } else {
                            $actions_menu = '
                            <div class="btn-group">
                                <button type="button" class="btn p-0 " onclick="location.href=\'' . site_url('Transaksi/kirimTransaksi/' . htmlentities($item->kode_transaksi)) . '\'">
                                    <i class="bx bx-send"></i> Kirim
                                </button>
                            </div>'; 
                          }
                        } elseif ($item->status == 'Dikirim') {
                            $actions_menu = '
                              <div class="btn-group">
                                  <button type="button" class="btn p-0 " onclick="location.href=\'' . site_url('Transaksi/selesaiTransaksi/' . htmlentities($item->kode_transaksi)) . '\'">
                                      <i class="bx bx-check"></i> Selesai
                                  </button>
                              </div>';
                        } else {
                            $actions_menu = '';
                        }

                        if ($item->ambil_toko == 1) {
                          $ambil_toko = 'YA';
                          if ($item->status == 'Menunggu Dikirim') {
                            $status = 'Menunggu Diambil';
                          } elseif ($item->status == 'Dikirim') {
                            $status = 'Sudah Diambil';
                          } else {
                            $status = $item->status;
                          }
                        } else {
                          $ambil_toko = 'TIDAK';
                          $status = $item->status;
                        }

                          $produk = '';
                          $harga = '';
                          $jumlah = '';
                          $total = '';
                          $penjual = '';
                          $detail_transaksi = $this->db->query(
                                "SELECT * FROM 
                                detail_transaksi 
                                JOIN data_produk ON data_produk.id=detail_transaksi.produk_id
                                LEFT JOIN admin AS penjual ON data_produk.created_by=penjual.id
                                WHERE transaksi_id = '$item->id'")->result();

                            foreach ($detail_transaksi as $row) {
                                $produk .= $row->nama_jamu.'<br>';
                                $harga .= 'Rp. ' . number_format($row->harga, 0, ',', '.').'<br>';
                                $jumlah .= $row->jumlah.'<br>';
                                $total .= 'Rp. ' . number_format($row->total, 0, ',', '.').'<br>';
                                $penjual .= $row->nama ? $row->nama . '<br>': "Pemilik Website" . '<br>';
                            }

                          $dropdown_menu = '
                          <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">

                                  <a class="dropdown-item" href="' . site_url('Produk/editKategoriProduk/' . htmlentities($item->kode_transaksi)) . '">
                                      <i class="bx bx-edit-alt me-1"></i> Edit
                                  </a>
                                  <button
                                      class="dropdown-item button"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modalHapusKategori"
                                      data-id-kategori="'.htmlentities($item->kode_transaksi).'"
                                      data-namakategori="'.htmlentities($item->pengguna_id).'"
                                      data-hapus-url="'. site_url('Produk/hapusKategoriProduk/' . htmlentities($item->kode_transaksi)).'"
                                  >
                                      <i class="bx bx-trash me-1"></i> Hapus
                                  </button>
                              

                              </div>
                          </div>';
                    
                        

                        $this->table->add_row(
                          $no_tampil,
                          $kode_transaksi,
                          ucwords($item->nama),
                          $item->alamat,
                          $produk,
                          $penjual,
                          $jumlah,
                          'Rp. ' . number_format($item->total_pembayaran, 0, ',', '.'),
                          $foto,
                          $ambil_toko,
                          $status,
                          $actions_menu
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