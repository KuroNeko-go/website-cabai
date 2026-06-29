<div style="height: 120px; width: 100%; display: block;"></div>

<div class="container text-center" style="padding-bottom: 80px; min-height: 60vh;">
    <div style="background: #2a2a2a; border-radius: 12px; padding: 40px; max-width: 500px; margin: 0 auto; border: 1px solid #444; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
        
        <i class="fas fa-wallet" style="font-size: 50px; color: #52b788; margin-bottom: 20px;"></i>
        <h2 style="font-weight: 800; color: #fff; margin-bottom: 10px;">Menunggu Pembayaran</h2>
        <p style="color: #bbb; margin-bottom: 30px; font-size: 1.1rem;">Total Tagihan: <br><strong style="font-size: 2rem; color: #fff;">Rp <?= number_format($total, 0, ',', '.') ?></strong></p>

        <button id="pay-button" style="background: #52b788; color: white; padding: 15px 30px; border: none; border-radius: 8px; font-size: 1.1rem; font-weight: bold; cursor: pointer; width: 100%; box-shadow: 0 4px 15px rgba(82, 183, 136, 0.3); transition: 0.3s;">
            <i class="fas fa-qrcode mr-2"></i> BUKA SCANNER QRIS
        </button>
        
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-XXXXXXXXXXXXXXXXX"></script>

<script>
    document.getElementById('pay-button').onclick = function(){
        // Buka Popup Midtrans pakai Token yang dikirim dari Controller
        snap.pay('<?= $snap_token ?>', {
            onSuccess: function(result){
                // Aksi kalau berhasil dibayar
                window.location.href = "<?= base_url('cart/success') ?>";
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda!");
            },
            onError: function(result){
                alert("Pembayaran gagal atau kadaluarsa!");
            },
            onClose: function(){
                alert('Anda menutup popup sebelum menyelesaikan pembayaran');
            }
        });
    };

    // Opsional: Bikin popupnya otomatis kebuka pas halaman ini dimuat
    window.onload = function() {
        document.getElementById('pay-button').click();
    }
</script>