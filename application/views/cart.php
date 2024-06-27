	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<!-- <p>See more Details</p>
						<h1>Keranjang</h1> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
            <!-- Tampilkan pesan alert success -->
            <?php if ($this->session->flashdata("success")): ?>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata("success"); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tampilkan pesan error -->
            <?php if ($this->session->flashdata("error")): ?>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata("error"); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
			<div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Belum di proses</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="konfirmasipembayaran-tab" data-toggle="tab" data-target="#konfirmasipembayaran" type="button" role="tab" aria-controls="konfirmasipembayaran" aria-selected="false">Konfirmasi Pembayaran</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="dikirim-tab" data-toggle="tab" data-target="#dikirim" type="button" role="tab" aria-controls="dikirim" aria-selected="false">Dikirim</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button" role="tab" aria-controls="selesai" aria-selected="false">Selesai</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ditolak-tab" data-toggle="tab" data-target="#ditolak" type="button" role="tab" aria-controls="ditolak" aria-selected="false">Ditolak</button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <?php
                                        if ($transaksicek > 0) {
                                    ?>
                                    <h4><?= $transaksi->kode_transaksi ?></h4>
                                    <?php
                                        }
                                    ?>
                                    <div class="cart-table-wrap">
                                        <table class="cart-table">
                                            <thead class="cart-table-head">
                                                <tr class="table-head-row">
                                                    <th class="product-remove"></th>
                                                    <th class="product-image">Gambar</th>
                                                    <th class="product-name">Nama</th>
                                                    <th class="product-price">Harga</th>
                                                    <th class="product-quantity">Jumlah</th>
                                                    <th class="product-total">SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($transaksicek > 0) {
                                                    $total = array();
                                                    foreach ($detail_transaksi as $row) {
                                                        $total[] = $row->total;
                                                ?>
                                                    <tr>
                                                        <td class="product-remove">
                                                            <a href="<?= site_url('Home/HapusProdukCart/'.$row->id) ?>" class="btn btn-danger text-white"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                        <td class="product-image">
                                                            <img src="<?php echo base_url('assets/img/produk/'.$row->foto); ?>" alt="">
                                                        </td>
                                                        <td class="product-name"><?= $row->nama_jamu ?></td>
                                                        <td class="product-price"><?= 'Rp. ' . number_format($row->harga, 0, ',', '.'); ?></td>
                                                        <td class="product-quantity"><?= $row->jumlah ?></td>
                                                        <td class="product-total"><?= 'Rp. ' . number_format($row->total, 0, ',', '.'); ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                    
                                <div class="col-lg-4 col-sm-12">
                                    <div class="total-section">
                                        <table class="total-table">
                                            <thead class="total-table-head">
                                                <tr class="table-total-row">
                                                    <th>Total</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if ($transaksicek > 0) {
                                                ?>
                                                <tr class="total-data">
                                                    <td><strong>Total: </strong></td>
                                                    <td><?= 'Rp. ' . number_format(array_sum($total), 0, ',', '.'); ?></td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                            if ($transaksicek > 0) {
                                        ?>
                                        <div class="cart-buttons">
                                            <a href="<?= site_url('Home/Belanja') ?>" class="boxed-btn">Tambah Keranjang</a>
                                            <a href="<?= site_url('Home/checkout/'. $transaksi->kode_transaksi) ?>" class="boxed-btn black">Check Out</a>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>                
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="konfirmasipembayaran" role="tabpanel" aria-labelledby="konfirmasipembayaran-tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="cart-table-wrap">
                                        <table class="cart-table">
                                            <thead class="cart-table-head">
                                                <tr class="table-head-row">
                                                    <th>Kode Transaksi</th>
                                                    <th class="product-image">Produk</th>
                                                    <th class="product-quantity">Jumlah</th>
                                                    <th class="product-subtotal">Subtotal</th>
                                                    <th class="product-total">Total</th>
                                                    <th>Metode Pembayaran</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($transaksi_konfirmasi as $row) {
                                                        $this->db->select("detail_transaksi.*, data_produk.nama_jamu, data_produk.foto, data_produk.harga");
                                                        $this->db->from('detail_transaksi');
                                                        $this->db->join('data_produk', 'data_produk.id = detail_transaksi.produk_id');
                                                        $this->db->where('transaksi_id', $row->id);
                                                        $detail_transaksi2 = $this->db->get()->result();
                                                ?>
                                                    <tr>
                                                        <td><?= $row->kode_transaksi ?></td>
                                                        <td class="product-image">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <img src="<?= base_url('assets/img/produk/'.$value->foto) ?>" alt=""><br>
                                                                <?= $value->nama_jamu.' x Rp'.number_format($value->harga, 0, ',', '.') ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <?= $value->jumlah ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-subtotal">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <?= 'Rp'.number_format($value->total, 0, ',', '.') ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-total">
                                                            <?= 'Rp'.number_format($row->total_pembayaran, 0, ',', '.') ?>
                                                        </td>
                                                        <td><?= $row->nama_rekening.' - '.$row->no_rekening.' - '.$row->bank ?></td>
                                                        <td><?= $row->status ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="cart-table-wrap">
                                        <table class="cart-table">
                                            <thead class="cart-table-head">
                                                <tr class="table-head-row">
                                                    <th>Kode Transaksi</th>
                                                    <th class="product-image">Produk</th>
                                                    <th class="product-quantity">Jumlah</th>
                                                    <th class="product-subtotal">Subtotal</th>
                                                    <th class="product-total">Total</th>
                                                    <th>Metode Pembayaran</th>
                                                    <th>No. Resi</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($transaksi_dikirim as $row) {
                                                        $this->db->select("detail_transaksi.*, data_produk.nama_jamu, data_produk.foto, data_produk.harga");
                                                        $this->db->from('detail_transaksi');
                                                        $this->db->join('data_produk', 'data_produk.id = detail_transaksi.produk_id');
                                                        $this->db->where('transaksi_id', $row->id);
                                                        $detail_transaksi2 = $this->db->get()->result();
                                                ?>
                                                    <tr>
                                                        <td><?= $row->kode_transaksi ?></td>
                                                        <td class="product-image">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <img src="<?= base_url('assets/img/produk/'.$value->foto) ?>" alt=""><br>
                                                                <?= $value->nama_jamu.' x Rp'.number_format($value->harga, 0, ',', '.') ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <?= $value->jumlah ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-subtotal">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <?= 'Rp'.number_format($value->total, 0, ',', '.') ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-total">
                                                            <?= 'Rp'.number_format($row->total_pembayaran, 0, ',', '.') ?>
                                                        </td>
                                                        <td><?= $row->nama_rekening.' - '.$row->no_rekening.' - '.$row->bank ?></td>
                                                        <td><?= $row->no_resi ?: 'Belum diinput Admin'; ?></td>
                                                        <td><?= $row->status ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="cart-table-wrap">
                                    <table class="cart-table">
                                            <thead class="cart-table-head">
                                                <tr class="table-head-row">
                                                    <th>Kode Transaksi</th>
                                                    <th class="product-image">Produk</th>
                                                    <th class="product-quantity">Jumlah</th>
                                                    <th class="product-subtotal">Subtotal</th>
                                                    <th class="product-total">Total</th>
                                                    <th>Metode Pembayaran</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($transaksi_selesai as $row) {
                                                        $this->db->select("detail_transaksi.*, data_produk.nama_jamu, data_produk.foto, data_produk.harga");
                                                        $this->db->from('detail_transaksi');
                                                        $this->db->join('data_produk', 'data_produk.id = detail_transaksi.produk_id');
                                                        $this->db->where('transaksi_id', $row->id);
                                                        $detail_transaksi2 = $this->db->get()->result();
                                                ?>
                                                    <tr>
                                                        <td><?= $row->kode_transaksi ?></td>
                                                        <td class="product-image">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <img src="<?= base_url('assets/img/produk/'.$value->foto) ?>" alt=""><br>
                                                                <?= $value->nama_jamu.' x Rp'.number_format($value->harga, 0, ',', '.') ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <?= $value->jumlah ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-subtotal">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <?= 'Rp'.number_format($value->total, 0, ',', '.') ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-total">
                                                            <?= 'Rp'.number_format($row->total_pembayaran, 0, ',', '.') ?>
                                                        </td>
                                                        <td><?= $row->nama_rekening.' - '.$row->no_rekening.' - '.$row->bank ?></td>
                                                        <td><?= $row->status ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak-tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="cart-table-wrap">
                                    <table class="cart-table">
                                            <thead class="cart-table-head">
                                                <tr class="table-head-row">
                                                    <th>Kode Transaksi</th>
                                                    <th class="product-image">Produk</th>
                                                    <th class="product-quantity">Jumlah</th>
                                                    <th class="product-subtotal">Subtotal</th>
                                                    <th class="product-total">Total</th>
                                                    <th>Metode Pembayaran</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($transaksi_ditolak as $row) {
                                                        $this->db->select("detail_transaksi.*, data_produk.nama_jamu, data_produk.foto, data_produk.harga");
                                                        $this->db->from('detail_transaksi');
                                                        $this->db->join('data_produk', 'data_produk.id = detail_transaksi.produk_id');
                                                        $this->db->where('transaksi_id', $row->id);
                                                        $detail_transaksi2 = $this->db->get()->result();
                                                ?>
                                                    <tr>
                                                        <td><?= $row->kode_transaksi ?></td>
                                                        <td class="product-image">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <img src="<?= base_url('assets/img/produk/'.$value->foto) ?>" alt=""><br>
                                                                <?= $value->nama_jamu.' x Rp'.number_format($value->harga, 0, ',', '.') ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <?= $value->jumlah ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-subtotal">
                                                            <?php
                                                                foreach ($detail_transaksi2 as $value) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <?= 'Rp'.number_format($value->total, 0, ',', '.') ?>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="product-total">
                                                            <?= 'Rp'.number_format($row->total_pembayaran, 0, ',', '.') ?>
                                                        </td>
                                                        <td><?= $row->nama_rekening.' - '.$row->no_rekening.' - '.$row->bank ?></td>
                                                        <td><?= $row->status ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-md-4">
					
				</div>
			</div>

		</div>
	</div>
	<!-- end single product -->