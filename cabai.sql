ALTER TABLE `transaksi_detail`
CHANGE COLUMN `bibit_id` `product_id` INT(11) NOT NULL,
ADD COLUMN `tipe_produk` ENUM('cabai','bibit') NOT NULL DEFAULT 'bibit' AFTER `product_id`;