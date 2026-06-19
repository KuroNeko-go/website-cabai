<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - CabaiNusa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/style.css'); ?>">
    
</head>
<body class="auth-page">
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-header">
                <div class="logo-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <h2>Lupa Password?</h2>
                <p>Masukkan email Anda untuk reset password</p>
            </div>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('auth/do_forgot_password') ?>" method="POST">
    <div class="form-group">
        <label>Email</label>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
        </div>
    </div>
    
    <button type="submit" class="btn-reset">
        <i class="fas fa-paper-plane"></i> Kirim Link Reset
    </button>
</form>
            
            <div class="back-link">
                <a href="<?= base_url('auth/login') ?>">
                    <i class="fas fa-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

    <script>
        <?php if($this->session->flashdata('success_forgot')): ?>
            Swal.fire({
                title: 'Link Reset Terkirim!',
                text: 'Link reset password telah dikirim ke email Anda. Silakan cek kotak masuk.',
                icon: 'success',
                confirmButtonText: 'Kembali ke Login',
                confirmButtonColor: '#2d7a24', // Warna hijau cabai lu
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect otomatis ke halaman login
                    window.location.href = '<?php echo base_url('auth/login'); ?>';
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>