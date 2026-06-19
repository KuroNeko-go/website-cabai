<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun - CabaiNusa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/style.css'); ?>">
</head>
<body class="auth-page">
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <h2>Daftar Akun</h2>
                <p>Buat akun untuk mengakses admin panel</p>
            </div>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <?php echo validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ', '</div>'); ?>
            
            <form action="<?= base_url('auth/do_register') ?>" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" value="<?= set_value('nama_lengkap') ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Username <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <i class="fas fa-user-circle"></i>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username (min. 4 karakter)" value="<?= set_value('username') ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif" value="<?= set_value('email') ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password (min. 6 karakter)" required>
                        <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                    <div class="password-requirement">
                        <i class="fas fa-info-circle"></i> Password minimal 6 karakter
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Konfirmasi Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="Ulangi password" required>
                        <i class="fas fa-eye-slash password-toggle" id="toggleConfirmPassword"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
            </form>
            
            <div class="login-link">
                Sudah punya akun? <a href="<?= base_url('auth/login') ?>">Login Sekarang</a>
            </div>
        </div>
    </div>
    
    <script>
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
        
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        
        if (toggleConfirmPassword) {
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
        
        // Real-time password match checking
        const confirmInput = document.getElementById('confirmPassword');
        const passwordInput = document.getElementById('password');
        
        function checkPasswordMatch() {
            if (confirmInput.value !== passwordInput.value) {
                confirmInput.setCustomValidity('Password tidak cocok');
            } else {
                confirmInput.setCustomValidity('');
            }
        }
        
        passwordInput.addEventListener('change', checkPasswordMatch);
        confirmInput.addEventListener('keyup', checkPasswordMatch);
    </script>
    
    <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

    <script>
        <?php if($this->session->flashdata('success_register')): ?>
            Swal.fire({
                title: 'Akun Berhasil Dibuat!',
                text: 'Registrasi Anda berhasil. Silakan lanjut ke halaman login.',
                icon: 'success',
                confirmButtonText: 'Login Sekarang',
                confirmButtonColor: '#2d7a24',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo base_url('auth/login'); ?>';
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>