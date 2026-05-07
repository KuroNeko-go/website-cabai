<section class="hero" style="min-height: 40vh; padding: 120px 0 60px;">
    <div class="container">
        <div class="hero-content" style="grid-template-columns: 1fr;">
            <div class="hero-text" style="text-align: center;">
                <h1>🌶️ Koleksi Varietas Cabai Nusantara</h1>
                <p>Jelajahi 8+ varietas cabai lokal unggul dengan karakteristik uniknya</p>
                <div style="max-width: 400px; margin: 30px auto 0;">
                    <div style="display: flex; gap: 10px;">
                        <input type="text" id="searchInput" class="search-input" placeholder="Cari varietas cabai..." style="flex: 1; padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 40px; font-family: inherit;">
                        <button id="searchBtn" class="btn-primary" style="padding: 12px 24px;">Cari</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="products-grid" id="cabaiGrid">
        <?php foreach ($cabais as $cabai): ?>
        <div class="product-card cabai-item" data-name="<?= strtolower($cabai['nama_varietas']) ?>">
            <a href="<?= base_url('/cabai/detail/' . $cabai['id']) ?>" style="text-decoration: none; color: inherit;">
                <div class="product-image">
                    <?php if ($cabai['gambar'] && file_exists('./' . $cabai['gambar'])): ?>
                        <img src="<?= base_url($cabai['gambar']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <i class="fas fa-pepper-hot"></i>
                    <?php endif; ?>
                </div>
                <div class="product-info">
                    <div class="product-title"><?= $cabai['nama_varietas'] ?></div>
                    <div class="product-price"><?= $cabai['tingkat_pedas'] ?></div>
                    <small>🌾 <?= $cabai['umur_panen'] ?> HST | 📍 <?= $cabai['cocok_ditanam'] ?></small>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.getElementById('searchBtn').addEventListener('click', function() {
    let searchValue = document.getElementById('searchInput').value.toLowerCase();
    let items = document.querySelectorAll('.cabai-item');
    
    items.forEach(item => {
        let name = item.getAttribute('data-name');
        if (name.includes(searchValue)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});

document.getElementById('searchInput').addEventListener('keyup', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('searchBtn').click();
    }
});
</script>