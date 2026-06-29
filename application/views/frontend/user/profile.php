<div class="container mt-5 mb-5" style="--warna-tema: #2d7a24; --hover-tema: #225d1c; --bg-ikon: #e8f5e9; --shadow-tema: #2d7a2440; --shadow-hover: #2d7a2460;">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="auth-style-card">
                
                <div class="auth-header">
                    <div class="icon-circle">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h2>Profil Saya</h2>
                    <p>Kelola informasi dan foto akun Anda</p>
                </div>
                
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success" style="border-radius: 12px;">
                        <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger" style="border-radius: 12px;">
                        <i class="fas fa-exclamation-triangle"></i> <?= $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>
                
                <form action="<?= base_url('user/update_profile') ?>" method="POST" enctype="multipart/form-data">
                    
                    <label class="form-label-custom text-center" style="display: block;">Foto Profil</label>
                    <div class="upload-area mb-4">
                        <?php if (!empty($user['foto'])): ?>
                            <img src="<?= base_url($user['foto']) ?>" style="height: 120px; width: 120px; border-radius: 50%; object-fit: cover; border: 4px solid #e8f5e9; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <?php else: ?>
                            <i class="fas fa-user-circle" style="font-size: 60px; color: #94a3b8; margin-bottom: 15px; display: block;"></i>
                        <?php endif; ?>
                        
                        <div class="custom-file" style="max-width: 350px; margin: 0 auto; text-align: left;">
                            <input type="file" name="foto" class="custom-file-input" id="fotoProfil" accept="image/png, image/jpeg, image/jpg">
                            <label class="custom-file-label" for="fotoProfil" style="border-radius: 10px;">Pilih foto baru...</label>
                        </div>
                        <small class="text-muted d-block mt-2">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label-custom">Nama Lengkap</label>
                            <div class="input-icon-wrap">
                                <input type="text" name="nama_lengkap" class="form-control" value="<?= $user['nama_lengkap'] ?? '' ?>" required>
                                <i class="fas fa-id-card icon-prefix"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Username</label>
                            <div class="input-icon-wrap">
                                <input type="text" name="username" class="form-control" value="<?= $user['username'] ?? '' ?>" required>
                                <i class="fas fa-user icon-prefix"></i>
                            </div>
                        </div>
                    </div>
                    
                    <label class="form-label-custom">Email</label>
                    <div class="input-icon-wrap">
                        <input type="email" name="email" class="form-control" value="<?= $user['email'] ?? '' ?>" required>
                        <i class="fas fa-envelope icon-prefix"></i>
                    </div>
                    
                    <label class="form-label-custom">Ganti Password <small class="text-muted">(Kosongkan jika tidak ingin ganti)</small></label>
                    <div class="input-icon-wrap">
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password baru (Min. 6 Karakter)">
                        <i class="fas fa-lock icon-prefix"></i>
                    </div>
                    
                    <button type="submit" class="btn-submit-auth mt-4">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script buat nampilin nama file foto yang dipilih
    let inputFoto = document.getElementById("fotoProfil");
    if(inputFoto) {
        inputFoto.addEventListener('change', function(e) {
            let fileName = this.files[0].name;
            let nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    }
</script>