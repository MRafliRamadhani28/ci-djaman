	<!-- home page slider -->
	<div class="homepage-slider">
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-1">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Fresh & Organik</p>
								<h1>Jamu Berkhasiat dan Sensasional</h1>
								<div class="hero-btns">
									<a href="<?= base_url()?>index.php/Home/Belanja" class="boxed-btn">Lihat Koleksi Jamu</a>
									<a href="<?= base_url()?>index.php/Home/KontakKami" class="bordered-btn">Kontak Kami</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-center">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Fresh Everyday</p>
								<h1>100% Berbahan Organik</h1>
								<div class="hero-btns">
									<a href="<?= base_url()?>index.php/Home/Belanja" class="boxed-btn">Kunjungi Belanja</a>
									<a href="<?= base_url()?>index.php/Home/TentangKami" class="bordered-btn">Tentang Kami</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-3">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-right">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Terdapat Diskon Murah!</p>
								<h1>Dapatkan Diskon</h1>
								<div class="hero-btns">
									<a href="<?= base_url()?>index.php/Home/KontakKami" class="boxed-btn">Kunjungi Belanja</a>
									<a href="<?= base_url()?>index.php/Home/KontakKami" class="bordered-btn">Kontak Kami</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end home page slider -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-microscope"></i>
						</div>
						<div class="content">
							<h3>Bahan Baku Yang Tersetandarisasi</h3>
							<p>Djaman memproduksi jamu tradisional dengan menjunjung tinggi standar kualitas yang ketat.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-receipt"></i>
						</div>
						<div class="content">
							<h3>Resep Rahasia dan Warisan Leluhur</h3>
							<p>Pengalaman dan pengetahuan Djaman dalam pembuatan jamu ini telah dijaga dengan baik selama bertahun-tahun.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-briefcase"></i>
						</div>
						<div class="content">
							<h3>Kemasan Aman</h3>
							<p>Kami menggunakan metode pengemasan yang sesuai dengan standar keamanan dan kebersihan yang ketat.</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3 style="color: #1B3366;"><span class="orange-text">Produk</span> Kami</h3>
						<p>Kami menyediakan beberapa produk jamu 100% organik yang terbuat dari bahan-bahan seperti rempah-rempah, tumbuhan, buah-buahan, dan tanaman obat yang tumbuh secara alami dan diolah dengan cara yang alami pula.</p>
					</div>
				</div>
			</div>

			<div class="row">
			<?php foreach ($data_produk_random as $produk) : ?>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="index.php/Home/SingleProduk/<?php echo $produk->id_produk; ?>"><img style="height: 200px; width: 100%; object-fit: cover;" src="<?= base_url()?>assets/img/produk/<?php echo $produk->foto; ?>" alt="fotoProduk"></a>
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
						<a href="index.php/Home/SingleProduk/<?php echo $produk->id_produk; ?>" class="cart-btn"> Lihat Detail</a>
					</div>
				</div>
			<?php endforeach; ?>

			</div>
			<div class="row mt-80">
					<div class="col-lg-10 offset-lg-1 text-center">
						<div class="showbutton">
							<a href="<?= base_url()?>index.php/Home/Belanja" class="show-all"> Lihsat Semua Produk</a>
						</div>
					</div>
			</div>
		</div>
	</div>
	<!-- end product section -->

	<!-- cart banner section -->
	<section id="Terlaris" class="cart-banner pt-100 pb-100">
    	<div class="container">
        	<div class="row clearfix">
            	<!--Image Column-->
            	<div class="image-column col-lg-6">
                	<div class="image">
                    	<div class="price-box">
                        	<div class="inner-price">
                                <span class="price">
                                    <strong><?php echo $produk_terlaris->diskon; ?>%</strong> <br> off per Pcs
                                </span>
                            </div>
                        </div>
                    	<img src="<?= base_url()?>assets/img/produk/<?php echo $produk_terlaris->foto; ?>" alt="fotoProduk">
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-lg-6">
					<h3><span class="orange-text">Terlaris</span> Bulan Ini</h3>
                    <h4><?php echo $produk_terlaris->nama_jamu; ?></h4>
					<span class="diskon-price" style="text-decoration: line-through;"><?php echo $produk_terlaris->harga_asli; ?> </span>
					<span class="product-price" ><?php echo $produk_terlaris->harga_diskon; ?> </span> 

					<!-- <div class="row">
						<div class="col">
							<p class="product-price" style="text-decoration: line-through;"><?php echo $produk_terlaris->harga_asli; ?> </p>
						</div>
						<div class="col">
							<p class="diskon-price" ><?php echo $produk_terlaris->harga_diskon; ?> </p> 

						</div>
					</div> -->
                    <div class="text">Dapatkan kesempatan emas untuk berbelanja dengan diskon besar-besaran! Hemat uang anda dengan diskon menarik yang kami tawarkan. Belanja Sekarang!</div>
                    <!--Countdown Timer-->
                    <div class="time-counter"><div class="time-countdown clearfix" data-countdown="<?php echo $produk_terlaris->date; ?>"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div>
                	<a href="<?= base_url()?>index.php/Home/SingleProduk/<?php echo $produk_terlaris->id_produk; ?>" class="cart-btn mt-3"> Lihat Detail</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart banner section -->
	
	<!-- advertisement section -->
	<div class="abt-section mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Sejak Tahun 2010</p>
						<h2>Kami adalah <span class="orange-text">Djaman</span></h2>
						<p>Djaman menjual jamu berupa resep
							rahasia atau warisan nenek
							moyang. Hal ini karena Djaman
							memiliki pengalaman dan
							pengetahuan dalam pembuatan
							jamu yang telah diwariskan dari
							nenek moyang dan dijaga dengan
							baik hingga saat ini.
							</p>
						<p>Seperti halnya resep rahasia yang hanya dimiliki
							oleh beberapa orang tertentu, Djaman memiliki resep jamu
							yang khas dan hanya bisa didapatkan dari produk kami.
							Warisan nenek moyang juga melambangkan kepercayaan dan
							nilai-nilai budaya yang dijaga dengan baik dan menjadi
							bagian dari identitas suatu bangsa. Dengan menggunakan produk
							Djaman, pelanggan dapat merasakan manfaat dari warisan budaya yang
							dijaga dengan baik ini dan menjaga kesehatan tubuh dengan 
							cara yang alami dan tradisional.
						</p>
						<a href="<?= base_url()?>index.php/Home/TentangKami" class="boxed-btn mt-4">Ketahui Tentang Kami</a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 mt-5"> 
                    <?= $data_link->link?>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->
	
	<!-- shop banner -->
	<section class="shop-banner">
    	<div class="container">
        	<h3>Penjualan dengan <span class="orange-text">Diskon Besar </span> <br> sedang berlangsung!   </h3>
            <div class="sale-percent"><span>Diskon! <br> Sampai</span><?php echo $produk_terlaris->diskon; ?>% </div>
            <a href="<?= base_url()?>index.php/Home/Belanja" class="cart-btn btn-lg">Belanja Sekarang</a>
        </div>
    </section>
	<!-- end shop banner -->
