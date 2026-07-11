<?php $this->load->view('frontend/template/header'); ?>

<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-12">

            <div class="card shadow-sm" style="border-radius: 15px; border: none;">
                <div class="card-header bg-white d-flex justify-content-between align-items-center" style="border-bottom: 2px solid #f4f6f9; border-radius: 15px 15px 0 0; padding: 20px;">
                    <h5 class="m-0 font-weight-bold" style="color: #2d6a4f;">
                        Pesanan: <?= $transaksi['kode_transaksi'] ?>
                    </h5>
                    <?php 
                        if ($transaksi['status'] == 'pending') {
                            echo '<span class="badge badge-warning px-3 py-2 text-dark" style="border-radius: 20px;">Menunggu Pembayaran</span>';
                        } elseif ($transaksi['status'] == 'paid') {
                            echo '<span class="badge badge-success px-3 py-2" style="border-radius: 20px;">Sudah Dibayar</span>';
                        } else {
                            echo '<span class="badge badge-secondary px-3 py-2" style="border-radius: 20px;">'.ucfirst($transaksi['status']).'</span>';
                        }
                    ?>
                </div>
                
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-muted mb-3">Informasi Pengiriman</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="120" class="text-muted">Nama</td>
                                    <td>: <strong><?= $transaksi['nama_pelanggan'] ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">No. WhatsApp</td>
                                    <td>: <?= $transaksi['telepon'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Alamat</td>
                                    <td>: <?= $transaksi['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Catatan</td>
                                    <td>: <?= empty($transaksi['catatan']) ? '-' : $transaksi['catatan'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-muted mb-3">Informasi Pembayaran</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="120" class="text-muted">Waktu Order</td>
                                    <td>: <?= date('d F Y, H:i', strtotime($transaksi['created_at'])) ?> WIB</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Total Harga</td>
                                    <td>: Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Ongkos Kirim</td>
                                    <td>: Rp <?= number_format($transaksi['ongkir'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="color: #2d6a4f; font-size: 1.1em;">Grand Total</td>
                                    <td class="font-weight-bold" style="color: #2d6a4f; font-size: 1.1em;">: Rp <?= number_format($transaksi['grand_total'], 0, ',', '.') ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <h6 class="font-weight-bold text-muted mb-3">Rincian Produk</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Tipe</th>
                                    <th class="text-right">Harga Satuan</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $item): ?>
                                <tr>
                                    <td><?= $item['nama_produk'] ?></td>
                                    <td class="text-center"><span class="badge badge-info"><?= ucfirst($item['tipe_produk']) ?></span></td>
                                    <td class="text-right">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= $item['qty'] ?></td>
                                    <td class="text-right font-weight-bold">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right mt-4">
                        <a href="<?= base_url('user/riwayat') ?>" class="btn btn-secondary" style="border-radius: 20px; padding: 8px 25px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Riwayat
                        </a>
                        <?php if ($transaksi['status'] == 'pending'): ?>
                            <!-- Opsional: Kalau mau kasih tombol bayar lagi khusus yg masih pending -->
                            <!-- Kodingan Tombol Lanjutkan Pembayaran yang Bener -->
                        <a href="<?= base_url('cart/lanjut_bayar/' . $transaksi['kode_transaksi']) ?>" class="btn btn-success ml-2" style="border-radius: 20px; background-color: #2d6a4f; padding: 8px 25px;">
                            <i class="fas fa-wallet mr-1"></i> Lanjutkan Pembayaran
                        </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view('frontend/template/footer'); ?>