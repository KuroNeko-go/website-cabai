<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - CabaiNusa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/style.css'); ?>">
</head>
<body class="auth-page">
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-header">
                <div class="logo-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h2>Password Baru</h2>
                <p>Silakan buat password baru Anda</p>
            </div>
            
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    Gagal! Pastikan password minimal 6 karakter & sama persis.
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('auth/do_reset_password') ?>" method="POST">
                <div class="form-group">
                    <label>Password Baru</label>
                    <div class="input-group">
                        <i class="fas fa-key"></i>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password baru" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-group">
                        <i class="fas fa-check-double"></i>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Ketik ulang password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-reset">
                    <i class="fas fa-save"></i> Simpan & Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>