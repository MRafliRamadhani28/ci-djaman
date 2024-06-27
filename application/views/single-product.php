	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<!-- <p>See more Details</p>
						<h1>Single Product</h1> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="<?php echo base_url('assets/img/produk/'.$single_product->foto); ?>" alt="fotoProduk">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3><?php echo $single_product->nama_jamu; ?></h3>

						<?php if ($is_diskon) : ?>
							<p class="single-product-pricing">
								<span class="sub-title">Per <?php echo $single_product->satuan; ?></span>
								<del><?php echo $single_product->harga; ?></del>
								<span class="product-price"> <?php echo $produk_terlaris->harga_diskon; ?></span>
							</p>
						<?php else : ?>
							<p class="single-product-pricing">
								<span class="sub-title">Per <?php echo $single_product->satuan; ?></span>
								<?php echo $single_product->harga; ?>
							</p>
						<?php endif; ?>

						<strong>Deskripsi </strong>
						<p><?php echo $single_product->deskripsi; ?></p>
						<strong>Manfaat: </strong>
						<p>1. <?php echo $single_product->manfaat1; ?></p>
						<p>2. <?php echo $single_product->manfaat2; ?></p>
						<p>3. <?php echo $single_product->manfaat3; ?></p>
						<div class="single-product-form">
							<form action="<?= site_url('Home/cart/'.$single_product->id_produk) ?>" method="post">
								<input type="hidden" name="produk_id" value="<?= $single_product->id ?>">
								<input type="hidden" name="harga_produk" value="<?= $harga_produk ?>">
								<button type="submit" style="background-color: #fff; border: 1px solid #978D4F; color: #978D4F;" class="cart-btn"> 
									<i class="fa fa-shop"></i>
									Beli Sekarang
								</button>
								<?php if ($is_diskon && $produk_terlaris->date >= date("Y-m-d")) : ?>
									<a href="<?php echo $single_product->api_wa . $data_kontak[0]->formated_phone_for_whatsapp . $produk_terlaris->link_wa;?>" target="_blank" class="cart-btn" data-ga-event="begin_checkout" data-ga-value="<?=$single_product->harga; ?>?>"> 
										<i class="fa-brands fa-whatsapp"></i>
										Beli via Whatsapp
									</a>
								<?php else : ?>
									<a href="<?php echo $single_product->api_wa . $data_kontak[0]->formated_phone_for_whatsapp . $single_product->link_wa;?>" target="_blank" class="cart-btn"> 
										<i class="fa-brands fa-whatsapp"></i>
										Beli via Whatsapp
									</a>
								<?php endif; ?>
								<?php if ($single_product->link_marketplace):?>
								<a href="<?php echo $single_product->link_marketplace; ?>" target="_blank" style="background-color:#E6B325" class="cart-btn">
									<i class="fa-solid fa-shop"></i> Marketplace
								</a>
								<?php endif; ?>
							</form>
							<p>
								<a style="color:#4B3414;" target="_blank" href="<?= site_url('Home/search?keyword=' . urlencode($single_product->kategori)) ?>">
									<strong>Kategori: </strong><?= $single_product->kategori ?>
									<iconify-icon icon="fluent-mdl2:open-in-new-tab"></iconify-icon>
								</a>

							</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end single product -->

	<!-- more products -->
	<div class="more-products mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Produk</span> Terkait</h3>
						<p>Produk terkait yang mungkin anda butuhkan atau anda minati. Silahkan dilihat dan dipilih.</p>
					</div>
				</div>
			</div>
			<div class="row">
			<?php foreach ($data_produk_random as $produk) : ?>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="<?php echo $produk->id_produk; ?>"><img src="<?= base_url()?>assets/img/produk/<?php echo $produk->foto; ?>" alt="fotoProduk"></a>
						</div>
						<h3><?php echo $produk->nama_jamu; ?></h3>
						<?php if ($is_diskon_harga == $produk->id_produk ) : ?>
								<p class="product-price">
									<span class="subtitle-product-price">Per <?php echo $produk->satuan; ?></span>
									<del><?php echo $produk_terlaris->harga_asli; ?></del>
									<span class="product-price-shop"> <?php echo $produk_terlaris->harga_diskon; ?></span>
								</p>

							<?php else : ?>
								<p class="product-price">
									<span class="subtitle-product-price">Per <?php echo $produk->satuan; ?></span>
									<?php echo $produk->harga; ?>
								</p>
						<?php endif; ?>
						<a href="<?php echo $produk->id_produk; ?>" class="cart-btn">Lihat Detail</a>
					</div>
				</div>
			<?php endforeach; ?>


			</div>
		</div>
	</div>
	<!-- end more products -->

