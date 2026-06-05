<!-- =============================================
     PAGE HEADER / BANNER ATAS
     ============================================= -->
<section class="page-header">
    <div class="container">
        <h1>📋 Formulir Checkout Pesanan</h1>
        <p>Silakan isi data pengiriman Anda dengan lengkap untuk menyelesaikan pemesanan bibit.</p>
    </div>
</section>

<!-- =============================================
     HALAMAN CHECKOUT PESANAN
     ============================================= -->
<section class="checkout-section" style="background: var(--light); padding: 5rem 0;">
    <div class="container">

        <!-- Form Utama Checkout kirim data ke controller Transaksi -->
        <form action="<?= base_url('shop/proses_checkout') ?>" method="post">
            
            <!-- Menggunakan Grid Flexbox Responsif untuk membagi 2 kolom -->
            <div style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-start;">
                
                <!-- KOLOM KIRI: FORM DATA PENGIRIMAN (65%) -->
                <div style="flex: 2; min-width: 300px; background: var(--white); padding: 2rem; border-radius: 20px; box-shadow: var(--shadow-md);">
                    <h3 style="margin-bottom: 1.5rem; color: var(--primary); border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">
                        <i class="fas fa-truck"></i> Informasi Pengiriman
                    </h3>
                    
                    <!-- Input Nama Lengkap -->
                    <div style="margin-bottom: 1.25rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--dark);">Nama Lengkap Penerima</label>
                        <input type="text" name="nama" required placeholder="Masukkan nama lengkap Anda" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--gray); border-radius: 10px; background: var(--light); color: var(--dark);">
                    </div>

                    <!-- Input Nomor Telepon/WhatsApp -->
                    <div style="margin-bottom: 1.25rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--dark);">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="telepon" required placeholder="Contoh: 081234567890" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--gray); border-radius: 10px; background: var(--light); color: var(--dark);">
                    </div>

                    <!-- Input Alamat Lengkap -->
                    <div style="margin-bottom: 1.25rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--dark);">Alamat Rumah Lengkap</label>
                        <textarea name="alamat" required rows="4" placeholder="Tuliskan alamat lengkap beserta nama jalan, nomor rumah, RT/RW, Kecamatan, dan Kabupaten" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--gray); border-radius: 10px; background: var(--light); color: var(--dark); resize: none;"></textarea>
                    </div>

                    <!-- Input Catatan Tambahan (Opsional) -->
                    <div style="margin-bottom: 1.25rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--gray-dark);">Catatan Tambahan (Opsional)</label>
                        <input type="text" name="catatan" placeholder="Contoh: Titipkan ke tetangga jika rumah kosong" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--gray); border-radius: 10px; background: var(--light); color: var(--dark);">
                    </div>
                </div>

                <!-- KOLOM KANAN: RINGKASAN BELANJA (35%) -->
                <div style="flex: 1; min-width: 300px; background: var(--white); padding: 2rem; border-radius: 20px; box-shadow: var(--shadow-md); position: sticky; top: 100px;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--primary); border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">
                        <i class="fas fa-shopping-bag"></i> Ringkasan Order
                    </h3>
                    
                    <!-- Loop Daftar Item yang Dibeli -->
                    <div style="max-height: 250px; overflow-y: auto; margin-bottom: 1.5rem; padding-right: 0.5rem;">
                        <?php foreach ($this->cart->contents() as $items): ?>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--gray-light);">
                                <div>
                                    <div style="font-weight: 600; color: var(--dark); font-size: 0.95rem;"><?= $items['name'] ?></div>
                                    <div style="font-size: 0.8rem; color: var(--gray);"><?= $items['qty'] ?>x @ Rp <?= number_format($items['price'], 0, ',', '.') ?></div>
                                </div>
                                <div style="font-weight: 700; color: var(--primary-light); font-size: 0.95rem;">
                                    Rp <?= number_format($items['subtotal'], 0, ',', '.') ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Total Pembayaran -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-top: 0.5rem;">
                        <span style="font-weight: 700; color: var(--dark); font-size: 1.1rem;">Total Bayar:</span>
                        <span style="font-weight: 800; color: var(--primary); font-size: 1.4rem;">
                            Rp <?= number_format($this->cart->total(), 0, ',', '.') ?>
                        </span>
                    </div>

                    <!-- Metode Pembayaran Info Resmi -->
                    <div style="background: var(--light); padding: 1rem; border-radius: 10px; font-size: 0.8rem; color: var(--gray-dark); margin-bottom: 2rem; border-left: 4px solid var(--secondary);">
                        <p style="margin: 0 0 0.5rem 0; font-weight: bold; color: var(--dark);"><i class="fas fa-info-circle"></i> Metode Pembayaran:</p>
                        Transfer Bank Mandiri / BRI / COD (Bayar di Tempat) setelah dikonfirmasi oleh Admin Duaputra via WhatsApp.
                    </div>

                    <!-- Tombol Eksekusi Submit Pesanan -->
                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1rem; font-size: 1rem; border-radius: 10px;">
                        <i class="fas fa-check-circle"></i> Selesaikan Pemesanan
                    </button>
                    
                    <a href="<?= base_url('cart') ?>" class="btn btn-outline" style="width: 100%; justify-content: center; margin-top: 0.75rem; padding: 0.75rem; font-size: 0.85rem; border-radius: 10px;">
                        <i class="fas fa-chevron-left"></i> Kembali ke Keranjang
                    </a>
                </div>

            </div>

        </form>

    </div>
</section>