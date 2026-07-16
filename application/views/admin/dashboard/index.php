<div class="container-fluid pt-4 px-4">
    
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-leaf fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Varietas</p>
                    <h6 class="mb-0"><?= $total_cabai ?></h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-seedling fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Produk</p>
                    <h6 class="mb-0"><?= $total_bibit ?></h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-shopping-cart fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Transaksi</p>
                    <h6 class="mb-0"><?= $statistics['total_transaksi'] ?></h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-wallet fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Pendapatan</p>
                    <h6 class="mb-0">Rp <?= number_format($statistics['pendapatan_hari_ini'], 0, ',', '.') ?></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light text-center rounded p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Pendapatan (7 Hari)</h6>
                </div>
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="bg-light text-center rounded p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Top 5 Terlaris</h6>
                </div>
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="popularChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Transaksi Terbaru</h6>
                    <a href="<?= base_url('admin_transaksi') ?>">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Kode</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($latest_transaksi)): foreach ($latest_transaksi as $trx): ?>
                            <tr>
                                <td><?= $trx['kode_transaksi'] ?></td>
                                <td><?= $trx['nama_pelanggan'] ?></td>
                                <td>Rp <?= number_format($trx['grand_total'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if(strtolower($trx['status']) == 'paid'): ?>
                                        <span class="badge bg-success">Paid</span>
                                    <?php elseif(strtolower($trx['status']) == 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= ucfirst($trx['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada transaksi</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Stok Menipis (Peringatan)</h6>
                    <a href="<?= base_url('admin_bibit') ?>">Kelola Stok</a>
                </div>
                <div class="table-responsive">
                    <?php if (!empty($low_stock)): ?>
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($low_stock as $item): ?> 
                                    <tr>
                                        <td>
                                            <?php if(!empty($item['gambar']) && file_exists('./' . $item['gambar'])): ?>
                                                <img src="<?= base_url($item['gambar']) ?>" alt="gambar" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px;">
                                            <?php else: ?>
                                                <span class="text-muted" style="background: #e9ecef; padding: 5px 10px; border-radius: 6px;">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold"><?= $item['produk'] ?></td>
                                        <td>
                                            <span class="badge bg-danger rounded-pill px-3"><?= $item['stok'] ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= $item['link'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="text-center py-2">
                            <p class="text-success fw-bold mb-0"><i class="fas fa-check-circle me-2"></i>Semua stok aman terkendali</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. RENDER GRAFIK PENDAPATAN (GARIS)
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
                borderColor: '#009CFF', // Warna biru khas Dashmin
                backgroundColor: 'rgba(0, 156, 255, .1)', // Warna biru transparan
                borderWidth: 2,
                pointBackgroundColor: '#009CFF',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // 2. RENDER GRAFIK TOP PRODUK (LINGKARAN/PIE)
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
                borderWidth: 0 // Ngilangin border putih biar lebih smooth
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>