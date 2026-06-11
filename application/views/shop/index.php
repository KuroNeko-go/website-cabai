<!-- BANNER ATAS HORTIKULTURA BIBIT -->
<section style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); padding: 5rem 0 3rem 0; text-align: center;">
    <div class="container">
        <h1 style="font-weight: 800; color: #2d6a4f; font-size: 2.5rem; margin-bottom: 0.5rem;">
            🌱 Benih & Bibit Tanaman Unggul
        </h1>
        <p style="color: #4a5b4e; font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
            Sedia berbagai macam bibit tanaman hortikultura berkualitas tinggi, adaptif, dan siap tanam untuk hasil panen maksimal.
        </p>
    </div>
</section>

<!-- GRID PRODUK BIBIT -->
<section style="padding: 5rem 0; background: #f5f7fa;">
    <div class="container">

        <?php if (!empty($bibits)): ?>
            <div class="product-grid">
                <?php foreach ($bibits as $index => $b): ?>
                    <?php
                        $nama_produk = '';
                        if (isset($b['nama_bibit']))          $nama_produk = $b['nama_bibit'];
                        elseif (isset($b['nama_varietas']))   $nama_produk = $b['nama_varietas'];
                        elseif (isset($b['nama']))            $nama_produk = $b['nama'];
                        else                                  $nama_produk = 'Bibit Unggul Duaputra';
                    ?>
                    <div class="product-card card-item-<?= ($index % 10) + 1 ?>">

                        <!-- Badge & Wishlist -->
                        <div class="product-badge">Varietas Unggul</div>
                        <div class="product-wishlist">♥</div>

                        <!-- Gambar Produk -->
                        <div class="product-image">
                            <?php if (!empty($b['gambar'])): ?>
                                <img src="<?= base_url($b['gambar']) ?>" alt="<?= $nama_produk ?>">
                            <?php else: ?>
                                <div class="product-image-placeholder">
                                    <i class="fas fa-seedling"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Konten -->
                        <div class="product-content">
                            <p class="product-category">Bibit Hortikultura</p>
                            <h3 class="product-title"><?= $nama_produk ?></h3>
                            <p class="product-desc">
                                <?= !empty($b['deskripsi']) ? (strlen($b['deskripsi']) > 80 ? substr($b['deskripsi'], 0, 80) . '...' : $b['deskripsi']) : 'Bibit tanaman pilihan dengan persentase tumbuh tinggi, perakaran kuat, dan bebas penyakit.' ?>
                            </p>
                            <div class="product-price">
                                <span class="price-current">
                                    Rp <?= isset($b['harga']) ? number_format($b['harga'], 0, ',', '.') : '0' ?>
                                </span>
                            </div>
                            <a href="<?= base_url('bibit/detail/' . $b['id']) ?>" class="product-btn">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="product-empty">
                <div class="product-empty-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <h3>Stok Bibit Belum Tersedia</h3>
                <p>Sistem terhubung, namun array data bibit kosong dari database.</p>
            </div>
        <?php endif; ?>

    </div>
</section>