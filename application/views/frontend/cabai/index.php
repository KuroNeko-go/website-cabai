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
<section style="padding: 5rem 0; background: #ffffff;">
    <div class="container">
        
        <?php if (!empty($cabais)): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
                <?php foreach ($cabais as $c): ?>
                    <div style="background: #ffffff; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e9ecef; overflow: hidden; transition: transform 0.3s ease; display: flex; flex-direction: column;">
                        
                        <!-- Gambar Produk Cabai -->
                        <div style="height: 200px; background: #f8f9fa; position: relative; overflow: hidden;">
                            <?php if (!empty($c['gambar'])): ?>
                                <img src="<?= base_url($c['gambar']) ?>" alt="<?= $c['nama_varietas'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #6c757d; font-size: 3rem;">
                                    <i class="fas fa-pepper-hot"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Konten Info Produk -->
                        <div style="padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; gap: 0.5rem;">
                            <span style="font-size: 0.75rem; color: #ff9f1c; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
                                <?= !empty($c['nama_latin']) ? $c['nama_latin'] : 'Capsicum Annuum' ?>
                            </span>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a2c1e; margin: 0;">
                                <?= $c['nama_varietas'] ?>
                            </h3>
                            <p style="color: #6c757d; font-size: 0.85rem; line-height: 1.5; margin: 0 0 1rem 0;">
                                <?= !empty($c['deskripsi']) ? (strlen($c['deskripsi']) > 90 ? substr($c['deskripsi'], 0, 90) . '...' : $c['deskripsi']) : 'Benih cabai unggulan dengan daya tahan tinggi terhadap penyakit dan adaptif di segala cuaca.' ?>
                            </p>
                            
                            <!-- Bagian Bawah Card (Harga & Tombol) -->
                            <div style="margin-top: auto; display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid #e9ecef;">
                                <div>
                                    <span style="display: block; font-size: 0.75rem; color: #6c757d;">Harga Paket</span>
                                    <span style="font-size: 1.15rem; font-weight: 800; color: #2d6a4f;">
                                        Rp <?= isset($c['harga']) ? number_format($c['harga'], 0, ',', '.') : '0' ?>
                                    </span>
                                </div>
                                <a href="<?= base_url('cabai/detail/' . $c['id']) ?>" class="btn btn-primary" style="padding: 0.5rem 1.25rem !important; border-radius: 10px !important; font-size: 0.8rem !important; background-color: #2d6a4f !important; color: white !important;">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div style="text-align: center; padding: 5rem 0;">
                <div style="font-size: 4rem; color: #6c757d; margin-bottom: 1.5rem;">
                    <i class="fas fa-pepper-hot" style="opacity: 0.3;"></i>
                </div>
                <h3 style="font-weight: 700; color: #4a5b4e;">Stok Cabai Belum Tersedia</h3>
                <p style="color: #6c757d; max-width: 500px; margin: 0 auto 1.5rem;">
                    Sistem terhubung, namun tidak mendeteksi baris data di dalam tabel 'cabais'.
                </p>
            </div>
        <?php endif; ?>

    </div>
</section>