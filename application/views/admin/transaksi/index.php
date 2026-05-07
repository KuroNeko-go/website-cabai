<div class="card">
    <div class="card-header">
        <i class="fas fa-shopping-cart"></i> Daftar Transaksi
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaksis as $trx): ?>
                <tr>
                    <td><strong><?= $trx['kode_transaksi'] ?></strong></td>
                    <td>
                        <?= $trx['nama_pelanggan'] ?><br>
                        <small class="text-muted"><?= $trx['telepon'] ?></small>
                    </td>
                    <td>Rp <?= number_format($trx['grand_total'], 0, ',', '.') ?></td>
                    <td>
                        <?php
                        $status_class = [
                            'pending' => 'badge-warning',
                            'paid' => 'badge-info',
                            'processing' => 'badge-primary',
                            'shipped' => 'badge-info',
                            'completed' => 'badge-success',
                            'cancelled' => 'badge-danger'
                        ];
                        $class = $status_class[$trx['status']] ?? 'badge-secondary';
                        ?>
                        <span class="badge <?= $class ?>"><?= ucfirst($trx['status']) ?></span>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($trx['created_at'])) ?></td>
                    <td>
                        <a href="<?= base_url('admin_transaksi/detail/' . $trx['id']) ?>" class="btn btn-sm btn-info" style="padding: 5px 10px;">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>