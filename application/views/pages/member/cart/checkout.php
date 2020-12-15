<main role="main" class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Formulir Data Penyewa
                </div>
                <div class="card-body">
                    <form action="<?= base_url('member/cart/checkout') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="name" placeholder="masukkan nama anda" value="<?php echo set_value('name'); ?>">
                            <?= form_error('name', '<small class="alert-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nama">Alamat Domisili</label>
                            <textarea id="" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat lengkap domisili" name="address"><?php echo set_value('address'); ?></textarea>
                            <?= form_error('address', '<small class="alert-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nama">Telepon</label>
                            <input type="numeric" class="form-control" name="telephone" placeholder="masukkan nomor telepon" value="<?php echo set_value('telephone'); ?>">
                            <?= form_error('telephone', '<small class="alert-danger">', '</small>'); ?>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Daftar Barang Yang Disewa
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Lama Sewa</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $row) :  ?>
                                        <tr>
                                            <td><?= $row['title']  ?></td>
                                            <td class="text-center"><?= $row['qty']  ?></td>
                                            <td class="text-center">
                                                <?= abs((strtotime($row['tgl_kembali']) - strtotime($row['tgl_sewa']))) / (60 * 60 * 24); ?> Hari
                                            </td>
                                            <td class="text-right">Rp<?= number_format($row['subtotal'], 0, ',', '.')  ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th class="text-right"><strong>Rp<?= number_format(array_sum(array_column($cart, 'subtotal')), 0, ',', '.');   ?></strong></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('member/cart')  ?>" class="btn btn-warning text-white"><i class="fas fa-angle-left"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</main>