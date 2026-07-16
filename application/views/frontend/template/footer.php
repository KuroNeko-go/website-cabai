</div><!-- /.duaputra-body (Penutup dari header.php) -->
    </div><!-- /.content-wrapper (Penutup dari header.php) -->

    <!-- HTML ELEMEN FOOTER KUSTOM DUAPUTRA -->
    <footer class="footer-duaputra">
        <div class="footer-grid">
            <!-- Kolom 1 -->
            <div class="footer-col">
                <h4>Tentang Duaputra</h4>
                <p>Duaputra adalah penyedia benih dan bibit unggul terpercaya. Kami berkomitmen membantu petani mendapatkan hasil pertanian terbaik dengan slogan: Bibit Unggul, Panen Maksimal!</p>
            </div>

            <!-- Kolom 2 -->
            <div class="footer-col">
                <h4>Kontak & Alamat</h4>
                <p><i class="fas fa-map-marker-alt" style="width:20px;"></i> Grabag, Secang, Magelang, Central Java</p>
                <p><i class="fas fa-phone-alt" style="width:20px;"></i> +62 812-3456-7890</p>
                <p><i class="fas fa-envelope" style="width:20px;"></i> info@duaputra.com</p>
            </div>

            <!-- Kolom 3 -->
            <div class="footer-col">
                <h4>Ikuti Kami</h4>
                <p>Dapatkan info seputar tips pertanian dan promo bibit unggul terbaru melalui sosial media kami.</p>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

        <!-- Bagian Hak Cipta di Paling Bawah -->
        <div class="footer-bottom">
            &copy; <?= date('Y') ?> <strong>Duaputra</strong>. All Rights Reserved.
        </div>
    </footer>

</div><!-- ./wrapper (Penutup dari header.php) -->

<!-- ==========================================
     WIDGET CHATBOT FRONTEND START (HTML)
     ========================================== -->
<div class="chat-widget-container">
    <!-- Tombol Buka Tutup -->
    <button class="chat-toggler shadow" id="chatToggler">
        <i class="fas fa-comment-dots"></i>
    </button>
    
    <!-- Jendela Chat -->
    <div class="chat-window rounded bg-white" id="chatWindow">
        <!-- Header Chat -->
        <div class="p-3 rounded-top d-flex justify-content-between align-items-center" style="background-color: #009CFF;">
            <h6 class="mb-0 text-white"><i class="fas fa-robot me-2"></i>Asisten DuaPutra</h6>
            <button class="btn-close btn-close-white" id="chatClose" style="background: transparent; border: none; color: white; font-weight: bold; cursor: pointer;">X</button>
        </div>
        <!-- Body Chat -->
        <div class="chat-body p-3" id="chatBody">
            <div class="d-flex justify-content-start mb-3">
                <div class="chat-msg-bot p-2 shadow-sm text-dark">
                    Halo Kak! Selamat datang di DuaPutra. Ada yang bisa kami bantu seputar varietas atau bibit cabai hari ini? 🌶️
                </div>
            </div>
        </div>
        <!-- Footer Chat (Input) -->
        <div class="p-3 border-top bg-white rounded-bottom">
            <div class="input-group d-flex">
                <input type="text" class="form-control" id="chatInput" placeholder="Ketik pesan..." autocomplete="off" style="flex: 1; border-radius: 4px 0 0 4px; border: 1px solid #000000; padding: 8px;">
                <button class="btn text-white; fas fa-paper-plane" id="chatSend" style="background-color: #009CFF; border-radius: 20px; border: none; padding: 0 15px; cursor: pointer;"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- WIDGET CHATBOT FRONTEND END -->

<!-- ========================================================
     SCRIPT JAVASCRIPT UTAMA (Bawaan AdminLTE & Plugins)
     ======================================================== -->
<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>

<!-- SCRIPT DARK MODE ADMINLTE -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const themeToggleBtn = document.getElementById('theme-toggle');
        const iconTheme = themeToggleBtn ? themeToggleBtn.querySelector('i') : null;
        const bodyElement = document.body; 

        if (themeToggleBtn) {
            if (localStorage.getItem('theme') === 'dark') {
                bodyElement.classList.add('dark-mode');
                if (iconTheme) iconTheme.classList.replace('fa-moon', 'fa-sun'); 
            }

            themeToggleBtn.addEventListener('click', () => {
                bodyElement.classList.toggle('dark-mode');
                if (bodyElement.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                    if (iconTheme) iconTheme.classList.replace('fa-moon', 'fa-sun');
                } else {
                    localStorage.setItem('theme', 'light');
                    if (iconTheme) iconTheme.classList.replace('fa-sun', 'fa-moon');
                }
            });
        }
    });
</script>

<!-- SCRIPT CHATBOT (Harus di bawah jQuery) -->
<script>
$(document).ready(function() {
    // Fungsi Buka Tutup Chat
    $('#chatToggler, #chatClose').click(function() {
        $('#chatWindow').fadeToggle(200);
    });

    // Fungsi Kirim Pesan
    function kirimPesan() {
        let pesan = $('#chatInput').val().trim();
        if (pesan !== '') {
            let userHtml = `
            <div class="d-flex justify-content-end mb-3" style="display: flex; justify-content: flex-end;">
                <div class="chat-msg-user p-2 shadow-sm">
                    ${pesan}
                </div>
            </div>`;
            $('#chatBody').append(userHtml);
            $('#chatInput').val(''); 
            scrollBawah();

            let typingId = 'typing-' + Date.now();
            let typingHtml = `
            <div class="d-flex justify-content-start mb-3" id="${typingId}" style="display: flex; justify-content: flex-start;">
                <div class="chat-msg-bot p-2 shadow-sm text-muted" style="font-style: italic;">
                    Mengetik...
                </div>
            </div>`;
            $('#chatBody').append(typingHtml);
            scrollBawah();

            $.ajax({
                url: "<?= base_url('home/balas_chat') ?>", // Sesuaikan nama controller lu
                type: "POST",
                data: { pesan: pesan },
                dataType: "json",
                success: function(response) {
                    // Hapus tulisan "Mengetik..."
                    $('#' + typingId).remove(); 
                    
                    // Render balasan asli dari MySQL
                    let botHtml = `
                    <div class="d-flex justify-content-start mb-3" style="display: flex; justify-content: flex-start;">
                        <div class="chat-msg-bot p-2 shadow-sm text-dark">
                            ${response.balasan}
                        </div>
                    </div>`;
                    $('#chatBody').append(botHtml);
                    scrollBawah();
                },
                error: function() {
                    $('#' + typingId).remove(); 
                    let errorHtml = `
                    <div class="d-flex justify-content-start mb-3" style="display: flex; justify-content: flex-start;">
                        <div class="chat-msg-bot p-2 shadow-sm text-danger">
                            Aduh, server lagi gangguan nih Kak. Coba lagi nanti ya!
                        </div>
                    </div>`;
                    $('#chatBody').append(errorHtml);
                    scrollBawah();
                }
            });
        }
    }

    $('#chatSend').click(kirimPesan);
    $('#chatInput').keypress(function(e) {
        if (e.which == 13) kirimPesan();
    });

    function scrollBawah() {
        $('#chatBody').animate({ scrollTop: $('#chatBody')[0].scrollHeight }, 300);
    }
});
</script>

</body>
</html>