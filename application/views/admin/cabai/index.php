<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <span><i class="fas fa-leaf"></i> Daftar Varietas Cabai</span>
        <a href="<?= base_url('admin_cabai/create') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Cabai
        </a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Varietas</th>
                    <th>Nama Latin</th>
                    <th>Tingkat Pedas</th>
                    <th>Umur Panen</th>
                    <th>Stok</th>
                    <th>Jumlah Bibit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cabais as $cabai): ?>
                <tr>
                    <td><?= $cabai['id'] ?></td>
                    <td>
                        <strong><?= $cabai['nama_varietas'] ?></strong>
                        <?php if ($cabai['gambar']): ?>
                            <br><img src="<?= base_url($cabai['gambar']) ?>" width="40" height="40" style="object-fit: cover; border-radius: 8px; margin-top: 5px;">
                        <?php endif; ?>
                    </td>
                    <td><em><?= $cabai['nama_latin'] ?></em></td>
                    <td>
                        <?php 
                        $pedas_class = '';
                        if ($cabai['tingkat_pedas'] == 'Extra Pedas' || $cabai['tingkat_pedas'] == 'Extra Hot') {
                            $pedas_class = 'badge-danger';
                        } elseif ($cabai['tingkat_pedas'] == 'Sangat Pedas') {
                            $pedas_class = 'badge-warning';
                        } else {
                            $pedas_class = 'badge-info';
                        }
                        ?>
                        <span class="badge <?= $pedas_class ?>"><?= $cabai['tingkat_pedas'] ?></span>
                    </td>
                    <td><?= $cabai['umur_panen'] ?> HST</td>
                    <td class="align-middle">
                        <?php if($cabai['stok'] > 0): ?>
                            <span class="badge" style="background-color: #d1fae5; color: #059669; border-radius: 10px; padding: 6px 12px;">
                                <?= $cabai['stok'] ?> Tersisa
                            </span>
                        <?php else: ?>
                            <span class="badge" style="background-color: #fee2e2; color: #dc2626; border-radius: 10px; padding: 6px 12px;">
                                Habis
                            </span>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge badge-success"><?= $cabai['total_bibit'] ?? 0 ?> Bibit</span></td>
                    <td>
                        <a href="<?= base_url('admin_cabai/edit/' . $cabai['id']) ?>" class="btn btn-sm btn-primary" style="padding: 5px 10px; margin-right: 5px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('admin_cabai/delete/' . $cabai['id']) ?>" class="btn btn-sm btn-danger" style="padding: 5px 10px;" onclick="return confirm('Yakin ingin menghapus data ini? Semua bibit terkait juga akan terhapus.')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>