-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2024 at 03:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `djaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_admin` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_aktif` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `id_admin`, `nama`, `email`, `username`, `password`, `foto`, `role_id`, `status_aktif`) VALUES
(1, 'SuperAdm', 'Reyhan Adriana Deris', 'reyhanadr.airdrop@gmail.com', 'admin', '25d55ad283aa400af464c76d713c07ad', 'reyhanadr_Avatar_updatedat_1696606924.webp', 1, 'Aktif'),
(2, 'ADM001', 'Dhiffa Namira', 'rustkoyreyhanputin@gmail.com', 'Dhiffa', '25d55ad283aa400af464c76d713c07ad', 'Dhiffa.webp', 2, 'Aktif'),
(3, 'ADM002', 'Nursafira Khairunnisaa', 'nursafira@gmail.com', 'Enuy', '202cb962ac59075b964b07152d234b70', 'Enuy_Avatar_updatedat_1696876604.webp', 2, 'Aktif'),
(8, 'ADM003', 'Tzaskia', 'Tzaskia@gmail.com', 'Tzaskia', '202cb962ac59075b964b07152d234b70', 'Tzaskia.webp', 2, 'Aktif'),
(9, 'ADM004', 'Chandani', 'Chandani@gmail.com', 'Chandani', '202cb962ac59075b964b07152d234b70', 'Chandani.webp', 2, 'Aktif'),
(10, 'ADM005', 'Wawan Hermawan', 'wawan.airdrop@gmail.com', 'wawan', '202cb962ac59075b964b07152d234b70', 'wawan_Avatarupdatedat_1696606812.webp', 2, 'Aktif'),
(11, 'ADM006', 'Seller K', 'depublic@yopmail.com', 'seller', '1e4970ada8c054474cda889490de3421', 'admin.webp', 2, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `asknsugest`
--

CREATE TABLE `asknsugest` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asknsugest`
--

INSERT INTO `asknsugest` (`id`, `nama`, `email`, `phone`, `subject`, `message`) VALUES
(1, 'Ardi Suradi', 'ardisuradi.airdp@gmail.com', '085871622926', 'Masalah Serius!!', 'Selamat Malam Bang..\r\nAgar tali silaturahmi tidak terputus boleh lah pinjam seratus.. Hehe');

-- --------------------------------------------------------

--
-- Table structure for table `data_kontak`
--

CREATE TABLE `data_kontak` (
  `id_kontak` varchar(5) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `maps` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kontak`
--

INSERT INTO `data_kontak` (`id_kontak`, `alamat`, `phone`, `email`, `maps`) VALUES
('KNTK1', 'Gang M. Ardjo RT 05 / 03 No. 224, Cimahi Tengah Kota Cimahi', '+62 813 9449 4246', 'support@djaman.my.id', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.135335059867!2d107.5450692!3d-6.8743837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e446ae9900a9%3A0xe7cc97d88dc6b93f!2sGg.%20M.%20Ardjo%202%2C%20Cimahi%2C%20Kec.%20Cimahi%20Tengah%2C%20Kota%20Cimahi%2C%20Jawa%20Barat%2040525!5e0!3m2!1sid!2sid!4v1677048460433!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>    ');

-- --------------------------------------------------------

--
-- Table structure for table `data_organisasi`
--

CREATE TABLE `data_organisasi` (
  `id_anggota` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jabatan` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_organisasi`
--

INSERT INTO `data_organisasi` (`id_anggota`, `nama`, `jabatan`, `email`, `foto`) VALUES
('ANG1', 'Reyhan Michael Jackson', 'Project Leader & Full Stack Dev', 'reyhanadr@gmail.com', 'ANG1.webp'),
('ANG2', 'Nursafira Eloise Bougenvile', 'Fullstack Web Developer', 'nursafira@gmail.com', 'ANG2.webp'),
('ANG3', 'Indro Abri Militer', 'System Analyst', 'indroabri@gmail.com', 'ANG3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `data_produk`
--

CREATE TABLE `data_produk` (
  `id` int(11) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `nama_jamu` varchar(30) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `manfaat1` varchar(500) NOT NULL,
  `manfaat2` varchar(500) NOT NULL,
  `manfaat3` varchar(500) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `api_wa` varchar(15) NOT NULL DEFAULT 'https://wa.me/',
  `link_wa` varchar(300) NOT NULL,
  `link_marketplace` varchar(250) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_produk`
--

INSERT INTO `data_produk` (`id`, `id_produk`, `nama_jamu`, `satuan`, `harga`, `deskripsi`, `manfaat1`, `manfaat2`, `manfaat3`, `foto`, `api_wa`, `link_wa`, `link_marketplace`, `id_kategori`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(6, 'JM002', 'Beras Kencur', 'Pack', 50000, 'Jamu adalah obat tradisional Indonesia yang terbuat dari campuran bahan-bahan alami seperti akar, daun, bunga, dan buah. Jamu telah digunakan selama berabad-abad sebagai obat alami untuk berbagai kondisi kesehatan, dan menjadi bagian dari budaya Indonesia.', 'Mengatasi Gangguan Pencernaan: Jamu Beras Kencur telah lama digunakan untuk membantu mengatasi masalah pencernaan seperti perut kembung, mual, dan gangguan pencernaan lainnya.', 'Penguat Sistem Kekebalan Tubuh: Produk ini mengandung bahan-bahan alami yang dapat membantu meningkatkan sistem kekebalan tubuh. Ini membuat tubuh lebih tahan terhadap infeksi dan membantu melindungi kesehatan Anda secara keseluruhan.', 'Mengurangi Gejala Flu dan Pilek: Jamu Beras Kencur juga dikenal dapat membantu meredakan gejala flu dan pilek, seperti batuk, pilek, dan sakit tenggorokan. Ramuan alami dalam jamu ini dapat membantu melegakan saluran pernapasan dan meningkatkan perasaan nyaman saat Anda sedang tidak sehat.', 'JM002.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Beras+Kencur+%0AHarga+Produk+per+Satuan%3A+Rp.+50.000+%0AJumlah+Pesanan%3A...+Pack+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', 'https://shopee.co.id/Sido-Muncul-Beras-Kencur-5\'s-Minuman-Tradisional-Kesehatan-i.139447146.2103865291?sp_atk=f657df70-764e-4883-8a50-2b9b83e3c15c&xptdk=f657df70-764e-4883-8a50-2b9b83e3c15c', 1, '2023-09-01 22:20:57', '2023-10-07 10:20:04', 1, 1),
(10, 'JM003', 'Buyung Upi', 'Pcs', 10000, 'Jamu Buyung UPI adalah produk jamu tradisional Indonesia yang terkenal karena kualitasnya yang tinggi dan bahan-bahan alami yang digunakan dalam pembuatannya. Jamu ini diproduksi oleh UPI (Usaha Produksi Jamu Indonesia) yang memiliki reputasi yang kuat dalam industri jamu.', 'Menyehatkan Sistem Imun: Beberapa jenis jamu tradisional mengandung bahan-bahan yang dikenal memiliki sifat imunostimulan, yang dapat membantu meningkatkan daya tahan tubuh terhadap penyakit.', 'Pemulihan Stamina: Jamu sering digunakan untuk membantu pemulihan energi dan stamina tubuh setelah aktivitas fisik yang intens. Ini bisa membantu merasa lebih bugar dan kurang lelah.', 'Mengurangi Ketegangan dan Stres: Beberapa jenis jamu herbal dapat memiliki efek menenangkan pada sistem saraf, membantu mengurangi ketegangan, stres, atau kecemasan.', 'JM003.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Buyung+Upi+%0AHarga+Produk+per+Satuan%3A+Rp.+10.000+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', 'https://shopee.co.id/Sido-Muncul-Beras-Kencur-5\'s-Minuman-Tradisional-Kesehatan-i.139447146.2103865291?sp_atk=f657df70-764e-4883-8a50-2b9b83e3c15c&xptdk=f657df70-764e-4883-8a50-2b9b83e3c15c', 1, NULL, '2024-06-13 22:19:31', 11, 11),
(12, 'JM005', 'Kunyit Asem', 'Pcs', 15000, 'Jamu kunyit asam merupakan minuman tradisional khas Indonesia yang diolah dari percampuran kunyit dan asam jawa. Kombinasi kunyit yang terkenal dengan kandungan kurkumin dan asam jawa yang kaya mineral penting, seperti magnesium, menjadikan jamu kunyit asam memiliki banyak manfaat untuk kesehatan.', 'Antiinflamasi: Kunyit memiliki sifat antiinflamasi yang kuat, yang dapat membantu mengurangi peradangan dalam tubuh. Ini bisa berguna dalam mengatasi masalah peradangan seperti arthritis atau gangguan inflamasi lainnya.', 'Antibakteri dan Antivirus: Kunyit juga dikenal memiliki sifat antibakteri dan antivirus, yang dapat membantu melawan infeksi bakteri dan virus dalam tubuh.', 'Detoksifikasi: Kombinasi kunyit dan asem jawa dapat membantu membersihkan racun dalam tubuh dan mendukung fungsi hati yang sehat.', 'JM005.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Kunyit+Asem+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', NULL, 1, NULL, '2023-10-07 09:35:56', 11, 1),
(13, 'JM006', 'Kunci Suruh', 'Pcs', 15000, 'Jamu kunci suruh dibuat dengan komposisi utama yang terdiri dari rimpang temu kunci dan daun sirih. Jamu ini secara umum di masyarakat digunakan untuk melancarkan ASI dan mengatasi keputihan pada wanita.', 'Mengurangi Nyeri Otot dan Sendi: Beberapa bahan dalam jamu Kunci Suruh, seperti daun kunci suruh dan temulawak, memiliki sifat antiinflamasi dan analgesik yang dapat membantu meredakan nyeri otot dan sendi.', 'Mengurangi Kolesterol: Beberapa bahan herbal yang digunakan dalam jamu ini telah dikaitkan dengan kemampuan mengurangi kadar kolesterol dalam tubuh.', 'Pengatur Tekanan Darah: Beberapa jamu tradisional dapat membantu mengendalikan tekanan darah, meskipun hasilnya dapat bervariasi antara individu.', 'JM006.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Kunci+Suruh+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', NULL, 1, NULL, '2023-10-07 09:36:41', NULL, 1),
(14, 'JM007', 'Kudu Laos', 'Pack', 15000, 'Jamu Kudu Laos merupakan campuran dari beberapa bahan alami seperti kunyit, temulawak, jahe, kencur, dan rempah-rempah lainnya. Jamu ini telah digunakan secara turun temurun sebagai minuman herbal tradisional untuk meningkatkan kesehatan dan kebugaran.', 'Meningkatkan Sistem Kekebalan Tubuh: Jamu ini dapat membantu meningkatkan sistem kekebalan tubuh Anda, membantu melawan infeksi dan penyakit.', 'Menyehatkan Sistem Pernafasan: Beberapa orang menggunakan jamu ini untuk membantu mengatasi masalah pernapasan seperti batuk dan pilek.', 'Mengurangi Ketegangan: Jamu Kudu Laos juga dikatakan dapat memiliki efek menenangkan pada sistem saraf, membantu mengurangi ketegangan dan stres.', 'JM007.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Kudu+Laos+%0AJumlah+Pesanan%3A...+Pack+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', NULL, 2, NULL, '2023-10-07 09:50:54', NULL, 1),
(15, 'JM008', 'Jamu Uyup-Uyup', 'Pcs', 15000, 'Jamu Uyup-uyup terbuat dari campuran bahan alami seperti kunyit, temulawak, jahe, kayu manis, lada hitam, dan bahan-bahan herbal lainnya. Jamu ini biasanya dikonsumsi dalam bentuk minuman hangat. Uyup-uyup sendiri memiliki arti \"bersih\" atau \"sehat\" dalam bahasa Jawa, menggambarkan manfaat kesehatan yang dikaitkan dengan minuman ini.', 'Penghangat Tubuh: Jamu ini juga dikatakan memiliki efek menghangatkan tubuh, sehingga sering dikonsumsi saat cuaca dingin atau untuk mengatasi masalah berkaitan dengan suhu tubuh.', 'Penyegaran: Beberapa orang mengonsumsi jamu ini untuk mendapatkan rasa penyegaran dan energi tambahan dalam kehidupan sehari-hari.', 'Pemeliharaan Kesehatan Jantung: Beberapa jamu tradisional juga dikatakan memiliki manfaat untuk menjaga kesehatan jantung, seperti mengatur tekanan darah.', 'JM008.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Jamu+Uyup-Uyup+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', NULL, 2, NULL, '2023-10-07 09:51:49', 10, 1),
(16, 'JM009', 'Jamu Sinom', 'Pcs', 15000, 'Jamu Sinom adalah minuman tradisional yang terbuat dari campuran bahan-bahan alami seperti asam jawa, jahe, daun pandan, serai, gula aren, dan air. Minuman ini memiliki rasa segar dan asam yang khas. Jamu Sinom biasanya dikonsumsi dalam keadaan hangat atau dingin.', 'Menurunkan demam: Jamu Sinom juga memiliki efek penurun demam. Kandungan bahan-bahan alami seperti daun pandan dan serai memiliki sifat penurun panas yang dapat membantu mengatasi demam ringan.', 'Menjaga kesehatan saluran kemih: Jamu Sinom juga dapat bermanfaat bagi kesehatan saluran kemih. Kandungan asam jawa dalam jamu ini dapat membantu mengurangi risiko infeksi saluran kemih dan memperbaiki fungsi ginjal.', 'Mengurangi Kebasahan: Konsumsi Jamu Sinom diklaim dapat membantu mengurangi rasa kebasahan atau kedinginan pada tubuh, terutama saat cuaca dingin.', 'JM009.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Jamu+Sinom+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', NULL, 3, NULL, '2023-10-07 09:52:51', 10, 1),
(17, 'JM010', 'Jamu Wedang Secang', 'Pcs', 15000, 'Jamu Wedang Secang adalah minuman herbal yang terbuat dari ekstrak akar secang (Caesalpinia sappan) dan bahan-bahan alami lainnya seperti jahe, serai, kayu manis, gula merah, dan air. Minuman ini memiliki rasa hangat dan kaya rempah, dengan warna merah khas yang berasal dari ekstrak akar secang.', 'Menenangkan pikiran dan tubuh: Jamu Wedang Secang juga memiliki efek menenangkan pada pikiran dan tubuh. Rasa hangat dan rempah-rempah yang kaya memberikan sensasi relaksasi dan mengurangi stres.', 'Meningkatkan Sirkulasi Darah: Jamu Wedang Secang juga diklaim dapat membantu meningkatkan sirkulasi darah, yang bermanfaat untuk kesehatan jantung dan fungsi tubuh secara umum.', 'Pengaturan Gula Darah: Beberapa penelitian menunjukkan bahwa secang dapat membantu mengatur gula darah, yang bermanfaat bagi penderita diabetes atau orang yang berisiko diabetes.', 'JM010.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Jamu+Wedang+Secang+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', NULL, 3, NULL, '2023-10-07 09:53:42', NULL, 1),
(19, 'JM011', 'Jamu Wedang Jahe', 'Pcs', 20000, 'Jamu Wedang Jahe adalah minuman herbal yang terbuat dari jahe segar, rempah-rempah, dan bahan-bahan alami lainnya seperti serai, daun pandan, gula merah, dan air. Minuman ini memiliki rasa hangat dan aromatik yang khas dari jahe, dengan sentuhan manis dari gula merah.', 'Efek relaksasi dan penenang: Selain manfaat fisik, Jamu Wedang Jahe juga dapat memberikan efek relaksasi dan penenang. Aroma jahe yang harum dan hangat dapat membantu meredakan stres, meningkatkan suasana hati, dan memberikan rasa tenang pada tubuh dan pikiran.', 'Pemulihan Setelah Aktivitas Fisik: Setelah melakukan aktivitas fisik yang intens, konsumsi Jamu Wedang Jahe dapat membantu pemulihan tubuh dan mengurangi kelelahan.', 'Penguat Sistem Kekebalan Tubuh: Jahe mengandung antioksidan dan senyawa bioaktif yang dapat meningkatkan sistem kekebalan tubuh, membantu tubuh melawan infeksi.', 'JM011.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Jamu+Wedang+Jahe+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', NULL, 3, NULL, '2023-10-07 09:54:22', NULL, 1),
(42, 'JM013', 'Jamu Cabai Puyang', 'Pcs', 150000, 'Jamu cabe puyang merupakan salah satu jenis ramuan herbal yang disebut sebagai rahasia raja-raja jawa. Disebut demikian karena ramuan ini memiliki khasiat untuk menjaga vitalitas.', 'Meningkatkan Metabolisme: Kandungan cabai dalam jamu ini mengandung senyawa kapsaisin yang dapat meningkatkan metabolisme tubuh. Ini dapat membantu dalam proses pembakaran kalori dan penurunan berat badan.', 'Peningkatan Kardiovaskular: Beberapa penelitian menunjukkan bahwa senyawa dalam cabai dapat membantu meningkatkan kesehatan kardiovaskular dengan mengurangi tekanan darah dan kadar kolesterol.', 'Mengurangi Nafsu Makan: Cabai pedas telah dikaitkan dengan pengurangan nafsu makan, yang bisa berguna bagi mereka yang ingin mengontrol berat badan.', 'JM013.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Jamu+Cabai+Puyang+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', 'ss', 1, '2023-09-26 12:37:24', '2023-10-07 09:55:01', 1, 1),
(83, 'JM014', 'Jamu Sari Rapet', 'Pcs', 15000, 'Jamu Sari Rapet adalah salah satu jenis jamu tradisional Indonesia yang dikenal karena manfaatnya untuk kesehatan reproduksi wanita. Jamu ini dibuat dari campuran bahan-bahan alami seperti kunyit, temulawak, beras kencur, dan rempah-rempah lainnya. Jamu Sari Rapet sering digunakan oleh wanita untuk menjaga kesehatan organ reproduksi, meningkatkan kebersihan daerah kewanitaan, dan merawat kesehatan secara keseluruhan.', 'Mengencangkan Otot Panggul: Salah satu manfaat utama Jamu Sari Rapet adalah membantu mengencangkan otot-otot panggul, yang dapat membantu mengatasi masalah kekencangan dan kesehatan daerah kewanitaan.', 'Mengurangi Keputihan Berlebihan: Jamu Sari Rapet juga diketahui memiliki efek menyeimbangkan pH di area kewanitaan, yang dapat membantu mengurangi keputihan berlebihan dan menjaga kebersihan.', 'Merawat Kesehatan Reproduksi Wanita: Bahan-bahan alami dalam jamu ini, seperti kunyit dan temulawak, juga dapat memiliki manfaat untuk kesehatan reproduksi wanita.', 'JM014updatedat_1696606712.webp', 'https://wa.me/', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Jamu+Sari+Rapet+%0AHarga+Produk+per+Satuan%3A+Rp.+15.000+%0AJumlah+Pesanan%3A...+Pcs+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', NULL, 3, '2023-10-02 18:47:01', '2023-10-07 10:17:10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `produk_id`, `jumlah`, `total`) VALUES
(3, 1, 10, 2, 20000),
(5, 2, 16, 1, 15000),
(6, 2, 14, 1, 15000),
(7, 3, 10, 1, 10000),
(8, 4, 6, 1, 50000),
(10, 5, 10, 1, 10000),
(11, 6, 10, 1, 10000),
(12, 7, 12, 1, 15000),
(13, 7, 19, 1, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `email_subs`
--

CREATE TABLE `email_subs` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_subs`
--

INSERT INTO `email_subs` (`id`, `email`) VALUES
(5, 'reyhanadr.airdrop@gmail.com'),
(6, 'rustkoyreyhanputin@gmail.com'),
(8, 'jamu.manunggal@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jam_operasional`
--

CREATE TABLE `jam_operasional` (
  `id_jamoperasional` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `isBuka` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jam_operasional`
--

INSERT INTO `jam_operasional` (`id_jamoperasional`, `hari`, `jam_buka`, `jam_tutup`, `isBuka`) VALUES
(1, 'Senin', '08:00:00', '17:00:00', 'Buka'),
(2, 'Selasa', '08:00:00', '17:00:00', 'Buka'),
(3, 'Rabu', '08:00:00', '17:00:00', 'Buka'),
(4, 'Kamis', '08:00:00', '17:00:00', 'Buka'),
(5, 'Jumat', NULL, NULL, 'Tutup'),
(6, 'Sabtu', '10:00:00', '15:00:00', 'Buka'),
(7, 'Minggu', NULL, NULL, 'Tutup');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi_kategori` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
(1, 'Jamu Segars', 'Jamu segar adalah minuman herbal yang dibuat dari bahan-bahan alami yang direbus atau dihaluskan. Jamu segar biasanya disajikan dingin dan memiliki rasa yang segar dan menyegarkan.                                                                                                                        '),
(2, 'Rajangan', 'Rajangan adalah minuman herbal yang terbuat dari bahan-bahan herbal yang dipotong-potong kecil. Rajangan biasanya direbus atau dihaluskan dan disajikan panas. Rajangan memiliki rasa yang lebih kuat daripada jamu segar'),
(3, 'Teh Herbal', 'Teh herbal adalah minuman herbal yang terbuat dari daun atau bunga herbal yang diseduh dengan air panas. Teh herbal memiliki rasa yang lebih ringan daripada jamu segar atau rajangan.');

-- --------------------------------------------------------

--
-- Table structure for table `link_embed`
--

CREATE TABLE `link_embed` (
  `id_link` int(11) NOT NULL,
  `link` longtext NOT NULL,
  `link_default` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `link_embed`
--

INSERT INTO `link_embed` (`id_link`, `link`, `link_default`) VALUES
(1, '<blockquote class=\"instagram-media\" data-instgrm-permalink=\"https://www.instagram.com/reel/CuEkenDpnpa/?utm_source=ig_embed&amp;utm_campaign=loading\" data-instgrm-version=\"14\" style=\" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);\"><div style=\"padding:16px;\"> <a href=\"https://www.instagram.com/reel/CuEkenDpnpa/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;\" target=\"_blank\"> <div style=\" display: flex; flex-direction: row; align-items: center;\"> <div style=\"background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;\"></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;\"></div></div></div><div style=\"padding: 19% 0;\"></div> <div style=\"display:block; height:50px; margin:0 auto 12px; width:50px;\"><svg width=\"50px\" height=\"50px\" viewBox=\"0 0 60 60\" version=\"1.1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\"><g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\"><g transform=\"translate(-511.000000, -20.000000)\" fill=\"#000000\"><g><path d=\"M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631\"></path></g></g></g></svg></div><div style=\"padding-top: 8px;\"> <div style=\" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;\">Lihat postingan ini di Instagram</div></div><div style=\"padding: 12.5% 0;\"></div> <div style=\"display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;\"><div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);\"></div> <div style=\"background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;\"></div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);\"></div></div><div style=\"margin-left: 8px;\"> <div style=\" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;\"></div> <div style=\" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)\"></div></div><div style=\"margin-left: auto;\"> <div style=\" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);\"></div> <div style=\" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);\"></div> <div style=\" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);\"></div></div></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;\"></div></div></a><p style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;\"><a href=\"https://www.instagram.com/reel/CuEkenDpnpa/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;\" target=\"_blank\">Sebuah kiriman dibagikan oleh PKM-PI 2023 | Universitas Jenderal Achmad Yani (@djaman.id)</a></p></div></blockquote> <script async src=\"//www.instagram.com/embed.js\"></script>', '<blockquote class=\"instagram-media\" data-instgrm-permalink=\"https://www.instagram.com/reel/CuEkenDpnpa/?utm_source=ig_embed&amp;utm_campaign=loading\" data-instgrm-version=\"14\" style=\" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);\"><div style=\"padding:16px;\"> <a href=\"https://www.instagram.com/reel/CuEkenDpnpa/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;\" target=\"_blank\"> <div style=\" display: flex; flex-direction: row; align-items: center;\"> <div style=\"background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;\"></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;\"></div></div></div><div style=\"padding: 19% 0;\"></div> <div style=\"display:block; height:50px; margin:0 auto 12px; width:50px;\"><svg width=\"50px\" height=\"50px\" viewBox=\"0 0 60 60\" version=\"1.1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\"><g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\"><g transform=\"translate(-511.000000, -20.000000)\" fill=\"#000000\"><g><path d=\"M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631\"></path></g></g></g></svg></div><div style=\"padding-top: 8px;\"> <div style=\" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;\">Lihat postingan ini di Instagram</div></div><div style=\"padding: 12.5% 0;\"></div> <div style=\"display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;\"><div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);\"></div> <div style=\"background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;\"></div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);\"></div></div><div style=\"margin-left: 8px;\"> <div style=\" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;\"></div> <div style=\" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)\"></div></div><div style=\"margin-left: auto;\"> <div style=\" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);\"></div> <div style=\" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);\"></div> <div style=\" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);\"></div></div></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;\"></div></div></a><p style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;\"><a href=\"https://www.instagram.com/reel/CuEkenDpnpa/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;\" target=\"_blank\">Sebuah kiriman dibagikan oleh PKM-PI 2023 | Universitas Jenderal Achmad Yani (@djaman.id)</a></p></div></blockquote> <script async src=\"//www.instagram.com/embed.js\"></script>');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `id_pengguna`, `nama`, `no_telp`, `email`, `username`, `password`, `kota`, `provinsi`, `alamat`, `kode_pos`, `foto`, `status`) VALUES
(1, 'PGN001', 'John Doe', '08989591299', 'john@example.com', 'johndoe', '25d55ad283aa400af464c76d713c07ad', 'Bogor', 'Jawa Barat', 'Kp. Jauh RT 01/02', '11251', 'pengguna.webp', 'Aktif'),
(2, 'PGN002', 'test', '098765456789', 'test@yopmail.com', 'testing', '7f2ababa423061c509f4923dd04b6cf1', 'Test', 'Test', 'Jl. Test No.8 Test', '768997', 'pengguna.webp', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `produk_terlaris`
--

CREATE TABLE `produk_terlaris` (
  `id_produk` varchar(10) NOT NULL,
  `diskon` varchar(30) NOT NULL,
  `harga_diskon` int(11) NOT NULL,
  `date` date NOT NULL,
  `foto` varchar(50) NOT NULL,
  `link_wa` longtext DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_terlaris`
--

INSERT INTO `produk_terlaris` (`id_produk`, `diskon`, `harga_diskon`, `date`, `foto`, `link_wa`, `updated_by`, `updated_at`) VALUES
('JM002', '15', 42500, '2023-10-31', 'JM002.webp', '?text=Nama+Lengkap%3A+%0ANomor+Telepon%3A+%0AKecamatan%3A+%0AKota%3A+%0AProvinsi%3A+%0AAlamat+Lengkap%3A+%0AKode+Pos%3A+%0ANama+Produk%3A+Beras+Kencur+%0AHarga+Produk+per+Satuan%3A+Rp.+42.500+%0AJumlah+Pesanan%3A...+Pack+++%0AMetode+Pembayaran%28Cash+on+Delivery%2C+BCA%2C+GoPay%2C+Dana%29%3A++', 1, '2023-10-07 03:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` int(11) NOT NULL,
  `nama_rekening` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `nama_rekening`, `no_rekening`, `bank`) VALUES
(1, 'Jamu Manunggal', '81237173', 'BCA'),
(3, 'Jamu Manunggal', '812367163', 'MANDIRI'),
(4, 'Jamu Manunggal', '0', 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_tokens`
--

CREATE TABLE `reset_password_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resi`
--

CREATE TABLE `resi` (
  `id` int(11) NOT NULL,
  `no_resi` varchar(255) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `pengguna_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resi`
--

INSERT INTO `resi` (`id`, `no_resi`, `transaksi_id`, `pengguna_id`) VALUES
(8, '43565434567564343', 4, 1),
(9, '8976545676854536', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `nama_role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `nama_role`) VALUES
(1, 'Super Admin'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `sitemap_urlproduk`
--

CREATE TABLE `sitemap_urlproduk` (
  `id` int(11) NOT NULL,
  `id_produk` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitemap_urlproduk`
--

INSERT INTO `sitemap_urlproduk` (`id`, `id_produk`) VALUES
(1, 'JM002'),
(13, 'JM003'),
(14, 'JM005'),
(15, 'JM006'),
(16, 'JM007'),
(17, 'JM008'),
(18, 'JM009'),
(22, 'JM010'),
(23, 'JM011'),
(24, 'JM013'),
(33, 'JM014');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `pengguna_id` int(11) NOT NULL,
  `rekening_id` int(11) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `ambil_toko` int(11) NOT NULL DEFAULT 0,
  `status` varchar(100) NOT NULL,
  `total_pembayaran` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `pengguna_id`, `rekening_id`, `bukti_pembayaran`, `ambil_toko`, `status`, `total_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 'TRS001', 1, 1, 'bukti-pembayaran-20240419160615.webp', 0, 'Selesai', 20000, '2024-04-19 09:21:55', '2024-04-19 09:21:55'),
(2, 'TRS002', 1, 3, 'bukti-pembayaran-20240419182759.webp', 0, 'Selesai', 30000, '2024-04-19 18:12:37', '2024-04-19 18:12:37'),
(3, 'TRS003', 1, 3, 'bukti-pembayaran-20240519085801.webp', 1, 'Selesai', 10000, '2024-04-19 18:54:53', '2024-04-19 18:54:53'),
(4, 'TRS004', 1, 4, NULL, 0, 'Dikirim', 50000, '2024-06-10 01:23:55', '2024-06-10 01:23:55'),
(5, 'TRS005', 2, 4, NULL, 0, 'Dikirim', 10000, '2024-06-12 21:11:04', '2024-06-12 21:11:04'),
(6, 'TRS006', 2, 4, NULL, 0, 'Dikirim', 10000, '2024-06-13 08:29:11', '2024-06-13 08:29:11'),
(7, 'TRS007', 2, 4, NULL, 0, 'Dikirim', 35000, '2024-06-13 22:28:35', '2024-06-13 22:28:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_admin` (`id_admin`),
  ADD KEY `relasi_role_id` (`role_id`);

--
-- Indexes for table `asknsugest`
--
ALTER TABLE `asknsugest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_kontak`
--
ALTER TABLE `data_kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `data_organisasi`
--
ALTER TABLE `data_organisasi`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_produk` (`id_produk`),
  ADD KEY `relasi_createdby_admin` (`created_by`),
  ADD KEY `relasi_updateby_admin` (`updated_by`),
  ADD KEY `relasi_kategori_id` (`id_kategori`);
ALTER TABLE `data_produk` ADD FULLTEXT KEY `nama_jamu` (`nama_jamu`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_subs`
--
ALTER TABLE `email_subs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jam_operasional`
--
ALTER TABLE `jam_operasional`
  ADD PRIMARY KEY (`id_jamoperasional`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `link_embed`
--
ALTER TABLE `link_embed`
  ADD PRIMARY KEY (`id_link`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_terlaris`
--
ALTER TABLE `produk_terlaris`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_password_tokens`
--
ALTER TABLE `reset_password_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `pengguna_id` (`pengguna_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sitemap_urlproduk`
--
ALTER TABLE `sitemap_urlproduk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_produk` (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `asknsugest`
--
ALTER TABLE `asknsugest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_produk`
--
ALTER TABLE `data_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `email_subs`
--
ALTER TABLE `email_subs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jam_operasional`
--
ALTER TABLE `jam_operasional`
  MODIFY `id_jamoperasional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `link_embed`
--
ALTER TABLE `link_embed`
  MODIFY `id_link` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reset_password_tokens`
--
ALTER TABLE `reset_password_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `resi`
--
ALTER TABLE `resi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sitemap_urlproduk`
--
ALTER TABLE `sitemap_urlproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `relasi_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD CONSTRAINT `relasi_createdby_admin` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `relasi_kategori_id` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_produk` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `relasi_updateby_admin` FOREIGN KEY (`updated_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `produk_terlaris`
--
ALTER TABLE `produk_terlaris`
  ADD CONSTRAINT `relasi_produk` FOREIGN KEY (`id_produk`) REFERENCES `data_produk` (`id_produk`),
  ADD CONSTRAINT `relasi_terlaris_admin` FOREIGN KEY (`updated_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `sitemap_urlproduk`
--
ALTER TABLE `sitemap_urlproduk`
  ADD CONSTRAINT `https://djaman.my.id/` FOREIGN KEY (`id_produk`) REFERENCES `data_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
