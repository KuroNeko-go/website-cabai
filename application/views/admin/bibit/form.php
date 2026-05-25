<div class="card">
    <div class="card-header">
        <i class="fas fa-<?= isset($bibit) ? 'edit' : 'plus' ?>"></i> 
        <?= isset($bibit) ? 'Edit Bibit Cabai' : 'Tambah Bibit Cabai' ?>
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
        <form action="<?= base_url(isset($bibit) ? 'admin_bibit/update/' . $bibit['id'] : 'admin_bibit/store') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Pilih Varietas Cabai <span class="text-danger">*</span></label>
                        <select name="cabai_id" class="form-control" required>
                            <option value="">Pilih Varietas</option>
                            <?php foreach ($cabais as $c): ?>
                                <option value="<?= $c['id'] ?>" <?= (isset($bibit) && $bibit['cabai_id'] == $c['id']) ? 'selected' : '' ?>>
                                    <?= $c['nama_varietas'] ?> - <?= $c['tingkat_pedas'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk" class="form-control" value="<?= $bibit['nama_produk'] ?? '' ?>" required>
                        <small class="text-muted">Contoh: Bibit Sigantung (10gr)</small>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="harga" class="form-control" value="<?= $bibit['harga'] ?? '' ?>" required>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Harga Diskon (Rp) - Kosongkan jika tidak ada</label>
                        <input type="number" name="harga_diskon" class="form-control" value="<?= $bibit['harga_diskon'] ?? '' ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stok" class="form-control" value="<?= $bibit['stok'] ?? '' ?>" required>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Berat (gram)</label>
                        <input type="number" name="berat" class="form-control" value="<?= $bibit['berat'] ?? 10 ?>">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Gambar Bibit</label>
                        <input type="file" name="gambar" class="form-control-file" accept="image/*">
                        <?php if (isset($bibit) && $bibit['gambar']): ?>
                            <div style="margin-top: 10px;">
                                <img src="<?= base_url($bibit['gambar']) ?>" style="max-width: 100px; border-radius: 8px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Status</label>
                        <div style="display: flex; gap: 20px;">
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="is_popular" value="1" <?= (isset($bibit) && $bibit['is_popular']) ? 'checked' : '' ?>> 🔥 Populer
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="is_new" value="1" <?= (isset($bibit) && $bibit['is_new']) ? 'checked' : '' ?>> ✨ Produk Baru
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" rows="5"><?= $bibit['deskripsi'] ?? '' ?></textarea>
            </div>
            
            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('admin_bibit') ?>" class="btn btn-secondary" style="background: #6c757d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>