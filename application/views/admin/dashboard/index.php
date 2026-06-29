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
                <h3 style="margin: 0; font-size: 28px;">Rp <?= number_format($statistics['pendapatan_hari_ini'], 0, ',', '.') ?></h3>
                <p style="margin: 5px 0 0; opacity: 0.9;">Pendapatan Hari Ini</p>
                <small style="display: block; margin-top: 10px; font-weight: 600; opacity: 0.85; border-top: 1px solid rgba(255,255,255,0.3); padding-top: 5px;">
                    Total Keseluruhan: Rp <?= number_format($statistics['total_pendapatan'], 0, ',', '.') ?>
                </small>
            </div>
            <i class="fas fa-money-bill-wave" style="font-size: 40px; opacity: 0.8;"></i>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px;">
    <div class="card" style="margin-bottom: 0;">
        <div class="card-header" style="background-color: white; border-bottom: 1px solid #f4f6f9;">
            <h3 class="card-title" style="margin: 0; font-weight: 600;">📈 Pendapatan (7 Hari)</h3>
        </div>
        <div class="card-body">
            <canvas id="revenueChart" style="height: 300px; width: 100%;"></canvas>
        </div>
    </div>

    <div class="card" style="margin-bottom: 0;">
        <div class="card-header" style="background-color: white; border-bottom: 1px solid #f4f6f9;">
            <h3 class="card-title" style="margin: 0; font-weight: 600;">🔥 Top 5 Terlaris</h3>
        </div>
        <div class="card-body" style="min-height: 300px;">
            <canvas id="popularChart" style="height: 100%; width: 100%;"></canvas>
        </div>
    </div>
</div>

<div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div class="card">
        <div class="card-header" style="background-color: white;">⚠️ Stok Menipis</div>
        <div class="card-body">
            <?php if (!empty($low_stock)): ?>
                <table class="table">
                    <thead><tr><th>Gambar</th><th>Produk</th><th>Stok</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (!empty($low_stock)): ?>
                            <?php foreach ($low_stock as $item): ?> 
                                <tr>
                                    <td class="align-middle">
                                        <?php if(!empty($item['gambar']) && file_exists('./' . $item['gambar'])): ?>
                                            <img src="<?= base_url($item['gambar']) ?>" alt="gambar" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px;">
                                        <?php else: ?>
                                            <span class="text-muted" style="background: #f1f5f9; padding: 10px 15px; border-radius: 6px;">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle fw-bold"><?= $item['produk'] ?></td>
                                    <td class="align-middle">
                                        <span class="badge" style="background-color: #fee2e2; color: #dc2626; border-radius: 50%; padding: 5px 10px;">
                                            <?= $item['stok'] ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="<?= $item['link'] ?>" class="btn btn-sm btn-primary" style="padding: 5px 10px; margin-right: 5px;">
                                        <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <span class="text-success"><i class="fas fa-check-square"></i> Semua stok aman</span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center; color: #6c757d;">✅ Semua stok aman</p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header" style="background-color: white;">📋 Transaksi Terbaru</div>
        <div class="card-body">
            <table class="table">
                <thead><tr><th>Kode</th><th>Pelanggan</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                    <?php foreach ($latest_transaksi as $trx): ?>
                    <tr>
                        <td><?= $trx['kode_transaksi'] ?></td>
                        <td><?= $trx['nama_pelanggan'] ?></td>
                        <td>Rp <?= number_format($trx['grand_total'], 0, ',', '.') ?></td>
                        <td>
                            <?php if($trx['status'] == 'paid'): ?>
                                <span class="badge badge-success">Paid</span>
                            <?php elseif($trx['status'] == 'Pending'): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php else: ?>
                                <span class="badge badge-secondary"><?= $trx['status'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ==========================================
    // 1. RENDER GRAFIK PENDAPATAN (GARIS)
    // ==========================================
    const labelsTanggal = <?= $grafik_tanggal ?>;
    const dataPendapatan = <?= $grafik_pendapatan ?>;

    const ctxRev = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRev, {
        type: 'line',
        data: {
            labels: labelsTanggal,
            datasets: [{
                label: 'Total Pendapatan',
                data: dataPendapatan,
                borderColor: '#2d7a24',
                backgroundColor: 'rgba(45, 122, 36, 0.1)',
                borderWidth: 3,
                pointBackgroundColor: '#2d7a24',
                pointRadius: 4,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, ticks: { callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); } } }
            },
            plugins: { tooltip: { callbacks: { label: function(context) { return ' Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID'); } } } }
        }
    });

    // ==========================================
    // 2. RENDER GRAFIK TOP PRODUK (LINGKARAN/PIE)
    // ==========================================
    const labelProduk = <?= $grafik_label_produk ?>;
    const dataTerjual = <?= $grafik_data_terjual ?>;
    const warnaProduk = <?= $grafik_warna_produk ?>;

    const ctxPop = document.getElementById('popularChart').getContext('2d');
    new Chart(ctxPop, {
        type: 'pie',
        data: {
            labels: labelProduk,
            datasets: [{
                data: dataTerjual,
                backgroundColor: warnaProduk,
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { 
                        boxWidth: 12, 
                        padding: 10, 
                        font: { size: 11 } 
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let nilai = context.parsed; 
                            let total = context.chart._metasets[context.datasetIndex].total;
                            let persen = ((nilai / total) * 100).toFixed(1) + '%';
                            return ' ' + label + ' : ' + nilai + ' terjual (' + persen + ')';
                        }
                    }
                }
            }
        }
    });
</script>