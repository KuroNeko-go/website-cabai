<?php $this->load->view('frontend/template/header'); ?>

<div style="height: 100px; width: 100%; display: block;"></div>

<div class="container mt-5">
    <h2>Keranjang Belanja Anda</h2>
    <div class="row">
        <div class="col-md-8">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            
            <?php if (empty($cart_items)): ?>
                <div class="alert alert-info">Keranjang belanja Anda kosong. <a href="<?= base_url('home/index'); ?>">Belanja sekarang!</a></div>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                            <tr>
                                <td><?= $item['name']; ?></td>
                                <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                                <td>
                                    <form action="<?= base_url('cart/update'); ?>" method="post" class="form-inline">
                                        <input type="hidden" name="rowid" value="<?= $item['rowid']; ?>">
                                        <input type="number" name="qty" value="<?= $item['qty']; ?>" class="form-control form-control-sm mr-2" style="width: 60px;" min="1">
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                                <td>Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="<?= base_url('cart/remove/' . $item['rowid']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk dari keranjang?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($cart_items)): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ringkasan Belanja</h5>
                        <hr>
                        <p class="card-text d-flex justify-content-between">
                            <span>Total Item:</span>
                            <strong><?= $this->cart->total_items(); ?></strong>
                        </p>
                        <p class="card-text d-flex justify-content-between">
                            <span>Total Harga:</span>
                            <strong>Rp <?= number_format($this->cart->total(), 0, ',', '.'); ?></strong>
                        </p>
                        <a href="<?= base_url('shop/checkout'); ?>" class="btn btn-success btn-block">Lanjut ke Checkout</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('frontend/template/footer'); ?>