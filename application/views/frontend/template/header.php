<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'CabaiNusa' ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #1a2e1a;
        }
        
        /* Modern Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 16px 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #1a3e15, #2d7a24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }
        
        .logo i {
            background: none;
            -webkit-text-fill-color: #2d7a24;
            margin-right: 8px;
        }
        
        .nav-menu {
            display: flex;
            gap: 32px;
            align-items: center;
        }
        
        .nav-menu a {
            text-decoration: none;
            color: #2c3e2f;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-menu a:hover {
            color: #2d7a24;
        }
        
        .cart-icon {
            position: relative;
            font-size: 20px;
        }
        
        .cart-count {
            position: absolute;
            top: -10px;
            right: -12px;
            background: #dc3545;
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 20px;
        }
        
        /* Hero Section - Devfolio Style */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #f0f9ef 0%, #e8f3e4 100%);
            padding-top: 80px;
        }
        
        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        
        .hero-text h1 {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #1a3e15, #2d7a24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero-text p {
            font-size: 18px;
            color: #4a5b4e;
            margin-bottom: 30px;
        }
        
        .hero-buttons {
            display: flex;
            gap: 16px;
        }
        
        .btn-primary {
            background: #2d7a24;
            color: white;
            padding: 12px 28px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary:hover {
            background: #1a5a12;
            transform: translateY(-2px);
        }
        
        .btn-outline {
            border: 2px solid #2d7a24;
            color: #2d7a24;
            padding: 12px 28px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-outline:hover {
            background: #2d7a24;
            color: white;
        }
        
        .hero-image {
            text-align: center;
        }
        
        .hero-image img {
            max-width: 100%;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        /* Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }
        
        .section-header h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        
        .section-header p {
            color: #6c757d;
        }
        
        /* Product Grid - E-commerce Style */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .product-image {
            aspect-ratio: 1 / 1;
            background: #f8faf7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        
        .product-image i {
            font-size: 60px;
            color: #2d7a24;
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 8px;
        }
        
        .product-price {
            color: #2d7a24;
            font-weight: 700;
            font-size: 20px;
        }
        
        .product-price small {
            font-size: 12px;
            font-weight: normal;
            color: #6c757d;
            text-decoration: line-through;
        }
        
        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, #1a3e15, #2d7a24);
            color: white;
            padding: 60px 0;
            border-radius: 40px;
            margin: 60px 0;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            text-align: center;
        }
        
        .stat-number {
            font-size: 42px;
            font-weight: 800;
        }
        
        /* Footer */
        .footer {
            background: #0a1f08;
            color: white;
            padding: 60px 0 30px;
            margin-top: 60px;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }
        
        .footer a {
            color: #a0c4a0;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-content { grid-template-columns: 1fr; text-align: center; }
            .hero-text h1 { font-size: 36px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; }
            .footer-grid { grid-template-columns: 1fr; }
            .products-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="nav-container">
            <a href="<?= base_url('/') ?>" class="logo">
                <i class="fas fa-seedling"></i> CabaiNusa
            </a>
            <div class="nav-menu">
                <a href="<?= base_url('/') ?>">Beranda</a>
                <a href="<?= base_url('/cabai') ?>">Jenis Cabai</a>
                <a href="<?= base_url('/bibit') ?>">Toko Bibit</a>
                <a href="<?= base_url('/auth/login') ?>">Login</a>
                <a href="<?= base_url('/cart') ?>" class="cart-icon" id="cartIconBtn">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-count" id="cartCount">0</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<main>