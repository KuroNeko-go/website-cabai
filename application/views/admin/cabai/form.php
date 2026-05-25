<div class="card">
    <div class="card-header">
        <i class="fas fa-<?= isset($cabai) ? 'edit' : 'plus' ?>"></i> 
        <?= isset($cabai) ? 'Edit Varietas Cabai' : 'Tambah Varietas Cabai' ?>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('error')): ?>
            <div style="margin-bottom: 20px; padding: 15px; border-radius: 12px; background: #f8d7da; color: #842029; border: 1px solid #f5c2c7;">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div style="margin-bottom: 20px; padding: 15px; border-radius: 12px; background: #d1e7dd; color: #0f5132; border: 1px solid #badbcc;">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>
        <?= validation_errors('<div style="margin-bottom: 20px; padding: 15px; border-radius: 12px; background: #f8d7da; color: #842029; border: 1px solid #f5c2c7;">', '</div>') ?>
        <form action="<?= base_url(isset($cabai) ? 'admin_cabai/update/' . $cabai['id'] : 'admin_cabai/store') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Nama Varietas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_varietas" class="form-control" value="<?= $cabai['nama_varietas'] ?? '' ?>" required>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Nama Latin</label>
                        <input type="text" name="nama_latin" class="form-control" value="<?= $cabai['nama_latin'] ?? '' ?>" placeholder="Contoh: Capsicum frutescens">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Tingkat Pedas <span class="text-danger">*</span></label>
                        <select name="tingkat_pedas" class="form-control" required>
                            <option value="">Pilih Tingkat Pedas</option>
                            <option value="Mild" <?= (isset($cabai) && $cabai['tingkat_pedas'] == 'Mild') ? 'selected' : '' ?>>🌶️ Mild (Tidak Pedas)</option>
                            <option value="Sedang" <?= (isset($cabai) && $cabai['tingkat_pedas'] == 'Sedang') ? 'selected' : '' ?>>🌶️🌶️ Sedang</option>
                            <option value="Pedas" <?= (isset($cabai) && $cabai['tingkat_pedas'] == 'Pedas') ? 'selected' : '' ?>>🌶️🌶️🌶️ Pedas</option>
                            <option value="Sangat Pedas" <?= (isset($cabai) && $cabai['tingkat_pedas'] == 'Sangat Pedas') ? 'selected' : '' ?>>🌶️🌶️🌶️🌶️ Sangat Pedas</option>
                            <option value="Extra Pedas" <?= (isset($cabai) && $cabai['tingkat_pedas'] == 'Extra Pedas') ? 'selected' : '' ?>>🌶️🌶️🌶️🌶️🌶️ Extra Pedas</option>
                        </select>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Skala Pedas (1-5)</label>
                        <select name="skala_pedas" class="form-control">
                            <option value="1" <?= (isset($cabai) && $cabai['skala_pedas'] == 1) ? 'selected' : '' ?>>1 - Mild</option>
                            <option value="2" <?= (isset($cabai) && $cabai['skala_pedas'] == 2) ? 'selected' : '' ?>>2 - Sedang</option>
                            <option value="3" <?= (isset($cabai) && $cabai['skala_pedas'] == 3) ? 'selected' : '' ?>>3 - Pedas</option>
                            <option value="4" <?= (isset($cabai) && $cabai['skala_pedas'] == 4) ? 'selected' : '' ?>>4 - Sangat Pedas</option>
                            <option value="5" <?= (isset($cabai) && $cabai['skala_pedas'] == 5) ? 'selected' : '' ?>>5 - Extra Pedas</option>
                        </select>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Umur Panen (Hari) <span class="text-danger">*</span></label>
                        <input type="number" name="umur_panen" class="form-control" value="<?= $cabai['umur_panen'] ?? '' ?>" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Cocok Ditanam</label>
                        <input type="text" name="cocok_ditanam" class="form-control" value="<?= $cabai['cocok_ditanam'] ?? '' ?>" placeholder="Contoh: Dataran rendah - tinggi">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Gambar Cabai</label>
                        <input type="file" name="gambar" class="form-control-file" accept="image/*">
                        <?php if (isset($cabai) && $cabai['gambar']): ?>
                            <div style="margin-top: 10px;">
                                <img src="<?= base_url($cabai['gambar']) ?>" style="max-width: 100px; border-radius: 8px;">
                                <p class="text-muted" style="font-size: 12px; margin-top: 5px;">Kosongkan jika tidak ingin mengubah gambar</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Keunggulan</label>
                        <textarea name="keunggulan" class="form-control" rows="3" placeholder="Contoh: Tahan hama, buah lebat"><?= $cabai['keunggulan'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Deskripsi Lengkap</label>
                <textarea name="deskripsi" class="form-control" rows="5" placeholder="Deskripsi detail tentang varietas cabai ini"><?= $cabai['deskripsi'] ?? '' ?></textarea>
            </div>
            
            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('admin_cabai') ?>" class="btn btn-secondary" style="background: #6c757d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>