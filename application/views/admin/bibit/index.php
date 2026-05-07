<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <span><i class="fas fa-seedling"></i> Daftar Bibit Cabai</span>
        <a href="<?= base_url('admin_bibit/create') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Bibit
        </a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produk</th>
                    <th>Varietas</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bibits as $bibit): ?>
                <tr>
                    <td><?= $bibit['id'] ?></td>
                    <td>
                        <strong><?= $bibit['nama_produk'] ?></strong>
                        <?php if ($bibit['gambar']): ?>
                            <br><img src="<?= base_url($bibit['gambar']) ?>" width="40" height="40" style="object-fit: cover; border-radius: 8px; margin-top: 5px;">
                        <?php endif; ?>
                    </td>
                    <td><?= $bibit['nama_varietas'] ?></td>
                    <td>
                        Rp <?= number_format($bibit['harga'], 0, ',', '.') ?>
                        <?php if ($bibit['harga_diskon']): ?>
                            <br><span class="badge badge-success">Diskon</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($bibit['stok'] > 10): ?>
                            <span class="badge badge-success"><?= $bibit['stok'] ?> tersisa</span>
                        <?php elseif ($bibit['stok'] > 0): ?>
                            <span class="badge badge-warning"><?= $bibit['stok'] ?> tersisa</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Habis</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($bibit['is_popular']): ?>
                            <span class="badge badge-primary">🔥 Populer</span>
                        <?php endif; ?>
                        <?php if ($bibit['is_new']): ?>
                            <span class="badge badge-info">✨ New</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('admin_bibit/edit/' . $bibit['id']) ?>" class="btn btn-sm btn-primary" style="padding: 5px 10px; margin-right: 5px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('admin_bibit/delete/' . $bibit['id']) ?>" class="btn btn-sm btn-danger" style="padding: 5px 10px;" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>