-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.39 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_cabai_lengkap

-- Dumping structure for table db_cabai_lengkap.bibits
CREATE TABLE IF NOT EXISTS `bibits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cabai_id` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_diskon` int(11) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `berat` int(11) DEFAULT '10' COMMENT 'gram',
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT '0',
  `is_new` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cabai_id` (`cabai_id`),
  CONSTRAINT `bibits_ibfk_1` FOREIGN KEY (`cabai_id`) REFERENCES `cabais` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.bibits: ~8 rows (approximately)
INSERT INTO `bibits` (`id`, `cabai_id`, `nama_produk`, `harga`, `harga_diskon`, `stok`, `berat`, `deskripsi`, `gambar`, `is_popular`, `is_new`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Bibit Cabai Rawit Sigantung', 25000, NULL, 50, 10, 'Bibit unggul varietas Sigantung, cocok untuk dataran rendah-tinggi. Produk asli dari petani lokal Jawa Timur.', 'uploads/bibit/c68a6d539bfc4aab9df745727295f56a.jpg', 1, 0, '2026-05-07 16:09:33', '2026-06-11 03:23:43'),
	(2, 2, 'Bibit Shypoon Anti Virus', 32000, NULL, 15, 10, 'Bibit dengan ketahanan tinggi terhadap Virus Gemini. Tanaman akan tumbuh sehat meskipun di lahan yang rawan penyakit.', NULL, 1, 0, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(3, 3, 'Bibit Sret Putih', 28000, NULL, 15, 10, 'Bibit dengan keunikan warna buah putih saat muda. Tingkat kepedasan extra hot.', NULL, 0, 1, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(4, 4, 'Bibit Taruna Tahan Layu', 22000, NULL, 38, 10, 'Bibit dengan ketahanan terhadap penyakit layu bakteri. Perawatan mudah, cocok untuk pemula.', NULL, 0, 0, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(5, 5, 'Bibit Bhaskara BISI', 30000, NULL, 30, 10, 'Produk unggulan PT BISI International. Tahan terhadap hama thrips dan tungau.', NULL, 1, 0, '2026-05-07 16:09:33', '2026-06-27 18:18:56'),
	(6, 6, 'Bibit Sonar Extra Hot', 27000, NULL, 12, 10, 'Bibit dengan tingkat kepedasan extra hot. Cocok untuk pecinta sensasi pedas maksimal.', NULL, 0, 0, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(7, 7, 'Bibit Dewata 43 F1', 35000, NULL, 70, 10, 'Varietas hibrida dengan umur panen super cepat, hanya 65-70 hari setelah tanam.', NULL, 0, 1, '2026-05-07 16:09:33', '2026-06-24 17:41:57'),
	(8, 8, 'Bibit Halbanero Abayomi', 45000, NULL, 100, 10, 'Bibit dengan karakter mirip habanero. Tahan antraknosa, cocok untuk dataran rendah.', NULL, 1, 1, '2026-05-07 16:09:33', '2026-06-24 17:41:44');

-- Dumping structure for table db_cabai_lengkap.cabais
CREATE TABLE IF NOT EXISTS `cabais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_varietas` varchar(100) NOT NULL,
  `nama_latin` varchar(100) DEFAULT NULL,
  `tingkat_pedas` varchar(50) NOT NULL,
  `skala_pedas` int(1) DEFAULT '3' COMMENT '1-5',
  `umur_panen` int(11) NOT NULL COMMENT 'hari',
  `cocok_ditanam` varchar(100) NOT NULL,
  `keunggulan` text NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `harga` int(11) NOT NULL DEFAULT '0',
  `stok` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.cabais: ~9 rows (approximately)
INSERT INTO `cabais` (`id`, `nama_varietas`, `nama_latin`, `tingkat_pedas`, `skala_pedas`, `umur_panen`, `cocok_ditanam`, `keunggulan`, `deskripsi`, `gambar`, `created_at`, `updated_at`, `harga`, `stok`) VALUES
	(1, 'Sigantung', 'Capsicum frutescens', 'Sangat Pedas', 4, 90, 'Dataran rendah - tinggi', 'Buah bergerombol menggantung, tahan hama, legendaris asli Jawa Timur', 'Varietas cabai rawit asli Madura dengan buah yang menggantung bergerombol. Ukuran buah sekitar 5x1 cm, warna merah cerah saat matang. Sangat cocok untuk sambal dan masakan pedas.', NULL, '2026-05-07 16:09:33', '2026-06-27 17:40:29', 25000, 30),
	(2, 'Shypoon', 'Capsicum annuum', 'Pedas', 4, 100, 'Semua ketinggian', 'Tahan Virus Gemini (Virus Bule), buah lebat 2-12 per tangkai', 'Varietas unggul yang tahan terhadap penyakit virus bule. Dalam satu tangkai bisa berisi 2-12 buah cabai, sehingga terlihat sangat lebat. Tanaman merunduk.', NULL, '2026-05-07 16:09:33', '2026-06-27 18:30:09', 30000, 30),
	(3, 'Sret', 'Capsicum frutescens', 'Extra Pedas', 5, 95, 'Dataran rendah', 'Buah putih saat muda, merah cerah saat tua, produktivitas tinggi', 'Varietas lokal dengan keunikan warna buah putih saat masih muda. Tingkat kepedasan sangat tinggi, cocok untuk yang suka sensasi pedas ekstra.', NULL, '2026-05-07 16:09:33', '2026-06-27 18:30:00', 35000, 30),
	(4, 'Taruna', 'Capsicum annuum', 'Sedang', 3, 85, 'Dataran rendah - menengah', 'Tahan penyakit layu bakteri, batang tegak dengan ruas pendek', 'Varietas yang dirancang untuk memudahkan perawatan. Batang tegak dan tidak terlalu tinggi, sehingga mudah dipanen. Cocok untuk pemula.', NULL, '2026-05-07 16:09:33', '2026-06-27 18:30:16', 20000, 30),
	(5, 'Bhaskara', 'Capsicum frutescens', 'Pedas', 4, 90, 'Dataran rendah - tinggi', 'Tahan hama thrips dan tungau, hasil buah lebat', 'Produk unggulan dari PT BISI International Tbk. Tahan terhadap hama thrips yang sering menjadi masalah bagi petani cabai.', NULL, '2026-05-07 16:09:33', '2026-06-27 18:30:36', 28000, 20),
	(6, 'Sonar', 'Capsicum annuum', 'Sangat Pedas', 5, 90, 'Dataran rendah - menengah', 'Tingkat kepedasan sangat tinggi, buah merah mengkilat', 'Salah satu varietas "jadul" yang masih eksis karena kualitas pedasnya yang luar biasa. Dikenal memiliki tingkat kepedasan extra hot.', NULL, '2026-05-07 16:09:33', '2026-06-27 18:30:58', 32000, 20),
	(7, 'Dewata 43 F1', 'Capsicum annuum', 'Pedas', 4, 70, 'Dataran rendah', 'Panen super cepat (65-70 HST), tanaman pendek, tahan Fusarium', 'Varietas hibrida (F1) yang dirancang untuk produktivitas maksimal di dataran rendah. Panen bisa dilakukan sangat cepat, cocok untuk lahan sawah setelah padi.', NULL, '2026-05-07 16:09:33', '2026-06-27 18:31:04', 27000, 20),
	(8, 'Halbanero Abayomi', 'Capsicum chinense', 'Extra Pedas', 5, 95, 'Dataran rendah', 'Tahan antraknosa (patek), rasa mirip habanero', 'Varietas dengan karakter mirip habanero, cocok untuk Anda yang suka cabai dengan rasa dan aroma khas. Diklaim lebih tahan terhadap penyakit antraknosa.', NULL, '2026-05-07 16:09:33', '2026-06-27 18:31:11', 45000, 20),
	(9, 'tes', 'tes', 'Extra Pedas', 5, 60, 'Dataran rendah', 'tes', 'tes', 'uploads/cabai/307db8bdec8a477bfd834efe2dd915b6.jpg', '2026-06-24 19:17:18', '2026-06-24 19:17:18', 0, 0);

-- Dumping structure for table db_cabai_lengkap.keranjang
CREATE TABLE IF NOT EXISTS `keranjang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tipe_produk` enum('cabai','bibit') NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cabai_lengkap.keranjang: ~3 rows (approximately)
INSERT INTO `keranjang` (`id`, `user_id`, `product_id`, `tipe_produk`, `qty`, `created_at`) VALUES
	(5, 18, 2, 'cabai', 1, '2026-06-27 03:14:24'),
	(6, 18, 3, 'cabai', 2, '2026-06-27 03:17:57'),
	(7, 19, 5, 'bibit', 1, '2026-06-30 23:07:46');

-- Dumping structure for table db_cabai_lengkap.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.settings: ~7 rows (approximately)
INSERT INTO `settings` (`id`, `key`, `value`) VALUES
	(1, 'nama_website', 'CabaiNusa'),
	(2, 'tagline', 'Pusat Bibit Cabai Unggul Nusantara'),
	(3, 'email', 'info@cabainusa.com'),
	(4, 'phone', '081234567890'),
	(5, 'address', 'Jl. Pertanian No. 123, Malang, Jawa Timur'),
	(6, 'instagram', '@cabainusa'),
	(7, 'whatsapp', '6281234567890');

-- Dumping structure for table db_cabai_lengkap.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `catatan` text,
  `total_harga` int(11) NOT NULL,
  `ongkir` int(11) DEFAULT '0',
  `grand_total` int(11) NOT NULL,
  `status` enum('pending','paid','processing','shipped','completed','cancelled') DEFAULT 'pending',
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_transaksi` (`kode_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.transaksi: ~33 rows (approximately)
INSERT INTO `transaksi` (`id`, `kode_transaksi`, `nama_pelanggan`, `email`, `telepon`, `alamat`, `catatan`, `total_harga`, `ongkir`, `grand_total`, `status`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
	(1, 'TRX202605070001', 'mas', 'test@gmail.com', '081234567890', 'klk', '', 70000, 15000, 85000, 'pending', NULL, '2026-05-07 12:23:12', NULL),
	(2, 'TRX202605070002', 'mas', 'test@gmail.com', '081234567890', 'klk', '', 57000, 15000, 72000, 'pending', NULL, '2026-05-07 12:46:43', NULL),
	(3, 'TRX202605070003', 'mas', 'test@gmail.com', '081234567890', 'klk', '', 30000, 15000, 45000, 'pending', NULL, '2026-05-07 12:52:46', NULL),
	(4, 'TRX202606220004', 'Jody Indra88', NULL, '3423434', 'bhhvggvhg', 'uhuhb', 50000, 0, 50000, 'pending', NULL, '2026-06-22 18:59:54', NULL),
	(5, 'TRX202606220005', 'Jody Indra88', NULL, '3423434', 'bhhvggvhg', 'uhuhb', 50000, 0, 50000, 'pending', NULL, '2026-06-22 19:11:23', NULL),
	(6, 'TRX202606220006', 'Jody Indra88', NULL, '3423434', 'bhhvggvhg', 'uhuhb', 50000, 0, 50000, 'pending', NULL, '2026-06-22 19:11:34', NULL),
	(7, 'TRX202606220007', 'Jody Indra88', NULL, '3423434', 'bhhvggvhg', 'uhuhb', 50000, 0, 50000, 'pending', NULL, '2026-06-22 19:15:23', NULL),
	(8, 'TRX202606220008', 'Jody Indra88', NULL, '3423434', 'bhhvggvhg', 'uhuhb', 30000, 0, 30000, 'pending', NULL, '2026-06-22 19:17:56', NULL),
	(9, 'TRX202606220009', 'Jody Indra88', NULL, '3423434', 'bhhvggvhg', 'uhuhb', 0, 0, 0, 'pending', NULL, '2026-06-22 19:18:23', NULL),
	(10, 'TRX202606220010', 'Jody Indra88', NULL, '3423434', 'gjvgcgc', 'uhuhb', 150000, 0, 150000, 'pending', NULL, '2026-06-22 19:19:13', NULL),
	(11, 'TRX202606220011', 'Jody Indra88', NULL, '3423434', 'jjjjjjjjjjjj', 'uhuhb', 100000, 0, 100000, 'pending', NULL, '2026-06-22 19:24:29', NULL),
	(12, 'TRX202606230012', 'Jody Indra88', NULL, '3423434', 'ffdcdfgffdd', 'uhuhb', 25000, 0, 25000, 'pending', NULL, '2026-06-23 16:00:45', NULL),
	(13, 'TRX202606230013', 'Jody Indra88', NULL, '3423434', 'hggcgh', 'uhuhb', 25000, 0, 25000, 'pending', NULL, '2026-06-23 16:40:55', NULL),
	(14, 'TRX202606230014', 'Jody Indra88', NULL, '3423434', 'cfcgdf', 'uhuhb', 25000, 0, 25000, 'pending', NULL, '2026-06-23 16:57:41', NULL),
	(15, 'TRX202606230015', 'Jody Indra88', NULL, '3423434', 'fsdfsdf', 'uhuhb', 25000, 0, 25000, 'pending', NULL, '2026-06-23 17:12:06', NULL),
	(16, 'TRX202606230016', 'Jody Indra88', NULL, '3423434', 'zcadsxcfsdx', 'uhuhb', 32000, 0, 32000, 'pending', NULL, '2026-06-23 17:14:39', NULL),
	(17, 'TRX202606230017', 'Jody Indra88', NULL, '3423434', 'sdvfvxdcvds', 'uhuhb', 32000, 0, 32000, '', NULL, '2026-06-23 17:16:01', '2026-06-23 17:16:17'),
	(18, 'TRX202606230018', 'Jody Indra88', NULL, '3423434', 'gfgfcfg gc', 'uhuhb', 32000, 0, 32000, 'paid', NULL, '2026-06-23 17:41:05', '2026-06-23 17:41:21'),
	(19, 'TRX202606240019', 'Jody Indra88', NULL, '3423434', 'ghftgyrt', 'uhuhb', 75000, 0, 75000, 'paid', NULL, '2026-06-24 17:04:30', '2026-06-24 17:06:06'),
	(20, 'TRX202606240020', 'Jody Indra88', NULL, '3423434', 'fefsdfsd', 'uhuhb', 442000, 0, 442000, 'paid', NULL, '2026-06-24 18:35:37', '2026-06-24 18:37:42'),
	(21, 'TRX202606240021', 'Jody Indra88', NULL, '3423434', 'grfgedrfvgdf', 'uhuhb', 955000, 0, 955000, 'paid', NULL, '2026-06-24 18:37:44', '2026-06-24 18:40:09'),
	(22, 'TRX202606250022', 'Jody Indra88', NULL, '3423434', 'edrtdrftg', 'uhuhb', 154000, 0, 154000, 'pending', NULL, '2026-06-25 15:25:10', NULL),
	(23, 'TRX202606250023', 'Jody Indra88', NULL, '3423434', 'gdfgfgvgd', 'uhuhb', 1800000, 0, 1800000, 'paid', NULL, '2026-06-25 15:50:09', '2026-06-25 15:50:56'),
	(24, 'TRX202606250024', 'Jody Indra88', NULL, '3423434', 'ygygygvfy', 'uhuhb', 595000, 0, 595000, 'pending', NULL, '2026-06-25 16:20:18', NULL),
	(25, 'TRX202606250025', 'Jody Indra88', NULL, '3423434', 'ggygyvy', 'uhuhb', 595000, 0, 595000, 'paid', NULL, '2026-06-25 16:20:57', NULL),
	(26, 'TRX202606250026', 'Jody Indra88', NULL, '3423434', 'rfgrt', 'uhuhb', 459000, 0, 459000, 'paid', NULL, '2026-06-25 16:34:53', NULL),
	(27, 'TRX202606250027', 'Jody Indra88', NULL, '3423434', 'dedasefrr', 'uhuhb', 190000, 0, 190000, 'paid', NULL, '2026-06-25 17:40:41', NULL),
	(28, 'TRX202606260028', 'Jody Indra88', NULL, '3423434', 'dfgdfvbdc', 'uhuhb', 355000, 0, 355000, 'pending', NULL, '2026-06-26 17:49:26', NULL),
	(29, 'TRX202606260029', 'Jody Indra88', NULL, '3423434', 'sfdf', 'uhuhb', 128000, 0, 128000, 'paid', NULL, '2026-06-26 17:56:21', NULL),
	(30, 'TRX202606260030', 'Jody Indra88', NULL, '3423434', 'dfsdfcsdfs', 'uhuhb', 240000, 0, 240000, 'paid', NULL, '2026-06-26 19:40:22', NULL),
	(31, 'TRX202606270031', 'Jody Indra88', NULL, '3423434', 'rtgdftgd', 'uhuhb', 210000, 0, 210000, 'completed', NULL, '2026-06-27 15:58:14', NULL),
	(32, 'TRX202606290032', 'Jody Indra88', NULL, '3423434', 'dssdzfss', 'uhuhb', 320000, 0, 320000, 'pending', NULL, '2026-06-29 18:19:33', NULL),
	(33, 'TRX202606290033', 'Jody Indra88', NULL, '3423434', 'dssdzfss', 'uhuhb', 320000, 0, 320000, 'paid', NULL, '2026-06-29 18:24:27', NULL);

-- Dumping structure for table db_cabai_lengkap.transaksi_detail
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tipe_produk` enum('cabai','bibit') NOT NULL DEFAULT 'bibit',
  `nama_produk` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_id` (`transaksi_id`),
  CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.transaksi_detail: ~42 rows (approximately)
INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `product_id`, `tipe_produk`, `nama_produk`, `harga`, `qty`, `subtotal`) VALUES
	(1, 1, 7, 'bibit', 'Bibit Dewata 43 F1', 35000, 2, 70000),
	(2, 2, 1, 'bibit', 'Bibit Cabai Rawit Sigantung', 25000, 1, 25000),
	(3, 2, 2, 'bibit', 'Bibit Shypoon Anti Virus', 32000, 1, 32000),
	(4, 3, 5, 'bibit', 'Bibit Bhaskara BISI', 30000, 1, 30000),
	(5, 4, 1, 'cabai', 'Sigantung', 25000, 2, 50000),
	(6, 5, 1, 'cabai', 'Sigantung', 25000, 2, 50000),
	(7, 6, 1, 'cabai', 'Sigantung', 25000, 2, 50000),
	(8, 7, 1, 'cabai', 'Sigantung', 25000, 2, 50000),
	(9, 8, 2, 'cabai', 'Shypoon', 30000, 1, 30000),
	(10, 10, 1, 'cabai', 'Sigantung', 25000, 2, 50000),
	(11, 10, 1, 'bibit', 'Bibit Cabai Rawit Sigantung', 25000, 4, 100000),
	(12, 11, 1, 'bibit', 'Bibit Cabai Rawit Sigantung', 25000, 4, 100000),
	(13, 12, 1, 'bibit', 'Bibit Cabai Rawit Sigantung', 25000, 1, 25000),
	(14, 13, 1, 'bibit', 'Bibit Cabai Rawit Sigantung', 25000, 1, 25000),
	(15, 14, 1, 'bibit', 'Bibit Cabai Rawit Sigantung', 25000, 1, 25000),
	(16, 15, 1, 'bibit', 'Bibit Cabai Rawit Sigantung', 25000, 1, 25000),
	(17, 16, 2, 'bibit', 'Bibit Shypoon Anti Virus', 32000, 1, 32000),
	(18, 17, 2, 'bibit', 'Bibit Shypoon Anti Virus', 32000, 1, 32000),
	(19, 18, 2, 'bibit', 'Bibit Shypoon Anti Virus', 32000, 1, 32000),
	(20, 19, 1, 'cabai', 'Sigantung', 25000, 3, 75000),
	(21, 20, 2, 'bibit', 'Bibit Shypoon Anti Virus', 32000, 1, 32000),
	(22, 20, 3, 'cabai', 'Sret', 35000, 4, 140000),
	(23, 20, 7, 'cabai', 'Dewata 43 F1', 27000, 10, 270000),
	(24, 21, 2, 'cabai', 'Shypoon', 30000, 1, 30000),
	(25, 21, 4, 'bibit', 'Bibit Taruna Tahan Layu', 22000, 10, 220000),
	(26, 21, 7, 'bibit', 'Bibit Dewata 43 F1', 35000, 6, 210000),
	(27, 21, 8, 'cabai', 'Halbanero Abayomi', 45000, 11, 495000),
	(28, 22, 4, 'bibit', 'Bibit Taruna Tahan Layu', 22000, 7, 154000),
	(29, 23, 2, 'cabai', 'Shypoon', 30000, 60, 1800000),
	(30, 24, 3, 'cabai', 'Sret', 35000, 17, 595000),
	(31, 25, 3, 'cabai', 'Sret', 35000, 17, 595000),
	(32, 26, 6, 'bibit', 'Bibit Sonar Extra Hot', 27000, 17, 459000),
	(33, 27, 3, 'cabai', 'Sret', 35000, 2, 70000),
	(34, 27, 2, 'cabai', 'Shypoon', 30000, 4, 120000),
	(35, 28, 3, 'cabai', 'Sret', 35000, 5, 175000),
	(36, 28, 5, 'bibit', 'Bibit Bhaskara BISI', 30000, 6, 180000),
	(37, 29, 2, 'bibit', 'Bibit Shypoon Anti Virus', 32000, 4, 128000),
	(38, 30, 5, 'bibit', 'Bibit Bhaskara BISI', 30000, 4, 120000),
	(39, 30, 4, 'cabai', 'Taruna', 20000, 6, 120000),
	(40, 31, 5, 'bibit', 'Bibit Bhaskara BISI', 30000, 7, 210000),
	(41, 32, 6, 'cabai', 'Sonar', 32000, 10, 320000),
	(42, 33, 6, 'cabai', 'Sonar', 32000, 10, 320000);

-- Dumping structure for table db_cabai_lengkap.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff','user') NOT NULL DEFAULT 'user',
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.users: ~15 rows (approximately)
INSERT INTO `users` (`id`, `username`, `nama_lengkap`, `password`, `email`, `foto`, `role`, `last_login`, `is_active`, `created_at`) VALUES
	(2, 'admin', 'Administrator', '0192023a7bbd73250516f069df18b500', 'test@gmail.com', NULL, 'admin', NULL, 1, NULL),
	(3, 'kang', 'mas', '$2y$10$O8MxbZyV2WHjPDujIgqBreuWy3UEHBFgxHt1CBIFZUJlTl/UFz05K', 'mas@gmail.com', NULL, 'staff', '2026-06-25 17:41:48', 1, '2026-05-07 13:14:43'),
	(4, 'Pendragon', 'jody', '$2y$10$nfCrK91HwRFf.kHvEQLsru1dK8VlVOrPij4Ymr7fiWOajfBX5WY2u', 'jodyindrarismantoro@gmail.com', NULL, 'staff', '2026-06-24 01:25:31', 1, '2026-06-14 16:26:19'),
	(5, 'Morgan', 'Arthur', '$2y$10$YZmntWMV/dQ8LXStTn4JuOR8e6fhr.vj.eHKmnmfLo2lkXkdXnAEO', 'indrarismantoro@gmail.com', NULL, 'staff', NULL, 1, '2026-06-14 16:31:40'),
	(6, 'Mustang', 'Arthur', '$2y$10$t99RnZ1qMni4CTsvl20.DOO7Xdho.3I50EViuqixhczk/os2sC7.q', 'hdjsjsuejhhuuu@gmail.com', NULL, 'staff', NULL, 1, '2026-06-14 16:42:57'),
	(7, 'Royy', 'Mustang', '$2y$10$KvrUCLSs8ZgK1xsYn5snIOjpUveEmWsBxbR0EyiT0zQ0l4Z19fqbS', 'indra@gmail.com', NULL, 'user', NULL, 1, '2026-06-14 16:45:43'),
	(8, 'ruyy', 'e22', '$2y$10$co8AIE1bdR8UjvjlQAhVteKJcAqLBHeaEoYYcVrzD/iQTS6KpC0qa', 'bagus@gmail.com', NULL, 'staff', NULL, 1, '2026-06-14 16:48:30'),
	(9, 'yeah', 'yaya', '$2y$10$cUlmNYnU/TEbJDuRPj3i/.SgFBn.iqr4f77WcpP2HmLcQMDjD3lou', 'yeah@gmail.com', NULL, 'user', NULL, 1, '2026-06-14 17:13:04'),
	(10, 'eeee', 'eee', '$2y$10$f.jEn2XjdbzdTlVl6/be3ex5w4Ib9U7Y/i/xRkdubXUKSBsAAr.Hm', 'eeee@gmail.com', NULL, 'user', NULL, 1, '2026-06-14 17:32:19'),
	(11, 'aight', 'yes', '$2y$10$eoNST1qCAxrGD/uW7mTCeekiWwJmYcUgiRdSukMxuGyN1laOWKsUS', 'aight@gmail.com', NULL, 'user', NULL, 1, '2026-06-14 18:25:45'),
	(13, 'test', 'hooh', '$2y$10$UKJfmpwx9pjmwPMNYdFlIuvTc1AZqerq1YOylFEibh6ZED.4eL2Ji', 'yoi@gmail.com', NULL, 'user', NULL, 1, '2026-06-15 15:51:22'),
	(16, 'jodd', 'jodyyyy', '$2y$10$n9mIxvUoU.aTHpXnkNMEkOrHe0XmsPySu/s4NrzGO98VzNpfV4lPu', 'jodd@gmail.com', NULL, 'user', NULL, 1, '2026-06-23 18:41:56'),
	(17, 'hyyy', 'hyy', '$2y$10$nIyLgvUn9U79cTks5dURH.I5FN1xMbNcJwzBSJngnpvcJHzy8udaS', 'hy@gmail.com', NULL, 'user', '2026-06-24 19:12:04', 1, '2026-06-23 18:59:59'),
	(18, 'giovanna', 'giorno', '$2y$10$7FRH1xMttSAUlXLggz3hMuenNB2l6PgoGTODMfNGoYExpTIPbJClW', 'giogio@gmail.com', 'uploads/profile/user_18_1782502658.jpeg', 'user', '2026-06-30 19:30:14', 1, '2026-06-24 16:53:12'),
	(19, 'aseng', 'antek', '$2y$10$.7x199ikKq9.IP1WLvk3WO6hLac5dBLI9txOTmdjBWCpEUE6NU4yO', 'aseng@gmail.com', NULL, 'admin', '2026-06-30 16:08:58', 1, '2026-06-25 17:59:38');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
