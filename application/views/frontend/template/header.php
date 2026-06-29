<!DOCTYPE html>
<?php 
    // Tarik data keranjang dari memori session
    $keranjang_header = $this->session->userdata('cart') ? $this->session->userdata('cart') : [];

    // Hitung total JENIS produk (bukan total kuantitas fisik)
    $total_qty_keranjang = count($keranjang_header);
?>
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
    <div class="sidebar-drawer" id="sidebarDrawer">
        <button class="close-drawer" onclick="tutupMenuDuaputra()">
            <i class="fas fa-times"></i>
        </button>
        <?php if ($this->session->userdata('logged_in')) : ?>
<div style="text-align: center; padding: 20px 15px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px;">
    
    <div style="width: 80px; height: 80px; border-radius: 50%; background: #2d7a24; margin: 0 auto 12px auto; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 3px solid #1a4d14; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
        <?php 
            // Trik Sakti: Tarik data paling fresh langsung dari database
            $ci =& get_instance();
            $ci->load->model('User_model');
            $user_aktif = $ci->User_model->get_by_id($this->session->userdata('id_user'));
            
            // Cek apakah di database ada foto DAN file fisiknya beneran ada
            if (!empty($user_aktif['foto']) && file_exists(FCPATH . $user_aktif['foto'])) : 
        ?>
            <img src="<?= base_url($user_aktif['foto']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
        <?php else : ?>
            <i class="fas fa-user" style="font-size: 35px; color: white;"></i>
        <?php endif; ?>
    </div>

    <h4 style="color: white; font-size: 18px; margin: 0 0 8px 0; font-weight: 600; letter-spacing: 0.5px;">
        <?= $this->session->userdata('nama_lengkap') ?? $this->session->userdata('username') ?? 'Pelanggan' ?>
    </h4>

    <a href="<?= base_url('user/profile') ?>" class= "btn-animasi" style="display: inline-block; background: transparent; border: 1px solid #4ade80; color: #4ade80; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 500; text-decoration: none; transition: 0.3s;" onmouseover="this.style.background='#4ade80'; this.style.color='#111827';" onmouseout="this.style.background='transparent'; this.style.color='#4ade80';">
        <i class="fas fa-cog"></i> Detail
    </a>

</div>
<?php endif; ?>
        <div class="drawer-menu">
            <a href="<?= base_url() ?>"><i class="fas fa-home" style="width:25px;"></i> Beranda</a>
            <a href="<?= base_url('bibit') ?>"><i class="fas fa-seedling" style="width:25px;"></i> Produk Bibit</a>
            <a href="<?= base_url('cabai') ?>"><i class="fas fa-pepper-hot" style="width:25px;"></i> Produk Cabai</a>
            <a href="<?= base_url('cart') ?>"><i class="fas fa-shopping-cart" style="width:25px;"></i> Keranjang</a>
            
            <?php if ($this->session->userdata('id_user')) : ?>

                <a href="<?= base_url('auth/logout') ?>" class="btn-login-drawer" style="background-color: #dc3545; color: white;"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php else : ?>
                <a href="<?= base_url('auth/login') ?>" class="btn-login-drawer"><i class="fas fa-sign-in-alt"></i> Login Anggota</a>
            <?php endif; ?>
            </div>
    </div>

    <!-- NAVBAR UTAMA -->
    <nav class="navbar">
        <div class="container" style="display: flex; align-items: center; gap: 1rem;">
            <button type="button" onclick="goBack()" class="btn-animasi" style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.9); border: 1px solid rgba(45,106,79,0.2); border-radius: 999px; padding: 0.65rem 1rem; color: #2d6a4f; font-weight: 600; cursor: pointer; box-shadow: 0 6px 18px rgba(45,106,79,0.08); transition: transform 0.2s ease;">
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
                <button id="theme-toggle" class="btn btn-sm btn-outline-secondary btn-animasi" style="border-radius: 50px; padding: 4px 10px;">
                    <i class="fas fa-moon"></i>
                </button>
                <!-- Ikon Keranjang Belanja -->
                <a href="<?= base_url('cart') ?>" class="cart-icon">
                    <i class="fas fa-shopping-cart" style="font-size: 1.2rem;"></i>
                    <span class="cart-count">
                        <?= $total_qty_keranjang ?>
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