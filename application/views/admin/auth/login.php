<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - CabaiNusa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a3e15 0%, #2d7a24 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Background pattern */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><path fill="white" d="M50,0 L60,40 L100,50 L60,60 L50,100 L40,60 L0,50 L40,40 Z"/></svg>');
            background-size: 60px;
            pointer-events: none;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        
        .login-card {
            background: white;
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            backdrop-filter: blur(10px);
            animation: fadeInUp 0.6s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #1a3e15, #2d7a24);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .logo-icon i {
            font-size: 32px;
            color: white;
        }
        
        .login-header h2 {
            color: #1a3e15;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .login-header p {
            color: #6c757d;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e2f;
            font-size: 14px;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0c4a0;
            font-size: 18px;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #2d7a24;
            box-shadow: 0 0 0 3px rgba(45, 122, 36, 0.1);
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #4a5b4e;
        }
        
        .forgot-link {
            color: #2d7a24;
            text-decoration: none;
            font-weight: 500;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1a3e15, #2d7a24);
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(45, 122, 36, 0.3);
        }
        
        .alert {
            padding: 14px 18px;
            border-radius: 16px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-danger {
            background: #fee2e2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #2d7a24;
        }
        
        .register-link {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #6c757d;
            font-size: 14px;
        }
        
        .register-link a {
            color: #2d7a24;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0c4a0;
        }
        
        .input-group .password-toggle {
            left: auto;
            right: 16px;
        }
        
        @media (max-width: 480px) {
            .login-card { padding: 30px 20px; }
            .login-header h2 { font-size: 24px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <h2> CabaiNusa Admin</h2>
                <p>Masuk ke panel administrator</p>
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
            
            <form action="<?= base_url('auth/do_login') ?>" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                        <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                </div>
                
                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                    <a href="<?= base_url('auth/forgot_password') ?>" class="forgot-link">Lupa password?</a>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="register-link">
                Belum punya akun? <a href="<?= base_url('auth/register') ?>">Daftar Sekarang</a>
            </div>

            <div class="register-link">
                Kembali Ke <a href="<?= base_url('home/index') ?>">Beranda</a>
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
    </script>
</body>
</html>