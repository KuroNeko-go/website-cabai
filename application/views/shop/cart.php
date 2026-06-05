<!-- =============================================
     PAGE HEADER / BANNER ATAS
     ============================================= -->
<section class="page-header">
    <div class="container">
        <h1>🛒 Keranjang Belanja Anda</h1>
        <p>Periksa kembali produk pilihan Anda sebelum melanjutkan ke proses pembayaran.</p>
    </div>
</section>

<!-- =============================================
     HALAMAN KERANJANG BELANJA
     ============================================= -->
<section class="cart-section" style="background: var(--light); padding: 5rem 0; min-height: 60vh;">
    <div class="container">

        <!-- Cek Apakah Keranjang Ada Isinya -->
        <?php if($this->cart->total_items() > 0): ?>
            
            <div style="background: var(--white); padding: 2rem; border-radius: 20px; box-shadow: var(--shadow-md); overflow-x: auto;">
                <!-- Tabel Kustom Minimalis -->
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--gray-light); color: var(--gray-dark); font-weight: 700;">
                            <th style="padding: 1rem 0.5rem; width: 100px;">Produk</th>
                            <th style="padding: 1rem 0.5rem;">Nama Barang</th>
                            <th style="padding: 1rem 0.5rem;">Harga</th>
                            <th style="padding: 1rem 0.5rem; width: 120px;">Jumlah</th>
                            <th style="padding: 1rem 0.5rem;">Subtotal</th>
                            <th style="padding: 1rem 0.5rem; text-align: center; width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($this->cart->contents() as $items): 
                        ?>
                            <tr style="border-bottom: 1px solid var(--gray-light); vertical-align: middle;">
                                <!-- Gambar Produk -->
                                <td style="padding: 1rem 0.5rem;">
                                    <?php 
                                    // Cek tipe produk untuk menentukan folder gambar
                                    $folder = (isset($items['options']['type']) && $items['options']['type'] == 'cabai') ? 'cabai' : 'bibit';
                                    $gambar = (!empty($items['options']['gambar'])) ? $items['options']['gambar'] : 'default-150x150.png';
                                    ?>
                                    <img src="<?= base_url('uploads/'.$folder.'/'.$gambar) ?>" style="width: 70px; height: 70px; object-fit: contain; background: var(--light); border-radius: 10px;" alt="<?= $items['name'] ?>">
                                </td>
                                
                                <!-- Nama Produk -->
                                <td style="padding: 1rem 0.5rem; font-weight: 600; color: var(--dark);">
                                    <?= $items['name'] ?>
                                </td>
                                
                                <!-- Harga Satuan -->
                                <td style="padding: 1rem 0.5rem; color: var(--gray-dark);">
                                    Rp <?= number_format($items['price'], 0, ',', '.') ?>
                                </td>
                                
                                <!-- Jumlah / Quantity -->
                                <td style="padding: 1rem 0.5rem;">
                                    <form action="<?= base_url('cart/update') ?>" method="post" style="margin:0; display: flex; gap: 0.25rem;">
                                        <input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
                                        <input type="number" name="qty" value="<?= $items['qty'] ?>" min="1" style="width: 60px; padding: 0.3rem; border: 1px solid var(--gray); border-radius: 5px; text-align: center;">
                                        <button type="submit" class="btn btn-primary" style="padding: 0.3rem 0.6rem; border-radius: 5px; font-size: 0.75rem;" title="Update Jumlah">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                
                                <!-- Subtotal per Item -->
                                <td style="padding: 1rem 0.5rem; font-weight: 700; color: var(--primary);">
                                    Rp <?= number_format($items['subtotal'], 0, ',', '.') ?>
                                </td>
                                
                                <!-- Tombol Hapus Item -->
                                <td style="padding: 1rem 0.5rem; text-align: center;">
                                    <a href="<?= base_url('cart/remove/'.$items['rowid']) ?>" class="btn" style="background: #dc3545; color: var(--white); padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;" onclick="return confirm('Hapus item ini dari keranjang?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                        $i++;
                        endforeach; 
                        ?>
                        
                        <!-- Baris Total Harga Keseluruhan -->
                        <tr style="font-size: 1.2rem; font-weight: 700;">
                            <td colspan="4" style="padding: 2rem 0.5rem 1rem; text-align: right; color: var(--gray-dark);">Total Belanja :</td>
                            <td colspan="2" style="padding: 2rem 0.5rem 1rem; color: var(--primary); font-size: 1.4rem;">
                                Rp <?= number_format($this->cart->total(), 0, ',', '.') ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Navigasi Tombol di Bawah Tabel -->
                <div style="display: flex; justify-content: space-between; margin-top: 2rem; flex-wrap: wrap; gap: 1rem;">
                    <a href="<?= base_url() ?>" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Lanjut Belanja
                    </a>
                    <div style="display: flex; gap: 1rem;">
                        <a href="<?= base_url('cart/clear') ?>" class="btn" style="background: var(--gray-light); color: var(--dark);" onclick="return confirm('Kosongkan seluruh isi keranjang?')">
                            <i class="fas fa-eraser"></i> Kosongkan Keranjang
                        </a>
                        <a href="<?= base_url('shop/checkout') ?>" class="btn btn-primary">
                            Proses Checkout <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Jika Keranjang Belanja Kosong -->
            <div style="text-align: center; padding: 5rem 0; background: var(--white); border-radius: 20px; box-shadow: var(--shadow-sm);">
                <i class="fas fa-shopping-basket" style="font-size: 4rem; margin-bottom: 1.5rem; color: var(--gray); opacity: 0.4;"></i>
                <h3 style="margin-bottom: 0.5rem;">Keranjang Belanja Anda Kosong</h3>
                <p style="color: var(--gray); margin-bottom: 2rem;">Anda belum menambahkan bibit atau cabai unggulan ke dalam keranjang.</p>
                <a href="<?= base_url() ?>" class="btn btn-primary">
                    <i class="fas fa-seedling"></i> Cari Produk Sekarang
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>