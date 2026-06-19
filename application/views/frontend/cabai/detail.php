<div class="container" style="padding-top: 120px; padding-bottom: 60px;">
    
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 30px;">
        <ol style="display: flex; gap: 10px; list-style: none; padding: 0; margin: 0; flex-wrap: wrap;">
            <a href="<?= base_url('/cabai') ?>" style="color: #2d7a24; text-decoration: none;">← Kembali ke Daftar Cabai</a>
        </ol>
    </nav>

    <!-- Product Detail Section -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px;">
        
        <!-- Left Column: Product Image -->
        <div>
            <div style="background: #f8faf7; border-radius: 24px; padding: 40px; text-align: center; position: relative;">
                <?php if (isset($cabai['gambar']) && $cabai['gambar'] && file_exists('./' . $cabai['gambar'])): ?>
                    <img src="<?= base_url($cabai['gambar']) ?>" style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 16px;">
                <?php else: ?>
                    <i class="fas fa-pepper-hot" style="font-size: 120px; color: #dc3545;"></i>
                <?php endif; ?>
                
                <!-- Badge Cabai -->
                <span style="position: absolute; top: 20px; left: 20px; background: #dc3545; color: white; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 600;">
                    🔥 CABAI UNGGULAN
                </span>
            </div>
        </div>
        
        <!-- Right Column: Product Info -->
        <div>
            <h1 style="font-size: 32px; font-weight: 700; margin-bottom: 10px; color: #1a2e1a;"><?= $cabai['nama_varietas'] ?></h1>
            
            <div style="margin-bottom: 15px;">
                <span style="background: #e8f5e9; padding: 4px 12px; border-radius: 20px; font-size: 14px;">
                    <i class="fas fa-leaf"></i> <em><?= $cabai['nama_latin'] ?></em>
                </span>
            </div>
            
            <!-- Price Section -->
            <div style="margin-bottom: 20px;">
                <span style="font-size: 32px; font-weight: 700; color: #2d7a24;">
                    Rp <?= isset($cabai['harga']) ? number_format($cabai['harga'], 0, ',', '.') : '0' ?>
                </span>
            </div>
            
            <!-- Highlight Info (Pengganti Stok di halaman Bibit) -->
            <div style="margin-bottom: 20px; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <div style="background: #f8d7da; color: #721c24; padding: 8px 16px; border-radius: 30px; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fas fa-fire"></i>
                    <strong>Pedas:</strong>
                    <span style="margin-left: 5px;"><?= $cabai['tingkat_pedas'] ?></span>
                </div>
                
                <div style="background: #e8f5e9; color: #2d7a24; padding: 8px 16px; border-radius: 30px; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fas fa-clock"></i>
                    Umur Panen: <?= $cabai['umur_panen'] ?>
                </div>
            </div>
            
            <!-- Quantity Selector -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Jumlah Pesanan</label>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="display: flex; align-items: center; border: 2px solid #e2e8f0; border-radius: 40px; overflow: hidden;">
                        <button id="qtyMinus" style="background: #f8faf7; border: none; width: 45px; height: 45px; font-size: 20px; cursor: pointer; transition: all 0.3s;">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" id="qtyInput" value="1" min="1" style="width: 70px; text-align: center; border: none; font-size: 16px; font-weight: 600; padding: 10px 0;">
                        <button id="qtyPlus" style="background: #f8faf7; border: none; width: 45px; height: 45px; font-size: 20px; cursor: pointer; transition: all 0.3s;">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div style="display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap;">
                <button id="addToCartBtn" class="btn-primary" style="padding: 14px 32px; font-size: 16px; cursor: pointer; border: none;">
                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                </button>
                <button id="buyNowBtn" class="btn-outline" style="padding: 14px 32px; font-size: 16px; cursor: pointer; background: transparent; border: 2px solid #2d7a24; color: #2d7a24; border-radius: 40px; font-weight: 600;">
                    <i class="fas fa-bolt"></i> Beli Sekarang
                </button>
            </div>
            
            <!-- Delivery Info -->
            <div style="background: #f8faf7; border-radius: 16px; padding: 20px; margin-bottom: 20px;">
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-truck" style="font-size: 20px; color: #2d7a24;"></i>
                        <div>
                            <div style="font-weight: 600;">Pengiriman Cepat</div>
                            <small style="color: #6c757d;">1-3 hari kerja</small>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-shield-alt" style="font-size: 20px; color: #2d7a24;"></i>
                        <div>
                            <div style="font-weight: 600;">Garansi Kualitas</div>
                            <small style="color: #6c757d;">Benih berkualitas</small>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-headset" style="font-size: 20px; color: #2d7a24;"></i>
                        <div>
                            <div style="font-weight: 600;">Konsultasi Gratis</div>
                            <small style="color: #6c757d;">Panduan menanam</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Product Description Section -->
    <hr style="margin: 50px 0;">
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px;">
        <div>
            <h3 style="margin-bottom: 20px;">📋 Deskripsi Produk</h3>
            <div style="color: #4a5b4e; line-height: 1.8;">
                <p><strong>Keunggulan:</strong><br><?= nl2br($cabai['keunggulan']) ?></p>
                <p><?= nl2br($cabai['deskripsi'] ?: 'Belum ada deskripsi untuk produk ini.') ?></p>
            </div>
        </div>
        
        <div>
            <h3 style="margin-bottom: 20px;">🌶️ Informasi Varietas</h3>
            <div style="background: #f8faf7; border-radius: 16px; padding: 20px;">
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="font-weight: 600;">Nama Varietas</span>
                    <span><?= $cabai['nama_varietas'] ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="font-weight: 600;">Tingkat Pedas</span>
                    <span>
                        <?php 
                        $pedas_level = ['Mild' => '🌶️', 'Sedang' => '🌶️🌶️', 'Pedas' => '🌶️🌶️🌶️', 'Sangat Pedas' => '🌶️🌶️🌶️🌶️', 'Extra Pedas' => '🌶️🌶️🌶️🌶️🌶️'];
                        echo $pedas_level[$cabai['tingkat_pedas']] ?? '🌶️🌶️🌶️';
                        ?> <?= $cabai['tingkat_pedas'] ?>
                    </span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                    <span style="font-weight: 600;">Cocok Ditanam</span>
                    <span><?= $cabai['cocok_ditanam'] ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products Section -->
    <?php if (!empty($bibits)): ?>
    <hr style="margin: 50px 0 40px;">
    
    <div class="section-header" style="text-align: center; margin-bottom: 30px;">
        <h3 style="font-size: 24px;">✨ Produk Bibit dari <?= $cabai['nama_varietas'] ?></h3>
        <p style="color: #6c757d;">Jelajahi ketersediaan bibit untuk varietas ini</p>
    </div>
    
    <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 25px;">
        <?php foreach ($bibits as $bibit): ?>
            <div class="product-card" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: all 0.3s; text-decoration: none; color: inherit;">
                <a href="<?= base_url('/bibit/detail/' . $bibit['id']) ?>" style="text-decoration: none; color: inherit;">
                    <div style="aspect-ratio: 1 / 1; background: #f8faf7; display: flex; align-items: center; justify-content: center; padding: 30px;">
                        <?php if (isset($bibit['gambar']) && $bibit['gambar'] && file_exists('./' . $bibit['gambar'])): ?>
                            <img src="<?= base_url($bibit['gambar']) ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        <?php else: ?>
                            <i class="fas fa-seedling" style="font-size: 50px; color: #2d7a24;"></i>
                        <?php endif; ?>
                    </div>
                    <div style="padding: 20px;">
                        <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;"><?= $bibit['nama_produk'] ?></h4>
                        <div style="color: #2d7a24; font-weight: 700; font-size: 18px;">
                            Rp <?= number_format($bibit['harga'], 0, ',', '.') ?>
                        </div>
                        <small style="color: #6c757d;">📦 Stok: <?= $bibit['stok'] ?> pak</small>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
// Logic Tambah/Kurang Jumlah
const qtyInput = document.getElementById('qtyInput');
const qtyMinus = document.getElementById('qtyMinus');
const qtyPlus = document.getElementById('qtyPlus');

qtyMinus.addEventListener('click', function() {
    let currentVal = parseInt(qtyInput.value);
    if (currentVal > 1) {
        qtyInput.value = currentVal - 1;
    }
});

qtyPlus.addEventListener('click', function() {
    let currentVal = parseInt(qtyInput.value);
    qtyInput.value = currentVal + 1;
});

// LOGIC KERANJANG BENERAN (BUKAN DUMMY LAGI)
document.getElementById('addToCartBtn').addEventListener('click', function() {
    let jumlah_qty = parseInt(qtyInput.value);
    
    // Tembak pake AJAX (jQuery) ke controller Cart
    $.ajax({
        url: '<?= base_url('cart/add') ?>',
        type: 'POST',
        data: {
            id: <?= $cabai['id'] ?>,      // Ambil ID cabai dari database
            qty: jumlah_qty,              // Ambil jumlah pesanan dari input
            tipe: 'cabai'                 // <--- STEMPEL TIPE CABAI MASUK KE SINI
        },
        dataType: 'json',
        success: function(response) {
            if(response.status === 'success') {
                alert(response.message); // Kalo lu mau SweetAlert, ganti alert ini pake Swal.fire
            } else {
                alert('Gagal: ' + response.message);
            }
        },
        error: function() {
            alert('Terjadi kesalahan jaringan.');
        }
    });
});

document.getElementById('buyNowBtn').addEventListener('click', function() {
    alert("Sistem checkout langsung masih dirakit. Gunakan 'Tambah ke Keranjang' dulu ya! 🚀");
});
</script>