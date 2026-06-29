<?php 
    $is_edit = isset($cabai); 
    $warna_tema = $is_edit ? '#ff9800' : '#2d7a24';
    $hover_tema = $is_edit ? '#e68a00' : '#225d1c';
    $bg_ikon = $is_edit ? '#fff3e0' : '#e8f5e9';
    $ikon_tema = $is_edit ? 'fa-edit' : 'fa-seedling';
?>

<div class="row" style="--warna-tema: <?= $warna_tema ?>; --hover-tema: <?= $hover_tema ?>; --bg-ikon: <?= $bg_ikon ?>; --shadow-tema: <?= $warna_tema ?>40; --shadow-hover: <?= $warna_tema ?>60;">
    <div class="col-md-8 mx-auto">
        <div class="auth-style-card">
            
            <div class="auth-header">
                <div class="icon-circle">
                    <i class="fas <?= $ikon_tema ?>"></i>
                </div>
                <h2><?= $is_edit ? 'Edit Varietas Cabai' : 'Daftar Varietas Baru' ?></h2>
                <p>Lengkapi formulir di bawah dengan data yang benar</p>
            </div>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger" style="border-radius: 12px;"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <?= validation_errors('<div class="alert alert-danger" style="border-radius: 12px;"><i class="fas fa-exclamation-circle"></i> ', '</div>') ?>
            
            <form action="<?= base_url($is_edit ? 'admin_cabai/update/' . $cabai['id'] : 'admin_cabai/store') ?>" method="POST" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama Varietas <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="text" name="nama_varietas" class="form-control" value="<?= $cabai['nama_varietas'] ?? '' ?>" required placeholder="Contoh: Sigantung">
                            <i class="fas fa-leaf icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama Latin</label>
                        <div class="input-icon-wrap">
                            <input type="text" name="nama_latin" class="form-control" value="<?= $cabai['nama_latin'] ?? '' ?>" placeholder="Contoh: Capsicum frutescens">
                            <i class="fas fa-microscope icon-prefix"></i>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Tingkat Pedas <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <select name="tingkat_pedas" class="form-control" required>
                                <option value="">-- Pilih Tingkat --</option>
                                <option value="Mild" <?= ($is_edit && $cabai['tingkat_pedas'] == 'Mild') ? 'selected' : '' ?>>🌶️ Mild</option>
                                <option value="Sedang" <?= ($is_edit && $cabai['tingkat_pedas'] == 'Sedang') ? 'selected' : '' ?>>🌶️🌶️ Sedang</option>
                                <option value="Pedas" <?= ($is_edit && $cabai['tingkat_pedas'] == 'Pedas') ? 'selected' : '' ?>>🌶️🌶️🌶️ Pedas</option>
                                <option value="Sangat Pedas" <?= ($is_edit && $cabai['tingkat_pedas'] == 'Sangat Pedas') ? 'selected' : '' ?>>🌶️🌶️🌶️🌶️ Sangat Pedas</option>
                                <option value="Extra Pedas" <?= ($is_edit && $cabai['tingkat_pedas'] == 'Extra Pedas') ? 'selected' : '' ?>>🌶️🌶️🌶️🌶️🌶️ Extra Pedas</option>
                            </select>
                            <i class="fas fa-fire icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Skala Pedas (1-5)</label>
                        <div class="input-icon-wrap">
                            <select name="skala_pedas" class="form-control">
                                <option value="1" <?= ($is_edit && $cabai['skala_pedas'] == 1) ? 'selected' : '' ?>>1 - Mild</option>
                                <option value="2" <?= ($is_edit && $cabai['skala_pedas'] == 2) ? 'selected' : '' ?>>2 - Sedang</option>
                                <option value="3" <?= ($is_edit && $cabai['skala_pedas'] == 3) ? 'selected' : '' ?>>3 - Pedas</option>
                                <option value="4" <?= ($is_edit && $cabai['skala_pedas'] == 4) ? 'selected' : '' ?>>4 - Sangat Pedas</option>
                                <option value="5" <?= ($is_edit && $cabai['skala_pedas'] == 5) ? 'selected' : '' ?>>5 - Extra Pedas</option>
                            </select>
                            <i class="fas fa-thermometer-half icon-prefix"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="stok">Stok Cabai</label>
                    <input type="number" name="stok" id="stok" class="form-control" 
                        value="<?= isset($cabai['stok']) ? $cabai['stok'] : set_value('stok', '0') ?>" 
                        required min="0">
                    <?= form_error('stok', '<small class="text-danger">', '</small>') ?>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Umur Panen (Hari) <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="number" name="umur_panen" class="form-control" value="<?= $cabai['umur_panen'] ?? '' ?>" required placeholder="Contoh: 90">
                            <i class="fas fa-calendar-day icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Cocok Ditanam</label>
                        <div class="input-icon-wrap">
                            <input type="text" name="cocok_ditanam" class="form-control" value="<?= $cabai['cocok_ditanam'] ?? '' ?>" placeholder="Contoh: Dataran rendah">
                            <i class="fas fa-mountain icon-prefix"></i>
                        </div>
                    </div>
                </div>
                
                <label class="form-label-custom">Keunggulan</label>
                <div class="input-icon-wrap">
                    <textarea name="keunggulan" class="form-control" rows="3" placeholder="Contoh: Tahan hama, buah lebat..."><?= $cabai['keunggulan'] ?? '' ?></textarea>
                    <i class="fas fa-star icon-prefix"></i>
                </div>
                
                <label class="form-label-custom">Deskripsi Lengkap</label>
                <div class="input-icon-wrap">
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi lengkap varietas ini..."><?= $cabai['deskripsi'] ?? '' ?></textarea>
                    <i class="fas fa-align-left icon-prefix"></i>
                </div>

                <label class="form-label-custom">Foto/Gambar Cabai</label>
                <div class="upload-area mb-4">
                    <?php if ($is_edit && !empty($cabai['gambar'])): ?>
                        <img src="<?= base_url($cabai['gambar']) ?>" style="height: 100px; border-radius: 12px; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); object-fit: cover;">
                    <?php else: ?>
                        <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #94a3b8; margin-bottom: 15px; display: block;"></i>
                    <?php endif; ?>
                    
                    <div class="custom-file" style="max-width: 350px; margin: 0 auto; text-align: left;">
                        <input type="file" name="gambar" class="custom-file-input" id="gambarCabai" accept="image/*">
                        <label class="custom-file-label" for="gambarCabai" style="border-radius: 10px;"><?= $is_edit ? 'Ganti gambar baru...' : 'Pilih file gambar...' ?></label>
                    </div>
                </div>
                
                <button type="submit" class="btn-submit-auth">
                    <i class="fas fa-paper-plane"></i> <?= $is_edit ? 'Simpan Perubahan' : 'Tambahkan Varietas' ?>
                </button>
                <a href="<?= base_url('admin_cabai') ?>" class="btn-back-auth">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        let fileName = document.getElementById("gambarCabai").files[0].name;
        let nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>