<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?= $title ?? 'Admin Panel' ?> | CabaiNusa Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="<?= base_url('assets/dist/img/fav.png') ?>" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="<?= base_url('assets/dashmin/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/dashmin/css/style.css') ?>" rel="stylesheet">

</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        
        <!-- SIDEBAR -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="<?= base_url('dashboard') ?>" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-seedling me-2"></i><span class="nav-text">CabaiNusa</span></h3>
                </a>
                
                <!-- Dibungkus class user-profile-area biar gampang diumpetin -->
                <div class="d-flex align-items-center ms-4 mb-4 user-profile-area">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?= base_url('assets/dashmin/img/user.jpg') ?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?= $this->session->userdata('username') ?></h6>
                        <span>Administrator</span>
                    </div>
                </div>
                
                <div class="navbar-nav w-100">
                    <!-- Teksnya gw bungkus <span class="nav-text"> semua -->
                    <a href="<?= base_url('dashboard') ?>" class="nav-item nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
                        <i class="fa fa-tachometer-alt me-2"></i><span class="nav-text">Dashboard</span>
                    </a>
                    <a href="<?= base_url('admin_cabai') ?>" class="nav-item nav-link <?= $this->uri->segment(1) == 'admin_cabai' ? 'active' : '' ?>">
                        <i class="fas fa-leaf me-2"></i><span class="nav-text">Varietas Cabai</span>
                    </a>
                    <a href="<?= base_url('admin_bibit') ?>" class="nav-item nav-link <?= $this->uri->segment(1) == 'admin_bibit' ? 'active' : '' ?>">
                        <i class="fas fa-seedling me-2"></i><span class="nav-text">Bibit Cabai</span>
                    </a>
                    <a href="<?= base_url('admin_transaksi') ?>" class="nav-item nav-link <?= $this->uri->segment(1) == 'admin_transaksi' ? 'active' : '' ?>">
                        <i class="fas fa-shopping-cart me-2"></i><span class="nav-text">Transaksi</span>
                    </a>
                    <a href="<?= base_url('admin_user') ?>" class="nav-item nav-link <?= $this->uri->segment(1) == 'admin_user' ? 'active' : '' ?>">
                        <i class="fas fa-users me-2"></i><span class="nav-text">Kelola User</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- WRAPPER KONTEN KANAN -->
        <div class="content">
            <!-- NAVBAR ATAS -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?= base_url('assets/dashmin/img/user.jpg') ?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?= $this->session->userdata('username') ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="<?= base_url('auth/logout') ?>" id="tombolLogout" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>