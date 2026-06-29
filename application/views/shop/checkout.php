<?php $this->load->view('frontend/template/header'); ?>

<?php 
    if ($this->session->userdata('mode_langsung')) {
        $cart_checkout = $this->session->userdata('cart_langsung') ? $this->session->userdata('cart_langsung') : [];
    } else {
        $cart_checkout = $this->session->userdata('cart') ? $this->session->userdata('cart') : [];
    }
    $total_belanja = 0;
    foreach ($cart_checkout as $item) {
        $total_belanja += $item['price'] * $item['qty'];
    }
?>

<div style="height: 100px; width: 100%; display: block;"></div>

<section class="checkout-wrapper">
    <div class="container">

        <h2 style="font-weight: 800; color: #222; margin-bottom: 30px; font-size: 2rem;">Checkout</h2>

        <form id="formCheckout" action="<?= base_url('cart/checkout') ?>" method="post">
            <div class="row">

                <div class="col-lg-7 mb-4">
                    <div class="checkout-card">
                        <h3>Informasi Pengiriman</h3>

                        <div class="mb-4">
                            <label class="form-label-minimalist">NAMA LENGKAP PENERIMA</label>
                            <input type="text" name="nama" class="form-minimalist" required placeholder="Masukkan nama lengkap Anda">
                        </div>

                        <div class="mb-4">
                            <label class="form-label-minimalist">NOMOR TELEPON / WHATSAPP</label>
                            <input type="text" name="telepon" class="form-minimalist" required placeholder="Contoh: 08123456789">
                            <small style="color:#888; font-size:0.75rem; margin-top:5px; display:block;">Anda akan menerima notifikasi resi melalui nomor ini</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-minimalist">ALAMAT RUMAH LENGKAP</label>
                            <textarea name="alamat" required rows="3" class="form-minimalist" style="resize:none;" placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, Kecamatan, dan Kabupaten"></textarea>
                        </div>

                        <div>
                            <label class="form-label-minimalist">CATATAN TAMBAHAN (OPSIONAL)</label>
                            <input type="text" name="catatan" class="form-minimalist" placeholder="Contoh: Titipkan ke tetangga jika rumah kosong">
                        </div>
                    </div>

                    <div class="checkout-card" style="opacity:0.7;">
                        <h3 style="color:#666;"><i class="fas fa-lock mr-2"></i> Pembayaran Aman</h3>
                        <p style="font-size:0.9rem; color:#666; margin:0;">Pembayaran akan diproses secara aman menggunakan sistem Midtrans.</p>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="checkout-summary-container" style="display: flex !important; flex-direction: column !important; gap: 25px !important; background: #2a2a2a; border-radius: 6px; padding: 30px; border: 1px solid #444;">
                        
                        <h3 class="checkout-summary-title" style="margin-top: 0; color: #fff; font-weight: 800; font-size: 1.25rem;">Order Summary</h3>
                        
                        <div class="checkout-item-list" style="display: flex !important; flex-direction: column !important; gap: 15px !important;">
                            <?php foreach ($cart_checkout as $item): ?>
                                <div class="checkout-item-row" style="display: flex !important; justify-content: space-between !important; align-items: center !important; padding-bottom: 15px !important; border-bottom: 1px solid #444 !important; width: 100% !important;">
                                    <div class="checkout-item-left" style="display: flex !important; align-items: center !important; gap: 15px !important;">
                                        <div class="checkout-qty-box" style="width: 45px; height: 45px; background: #1a1a1a; border-radius: 6px; display: flex !important; align-items: center !important; justify-content: center !important; color: #fff; font-weight: bold;">
                                            <span><?= $item['qty'] ?>x</span>
                                        </div>
                                        <div>
                                            <div class="checkout-item-name" style="font-weight: 600; font-size: 0.95rem; color: #fff; margin-bottom: 4px;">
                                                <?= strip_tags($item['name']) ?>
                                            </div>
                                            <div class="checkout-item-meta" style="font-size: 0.8rem; color: #bbb;">Tipe: <?= ucfirst($item['tipe']) ?></div>
                                        </div>
                                    </div>
                                    <div class="checkout-item-price" style="font-weight: 600; color: #fff;">
                                        Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>
                                    </div>
                                </div> 
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="checkout-calc-section" style="display: flex !important; flex-direction: column !important; gap: 12px !important; width: 100% !important;">
                            <div class="checkout-calc-row" style="display: flex !important; justify-content: space-between !important;">
                                <span style="color: #bbb;">Subtotal</span>
                                <span style="color: #bbb;">Rp <?= number_format($total_belanja, 0, ',', '.') ?></span>
                            </div>
                            <div class="checkout-calc-row" style="display: flex !important; justify-content: space-between !important;">
                                <span style="color: #bbb;">Pajak (Tax)</span>
                                <span style="color: #bbb;">Rp 0</span>
                            </div>
                            
                            <hr class="checkout-divider" style="border-top: 1px solid #444; margin: 10px 0; width: 100%;">
                            
                            <div class="checkout-total-row" style="display: flex !important; justify-content: space-between !important; align-items: center !important;">
                                <span style="font-weight: 700; color: #fff; font-size: 1.1rem;">Total</span>
                                <span class="checkout-total-price" style="font-weight: 800; font-size: 1.4rem; color: #fff;">Rp <?= number_format($total_belanja, 0, ',', '.') ?></span>
                            </div>
                        </div>

                        <button type="button" onclick="submitFormCheckout(this)" class="btn-pay-now" style="display: block !important; width: 100% !important; padding: 15px !important; background: #52b788 !important; color: #fff !important; border: none !important; border-radius: 6px !important; font-weight: bold !important; text-transform: uppercase !important; margin-top: 10px !important; cursor: pointer;">
                            LANJUT PEMBAYARAN
                        </button>
                        
                        <div class="checkout-secure-badge" style="text-align: center; color: #bbb; font-size: 0.75rem; margin-top: 15px; font-weight: 600;">
                            <i class="fas fa-shield-alt mr-1"></i> SECURE SSL CHECKOUT
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
</section>

<script>
function submitFormCheckout(btn) {
    let form = document.getElementById('formCheckout');
    if (form) {
        if (form.checkValidity()) {
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> MENGHUBUNGKAN KE SERVER...';
            btn.disabled = true;
            form.submit(); // Langsung tembak ke Controller!
        } else {
            form.reportValidity(); // Kasih warning kalau ada form yang belum diisi
        }
    } else {
        alert('Gagal menemukan form checkout!');
    }
}
</script>

<?php $this->load->view('frontend/template/footer'); ?>