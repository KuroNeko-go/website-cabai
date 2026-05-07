<div class="row" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
    <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="margin: 0; font-size: 28px;"><?= $total_cabai ?></h3>
                <p style="margin: 5px 0 0; opacity: 0.9;">Total Varietas</p>
            </div>
            <i class="fas fa-leaf" style="font-size: 40px; opacity: 0.8;"></i>
        </div>
    </div>
    <div class="card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
        <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="margin: 0; font-size: 28px;"><?= $total_bibit ?></h3>
                <p style="margin: 5px 0 0; opacity: 0.9;">Total Produk</p>
            </div>
            <i class="fas fa-seedling" style="font-size: 40px; opacity: 0.8;"></i>
        </div>
    </div>
    <div class="card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
        <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="margin: 0; font-size: 28px;"><?= $statistics['total_transaksi'] ?></h3>
                <p style="margin: 5px 0 0; opacity: 0.9;">Total Transaksi</p>
            </div>
            <i class="fas fa-shopping-cart" style="font-size: 40px; opacity: 0.8;"></i>
        </div>
    </div>
    <div class="card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white;">
        <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="margin: 0; font-size: 28px;">Rp <?= number_format($statistics['total_pendapatan'], 0, ',', '.') ?></h3>
                <p style="margin: 5px 0 0; opacity: 0.9;">Pendapatan</p>
            </div>
            <i class="fas fa-money-bill-wave" style="font-size: 40px; opacity: 0.8;"></i>
        </div>
    </div>
</div>

<div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div class="card">
        <div class="card-header">⚠️ Stok Menipis</div>
        <div class="card-body">
            <?php if (!empty($low_stock)): ?>
                <table class="table">
                    <thead><tr><th>Produk</th><th>Stok</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php foreach ($low_stock as $item): ?>
                        <tr>
                            <td><?= $item['nama_produk'] ?></td>
                            <td><span class="badge badge-danger"><?= $item['stok'] ?></span></td>
                            <td><a href="<?= base_url('admin_bibit/edit/' . $item['id']) ?>" class="btn btn-sm btn-primary">Edit</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center; color: #6c757d;">✅ Semua stok aman</p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">📋 Transaksi Terbaru</div>
        <div class="card-body">
            <table class="table">
                <thead><tr><th>Kode</th><th>Pelanggan</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                    <?php foreach ($latest_transaksi as $trx): ?>
                    <tr>
                        <td><?= $trx['kode_transaksi'] ?></td>
                        <td><?= $trx['nama_pelanggan'] ?></td>
                        <td>Rp <?= number_format($trx['grand_total'], 0, ',', '.') ?></td>
                        <td><span class="badge badge-warning"><?= $trx['status'] ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>