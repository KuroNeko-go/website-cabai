<?php $this->load->view('frontend/template/header'); ?>

<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-12">
            
            <!-- Breadcrumb (Biar navigasinya jelas) -->

            <div class="card shadow-sm" style="border-radius: 15px; border: none;">
                <div class="card-header bg-white" style="border-bottom: 2px solid #f4f6f9; border-radius: 15px 15px 0 0; padding: 20px;">
                    <h4 class="m-0 font-weight-bold" style="color: #2d6a4f;">
                        <i class="fas fa-clipboard-list mr-2"></i> Riwayat Pesanan Saya
                    </h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-nowrap" id="tabelRiwayat">
                            <thead style="background-color: #f8f9fa; color: #495057;">
                                <tr>
                                    <th class="border-0 px-4">No. Pesanan</th>
                                    <th class="border-0">Tanggal</th>
                                    <th class="border-0">Total Belanja</th>
                                    <th class="border-0 text-center">Status</th>
                                    <th class="border-0 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($riwayat)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-box-open fa-3x mb-3" style="color: #dee2e6;"></i>
                                                <h5>Belum ada pesanan</h5>
                                                <p>Yuk, mulai belanja bibit dan cabai segar di Duaputra!</p>
                                                <a href="<?= base_url('cabai') ?>" class="btn btn-success mt-2" style="border-radius: 20px; background-color: #2d6a4f; border: none;">Mulai Belanja</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($riwayat as $trx): ?>
                                        <tr>
                                            <td class="px-4 align-middle font-weight-bold text-dark">
                                                <?= $trx['kode_transaksi'] ?>
                                            </td>
                                            <td class="align-middle text-muted">
                                                <?= date('d M Y H:i', strtotime($trx['created_at'])) ?> WIB
                                            </td>
                                            <td class="align-middle font-weight-bold text-success">
                                                Rp <?= number_format($trx['grand_total'], 0, ',', '.') ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php 
                                                    // Logika warna badge status
                                                    if ($trx['status'] == 'pending') {
                                                        echo '<span class="badge badge-warning px-3 py-2 text-dark" style="border-radius: 20px;">Menunggu Pembayaran</span>';
                                                    } elseif ($trx['status'] == 'paid') {
                                                        echo '<span class="badge badge-success px-3 py-2" style="border-radius: 20px;">Dibayar</span>';
                                                    } elseif ($trx['status'] == 'processing') {
                                                        echo '<span class="badge badge-info px-3 py-2" style="border-radius: 20px;">Diproses</span>';
                                                    } elseif ($trx['status'] == 'shipped') {
                                                        echo '<span class="badge badge-primary px-3 py-2" style="border-radius: 20px;">Dikirim</span>';
                                                    } elseif ($trx['status'] == 'completed') {
                                                        echo '<span class="badge px-3 py-2" style="background-color: #2d6a4f; color: white; border-radius: 20px;">Selesai</span>';
                                                    } elseif ($trx['status'] == 'cancelled') {
                                                        echo '<span class="badge badge-danger px-3 py-2" style="border-radius: 20px;">Dibatalkan</span>';
                                                    } else {
                                                        echo '<span class="badge badge-secondary px-3 py-2" style="border-radius: 20px;">'.ucfirst($trx['status']).'</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="<?= base_url('user/detail_riwayat/' . $trx['kode_transaksi']) ?>" class="btn btn-sm btn-outline-success" style="border-radius: 20px; font-weight: 500;">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php $this->load->view('frontend/template/footer'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabelRiwayat').DataTable({
            "pageLength": 10,        // Maksimal 10 baris per halaman
            "lengthChange": false,   // Hilangin dropdown pilihan baris biar UI tetep clean
            "ordering": false,       // Matiin panah sorting (karena dari database udah diurutin paling baru)
            "language": {
                "search": "Cari Pesanan:",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                },
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ pesanan",
                "infoEmpty": "Tidak ada pesanan untuk ditampilkan",
                "zeroRecords": "Nomor pesanan tidak ditemukan"
            }
        });
    });
</script>