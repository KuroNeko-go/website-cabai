<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Duaputra - Bibit Unggul, Panen Maksimal</title>

    <!-- Google Fonts (Inter & Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons (Bawaan AdminLTE) -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    
    <!-- Theme style (AdminLTE Original) -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">

    <!-- ========================================================
         JALUR UTAMA STYLE KUSTOM DUAPUTRA (WAJIB PALING BAWAH)
         ======================================================== -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css') ?>">

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <!-- Latar Belakang Redup Gelap -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="tutupMenuDuaputra()"></div>

    <!-- LACI MENU SAMPING (SIDEBAR DRAWER) -->
    <div class="sidebar-drawer" id="sidebarDrawer">
        <button class="close-drawer" onclick="tutupMenuDuaputra()">
            <i class="fas fa-times"></i>
        </button>
        <div class="drawer-menu">
            <a href="<?= base_url() ?>"><i class="fas fa-home" style="width:25px;"></i> Beranda</a>
            <a href="<?= base_url('bibit') ?>"><i class="fas fa-seedling" style="width:25px;"></i> Produk Bibit</a>
            <a href="<?= base_url('cabai') ?>"><i class="fas fa-pepper-hot" style="width:25px;"></i> Produk Cabai</a>
            <a href="<?= base_url('cart') ?>"><i class="fas fa-shopping-cart" style="width:25px;"></i> Keranjang</a>
            <a href="<?= base_url('auth/login') ?>" class="btn-login-drawer"><i class="fas fa-sign-in-alt"></i> Login Anggota</a>
            </div>
            </div>

    <!-- NAVBAR UTAMA -->
    <nav class="navbar">
        <div class="container" style="display: flex; align-items: center; gap: 1rem;">
            <button type="button" onclick="goBack()" style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.9); border: 1px solid rgba(45,106,79,0.2); border-radius: 999px; padding: 0.65rem 1rem; color: #2d6a4f; font-weight: 600; cursor: pointer; box-shadow: 0 6px 18px rgba(45,106,79,0.08); transition: transform 0.2s ease;">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </button>
            <!-- Brand Logo Duaputra -->
            <a href="<?= base_url() ?>" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <div>
                    <span class="logo-text">DUAPUTRA</span>
                    <span class="logo-tagline">Bibit Unggul, Panen Maksimal</span>
                </div>
            </a>
            
            <!-- Bagian Kanan Navbar -->
            <div style="display: flex; align-items: center; gap: 1.25rem;">
                <!-- Ikon Keranjang Belanja -->
                <a href="<?= base_url('cart') ?>" class="cart-icon">
                    <i class="fas fa-shopping-cart" style="font-size: 1.2rem;"></i>
                    <span class="cart-count">
                        <?= ($this->cart->total_items() > 0) ? $this->cart->total_items() : '0' ?>
                    </span>
                </a>

                <!-- Tombol Burger -->
                <button class="btn-burger-kustom" onclick="bukaMenuDuaputra()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- SCRIPT KLIK BURGER -->
    <script>
        function bukaMenuDuaputra() {
            document.getElementById('sidebarDrawer').classList.add('open');
            document.getElementById('drawerOverlay').classList.add('show');
        }

        function tutupMenuDuaputra() {
            document.getElementById('sidebarDrawer').classList.remove('open');
            document.getElementById('drawerOverlay').classList.remove('show');
        }

        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '<?= base_url() ?>';
            }
        }

        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

    <!-- Pembungkus Konten Utama Aplikasi -->
    <div class="content-wrapper" style="padding-top: 90px;">
    <div class="duaputra-body">