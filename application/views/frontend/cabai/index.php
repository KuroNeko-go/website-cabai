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

<section style="padding: 5rem 0; background: #f5f7fa;">
    <div class="container">

        <?php if (!empty($cabais)): ?>
            <div class="row">
                <?php foreach ($cabais as $index => $c): ?>
                    
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        
                        <div class="card h-100 card<?= ($index % 10) + 1 ?> <?= (isset($c['stok']) && $c['stok'] <= 0) ? 'card-habis' : '' ?>" style="position: relative;">

                            <?php if(isset($c['stok']) && $c['stok'] <= 0): ?>
                                <div class="overlay-habis">STOK HABIS</div>
                            <?php endif; ?>

                            <div class="card-badge">Cabai Unggulan</div>
                            <div class="card-wishlist">♥</div>

                            <?php if (!empty($c['gambar'])): ?>
                                <div class="card-image" style="background-image: url('<?= base_url($c['gambar']) ?>');"></div>
                            <?php else: ?>
                                <div class="card-image d-flex align-items-center justify-content-center" style="background-color: #ddd;">
                                    <i class="fas fa-pepper-hot" style="font-size: 3rem; color: #aaa;"></i>
                                </div>
                            <?php endif; ?>

                            <div class="card-content d-flex flex-column h-100">
                                <p class="card-category">
                                    <?= !empty($c['nama_latin']) ? $c['nama_latin'] : 'Capsicum Annuum' ?>
                                </p>
                                <h2 class="card-title" style="font-size: 1.2rem;"><?= $c['nama_varietas'] ?></h2>
                                
                                <p style="font-size: 0.85rem; color: #7f8c8d; margin-bottom: 15px;">
                                    <?= !empty($c['deskripsi']) ? (strlen($c['deskripsi']) > 80 ? substr($c['deskripsi'], 0, 80) . '...' : $c['deskripsi']) : 'Benih cabai unggulan dengan daya tahan tinggi terhadap penyakit dan adaptif di segala cuaca.' ?>
                                </p>

                                <div class="card-rating">★★★★★ <span>(4.9)</span></div>
                                
                                <div class="card-price mt-auto">
                                    <span style="font-size: 1.2rem;">Rp <?= isset($c['harga']) ? number_format($c['harga'], 0, ',', '.') : '0' ?></span>
                                </div>
                                
                                <a href="<?= base_url('cabai/detail/' . $c['id']) ?>" class="card-btn w-100 text-center" style="display:block; padding:10px;">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="product-empty text-center" style="padding: 3rem 0;">
                <div class="product-empty-icon" style="font-size: 4rem; color: #e74c3c; margin-bottom: 1rem;">
                    <i class="fas fa-pepper-hot"></i>
                </div>
                <h3>Stok Cabai Belum Tersedia</h3>
                <p>Sistem terhubung, namun tidak mendeteksi baris data di dalam tabel 'cabais'.</p>
            </div>
        <?php endif; ?>

    </div>
</section>