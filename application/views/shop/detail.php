<div class="container" style="padding-top: 120px; padding-bottom: 60px;">
    
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 30px;">
        <ol style="display: flex; gap: 10px; list-style: none; padding: 0; margin: 0; flex-wrap: wrap;">
            <a href="<?= base_url('/cabai') ?>" style="color: #2d7a24; text-decoration: none;">← Kembali ke Toko Bibit</a>
        </ol>
    </nav>

    <!-- Product Detail Section -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px;">
        
        <!-- Left Column: Product Image -->
        <div>
            <div style="background: #f8faf7; border-radius: 24px; padding: 40px; text-align: center; position: relative;">
                <?php if ($bibit['gambar'] && file_exists('./' . $bibit['gambar'])): ?>
                    <img src="<?= base_url($bibit['gambar']) ?>" style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 16px;">
                <?php else: ?>
                    <i class="fas fa-seedling" style="font-size: 120px; color: #2d7a24;"></i>
                <?php endif; ?>
                
                <!-- Badges -->
                <?php if ($bibit['is_new']): ?>
                    <span style="position: absolute; top: 20px; left: 20px; background: #dc3545; color: white; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 600;">
                        ✨ PRODUK BARU
                    </span>
                <?php endif; ?>
                <?php if ($bibit['is_popular']): ?>
                    <span style="position: absolute; top: 20px; right: 20px; background: #ff9800; color: white; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 600;">
                        🔥 POPULER
                    </span>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Right Column: Product Info -->
        <div>
            <h1 style="font-size: 32px; font-weight: 700; margin-bottom: 10px; color: #1a2e1a;"><?= $bibit['nama_produk'] ?></h1>
            
            <div style="margin-bottom: 15px;">
                <span style="background: #e8f5e9; padding: 4px 12px; border-radius: 20px; font-size: 14px;">
                    <i class="fas fa-leaf"></i> <?= $bibit['nama_varietas'] ?>
                </span>
            </div>
            
            <!-- Price Section -->
            <div style="margin-bottom: 20px;">
                <?php if ($bibit['harga_diskon'] && $bibit['harga_diskon'] < $bibit['harga']): ?>
                    <span style="font-size: 14px; color: #6c757d; text-decoration: line-through; margin-right: 10px;">
                        Rp <?= number_format($bibit['harga'], 0, ',', '.') ?>
                    </span>
                    <span style="font-size: 32px; font-weight: 700; color: #dc3545;">
                        Rp <?= number_format($bibit['harga_diskon'], 0, ',', '.') ?>
                    </span>
                    <span style="background: #dc3545; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; margin-left: 10px;">
                        HEMAT <?= round((($bibit['harga'] - $bibit['harga_diskon']) / $bibit['harga']) * 100) ?>%
                    </span>
                <?php else: ?>
                    <span style="font-size: 32px; font-weight: 700; color: #2d7a24;">
                        Rp <?= number_format($bibit['harga'], 0, ',', '.') ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <!-- Stock Info -->
            <div style="margin-bottom: 20px; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <?php if ($bibit['stok'] > 0): ?>
                    <div style="background: #d4edda; color: #155724; padding: 8px 16px; border-radius: 30px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-check-circle"></i>
                        <strong>Stok Tersedia</strong>
                        <span style="margin-left: 5px;">(<?= $bibit['stok'] ?> pak)</span>
                    </div>
                <?php else: ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 8px 16px; border-radius: 30px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-times-circle"></i>
                        <strong>Stok Habis</strong>
                    </div>
                <?php endif; ?>
                
                <div style="background: #e8f5e9; color: #2d7a24; padding: 8px 16px; border-radius: 30px; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fas fa-weight-hanging"></i>
                    Berat: <?= $bibit['berat'] ?> gram
                </div>
            </div>
            
            <!-- Quantity Selector -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Jumlah</label>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="display: flex; align-items: center; border: 2px solid #e2e8f0; border-radius: 40px; overflow: hidden;">
                        <button id="qtyMinus" style="background: #f8faf7; border: none; width: 45px; height: 45px; font-size: 20px; cursor: pointer; transition: all 0.3s;">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" id="qtyInput" value="1" min="1" max="<?= $bibit['stok'] ?>" style="width: 70px; text-align: center; border: none; font-size: 16px; font-weight: 600; padding: 10px 0;">
                        <button id="qtyPlus" style="background: #f8faf7; border: none; width: 45px; height: 45px; font-size: 20px; cursor: pointer; transition: all 0.3s;">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <span style="color: #6c757d;">Maksimal <?= $bibit['stok'] ?> pak</span>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div style="display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap;">
                <button id="addToCartBtn" class="btn-outline btn-animasi" style="padding: 14px 32px; font-size: 16px; cursor: pointer; background: transparent; border: 2px solid #2d7a24; color: #2d7a24; border-radius: 40px; font-weight: 600; <?= $bibit['stok'] <= 0 ? 'opacity: 0.5; cursor: not-allowed;' : '' ?>" <?= $bibit['stok'] <= 0 ? 'disabled' : '' ?>>
                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                </button>
                <button id="buyNowBtn" class="btn-outline btn-animasi" style="padding: 14px 32px; font-size: 16px; cursor: pointer; background: transparent; border: 2px solid #2d7a24; color: #2d7a24; border-radius: 40px; font-weight: 600; <?= $bibit['stok'] <= 0 ? 'opacity: 0.5; cursor: not-allowed;' : '' ?>" <?= $bibit['stok'] <= 0 ? 'disabled' : '' ?>>
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
                <?= nl2br($bibit['deskripsi'] ?: 'Belum ada deskripsi untuk produk ini.') ?>
            </div>
        </div>
        
        <div>
            <h3 style="margin-bottom: 20px;">🌶️ Informasi Varietas</h3>
            <div style="background: #f8faf7; border-radius: 16px; padding: 20px;">
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="font-weight: 600;">Nama Varietas</span>
                    <span><?= $bibit['nama_varietas'] ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="font-weight: 600;">Tingkat Pedas</span>
                    <span>
                        <?php 
                        $pedas_level = ['Mild' => '🌶️', 'Sedang' => '🌶️🌶️', 'Pedas' => '🌶️🌶️🌶️', 'Sangat Pedas' => '🌶️🌶️🌶️🌶️', 'Extra Pedas' => '🌶️🌶️🌶️🌶️🌶️'];
                        echo $pedas_level[$bibit['tingkat_pedas']] ?? '🌶️🌶️🌶️';
                        ?> <?= $bibit['tingkat_pedas'] ?>
                    </span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                    <span style="font-weight: 600;">Kemasan</span>
                    <span><?= $bibit['berat'] ?> gram / pak</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products Section -->
    <?php if (!empty($related) && count($related) > 1): ?>
    <hr style="margin: 50px 0 40px;">
    
    <div class="section-header" style="text-align: center; margin-bottom: 30px;">
        <h3 style="font-size: 24px;">✨ Produk Lain dari <?= $bibit['nama_varietas'] ?></h3>
        <p style="color: #6c757d;">Jelajahi bibit unggul lainnya</p>
    </div>
    
    <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 25px;">
        <?php foreach ($related as $item): ?>
            <?php if ($item['id'] != $bibit['id']): ?>
            <div class="product-card" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: all 0.3s; text-decoration: none; color: inherit;">
                <a href="<?= base_url('/bibit/detail/' . $item['id']) ?>" style="text-decoration: none; color: inherit;">
                    <div style="aspect-ratio: 1 / 1; background: #f8faf7; display: flex; align-items: center; justify-content: center; padding: 30px;">
                        <?php if ($item['gambar'] && file_exists('./' . $item['gambar'])): ?>
                            <img src="<?= base_url($item['gambar']) ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        <?php else: ?>
                            <i class="fas fa-seedling" style="font-size: 50px; color: #2d7a24;"></i>
                        <?php endif; ?>
                    </div>
                    <div style="padding: 20px;">
                        <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;"><?= $item['nama_produk'] ?></h4>
                        <div style="color: #2d7a24; font-weight: 700; font-size: 18px;">
                            Rp <?= number_format($item['harga_diskon'] ?: $item['harga'], 0, ',', '.') ?>
                            <?php if ($item['harga_diskon']): ?>
                                <small style="font-size: 12px; color: #6c757d; text-decoration: line-through;">Rp <?= number_format($item['harga'], 0, ',', '.') ?></small>
                            <?php endif; ?>
                        </div>
                        <small style="color: #6c757d;">📦 Stok: <?= $item['stok'] ?></small>
                    </div>
                </a>
                <button class="add-to-cart-related" data-id="<?= $item['id'] ?>" data-name="<?= $item['nama_produk'] ?>" data-price="<?= $item['harga_diskon'] ?: $item['harga'] ?>" style="width: calc(100% - 40px); margin: 0 20px 20px; padding: 10px; background: #2d7a24; color: white; border: none; border-radius: 30px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                </button>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>

<script>
// Quantity selector
const qtyInput = document.getElementById('qtyInput');
const qtyMinus = document.getElementById('qtyMinus');
const qtyPlus = document.getElementById('qtyPlus');
const maxStock = <?= $bibit['stok'] ?>;

// Bikin fungsi khusus buat ngecek dan ngubah gaya tombol
function updateTombolStatus() {
    let currentVal = parseInt(qtyInput.value);

    // 1. Logika Tombol Plus (Kalau mentok stok maksimal)
    if (currentVal >= maxStock) {
        qtyPlus.disabled = true; 
        qtyPlus.style.opacity = '0.4'; 
        qtyPlus.style.cursor = 'not-allowed'; 
    } else {
        qtyPlus.disabled = false;
        qtyPlus.style.opacity = '1';
        qtyPlus.style.cursor = 'pointer';
    }

    // 2. Logika Tombol Minus (Biar ga bisa turun di bawah 1 sekalian)
    if (currentVal <= 1) {
        qtyMinus.disabled = true;
        qtyMinus.style.opacity = '0.4';
        qtyMinus.style.cursor = 'not-allowed';
    } else {
        qtyMinus.disabled = false;
        qtyMinus.style.opacity = '1';
        qtyMinus.style.cursor = 'pointer';
    }
}

// Panggil fungsinya sekali saat halaman baru beres loading
updateTombolStatus();

qtyMinus.addEventListener('click', function() {
    let currentVal = parseInt(qtyInput.value);
    if (currentVal > 1) { 
        qtyInput.value = currentVal - 1; 
        updateTombolStatus(); 
    }
});

qtyPlus.addEventListener('click', function() {
    let currentVal = parseInt(qtyInput.value);
    if (currentVal < maxStock) { 
        qtyInput.value = currentVal + 1;
        updateTombolStatus(); 
    }
});

// Modif juga buat input manual biar ga muncul alert kalau diketik langsung
qtyInput.addEventListener('change', function() {
    let val = parseInt(this.value);
    if (isNaN(val) || val < 1) {
        this.value = 1;
    } else if (val > maxStock) {
        this.value = maxStock; // Otomatis mentok ke batas maksimal
    }
    updateTombolStatus(); // Update gaya tombol
});

// Update cart count
function updateCartCount() {
    fetch('<?= base_url("cart/get_cart") ?>')
        .then(response => response.json())
        .then(data => {
            const cartCount = document.getElementById('cartCount');
            if (cartCount) { cartCount.innerText = data.total_items; }
        });
}

// Animate cart icon
function animateCartIcon() {
    const cartIcon = document.querySelector('.cart-icon i');
    if (cartIcon) {
        cartIcon.style.transform = 'scale(1.2)';
        setTimeout(() => { cartIcon.style.transform = 'scale(1)'; }, 300);
    }
}

// Notification popup (Buat tombol ajax yang berhasil)
function showNotification(message, type) {
    let notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed; bottom: 20px; right: 20px;
        background: ${type === 'success' ? '#2d7a24' : '#dc3545'};
        color: white; padding: 15px 25px; border-radius: 40px;
        z-index: 10000; font-weight: 600; box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        animation: slideIn 0.3s ease;
    `;
    notification.innerHTML = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// =========================================================
// FUNGSI 1: TAMBAH KERANJANG (AJAX Biasa)
// =========================================================
document.getElementById('addToCartBtn').addEventListener('click', function() {
    // --- SATPAM LOGIN ---
    <?php if (!$this->session->userdata('id_user')) : ?>
        Swal.fire({
            title: 'Tunggu Dulu!',
            text: 'Anda harus login untuk bisa memasukkan barang ke keranjang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2d6a4f',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Login Sekarang',
            cancelButtonText: 'Nanti Aja'
        }).then((result) => {
            if (result.isConfirmed) { window.location.href = "<?= base_url('auth/login') ?>"; }
        });
        return; 
    <?php endif; ?>
    // --------------------

    let originalText = this.innerHTML;
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    
    fetch('<?= base_url('cart/add') ?>', {
        method: 'POST',
        credentials: 'include',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            'id': '<?= $bibit['id'] ?>',
            'qty': parseInt(qtyInput.value),
            'tipe': 'bibit' 
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            swal.fire({
                title: 'sukses',
                text: data.message +' Mau Cek Keranjang Dulu Atau Liat Produk Lainnya?',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#2d6a4f',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cek Keranjang',
                cancelButtonText: 'Lihat Produk Lain',
                background: '#1e293b',
                color: '#f8fafc',
                }).then((result) => {
                    if (result.isConfirmed) { window.location.href = "<?= base_url('cart') ?>"; }
                });
        } else {
            swal.fire({
                title: 'Gagal Memasukkan ke Keranjang',
                text: data.message,
                icon: 'error',
                confirmButtonColor: '#D33',
                background: '#1e293b',
                color: '#f8fafc',
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan sistem atau jaringan.');
    })
    .finally(() => { this.innerHTML = originalText; });
});

// =========================================================
// FUNGSI 2: BELI SEKARANG (FORM GAIB)
// =========================================================
document.getElementById('buyNowBtn').addEventListener('click', function() {
    // --- SATPAM LOGIN ---
    <?php if (!$this->session->userdata('id_user')) : ?>
        Swal.fire({
            title: 'Mau Langsung Beli?',
            text: 'Login dulu yuk biar kami tahu mau dikirim ke mana bibitnya.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#2d6a4f',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Gas Login',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) { window.location.href = "<?= base_url('auth/login') ?>"; }
        });
        return; 
    <?php endif; ?>
    // --------------------

    let originalText = this.innerHTML;
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengalihkan...';
    
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?= base_url('cart/set_langsung') ?>'; 
    
    form.innerHTML = `
        <input type="hidden" name="id" value="<?= $bibit['id'] ?>">
        <input type="hidden" name="name" value="<?= htmlspecialchars($bibit['nama_produk']) ?>">
        <input type="hidden" name="price" value="<?= $bibit['harga_diskon'] ?: $bibit['harga'] ?>">
        <input type="hidden" name="qty" value="${parseInt(qtyInput.value)}">
        <input type="hidden" name="tipe" value="bibit">
    `;
    
    document.body.appendChild(form);
    form.submit();
    
    setTimeout(() => { this.innerHTML = originalText; }, 1000);
});

// =========================================================
// FUNGSI 3: RELATED PRODUCTS (PRODUK LAINNYA)
// =========================================================
document.querySelectorAll('.add-to-cart-related').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        // --- SATPAM LOGIN ---
        <?php if (!$this->session->userdata('id_user')) : ?>
            Swal.fire({
                title: 'Tunggu Dulu!',
                text: 'Anda harus login untuk bisa memasukkan barang ke keranjang.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2d6a4f',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login Sekarang',
                cancelButtonText: 'Nanti Aja'
            }).then((result) => {
                if (result.isConfirmed) { window.location.href = "<?= base_url('auth/login') ?>"; }
            });
            return; 
        <?php endif; ?>
        // --------------------

        let id = this.dataset.id;
        let name = this.dataset.name;
        let price = parseInt(this.dataset.price);
        
        fetch('<?= base_url("cart/add") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + id + '&qty=1&tipe=bibit' // Tambahin tipe=bibit biar aman
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showNotification('✅ ' + name + ' ditambahkan ke keranjang!', 'success');
                updateCartCount();
                animateCartIcon();
            } else {
                showNotification('❌ ' + data.message, 'error');
            }
        });
    });
});

// Add animation styles
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    .cart-icon i { transition: transform 0.3s ease; }
`;
document.head.appendChild(style);
</script>