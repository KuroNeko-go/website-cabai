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
CREATE DATABASE IF NOT EXISTS `db_cabai_lengkap` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_cabai_lengkap`;

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
	(2, 2, 'Bibit Shypoon Anti Virus', 32000, NULL, 22, 10, 'Bibit dengan ketahanan tinggi terhadap Virus Gemini. Tanaman akan tumbuh sehat meskipun di lahan yang rawan penyakit.', NULL, 1, 0, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(3, 3, 'Bibit Sret Putih', 28000, NULL, 15, 10, 'Bibit dengan keunikan warna buah putih saat muda. Tingkat kepedasan extra hot.', NULL, 0, 1, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(4, 4, 'Bibit Taruna Tahan Layu', 22000, NULL, 38, 10, 'Bibit dengan ketahanan terhadap penyakit layu bakteri. Perawatan mudah, cocok untuk pemula.', NULL, 0, 0, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(5, 5, 'Bibit Bhaskara BISI', 30000, NULL, 11, 10, 'Produk unggulan PT BISI International. Tahan terhadap hama thrips dan tungau.', NULL, 1, 0, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(6, 6, 'Bibit Sonar Extra Hot', 27000, NULL, 29, 10, 'Bibit dengan tingkat kepedasan extra hot. Cocok untuk pecinta sensasi pedas maksimal.', NULL, 0, 0, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(7, 7, 'Bibit Dewata 43 F1', 35000, NULL, 7, 10, 'Varietas hibrida dengan umur panen super cepat, hanya 65-70 hari setelah tanam.', NULL, 0, 1, '2026-05-07 16:09:33', '2026-05-07 16:09:33'),
	(8, 8, 'Bibit Halbanero Abayomi', 45000, NULL, 5, 10, 'Bibit dengan karakter mirip habanero. Tahan antraknosa, cocok untuk dataran rendah.', NULL, 1, 1, '2026-05-07 16:09:33', '2026-05-07 13:20:54');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.cabais: ~8 rows (approximately)
INSERT INTO `cabais` (`id`, `nama_varietas`, `nama_latin`, `tingkat_pedas`, `skala_pedas`, `umur_panen`, `cocok_ditanam`, `keunggulan`, `deskripsi`, `gambar`, `created_at`, `updated_at`, `harga`) VALUES
	(1, 'Sigantung', 'Capsicum frutescens', 'Sangat Pedas', 4, 90, 'Dataran rendah - tinggi', 'Buah bergerombol menggantung, tahan hama, legendaris asli Jawa Timur', 'Varietas cabai rawit asli Madura dengan buah yang menggantung bergerombol. Ukuran buah sekitar 5x1 cm, warna merah cerah saat matang. Sangat cocok untuk sambal dan masakan pedas.', NULL, '2026-05-07 16:09:33', '2026-05-07 14:22:11', 25000),
	(2, 'Shypoon', 'Capsicum annuum', 'Pedas', 4, 100, 'Semua ketinggian', 'Tahan Virus Gemini (Virus Bule), buah lebat 2-12 per tangkai', 'Varietas unggul yang tahan terhadap penyakit virus bule. Dalam satu tangkai bisa berisi 2-12 buah cabai, sehingga terlihat sangat lebat. Tanaman merunduk.', NULL, '2026-05-07 16:09:33', '2026-05-07 16:09:33', 30000),
	(3, 'Sret', 'Capsicum frutescens', 'Extra Pedas', 5, 95, 'Dataran rendah', 'Buah putih saat muda, merah cerah saat tua, produktivitas tinggi', 'Varietas lokal dengan keunikan warna buah putih saat masih muda. Tingkat kepedasan sangat tinggi, cocok untuk yang suka sensasi pedas ekstra.', NULL, '2026-05-07 16:09:33', '2026-05-07 16:09:33', 35000),
	(4, 'Taruna', 'Capsicum annuum', 'Sedang', 3, 85, 'Dataran rendah - menengah', 'Tahan penyakit layu bakteri, batang tegak dengan ruas pendek', 'Varietas yang dirancang untuk memudahkan perawatan. Batang tegak dan tidak terlalu tinggi, sehingga mudah dipanen. Cocok untuk pemula.', NULL, '2026-05-07 16:09:33', '2026-05-07 16:09:33', 20000),
	(5, 'Bhaskara', 'Capsicum frutescens', 'Pedas', 4, 90, 'Dataran rendah - tinggi', 'Tahan hama thrips dan tungau, hasil buah lebat', 'Produk unggulan dari PT BISI International Tbk. Tahan terhadap hama thrips yang sering menjadi masalah bagi petani cabai.', NULL, '2026-05-07 16:09:33', '2026-05-07 16:09:33', 28000),
	(6, 'Sonar', 'Capsicum annuum', 'Extra Hot', 5, 90, 'Dataran rendah - menengah', 'Tingkat kepedasan sangat tinggi, buah merah mengkilat', 'Salah satu varietas "jadul" yang masih eksis karena kualitas pedasnya yang luar biasa. Dikenal memiliki tingkat kepedasan extra hot.', NULL, '2026-05-07 16:09:33', '2026-05-07 16:09:33', 32000),
	(7, 'Dewata 43 F1', 'Capsicum annuum', 'Pedas', 4, 70, 'Dataran rendah', 'Panen super cepat (65-70 HST), tanaman pendek, tahan Fusarium', 'Varietas hibrida (F1) yang dirancang untuk produktivitas maksimal di dataran rendah. Panen bisa dilakukan sangat cepat, cocok untuk lahan sawah setelah padi.', NULL, '2026-05-07 16:09:33', '2026-05-07 16:09:33', 27000),
	(8, 'Halbanero Abayomi', 'Capsicum chinense', 'Extra Pedas', 5, 95, 'Dataran rendah', 'Tahan antraknosa (patek), rasa mirip habanero', 'Varietas dengan karakter mirip habanero, cocok untuk Anda yang suka cabai dengan rasa dan aroma khas. Diklaim lebih tahan terhadap penyakit antraknosa.', NULL, '2026-05-07 16:09:33', '2026-05-07 13:43:32', 45000);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.transaksi: ~3 rows (approximately)
INSERT INTO `transaksi` (`id`, `kode_transaksi`, `nama_pelanggan`, `email`, `telepon`, `alamat`, `catatan`, `total_harga`, `ongkir`, `grand_total`, `status`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
	(1, 'TRX202605070001', 'mas', 'test@gmail.com', '081234567890', 'klk', '', 70000, 15000, 85000, 'pending', NULL, '2026-05-07 12:23:12', NULL),
	(2, 'TRX202605070002', 'mas', 'test@gmail.com', '081234567890', 'klk', '', 57000, 15000, 72000, 'pending', NULL, '2026-05-07 12:46:43', NULL),
	(3, 'TRX202605070003', 'mas', 'test@gmail.com', '081234567890', 'klk', '', 30000, 15000, 45000, 'pending', NULL, '2026-05-07 12:52:46', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.transaksi_detail: ~4 rows (approximately)
INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `product_id`, `tipe_produk`, `nama_produk`, `harga`, `qty`, `subtotal`) VALUES
	(1, 1, 7, 'bibit', 'Bibit Dewata 43 F1', 35000, 2, 70000),
	(2, 2, 1, 'bibit', 'Bibit Cabai Rawit Sigantung', 25000, 1, 25000),
	(3, 2, 2, 'bibit', 'Bibit Shypoon Anti Virus', 32000, 1, 32000),
	(4, 3, 5, 'bibit', 'Bibit Bhaskara BISI', 30000, 1, 30000);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_cabai_lengkap.users: ~13 rows (approximately)
INSERT INTO `users` (`id`, `username`, `nama_lengkap`, `password`, `email`, `foto`, `role`, `last_login`, `is_active`, `created_at`) VALUES
	(2, 'admin', 'Administrator', '0192023a7bbd73250516f069df18b500', 'test@gmail.com', NULL, 'admin', NULL, 1, NULL),
	(3, 'kang', 'mas', '$2y$10$O8MxbZyV2WHjPDujIgqBreuWy3UEHBFgxHt1CBIFZUJlTl/UFz05K', 'mas@gmail.com', NULL, 'staff', '2026-06-15 17:38:27', 1, '2026-05-07 13:14:43'),
	(4, 'Pendragon', 'jody', '$2y$10$nfCrK91HwRFf.kHvEQLsru1dK8VlVOrPij4Ymr7fiWOajfBX5WY2u', 'jodyindrarismantoro@gmail.com', NULL, 'staff', NULL, 1, '2026-06-14 16:26:19'),
	(5, 'Morgan', 'Arthur', '$2y$10$YZmntWMV/dQ8LXStTn4JuOR8e6fhr.vj.eHKmnmfLo2lkXkdXnAEO', 'indrarismantoro@gmail.com', NULL, 'staff', NULL, 1, '2026-06-14 16:31:40'),
	(6, 'Mustang', 'Arthur', '$2y$10$t99RnZ1qMni4CTsvl20.DOO7Xdho.3I50EViuqixhczk/os2sC7.q', 'hdjsjsuejhhuuu@gmail.com', NULL, 'staff', NULL, 1, '2026-06-14 16:42:57'),
	(7, 'Royy', 'Mustang', '$2y$10$KvrUCLSs8ZgK1xsYn5snIOjpUveEmWsBxbR0EyiT0zQ0l4Z19fqbS', 'indra@gmail.com', NULL, 'user', NULL, 1, '2026-06-14 16:45:43'),
	(8, 'ruyy', 'e22', '$2y$10$co8AIE1bdR8UjvjlQAhVteKJcAqLBHeaEoYYcVrzD/iQTS6KpC0qa', 'bagus@gmail.com', NULL, 'staff', NULL, 1, '2026-06-14 16:48:30'),
	(9, 'yeah', 'yaya', '$2y$10$cUlmNYnU/TEbJDuRPj3i/.SgFBn.iqr4f77WcpP2HmLcQMDjD3lou', 'yeah@gmail.com', NULL, 'user', NULL, 1, '2026-06-14 17:13:04'),
	(10, 'eeee', 'eee', '$2y$10$f.jEn2XjdbzdTlVl6/be3ex5w4Ib9U7Y/i/xRkdubXUKSBsAAr.Hm', 'eeee@gmail.com', NULL, 'user', NULL, 1, '2026-06-14 17:32:19'),
	(11, 'aight', 'yes', '$2y$10$eoNST1qCAxrGD/uW7mTCeekiWwJmYcUgiRdSukMxuGyN1laOWKsUS', 'aight@gmail.com', NULL, 'user', NULL, 1, '2026-06-14 18:25:45'),
	(12, 'hooh', 'mamat', '$2y$10$fw7YIgK6jLb3aE8IYYng7.xjtxLwYnYIj8SITN.W0zUe1cgXf/pzi', 'hooh@gmail.com', NULL, 'user', NULL, 1, '2026-06-15 15:48:40'),
	(13, 'test', 'hooh', '$2y$10$UKJfmpwx9pjmwPMNYdFlIuvTc1AZqerq1YOylFEibh6ZED.4eL2Ji', 'yoi@gmail.com', NULL, 'user', NULL, 1, '2026-06-15 15:51:22'),
	(14, 'agus', 'agus', '$2y$10$m8SkXzmv3a96Rt9WddjS3.cJPkQ/vhBEEF3BmAKTxaDt/j3OXKkDO', 'agus@gmail.com', NULL, 'user', NULL, 1, '2026-06-15 16:09:45');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
