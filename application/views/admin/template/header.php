<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> | CabaiNusa Admin</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/dist/img/fav.png') ?>">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css?v=') . time(); ?>">

    
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
        <a href="<?= base_url('admin_user') ?>" class="menu-item <?= $this->uri->segment(1) == 'admin_user' ? 'active' : '' ?>">
            <i class="fas fa-users"></i> Kelola User
        </a>
        <div class="menu-divider"></div>
        <a href="<?= base_url('auth/logout') ?>" id="tombolLogout" class="menu-item">
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