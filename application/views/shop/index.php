<!-- BANNER ATAS HORTIKULTURA BIBIT -->
<section class="shop-banner">
    <div class="container">
        <h1 class="shop-banner-title">
            🌱 Benih & Bibit Tanaman Unggul
        </h1>
        <p class="shop-banner-text">
            Sedia berbagai macam bibit tanaman hortikultura berkualitas tinggi, adaptif, dan siap tanam untuk hasil panen maksimal.
        </p>
    </div>
</section>

<!-- GRID PRODUK BIBIT -->
<section class="products-section">
    <div class="container">
        
        <?php if (!empty($bibits)): ?>
            <div class="products-grid">
                <?php foreach ($bibits as $b): ?>
                    <?php 
                        // Deteksi nama kolom SQL data produk bibit lu
                        $nama_produk = '';
                        if (isset($b['nama_bibit'])) {
                            $nama_produk = $b['nama_bibit'];
                        } elseif (isset($b['nama_varietas'])) {
                            $nama_produk = $b['nama_varietas'];
                        } elseif (isset($b['nama'])) {
                            $nama_produk = $b['nama'];
                        } else {
                            $nama_produk = 'Bibit Unggul Duaputra';
                        }
                    ?>
                    <div class="product-card">
                        
                        <!-- Gambar Produk Bibit -->
                        <div class="product-image-container">
                            <?php if (!empty($b['gambar'])): ?>
                                <img src="<?= base_url($b['gambar']) ?>" alt="<?= $nama_produk ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div class="product-image-placeholder">
                                    <i class="fas fa-seedling"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Konten Info Produk -->
                        <div class="product-info">
                            <span class="product-category">
                                Varietas Unggul
                            </span>
                            <h3 class="product-title">
                                <?= $nama_produk ?>
                            </h3>
                            <p class="product-description">
                                <?= !empty($b['deskripsi']) ? (strlen($b['deskripsi']) > 90 ? substr($b['deskripsi'], 0, 90) . '...' : $b['deskripsi']) : 'Bibit tanaman pilihan dengan persentase tumbuh tinggi, perakaran kuat, dan bebas penyakit.' ?>
                            </p>
                            
                            <!-- Bagian Bawah Card (Harga & Tombol) -->
                            <div class="product-footer">
                                <div>
                                    <span class="product-price-label">Harga Bibit</span>
                                    <span class="product-price">
                                        Rp <?= isset($b['harga']) ? number_format($b['harga'], 0, ',', '.') : '0' ?>
                                    </span>
                                </div>
                                <a href="<?= base_url('bibit/detail/' . $b['id']) ?>" class="product-btn">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="no-products">
                <div class="no-products-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <h3 class="no-products-title">Stok Bibit Belum Tersedia</h3>
                <p class="no-products-text">
                    Sistem terhubung, namun array data bibit kosong dari database.
                </p>
            </div>
        <?php endif; ?>

    </div>
</section>