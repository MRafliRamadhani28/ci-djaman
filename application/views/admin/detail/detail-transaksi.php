          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Transaksi dari:</span> <?php echo $transaksi->kode_transaksi; ?></h4>
              <div class="row">
                <div class="col-lg-12">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="mb-3 col-md-12">
                          <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($detail_transaksi as $row) {
                                ?>
                                    <tr>
                                        <td><?= $row->nama_jamu ?></td>
                                        <td><?= 'Rp. ' . number_format($row->harga, 0, ',', '.') ?></td>
                                        <td><?= $row->jumlah ?></td>
                                        <td><?= 'Rp. ' . number_format($row->total, 0, ',', '.') ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <th colspan="3" class="text-center">Total Pembayaran</th>
                                    <td><?= 'Rp. ' . number_format($transaksi->total_pembayaran, 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-center">Metode Pembayaran</th>
                                </tr>
                                <tr class="text-center">
                                    <th colspan="2">METODE PEMBAYARAN</th>
                                    <td colspan="2"><?= $transaksi->bank ?></td>
                                </tr>
                                <tr class="text-center">
                                    <th colspan="2">NAMA REKENING</th>
                                    <td colspan="2"><?= $transaksi->nama_rekening ?></td>
                                </tr>
                                <?php
                                  if ($transaksi->no_rekening <> 0) {
                                ?>
                                <tr class="text-center">
                                    <th colspan="2">No Rekening</th>
                                    <td colspan="2"><?= $transaksi->no_rekening ?></td>
                                </tr>
                                <?php
                                  } else {
                                    if ($transaksi->bukti_pembayaran <> '') {
                                ?>
                                <tr class="text-center">
                                    <th colspan="2">Bukti Pembayaran</th>
                                    <td colspan="2">
                                        <a href="<?= base_url('assets/img/bukti_pembayaran/'.$transaksi->bukti_pembayaran) ?>" target="_blank">
                                            <img src="<?= base_url('assets/img/bukti_pembayaran/'.$transaksi->bukti_pembayaran) ?>" style="max-width: 100%; height: auto; width: 50px; ">
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                  }
                                ?>
                            </tbody>
                          </table>
                        </div>

                        
                        <div class="row">
                          <div class="col-md-6 mt-2">
                            <a href="<?= base_url()?>index.php/Transaksi/tampilDataTransaksi" class="btn btn-icon btn-outline-primary">
                              <span class="tf-icons bx bx-left-arrow-alt"></span>
                            </a>
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