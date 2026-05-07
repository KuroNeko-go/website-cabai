<div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-box"></i> Detail Pesanan
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi['details'] as $item): ?>
                    <tr>
                        <td><?= $item['nama_produk'] ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= $item['qty'] ?></td>
                        <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr><th colspan="3" style="text-align: right;">Subtotal</th><th>Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></th></tr>
                    <tr><th colspan="3" style="text-align: right;">Ongkos Kirim</th><th>Rp <?= number_format($transaksi['ongkir'], 0, ',', '.') ?></th></tr>
                    <tr style="background: #f0fdf4;"><th colspan="3" style="text-align: right; color: #2d7a24;">Grand Total</th><th style="color: #2d7a24; font-weight: bold;">Rp <?= number_format($transaksi['grand_total'], 0, ',', '.') ?></th></tr>
                </tfoot>
            </table>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="fas fa-user"></i> Informasi Pelanggan
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> <?= $transaksi['nama_pelanggan'] ?></p>
            <p><strong>Email:</strong> <?= $transaksi['email'] ?? '-' ?></p>
            <p><strong>Telepon:</strong> <?= $transaksi['telepon'] ?></p>
            <p><strong>Alamat:</strong> <?= nl2br($transaksi['alamat']) ?></p>
            <?php if ($transaksi['catatan']): ?>
                <p><strong>Catatan:</strong> <?= nl2br($transaksi['catatan']) ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <i class="fas fa-truck"></i> Update Status Pesanan
    </div>
    <div class="card-body">
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="<?= base_url('admin_transaksi/update_status/' . $transaksi['id'] . '/pending') ?>" class="btn btn-sm <?= $transaksi['status'] == 'pending' ? 'btn-warning' : 'btn-outline-warning' ?>">
                ⏳ Pending
            </a>
            <a href="<?= base_url('admin_transaksi/update_status/' . $transaksi['id'] . '/paid') ?>" class="btn btn-sm <?= $transaksi['status'] == 'paid' ? 'btn-info' : 'btn-outline-info' ?>">
                💳 Paid (Dibayar)
            </a>
            <a href="<?= base_url('admin_transaksi/update_status/' . $transaksi['id'] . '/processing') ?>" class="btn btn-sm <?= $transaksi['status'] == 'processing' ? 'btn-primary' : 'btn-outline-primary' ?>">
                🔧 Processing
            </a>
            <a href="<?= base_url('admin_transaksi/update_status/' . $transaksi['id'] . '/shipped') ?>" class="btn btn-sm <?= $transaksi['status'] == 'shipped' ? 'btn-info' : 'btn-outline-info' ?>">
                📦 Shipped (Dikirim)
            </a>
            <a href="<?= base_url('admin_transaksi/update_status/' . $transaksi['id'] . '/completed') ?>" class="btn btn-sm <?= $transaksi['status'] == 'completed' ? 'btn-success' : 'btn-outline-success' ?>">
                ✅ Completed (Selesai)
            </a>
            <a href="<?= base_url('admin_transaksi/update_status/' . $transaksi['id'] . '/cancelled') ?>" class="btn btn-sm <?= $transaksi['status'] == 'cancelled' ? 'btn-danger' : 'btn-outline-danger' ?>">
                ❌ Cancelled (Batal)
            </a>
        </div>
    </div>
</div>

<div style="margin-top: 20px;">
    <a href="<?= base_url('admin_transaksi') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>