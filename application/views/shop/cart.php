<div class="container" style="padding-top: 100px; padding-bottom: 60px;">
    <h1 style="font-size: 36px; margin-bottom: 30px;">🛒 Keranjang Belanja</h1>
    
    <?php if (empty($cart)): ?>
        <div style="text-align: center; padding: 80px 20px; background: #f8faf7; border-radius: 24px;">
            <i class="fas fa-shopping-cart" style="font-size: 64px; color: #2d7a24; margin-bottom: 20px;"></i>
            <h3>Keranjang Masih Kosong</h3>
            <p>Yuk, belanja bibit cabai unggul sekarang!</p>
            <a href="<?= base_url('/bibit') ?>" class="btn-primary" style="display: inline-block; margin-top: 20px;">Belanja Sekarang</a>
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 30px;">
            <div>
                <?php foreach ($cart as $id => $item): ?>
                <div style="display: flex; gap: 20px; background: white; border-radius: 16px; padding: 20px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div style="width: 100px; height: 100px; background: #f8faf7; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-seedling" style="font-size: 40px; color: #2d7a24;"></i>
                    </div>
                    <div style="flex: 1;">
                        <h4><?= $item['name'] ?></h4>
                        <div class="product-price">Rp <?= number_format($item['price'], 0, ',', '.') ?></div>
                        <div style="display: flex; gap: 15px; margin-top: 10px;">
                            <button class="qty-minus" data-id="<?= $id ?>" style="background: #e2e8f0; border: none; width: 30px; height: 30px; border-radius: 8px; cursor: pointer;">-</button>
                            <span class="qty-value"><?= $item['qty'] ?></span>
                            <button class="qty-plus" data-id="<?= $id ?>" style="background: #e2e8f0; border: none; width: 30px; height: 30px; border-radius: 8px; cursor: pointer;">+</button>
                            <a href="<?= base_url('cart/remove/' . $id) ?>" style="color: #dc3545; text-decoration: none;">Hapus</a>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <strong>Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></strong>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div>
                <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); position: sticky; top: 100px;">
                    <h3>Ringkasan Pesanan</h3>
                    <hr>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Subtotal</span>
                        <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Ongkos Kirim</span>
                        <strong>Rp 15.000</strong>
                    </div>
                    <hr>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 20px;">
                        <span>Total</span>
                        <strong style="color: #2d7a24;">Rp <?= number_format($total + 15000, 0, ',', '.') ?></strong>
                    </div>
                    <a href="<?= base_url('cart/checkout') ?>" class="btn-primary" style="display: block; text-align: center;">Checkout</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.querySelectorAll('.qty-minus, .qty-plus').forEach(btn => {
    btn.addEventListener('click', function() {
        let id = this.dataset.id;
        let isMinus = this.classList.contains('qty-minus');
        let qtySpan = this.parentElement.querySelector('.qty-value');
        let newQty = parseInt(qtySpan.innerText) + (isMinus ? -1 : 1);
        
        if (newQty < 1) return;
        
        fetch('<?= base_url("cart/update") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + id + '&qty=' + newQty
        })
        .then(() => location.reload());
    });
});
</script>