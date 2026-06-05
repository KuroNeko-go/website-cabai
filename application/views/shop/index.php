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
<section style="padding: 5rem 0; background: #ffffff;">
    <div class="container">
        
        <?php if (!empty($bibits)): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
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
                    <div style="background: #ffffff; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e9ecef; overflow: hidden; transition: transform 0.3s ease; display: flex; flex-direction: column;">
                        
                        <!-- Gambar Produk Bibit -->
                        <div style="height: 200px; background: #f8f9fa; position: relative; overflow: hidden;">
                            <?php if (!empty($b['gambar'])): ?>
                                <img src="<?= base_url($b['gambar']) ?>" alt="<?= $nama_produk ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #6c757d; font-size: 3rem;">
                                    <i class="fas fa-seedling"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Konten Info Produk -->
                        <div style="padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; gap: 0.5rem;">
                            <span style="font-size: 0.75rem; color: #ff9f1c; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
                                Varietas Unggul
                            </span>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a2c1e; margin: 0;">
                                <?= $nama_produk ?>
                            </h3>
                            <p style="color: #6c757d; font-size: 0.85rem; line-height: 1.5; margin: 0 0 1rem 0;">
                                <?= !empty($b['deskripsi']) ? (strlen($b['deskripsi']) > 90 ? substr($b['deskripsi'], 0, 90) . '...' : $b['deskripsi']) : 'Bibit tanaman pilihan dengan persentase tumbuh tinggi, perakaran kuat, dan bebas penyakit.' ?>
                            </p>
                            
                            <!-- Bagian Bawah Card (Harga & Tombol) -->
                            <div style="margin-top: auto; display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid #e9ecef;">
                                <div>
                                    <span style="display: block; font-size: 0.75rem; color: #6c757d;">Harga Bibit</span>
                                    <span style="font-size: 1.15rem; font-weight: 800; color: #2d6a4f;">
                                        Rp <?= isset($b['harga']) ? number_format($b['harga'], 0, ',', '.') : '0' ?>
                                    </span>
                                </div>
                                <a href="<?= base_url('bibit/detail/' . $b['id']) ?>" class="btn btn-primary" style="padding: 0.5rem 1.25rem !important; border-radius: 10px !important; font-size: 0.8rem !important; background-color: #2d6a4f !important; color: white !important; text-decoration: none;">
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
                    <i class="fas fa-seedling" style="opacity: 0.3;"></i>
                </div>
                <h3 style="font-weight: 700; color: #4a5b4e;">Stok Bibit Belum Tersedia</h3>
                <p style="color: #6c757d; max-width: 500px; margin: 0 auto 1.5rem;">
                    Sistem terhubung, namun array data bibit kosong dari database.
                </p>
            </div>
        <?php endif; ?>

    </div>
</section>