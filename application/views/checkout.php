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
	        <?php if ($this->session->flashdata("success")) : ?>
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
	        <?php if ($this->session->flashdata("error")) : ?>
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
	            <div class="col-md-12 mt-3">
	                <div class="tab-content" id="myTabContent">
	                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	                        <div class="row">
	                            <div class="col-lg-8 col-md-12">
	                                <h4><?= $transaksi->kode_transaksi ?></h4>
	                                <div class="cart-table-wrap">
	                                    <table class="cart-table">
	                                        <thead class="cart-table-head">
	                                            <tr class="table-head-row">
	                                                <th class="product-image">Gambar</th>
	                                                <th class="product-name">Nama</th>
	                                                <th class="product-price">Harga</th>
	                                                <th class="product-quantity">Jumlah</th>
	                                                <th class="product-total">SubTotal</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                            <?php
                                                $total = array();
                                                foreach ($detail_transaksi as $row) {
                                                    $total[] = $row->total;
                                                    ?>
	                                                <tr>
	                                                    <td class="product-image">
	                                                        <img src="<?php echo base_url('assets/img/produk/' . $row->foto); ?>" alt="">
	                                                    </td>
	                                                    <td class="product-name"><?= $row->nama_jamu ?></td>
	                                                    <td class="product-price"><?= 'Rp. ' . number_format($row->harga, 0, ',', '.'); ?></td>
	                                                    <td class="product-quantity"><?= $row->jumlah ?></td>
	                                                    <td class="product-total"><?= 'Rp. ' . number_format($row->total, 0, ',', '.'); ?></td>
	                                                </tr>
	                                            <?php
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
	                                            <tr class="total-data">
	                                                <td><strong>Total: </strong></td>
	                                                <td><?= 'Rp. ' . number_format(array_sum($total), 0, ',', '.'); ?></td>
	                                            </tr>
	                                        </tbody>
	                                    </table>
	                                </div>
	                                <div class="checkout-accordion-wrap mt-3">
	                                    <div class="accordion" id="accordionExample">

	                                        <form action="<?= site_url('Home/pembayaran/' . $transaksi->kode_transaksi) ?>" method="post" enctype="multipart/form-data">

	                                            <div class="card single-accordion">
	                                                <div class="card-header" id="headingOne">
	                                                    <h5 class="mb-0">
	                                                        Metode Pembayaran
	                                                    </h5>
	                                                </div>
	                                            </div>
	                                            <div class="card-body">
	                                                <input type="hidden" name="total_pembayaran" value="<?= array_sum($total) ?>">
	                                                <div class="form-group">
	                                                    <?php
                                                        foreach ($rekening as $row) {
                                                            if ($row->no_rekening <> 0) {
                                                                ?>
	                                                            <h6 class="font-bold text-black mb-2">
	                                                                <input type="radio" id="rekeningBank<?= $row->id; ?>" name="rekening_id" value="<?= $row->id ?>">
	                                                                <label for="rekeningBank<?= $row->id; ?>"><?= $row->no_rekening . ' - ' . $row->nama_rekening . ' - ' . $row->bank ?></label>
	                                                            </h6>
	                                                        <?php
                                                                } else {
                                                                    ?>
	                                                            <h6 class="font-bold text-black">
	                                                                <input type="radio" id="rekeningCod<?= $row->id; ?>" name="rekening_id" value="<?= $row->id ?>">
	                                                                <label for="rekeningCod<?= $row->id; ?>"><?= $row->nama_rekening . ' - ' . $row->bank ?></label>
	                                                            </h6>
	                                                    <?php
                                                            }
                                                        }
                                                        ?>
	                                                </div>
	                                                <div class="form-group">
	                                                    <h6 class="font-bold text-black">Bukti Pembayaran</h6>
	                                                    <input type="file" name="foto" class="form-control">
	                                                </div>
	                                            </div>
	                                            <input type="submit" class="boxed-btn black" value="Proses Order">
	                                        </form>

	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

	    </div>
	</div>
	<!-- end single product -->