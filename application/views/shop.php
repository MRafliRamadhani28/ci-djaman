<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<!-- <p>Fresh and Organic</p>
						<h1>Shop</h1> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- products -->
<div class="product-section mt-150 mb-150">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div class="product-filters">
					<ul>
						<li class="active" data-filter="*">All</li>
						<?php foreach ($kategori_produk as $row) { ?>
							<li data-filter=".<?php echo str_replace(' ', '', $row['nama_kategori']); ?>">
								<?php echo $row['nama_kategori']; ?>
							</li>
						<?php } ?>
					</ul>
					<!-- <div class="section-title" style="text-align: center!important;">	
							<p id="kategori-deskripsi"></p>
						</div> -->
				</div>
			</div>
		</div>
		<div class="row product-lists">
			<?php foreach ($data_produk as $row): ?>
				<div class="col-lg-4 col-md-6 text-center <?php echo str_replace(' ', '', $row->nama_kategori); ?>">
					<div class="single-product-item">
						<div class="product-image p-0">
							<a href="SingleProduk/<?php echo $row->id_produk; ?>"><img
									src="<?= base_url() ?>assets/img/produk/<?php echo $row->foto; ?>" alt="fotoProduk"
									style="height: 200px; width: 100%; object-fit: cover;"></a>
						</div>
						<h3><?php echo $row->nama_jamu; ?></h3>
						<?php
						$terjual_found = false;
						foreach ($terjual as $jual):
							if ($row->id == $jual->id_produk_terjual):
								$terjual_found = true;
								?>
								<span>Terjual <?= $jual->terjual; ?></span>
							<?php
							endif;
						endforeach;
						if (!$terjual_found):
							?>
							<span>Terjual 0</span>
						<?php endif; ?>
						<hr class="mx-5 my-1">
						<?php if ($is_diskon == $row->id_produk): ?>
							<p class="product-price">
								<del style="font-size: 15px;"><?php echo $produk_terlaris->harga_asli; ?></del>
								<span class="product-price-shop"><?php echo $produk_terlaris->harga_diskon; ?>
									<span class="subtitle-product-price">/<?php echo strtolower($row->satuan); ?></span>
								</span>
							</p>

						<?php else: ?>
							<p class="product-price mt-5">
								<?php echo $row->harga; ?><span
									class="subtitle-product-price">/<?php echo strtolower($row->satuan); ?></span>
							</p>
						<?php endif; ?>

						<a href="SingleProduk/<?php echo $row->id_produk; ?>" class="cart-btn"> Lihat Detail</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>


		<!-- <div class="row">
				<div class="col-lg-12 text-center">
					<div class="pagination-wrap">
						<ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a class="active" href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div> -->
	</div>
</div>
<!-- end products -->