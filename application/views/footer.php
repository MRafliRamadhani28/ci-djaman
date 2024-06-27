
    <!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">Djaman Brand</h2>
						<p>Djaman menjual jamu berupa resep
							rahasia atau warisan nenek
							moyang. Hal ini karena Djaman
							memiliki pengalaman dan
							pengetahuan dalam pembuatan
							jamu yang telah diwariskan dari
							nenek moyang dan dijaga dengan
							baik hingga saat ini.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Kontak</h2>
						<ul>
							<li><?php echo $data_kontak[0]->alamat; ?></li>
							<li><?php echo $data_kontak[0]->email; ?></li>
							<li><?php echo $data_kontak[0]->phone; ?></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Halaman</h2>
						<ul>
							<li><a href="<?= base_url()?>">Home</a></li>
							<li><a href="<?= base_url()?>index.php/Home/TentangKami">Tentang Kami</a></li>
							<li><a href="<?= base_url()?>index.php/Home/KontakKami">Kontak Kami</a></li>
							<li><a href="<?= base_url()?>index.php/Home/Belanja">Belanja</a></li>
							<!-- <li><a href="news.html">News</a></li> -->
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Berlangganan Email</h2>
						<p>Berlangganan Email untuk mendapatkan info terbaru tentang Djaman!</p>
						<form action="<?= base_url()?>index.php/Home/kirimEmail" method="POST">
							<input type="email" name="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
						<div class="social-icons">
						<!-- <ul>
							<li><a href="https://instagram.com/djaman.id" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="https://www.tiktok.com/@djaman.id" target="_blank"><i class="fa-brands fa-tiktok"></i></a></li>
							<li><a href="https://api.whatsapp.com/send/?phone=6281394494246" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
						</ul> -->
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- Google Recaptcha v3
    <script async>
        grecaptcha.enterprise.ready(async () => {
            const token = await grecaptcha.enterprise.execute('6Lex9TQoAAAAAOsg03-UxVb7PpKluWliiB_DQd9B', {action: 'homepage'});
            // IMPORTANT: The 'token' that results from execute is an encrypted response sent by
            // reCAPTCHA Enterprise to the end user's browser.
            // This token must be validated by creating an assessment.
            // See https://cloud.google.com/recaptcha-enterprise/docs/create-assessment
        });
    </script> -->


	<!-- Iconify -->
	<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js" async></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.1/umd/popper.min.js" integrity="sha512-LCNYs7jH7Odmoc6adflrhgpq0cJmq8fwQJq3ICCBuk8BKFwA0PL6pVgVcKFnfNc0dJ+UmFp5sYvjG+jjlh7nXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- jquery -->
	<script src="<?= base_url()?>assets_client/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="<?= base_url()?>assets_client/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="<?= base_url()?>assets_client/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="<?= base_url()?>assets_client/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="<?= base_url()?>assets_client/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="<?= base_url()?>assets_client/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="<?= base_url()?>assets_client/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="<?= base_url()?>assets_client/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="<?= base_url()?>assets_client/js/sticker.js"></script>
	<!-- main js -->
	<script src="<?= base_url()?>assets_client/js/main.js"></script>


	<!-- Custom JS for Shop -->
		<script>
		$(document).ready(function() {
			// Tangkap elemen kategori yang diklik
			$('li[data-filter]').click(function() {
				var deskripsi = $(this).data('deskripsi'); // Ambil deskripsi dari atribut data

				// Periksa apakah elemen yang diklik adalah "All"
				if ($(this).data('filter') === '*') {
					$('#kategori-deskripsi').empty(); // Hapus isi deskripsi jika "All" diklik
				} else {
					// Tampilkan deskripsi di elemen kategori-deskripsi
					$('#kategori-deskripsi').html('<p>' + deskripsi + '</p>');
				}
			});
		});
	</script>
	
</body>

</html>