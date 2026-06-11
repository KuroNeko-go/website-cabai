<!-- BANNER ATAS HORTIKULTURA -->
<section style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); padding: 5rem 0 3rem 0; text-align: center;">
    <div class="container">
        <h1 style="font-weight: 800; color: #2d6a4f; font-size: 2.5rem; margin-bottom: 0.5rem;">
            🌶️ Koleksi Varietas Cabai Unggulan
        </h1>
        <p style="color: #4a5b4e; font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
            Temukan berbagai pilihan hasil cabai premium dan benih berkualitas tinggi langsung dari petani binaan Duaputra.
        </p>
    </div>
</section>

<!-- GRID PRODUK CABAI -->
<section style="padding: 5rem 0; background: #f5f7fa;">
    <div class="container">

        <?php if (!empty($cabais)): ?>
            <div class="product-grid">
                <?php foreach ($cabais as $index => $c): ?>
                    <div class="product-card card-item-<?= ($index % 10) + 1 ?>">

                        <!-- Badge & Wishlist -->
                        <div class="product-badge">Cabai Unggulan</div>
                        <div class="product-wishlist">♥</div>

                        <!-- Gambar Produk -->
                        <div class="product-image">
                            <?php if (!empty($c['gambar'])): ?>
                                <img src="<?= base_url($c['gambar']) ?>" alt="<?= $c['nama_varietas'] ?>">
                            <?php else: ?>
                                <div class="product-image-placeholder">
                                    <i class="fas fa-pepper-hot"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Konten -->
                        <div class="product-content">
                            <p class="product-category">
                                <?= !empty($c['nama_latin']) ? $c['nama_latin'] : 'Capsicum Annuum' ?>
                            </p>
                            <h3 class="product-title"><?= $c['nama_varietas'] ?></h3>
                            <p class="product-desc">
                                <?= !empty($c['deskripsi']) ? (strlen($c['deskripsi']) > 80 ? substr($c['deskripsi'], 0, 80) . '...' : $c['deskripsi']) : 'Benih cabai unggulan dengan daya tahan tinggi terhadap penyakit dan adaptif di segala cuaca.' ?>
                            </p>
                            <div class="product-price">
                                <span class="price-current">
                                    Rp <?= isset($c['harga']) ? number_format($c['harga'], 0, ',', '.') : '0' ?>
                                </span>
                            </div>
                            <a href="<?= base_url('cabai/detail/' . $c['id']) ?>" class="product-btn">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="product-empty">
                <div class="product-empty-icon">
                    <i class="fas fa-pepper-hot"></i>
                </div>
                <h3>Stok Cabai Belum Tersedia</h3>
                <p>Sistem terhubung, namun tidak mendeteksi baris data di dalam tabel 'cabais'.</p>
            </div>
        <?php endif; ?>

    </div>
</section>