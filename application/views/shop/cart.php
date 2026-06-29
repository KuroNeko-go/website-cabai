<?php $this->load->view('frontend/template/header'); ?>

<div style="height: 40px; width: 100%; display: block;"></div>

<div class="container" id="cart-container" style="margin-bottom: 80px;">
    <h2 style="font-weight: 800; color: #1a2e1a; margin-bottom: 30px;">Keranjang Belanja</h2>
    
    <div class="row">
        <div class="col-md-8">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success" style="border-radius: 12px; font-weight: 600;">
                    <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (empty($cart)): ?>
                <div style="background: white; border-radius: 20px; padding: 50px; text-align: center; border: 1px solid #e2e8f0;">
                    <i class="fas fa-shopping-cart" style="font-size: 80px; color: #e2e8f0; margin-bottom: 20px;"></i>
                    <h4 style="color: #4a5b4e; font-weight: 700;">Keranjang Anda masih kosong!</h4>
                    <p style="color: #6c757d; margin-bottom: 25px;">Yuk, mulai penuhi keranjang dengan bibit dan cabai berkualitas.</p>
                    <a href="<?= base_url('cabai'); ?>" class="btn btn-primary" style="border-radius: 30px; padding: 10px 30px; font-weight: 600;">Belanja Sekarang</a>
                </div>
            <?php else: ?>
                
                <?php 
                $total_item = 0;
                foreach ($cart as $key => $item): 
                    $subtotal = $item['price'] * $item['qty'];
                    $total_item += $item['qty'];
                ?>
                    <div class="cart-card">
                        <div class="cart-img-box">
                            <?php if($item['tipe'] == 'bibit'): ?>
                                <i class="fas fa-seedling" style="font-size: 45px; color: #2d7a24;"></i>
                            <?php else: ?>
                                <i class="fas fa-pepper-hot" style="font-size: 45px; color: #dc3545;"></i>
                            <?php endif; ?>
                        </div>
                        
                        <div class="cart-info">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <h4 style="font-size: 1.1rem; font-weight: 700; margin: 0; color: #1a2e1a;"><?= $item['name']; ?></h4>
                                    <span style="display: inline-block; background: <?= $item['tipe'] == 'bibit' ? '#e8f5e9' : '#fce4e4' ?>; color: <?= $item['tipe'] == 'bibit' ? '#2d7a24' : '#dc3545' ?>; padding: 3px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; margin-top: 5px;">
                                        Tipe: <?= ucfirst($item['tipe']); ?>
                                    </span>
                                    <div style="color: #2d7a24; font-weight: 800; font-size: 1.2rem; margin-top: 8px;">
                                        Rp <?= number_format($item['price'], 0, ',', '.'); ?>
                                    </div>
                                </div>
                                
                                <div style="text-align: right; font-weight: 700; color: #4a5b4e; font-size: 1.1rem;">
                                    Sub: Rp <?= number_format($subtotal, 0, ',', '.'); ?>
                                </div>
                            </div>
                            
                            <div class="qty-wrapper">
                                <form action="<?= base_url('cart/update'); ?>" method="post" class="m-0 form-update-cart">
                                    <input type="hidden" name="rowid" value="<?= $key; ?>">
                                    <div class="qty-control">
                                        <button type="button" class="qty-btn qty-btn-minus"><i class="fas fa-minus"></i></button>
                                        <input type="number" name="qty" value="<?= $item['qty']; ?>" class="qty-input">
                                        <button type="button" class="qty-btn qty-btn-plus"><i class="fas fa-plus"></i></button>
                                    </div>
                                    <button type="submit" class="submit-btn-hidden" style="display: none;"></button>
                                </form>
                                
                                <a href="<?= base_url('cart/remove/' . $key); ?>" class="btn-trash btn-hapus-cart" title="Hapus Produk">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            <?php endif; ?>
        </div>
        
        <?php if (!empty($cart)): ?>
            <div class="col-md-4">
                <div class="summary-card">
                    <h5 style="font-weight: 700; color: #1a2e1a; margin-bottom: 20px;">
                        <i class="fas fa-clipboard-check" style="color: #2d7a24;"></i> Ringkasan Belanja
                    </h5>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; color: #6c757d; font-weight: 500;">
                        <span>Total Item:</span>
                        <span><?= $total_item; ?> barang</span>
                    </div>
                    
                    <hr style="border-top: 2px dashed #e2e8f0; margin: 15px 0;">
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                        <span style="font-weight: 600; color: #1a2e1a;">Total Harga:</span>
                        <span style="font-size: 1.5rem; font-weight: 800; color: #2d7a24;">
                            Rp <?= number_format($total, 0, ',', '.'); ?>
                        </span>
                    </div>
                    
                    <a href="<?= base_url('cart/checkout'); ?>" class="btn btn-primary" style="width: 100%; border-radius: 12px; padding: 12px; font-weight: 700; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(45,122,36,0.3);">
                        Lanjut ke Checkout <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    
                    <a href="<?= base_url('cabai'); ?>" class="btn" style="width: 100%; border-radius: 12px; padding: 12px; font-weight: 600; color: #6c757d; background: #f8faf7; margin-top: 10px; border: 1px solid #e2e8f0;">
                        <i class="fas fa-arrow-left mr-2"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// SCRIPT SAKTI AJAX DOM REPLACEMENT & KONTROL PLUS MINUS
document.addEventListener('click', function(e) {
    // 1. LOGIKA TOMBOL PLUS
    let btnPlus = e.target.closest('.qty-btn-plus');
    if(btnPlus) {
        let form = btnPlus.closest('form.form-update-cart');
        let input = form.querySelector('.qty-input');
        input.value = parseInt(input.value) + 1;
        form.querySelector('.submit-btn-hidden').click(); // Submit otomatis
    }
    
    // 2. LOGIKA TOMBOL MINUS
    let btnMinus = e.target.closest('.qty-btn-minus');
    if(btnMinus) {
        let form = btnMinus.closest('form.form-update-cart');
        let input = form.querySelector('.qty-input');
        if(parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            form.querySelector('.submit-btn-hidden').click(); // Submit otomatis
        }
    }
    
    // 3. LOGIKA TOMBOL HAPUS
    let btnHapus = e.target.closest('a.btn-hapus-cart');
    if(btnHapus) {
        e.preventDefault();
        if(confirm('Hapus produk ini dari keranjang?')) {
            // Ubah icon jadi loading sementara nunggu server
            let icon = btnHapus.querySelector('i');
            icon.className = 'fas fa-spinner fa-spin';
            
            fetch(btnHapus.href)
            .then(res => res.text())
            .then(html => {
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');
                document.getElementById('cart-container').innerHTML = doc.getElementById('cart-container').innerHTML;
            });
        }
    }
});

// 4. LOGIKA AJAX SUBMIT (Tembak data di belakang layar tanpa reload)
document.addEventListener('submit', function(e) {
    let form = e.target.closest('form.form-update-cart');
    if(form) {
        e.preventDefault();
        // Bikin container keranjang jadi agak pudar pas proses update angka
        document.getElementById('cart-container').style.opacity = '0.6';
        
        fetch(form.action, { 
            method: 'POST', 
            body: new FormData(form) 
        })
        .then(res => res.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');
            document.getElementById('cart-container').innerHTML = doc.getElementById('cart-container').innerHTML;
            document.getElementById('cart-container').style.opacity = '1';
        });
    }
});
</script>

