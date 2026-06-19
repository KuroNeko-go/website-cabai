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

<section style="padding: 5rem 0; background: #f5f7fa;">
    <div class="container">

        <?php if (!empty($bibits)): ?>
            <div class="row">
                <?php foreach ($bibits as $index => $b): ?>
                    <?php
                        $nama_produk = '';
                        if (isset($b['nama_bibit']))          $nama_produk = $b['nama_bibit'];
                        elseif (isset($b['nama_varietas']))   $nama_produk = $b['nama_varietas'];
                        elseif (isset($b['nama']))            $nama_produk = $b['nama'];
                        else                                  $nama_produk = 'Bibit Unggul Duaputra';
                    ?>
                    
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        
                        <div class="card h-100 card<?= ($index % 10) + 1 ?>">

                            <div class="card-badge">Varietas Unggul</div>
                            <div class="card-wishlist">♥</div>

                            <?php if (!empty($b['gambar'])): ?>
                                <div class="card-image" style="background-image: url('<?= base_url($b['gambar']) ?>');"></div>
                            <?php else: ?>
                                <div class="card-image d-flex align-items-center justify-content-center" style="background-color: #ddd;">
                                    <i class="fas fa-seedling" style="font-size: 3rem; color: #aaa;"></i>
                                </div>
                            <?php endif; ?>

                            <div class="card-content d-flex flex-column h-100">
                                <p class="card-category">Bibit Hortikultura</p>
                                <h2 class="card-title" style="font-size: 1.2rem;"><?= $nama_produk ?></h2>
                                <div class="card-rating">★★★★★ <span>(4.8)</span></div>
                                
                                <div class="card-price mt-auto">
                                    Rp <?= isset($b['harga']) ? number_format($b['harga'], 0, ',', '.') : '0' ?>
                                </div>
                                
                                <a href="<?= base_url('bibit/detail/' . $b['id']) ?>" class="card-btn w-100 text-center" style="display:block; padding:10px;">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="product-empty text-center" style="padding: 3rem 0;">
                <div class="product-empty-icon" style="font-size: 4rem; color: #28a745; margin-bottom: 1rem;">
                    <i class="fas fa-seedling"></i>
                </div>
                <h3>Stok Bibit Belum Tersedia</h3>
                <p>Sistem terhubung, namun array data bibit kosong dari database.</p>
            </div>
        <?php endif; ?>

    </div>
</section>