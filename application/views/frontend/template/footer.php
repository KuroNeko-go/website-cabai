</main>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h4><i class="fas fa-seedling"></i> CabaiNusa</h4>
                <p>Pusat edukasi dan penjualan bibit cabai unggul Nusantara.</p>
            </div>

            <div>
                <h5>Kontak</h5>
                <p><i class="fab fa-whatsapp"></i> +62 812-3456-7890</p>
                <p><i class="far fa-envelope"></i> info@cabainusa.id</p>
                <p><i class="fab fa-instagram"></i> @cabainusa</p>
            </div>
            
            <div>
                <h5>Jam Operasional</h5>
                <p>Senin - Sabtu: 08:00 - 17:00</p>
                <p>Minggu & Hari Besar: Tutup</p>
            </div>
        </div>
        <hr style="margin: 40px 0 20px; border-color: rgba(255,255,255,0.1);">
        <p style="text-align: center;">&copy; 2025 CabaiNusa. Semua Hak Dilindungi.</p>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 800, once: true });

function updateCartCount() {
    fetch('<?= base_url("cart/get_cart") ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('cartCount').innerText = data.total_items;
        });
}

document.addEventListener('DOMContentLoaded', updateCartCount);
</script>
</body>
</html>