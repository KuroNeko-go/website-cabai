<?php 
    $is_edit = isset($bibit); 
    $warna_tema = $is_edit ? '#ff9800' : '#2d7a24';
    $hover_tema = $is_edit ? '#e68a00' : '#225d1c';
    $bg_ikon = $is_edit ? '#fff3e0' : '#e8f5e9';
    $ikon_tema = $is_edit ? 'fa-edit' : 'fa-box-open';
?>

<div class="row" style="--warna-tema: <?= $warna_tema ?>; --hover-tema: <?= $hover_tema ?>; --bg-ikon: <?= $bg_ikon ?>; --shadow-tema: <?= $warna_tema ?>40; --shadow-hover: <?= $warna_tema ?>60;">
    <div class="col-md-8 mx-auto">
        <div class="auth-style-card">
            
            <div class="auth-header">
                <div class="icon-circle">
                    <i class="fas <?= $ikon_tema ?>"></i>
                </div>
                <h2><?= $is_edit ? 'Edit Produk Bibit' : 'Daftar Bibit Baru' ?></h2>
                <p>Isi rincian produk bibit untuk etalase toko</p>
            </div>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger" style="border-radius: 12px;"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <?= validation_errors('<div class="alert alert-danger" style="border-radius: 12px;"><i class="fas fa-exclamation-circle"></i> ', '</div>') ?>
            
            <form action="<?= base_url($is_edit ? 'admin_bibit/update/' . $bibit['id'] : 'admin_bibit/store') ?>" method="POST" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Varietas Cabai <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <select name="cabai_id" class="form-control" required>
                                <option value="">-- Pilih Varietas Terkait --</option>
                                <?php foreach ($cabais as $c): ?>
                                    <option value="<?= $c['id'] ?>" <?= ($is_edit && $bibit['cabai_id'] == $c['id']) ? 'selected' : '' ?>>
                                        <?= $c['nama_varietas'] ?> - <?= $c['tingkat_pedas'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <i class="fas fa-leaf icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama Produk <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="text" name="nama_produk" class="form-control" value="<?= $bibit['nama_produk'] ?? '' ?>" required placeholder="Contoh: Bibit Sigantung (10gr)">
                            <i class="fas fa-box icon-prefix"></i>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Harga Asli (Rp) <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="number" name="harga" class="form-control" value="<?= $bibit['harga'] ?? '' ?>" required placeholder="Contoh: 50000">
                            <i class="fas fa-tag icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Harga Diskon (Rp)</label>
                        <div class="input-icon-wrap">
                            <input type="number" name="harga_diskon" class="form-control" value="<?= $bibit['harga_diskon'] ?? '' ?>" placeholder="Kosongkan jika tidak ada">
                            <i class="fas fa-percent icon-prefix"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label-custom">Stok (Pak) <span class="text-danger">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="number" name="stok" class="form-control" value="<?= $bibit['stok'] ?? '' ?>" required placeholder="Contoh: 150">
                            <i class="fas fa-layer-group icon-prefix"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Berat Kemasan (gram)</label>
                        <div class="input-icon-wrap">
                            <input type="number" name="berat" class="form-control" value="<?= $bibit['berat'] ?? 10 ?>" placeholder="Contoh: 10">
                            <i class="fas fa-weight-hanging icon-prefix"></i>
                        </div>
                    </div>
                </div>

                <label class="form-label-custom">Status Etalase</label>
                <div class="checkbox-wrapper">
                    <label class="checkbox-item">
                        <input type="checkbox" name="is_popular" value="1" <?= ($is_edit && $bibit['is_popular']) ? 'checked' : '' ?>>
                        <span>🔥 Jadikan Populer</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="is_new" value="1" <?= ($is_edit && $bibit['is_new']) ? 'checked' : '' ?>>
                        <span>✨ Beri Tag Baru</span>
                    </label>
                </div>
                
                <label class="form-label-custom">Deskripsi Lengkap Produk</label>
                <div class="input-icon-wrap">
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi produk bibit di sini..."><?= $bibit['deskripsi'] ?? '' ?></textarea>
                    <i class="fas fa-align-left icon-prefix"></i>
                </div>

                <label class="form-label-custom">Foto/Gambar Bibit</label>
                <div class="upload-area mb-4">
                    <?php if ($is_edit && !empty($bibit['gambar'])): ?>
                        <img src="<?= base_url($bibit['gambar']) ?>" style="height: 100px; border-radius: 12px; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); object-fit: cover;">
                    <?php else: ?>
                        <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #94a3b8; margin-bottom: 15px; display: block;"></i>
                    <?php endif; ?>
                    
                    <div class="custom-file" style="max-width: 350px; margin: 0 auto; text-align: left;">
                        <input type="file" name="gambar" class="custom-file-input" id="gambarBibit" accept="image/*">
                        <label class="custom-file-label" for="gambarBibit" style="border-radius: 10px;"><?= $is_edit ? 'Ganti gambar baru...' : 'Pilih file gambar...' ?></label>
                    </div>
                </div>
                
                <button type="submit" class="btn-submit-auth">
                    <i class="fas fa-paper-plane"></i> <?= $is_edit ? 'Simpan Perubahan' : 'Tambahkan Produk' ?>
                </button>
                <a href="<?= base_url('admin_bibit') ?>" class="btn-back-auth">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        let fileName = document.getElementById("gambarBibit").files[0].name;
        let nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>