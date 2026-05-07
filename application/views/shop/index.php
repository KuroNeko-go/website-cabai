<section class="hero" style="min-height: 40vh; padding: 120px 0 60px;">
    <div class="container">
        <div class="hero-content" style="grid-template-columns: 1fr;">
            <div class="hero-text" style="text-align: center;">
                <h1>🛒 Toko Bibit Cabai Nusantara</h1>
                <p>Dapatkan bibit unggul berkualitas dengan harga terbaik</p>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="products-grid">
        <?php foreach ($bibits as $bibit): ?>
        <div class="product-card">
            <a href="<?= base_url('/bibit/detail/' . $bibit['id']) ?>" style="text-decoration: none; color: inherit;">
                <div class="product-image">
                    <?php if ($bibit['gambar'] && file_exists('./' . $bibit['gambar'])): ?>
                        <img src="<?= base_url($bibit['gambar']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <i class="fas fa-seedling"></i>
                    <?php endif; ?>
                    <?php if ($bibit['is_new']): ?>
                        <span style="position: absolute; top: 10px; left: 10px; background: #dc3545; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px;">NEW</span>
                    <?php endif; ?>
                    <?php if ($bibit['is_popular']): ?>
                        <span style="position: absolute; top: 10px; right: 10px; background: #ff9800; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px;">🔥 POPULER</span>
                    <?php endif; ?>
                </div>
                <div class="product-info">
                    <div class="product-title"><?= $bibit['nama_produk'] ?></div>
                    <div class="product-price">
                        Rp <?= number_format($bibit['harga_diskon'] ?: $bibit['harga'], 0, ',', '.') ?>
                        <?php if ($bibit['harga_diskon']): ?>
                            <small>Rp <?= number_format($bibit['harga'], 0, ',', '.') ?></small>
                        <?php endif; ?>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                        <small>📦 Stok: <?= $bibit['stok'] ?></small>
                        <small>🌶️ <?= $bibit['nama_varietas'] ?></small>
                    </div>
                </div>
            </a>
            <button class="add-to-cart" data-id="<?= $bibit['id'] ?>" data-name="<?= $bibit['nama_produk'] ?>" data-price="<?= $bibit['harga_diskon'] ?: $bibit['harga'] ?>" style="width: calc(100% - 40px); margin: 0 20px 20px; padding: 12px; background: #2d7a24; color: white; border: none; border-radius: 40px; font-weight: 600; cursor: pointer;">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        let id = this.dataset.id;
        let name = this.dataset.name;
        let price = parseInt(this.dataset.price);
        
        fetch('<?= base_url("cart/add") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + id + '&qty=1'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('✅ ' + name + ' ditambahkan ke keranjang!');
                updateCartCount();
            } else {
                alert('❌ ' + data.message);
            }
        });
    });
});
</script>