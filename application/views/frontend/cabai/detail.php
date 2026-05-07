<div class="container" style="padding-top: 120px; padding-bottom: 60px;">
    <nav style="margin-bottom: 30px;">
        <a href="<?= base_url('/cabai') ?>" style="color: #2d7a24; text-decoration: none;">← Kembali ke Daftar Cabai</a>
    </nav>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px;">
        <div>
            <div class="product-image" style="background: #f8faf7; border-radius: 24px; padding: 40px; text-align: center;">
                <?php if ($cabai['gambar'] && file_exists('./' . $cabai['gambar'])): ?>
                    <img src="<?= base_url($cabai['gambar']) ?>" style="max-width: 100%; border-radius: 16px;">
                <?php else: ?>
                    <i class="fas fa-pepper-hot" style="font-size: 120px; color: #dc3545;"></i>
                <?php endif; ?>
            </div>
        </div>
        
        <div>
            <h1 style="font-size: 42px; font-weight: 800; margin-bottom: 10px;"><?= $cabai['nama_varietas'] ?></h1>
            <p style="color: #6c757d; margin-bottom: 20px;"><em><?= $cabai['nama_latin'] ?></em></p>
            
            <div style="margin-bottom: 20px;">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="fas fa-fire" style="color: <?= $i <= $cabai['skala_pedas'] ? '#dc3545' : '#ddd' ?>"></i>
                <?php endfor; ?>
                <span style="margin-left: 10px;"><?= $cabai['tingkat_pedas'] ?></span>
            </div>
            
            <div style="margin-bottom: 30px;">
                <div style="display: inline-block; background: #e8f5e9; padding: 5px 15px; border-radius: 20px; margin-right: 10px;">
                    🌾 Umur Panen: <?= $cabai['umur_panen'] ?> HST
                </div>
                <div style="display: inline-block; background: #e8f5e9; padding: 5px 15px; border-radius: 20px;">
                    📍 <?= $cabai['cocok_ditanam'] ?>
                </div>
            </div>
            
            <div style="margin-bottom: 30px;">
                <h3>Keunggulan</h3>
                <p><?= $cabai['keunggulan'] ?></p>
            </div>
            
            <div style="margin-bottom: 30px;">
                <h3>Deskripsi</h3>
                <p><?= nl2br($cabai['deskripsi']) ?></p>
            </div>
        </div>
    </div>
    
    <?php if (!empty($bibits)): ?>
    <hr style="margin: 50px 0;">
    
    <h2 style="margin-bottom: 30px;">🌱 Bibit <?= $cabai['nama_varietas'] ?></h2>
    <div class="products-grid">
        <?php foreach ($bibits as $bibit): ?>
        <a href="<?= base_url('/bibit/detail/' . $bibit['id']) ?>" class="product-card" style="text-decoration: none; color: inherit;">
            <div class="product-image">
                <i class="fas fa-seedling"></i>
            </div>
            <div class="product-info">
                <div class="product-title"><?= $bibit['nama_produk'] ?></div>
                <div class="product-price">Rp <?= number_format($bibit['harga'], 0, ',', '.') ?></div>
                <small>📦 Stok: <?= $bibit['stok'] ?> pak</small>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>