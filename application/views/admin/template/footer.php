</div>

<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>

<script>
// Simple mobile menu toggle
document.querySelector('.menu-toggle')?.addEventListener('click', function() {
    document.querySelector('.sidebar').style.transform = 'translateX(0)';
});

// 2. LOGIKA TOMBOL LOGOUT-NYA
document.getElementById('tombolLogout').addEventListener('click', function(e) {
    e.preventDefault(); // Ngerem biar ga langsung pindah halaman
    
    let linkLogout = this.getAttribute('href');

    Swal.fire({
        title: 'Yakin ingin logout?',
        text: "Kamu akan keluar dari akun admin ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',     // Merah buat tombol logout
        cancelButtonColor: '#2d7a24',   // Ijo buat batal
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal',
        background: '#ffffff',
        color: '#1a3e15'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = linkLogout; 
        }
    });
});
</script>
</body>
</html>