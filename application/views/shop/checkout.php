<div class="container" style="padding-top: 100px; padding-bottom: 60px;">
    <h1 style="font-size: 36px; margin-bottom: 30px;">📝 Checkout</h1>
    
    <div style="display: grid; grid-template-columns: 1fr 400px; gap: 30px;">
        <div>
            <div style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <h3>Informasi Pengiriman</h3>
                <hr>
                <form action="<?= base_url('cart/process') ?>" method="POST">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px;">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px;" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px;">Email</label>
                        <input type="email" name="email" class="form-control" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px;">No. Telepon/WhatsApp <span class="text-danger">*</span></label>
                        <input type="tel" name="telepon" class="form-control" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px;" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px;">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px; min-height: 100px;" required></textarea>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px;">Catatan (opsional)</label>
                        <textarea name="catatan" class="form-control" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px;" placeholder="Contoh: Pakai bubble wrap"></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%;">Konfirmasi Pesanan</button>
                </form>
            </div>
        </div>
        
        <div>
            <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); position: sticky; top: 100px;">
                <h3>Ringkasan Pesanan</h3>
                <hr>
                <?php foreach ($cart as $item): ?>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span><?= $item['name'] ?> <strong>x<?= $item['qty'] ?></strong></span>
                    <span>Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></span>
                </div>
                <?php endforeach; ?>
                <hr>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Subtotal</span>
                    <strong>Rp <?= number_format($subtotal, 0, ',', '.') ?></strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Ongkos Kirim</span>
                    <strong>Rp <?= number_format($ongkir, 0, ',', '.') ?></strong>
                </div>
                <hr>
                <div style="display: flex; justify-content: space-between; font-size: 20px;">
                    <span>Total</span>
                    <strong style="color: #2d7a24;">Rp <?= number_format($grand_total, 0, ',', '.') ?></strong>
                </div>
                
                <div style="margin-top: 20px; background: #f0fdf4; padding: 15px; border-radius: 12px;">
                    <h4>💳 Metode Pembayaran</h4>
                    <p><i class="fas fa-university"></i> Transfer Bank BCA</p>
                    <p><strong>1234567890</strong> a.n. CabaiNusa</p>
                    <p><i class="fas fa-mobile-alt"></i> QRIS (Scan via GoPay/OVO)</p>
                    <small class="text-muted">Konfirmasi pembayaran via WhatsApp: <strong>0812-3456-7890</strong></small>
                </div>
            </div>
        </div>
    </div>
</div>