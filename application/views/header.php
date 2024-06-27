<!DOCTYPE html>
<html lang="id">
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TFRBS5T6');
	</script>
	<!-- End Google Tag Manager -->
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-SGFXRNC31M"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-SGFXRNC31M');
	</script>
			
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="keywords" content="Djaman, Jamu Manunggal, Jamu Cimahi, Jawa Barat, Indonesia, Jamu organik, Kesehatan tubuh, Minuman herbal, Pengobatan tradisional, Kualitas produk jamu, Standarisasi bahan baku, Manfaat jamu alami, Laboratorium pengujian, Herbal Indonesia, Pengobatan alami, Penyembuhan tradisional, Ramuan alami, Keunggulan produk jamu, jamu juice, jamu, jamu indonesia , indonesian jamu, omi, navitas, vegan ingredients, vegan medicine list, vegan medicine list, bovine derived medication, vegan medication, organic medicine, organic medicine for cough, medicine organizer ideas, how to organize medicine cabinet, organic medicinal herb seeds, drinks for vegans, vegan drinks, vegan beverage, drinks for vegetarians, what do vegans drink, vegan drinks, healthy drinks for vegans, vegan diet, jamu juice benefits, jamu benefits, what is jamu, jamu drink benefits, jamu organik, khasiat jamu alami, manfaat jamu tradisional, jamu alami untuk kesehatan, obat tradisional indonesia, ramuan jamu alami, resep jamu tradisional, jamu herbal, pengobatan alternatif, jamu sehat, bahan alami untuk kesehatan, ramuan tradisional, obat herbal alami, Kualitas Bahan Baku Jamu">

	
	
    <meta name="description" content="<?php echo substr($meta_description, 0, 160); ?>">

	<meta name="robots" content="index,follow">
	<meta property="og:site_name" content="Djaman - Obat dan Jamu Tradisional">
	<meta property="og:title" content="<?php echo $title?>">
	<meta property="og:type" content="website">
    <meta property="og:description" content="<?php echo $meta_description?>">
    <meta property="og:url" content="<?php echo $meta_url?>">
	<meta property="og:image" 
    	content="
			<?php if($active_menu === 'belanjaSingle'): echo $meta_img; else: ?>
				https://ucarecdn.com/33a03e8c-b9e8-4ecc-a39c-a0868bb9b1da/-/preview/500x500/-/quality/smart_retina/-/format/auto/ 
			<?php endif; ?>
	">


    <meta name="twitter:site" content="@">
    <meta name="twitter:title" content="Djaman - Jamu Organik">
	<meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="https://ucarecdn.com/0e28a0c9-efa3-43c8-a881-50add92756ed/-/preview/1200x675/-/quality/smart_retina/-/format/auto/">
    <meta name="twitter:description" content="Jamu Organik dan Terstandarisasi dari Djaman (Jamu Manunggal) Cimahi.">
    
    <!--Meta Name For Yandex Search Engine-->
    <meta name="yandex-verification" content="180ae2f2eba03d9b" />

	<!-- title -->
	<title>
		<?php echo $title ?>
	</title>
	
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "Djaman",
        "url": "/",
        "logo": "https://djaman.42web.io//assets_client/img/Logo_Djaman.png",
        "sameAs": [
				"https://instagram.com/djaman.id",
                "https://www.tiktok.com/@djaman.id"
		]
    }
    </script>

	<!-- Tentang Kanonik (Halaman Duplikat) -->
	<?php if ($active_menu == "cariProduk"):?>
		<link rel="canonical" href= "<?= $canonical_url_search ?>" />
	<?php elseif ($active_menu == "404NotFound"): ?>
		<link rel="canonical" href= "<?=base_url()?>index.php/Home/not_found" />
	<?php elseif ($active_menu == "belanjaSingle"): ?>
		<link rel="canonical" href= "<?=base_url()?>index.php/Home/SingleProduk/<?= $single_product->id_produk?>" />
	<?php elseif ($active_menu == "belanja"): ?>
		<link rel="canonical" href= "<?=base_url()?>index.php/Home/Belanja" />
	<?php elseif ($active_menu == "tentang_kami"): ?>
		<link rel="canonical" href= "<?=base_url()?>index.php/Home/TentangKami" />
	<?php elseif ($active_menu == "kontak_kami"): ?>
		<link rel="canonical" href= "<?=base_url()?>index.php/Home/KontakKami" />


	<?php endif;?>
	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="<?= base_url()?>assets_client/img/Logo_Djaman.webp">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- bootstrap -->
	<link rel="stylesheet" href="<?= base_url()?>assets_client/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="<?= base_url()?>assets_client/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="<?= base_url()?>assets_client/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="<?= base_url()?>assets_client/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="<?= base_url()?>assets_client/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="<?= base_url()?>assets_client/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="<?= base_url()?>assets_client/css/responsive.css">
    <!-- reCaptcha Enterprise Google -->
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6Lf8M04nAAAAAMpRiYuWw87cLuk1LV1Zl5H4oqFM"></script>
    <script src="https://www.google.com/recaptcha/api.js" async></script>
    <!--Google Search Console-->
    <meta name="google-site-verification" content="IMlMqTcUUpn9O82xGRFvgcCHwsk8CHqkRSFwO3b5YEU" />

</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFRBS5T6"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
	<!--PreLoader-->

	<!-- UNCOMMENT LATER -->
    <!-- <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div> -->

    <!--PreLoader Ends-->
	
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="<?= base_url()?>">
								<img src="<?= base_url()?>assets_client/img/Logo_Djaman.png" alt="logoDjaman">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
                            <ul>
                                <li <?php if ($active_menu === 'home') echo 'class="current-list-item"'; ?>><a href="<?= base_url()?>">Home</a></li>
                                <li <?php if ($active_menu === 'tentang_kami') echo 'class="current-list-item"'; ?>><a href="<?= base_url()?>index.php/Home/TentangKami">Tentang Kami</a></li>
                                <li <?php if ($active_menu === 'kontak_kami') echo 'class="current-list-item"'; ?>><a href="<?= base_url()?>index.php/Home/KontakKami">Kontak Kami</a></li>
                                <li <?php if ($active_menu === 'belanja' || $active_menu === 'belanjaSingle' || $active_menu === "cariProduk") echo 'class="current-list-item"'; ?>><a href="<?= base_url()?>index.php/Home/Belanja">Belanja</a></li>
                                <li><a href="https://cekresi.com/" target="_blank">Lacak Pengiriman</a></li>
								<?php
									if ($this->session->userdata('pengguna_logged_in') == true) {
								?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?= $this->session->userdata('nama_lengkap') ?></a>
									<div class="dropdown-menu">
									<a class="dropdown-item" href="<?= site_url('Home/logout') ?>"><i class="fas fa-sign-out"></i> <span>Keluar</span></a>
								</li>
								<?php
									} else {
								?>
								<li><a href="<?= base_url()?>index.php/Home/loginPage">Masuk/Daftar</a></li>
								<?php
									}
								?>
                                <li>
                                    <div class="header-icons">
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
										<?php
											if ($this->session->userdata('pengguna_logged_in') == true) {
										?>
										<a href="<?= site_url('Home/cart') ?>" class="shopping-cart"><i class="fas fa-shopping-cart"></i> <span><?= $cart_count ?></span></a>
										<?php
											}
										?>
                                    </div>
                                </li>
                            </ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
	
	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Cari Produk / Kategori:</h3>
							<form action="<?= site_url('Home/search') ?>" method="GET">
							<input type="text" name="keyword" placeholder="Kata Kunci">
								<button type="submit">Cari <i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->