<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> | CabaiNusa Admin</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
        }
        
        /* Sidebar */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(135deg, #1a3e15 0%, #2d7a24 100%);
            color: white;
            transition: all 0.3s;
        }
        
        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header h3 {
            margin: 0;
            font-weight: 600;
        }
        
        .sidebar-header p {
            margin: 5px 0 0;
            font-size: 12px;
            opacity: 0.7;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .sidebar-menu .menu-item {
            padding: 12px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu .menu-item:hover,
        .sidebar-menu .menu-item.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        
        .sidebar-menu .menu-item i {
            width: 24px;
            font-size: 18px;
        }
        
        .sidebar-menu .menu-divider {
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 12px 0;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }
        
        /* Top Navbar */
        .top-navbar {
            background: white;
            padding: 15px 24px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .page-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e4620;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2e7d32;
        }
        
        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            margin-bottom: 24px;
        }
        
        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #eef2f6;
            font-weight: 600;
        }
        
        .card-body {
            padding: 24px;
        }
        
        /* Buttons */
        .btn-primary {
            background: #2d7a24;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: #1a5a12;
        }
        
        .btn-danger {
            background: #dc3545;
            border: none;
            border-radius: 10px;
        }
        
        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 12px;
            border-bottom: 1px solid #eef2f6;
            text-align: left;
        }
        
        .table th {
            background: #f8faf8;
            font-weight: 600;
            color: #2c3e2f;
        }
        
        /* Badges */
        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-primary { background: #cce5ff; color: #004085; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-280px); z-index: 1000; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-seedling"></i> CabaiNusa</h3>
        <p>Admin Panel</p>
    </div>
    <div class="sidebar-menu">
        <a href="<?= base_url('dashboard') ?>" class="menu-item <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <div class="menu-divider"></div>
        <a href="<?= base_url('admin_cabai') ?>" class="menu-item <?= $this->uri->segment(1) == 'admin_cabai' ? 'active' : '' ?>">
            <i class="fas fa-leaf"></i> Varietas Cabai
        </a>
        <a href="<?= base_url('admin_bibit') ?>" class="menu-item <?= $this->uri->segment(1) == 'admin_bibit' ? 'active' : '' ?>">
            <i class="fas fa-seedling"></i> Bibit Cabai
        </a>
        <a href="<?= base_url('admin_transaksi') ?>" class="menu-item <?= $this->uri->segment(1) == 'admin_transaksi' ? 'active' : '' ?>">
            <i class="fas fa-shopping-cart"></i> Transaksi
        </a>
        <div class="menu-divider"></div>
        <a href="<?= base_url('auth/logout') ?>" class="menu-item" onclick="return confirm('Yakin ingin logout?')">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="top-navbar">
        <div class="page-title"><?= $title ?? 'Dashboard' ?></div>
        <div class="user-info">
            <span>Halo, <?= $this->session->userdata('username') ?></span>
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>