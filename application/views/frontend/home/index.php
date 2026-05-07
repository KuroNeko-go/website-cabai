<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <h1>Bibit Cabai Unggul Untuk Kebun Produktif</h1>
                <p>Jelajahi 8+ varietas cabai lokal Jawa yang telah terbukti ketahanan dan produktivitasnya. Dapatkan bibit berkualitas langsung dari sumbernya.</p>
                <div class="hero-buttons">
                    <a href="<?= base_url('/cabai') ?>" class="btn-primary">Lihat Varietas <i class="fas fa-arrow-right"></i></a>
                    <a href="<?= base_url('/bibit') ?>" class="btn-outline">Belanja Sekarang</a>
                </div>
            </div>
            <div class="hero-image" data-aos="fade-left">
                <img src="https://cdn-icons-png.flaticon.com/512/1065/1065830.png" alt="Cabai">
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- Varietas Unggulan -->
    <div class="section-header" data-aos="fade-up">
        <h2>🌶️ Varietas Unggulan</h2>
        <p>Pilihan terbaik untuk kebun produktif Anda</p>
    </div>
    
    <div class="products-grid" data-aos="fade-up">
        <?php foreach ($featured_cabais as $cabai): ?>
        <a href="<?= base_url('/cabai/detail/' . $cabai['id']) ?>" class="product-card">
            <div class="product-image">
                <i class="fas fa-pepper-hot"></i>
            </div>
            <div class="product-info">
                <div class="product-title"><?= $cabai['nama_varietas'] ?></div>
                <div class="product-price"><?= $cabai['tingkat_pedas'] ?></div>
                <small>🌾 Panen: <?= $cabai['umur_panen'] ?> HST</small>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Produk Populer -->
    <div class="section-header" data-aos="fade-up" style="margin-top: 60px;">
        <h2>🔥 Produk Populer</h2>
        <p>Bibit paling laris di musim ini</p>
    </div>
    
    <div class="products-grid" data-aos="fade-up">
        <?php foreach ($popular_bibits as $bibit): ?>
        <a href="<?= base_url('/bibit/detail/' . $bibit['id']) ?>" class="product-card">
            <div class="product-image">
                <i class="fas fa-seedling"></i>
            </div>
            <div class="product-info">
                <div class="product-title"><?= $bibit['nama_produk'] ?></div>
                <div class="product-price">
                    Rp <?= number_format($bibit['harga_diskon'] ?: $bibit['harga'], 0, ',', '.') ?>
                    <?php if ($bibit['harga_diskon']): ?>
                        <small>Rp <?= number_format($bibit['harga'], 0, ',', '.') ?></small>
                    <?php endif; ?>
                </div>
                <small>💚 <?= $bibit['nama_produk'] ?></small>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Stats Section -->
<div class="container">
    <div class="stats-section" data-aos="zoom-in">
        <div class="stats-grid">
            <div>
                <div class="stat-number">8+</div>
                <p>Varietas Cabai</p>
            </div>
            <div>
                <div class="stat-number">100</div>
                <p>Pelanggan Puas</p>
            </div>
            <div>
                <div class="stat-number">24/7</div>
                <p>Konsultasi</p>
            </div>
            <div>
                <div class="stat-number">100%</div>
                <p>Bibit Berkualitas</p>
            </div>
        </div>
    </div>
</div>