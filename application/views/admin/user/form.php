<?php 
    $is_edit = isset($user); 
    $warna_tema = $is_edit ? '#ff9800' : '#2d7a24';
    $hover_tema = $is_edit ? '#e68a00' : '#225d1c';
    $bg_ikon = $is_edit ? '#fff3e0' : '#e8f5e9';
    $ikon_tema = $is_edit ? 'fa-user-edit' : 'fa-user-plus';
?>

<div class="row" style="--warna-tema: <?= $warna_tema ?>; --hover-tema: <?= $hover_tema ?>; --bg-ikon: <?= $bg_ikon ?>; --shadow-tema: <?= $warna_tema ?>40; --shadow-hover: <?= $warna_tema ?>60;">
    <div class="col-md-8 mx-auto">
        <div class="auth-style-card">
            
            <div class="auth-header">
                <div class="icon-circle">
                    <i class="fas <?= $ikon_tema ?>"></i>
                </div>
                <h2><?= $is_edit ? 'Edit Data User' : 'Tambah User Baru' ?></h2>
                <p><?= $is_edit ? 'Ubah informasi akun di bawah ini' : 'Buat akun untuk akses sistem' ?></p>
            </div>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger" style="border-radius: 12px;"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            
            <form action="<?= base_url($is_edit ? 'admin_user/update/' . $user['id'] : 'admin_user/store') ?>" method="POST">
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= $user['nama_lengkap'] ?? '' ?>" required placeholder="Nama Lengkap">
                            <i class="fas fa-id-card icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Username <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="text" name="username" class="form-control" value="<?= $user['username'] ?? '' ?>" required placeholder="Username">
                            <i class="fas fa-user icon-prefix"></i>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Email <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?? '' ?>" required placeholder="Email aktif">
                            <i class="fas fa-envelope icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Password <?= $is_edit ? '<small class="text-muted">(Kosongkan jika tidak diganti)</small>' : '<span class="text-danger">*</span>' ?></label>
                        <div class="input-icon-wrap">
                            <input type="password" name="password" class="form-control" placeholder="Password (Min. 6 Karakter)" <?= $is_edit ? '' : 'required' ?>>
                            <i class="fas fa-lock icon-prefix"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Role (Hak Akses) <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <select name="role" class="form-control" required>
                                <option value="user" <?= ($is_edit && $user['role'] == 'user') ? 'selected' : '' ?>>👤 User (Pembeli)</option>
                                <option value="admin" <?= ($is_edit && $user['role'] == 'admin') ? 'selected' : '' ?>>👑 Admin (Toko)</option>
                            </select>
                            <i class="fas fa-shield-alt icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Status Akun <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <select name="is_active" class="form-control" required>
                                <option value="1" <?= ($is_edit && $user['is_active'] == 1) ? 'selected' : '' ?>>✅ Aktif</option>
                                <option value="0" <?= ($is_edit && $user['is_active'] == 0) ? 'selected' : '' ?>>❌ Banned / Nonaktif</option>
                            </select>
                            <i class="fas fa-power-off icon-prefix"></i>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn-submit-auth mt-4">
                    <i class="fas fa-save"></i> <?= $is_edit ? 'Simpan Perubahan' : 'Tambahkan Akun' ?>
                </button>
                <a href="<?= base_url('admin_user') ?>" class="btn-back-auth">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar User
                </a>
            </form>
        </div>
    </div>
</div>