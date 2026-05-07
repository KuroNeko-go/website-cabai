<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - CabaiNusa</title>
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
        }
        
        .forgot-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }
        
        .forgot-card {
            background: white;
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
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
        
        .forgot-header {
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
        
        .forgot-header h2 {
            color: #1a3e15;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .forgot-header p {
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
        }
        
        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #2d7a24;
            box-shadow: 0 0 0 3px rgba(45, 122, 36, 0.1);
        }
        
        .btn-reset {
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
        
        .btn-reset:hover {
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
        
        .back-link {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        
        .back-link a {
            color: #2d7a24;
            text-decoration: none;
            font-weight: 500;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
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
</body>
</html>