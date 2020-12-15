<main role="main" class="container">
    <?= $this->session->flashdata('message')  ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    Cart
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Harga Sewa</th>
                                <th class="text-center" width="15%">Jumlah</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Kembali</th>
                                <th></th>
                                <th class="text-center">Subtotal Sewa</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($cart) : ?>
                                <?php foreach ($cart as $row) : ?>
                                    <tr>
                                        <td>
                                            <p><img style="width: 80px;" src="<?= base_url('assets/images/product/') . $row['image'] ?>" alt="">
                                                <strong><?= substr($row['title'], 0, 30) ?></strong></p>
                                        </td>
                                        <td class="text-center">Rp<?= number_format($row['price'], 0, ',', '.')  ?></td>
                                        <td>
                                            <form action="<?= base_url('member/cart/update') ?>" method="POST">
                                                <input type="hidden" value="<?= $row['price'] ?>" name="price">
                                                <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                                <div class=" input-group">
                                                    <input type="number" name="qty" value="<?= $row['qty'] ?>" min="1" class="form-control text-center">
                                                </div>
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" name="tgl_sewa" value="<?= $row['tgl_sewa'] ?>">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" name="tgl_kembali" value="<?= $row['tgl_kembali'] ?>">
                                        </td>
                                        <td> <button class="btn btn-info" type="submit"><i class="fas fa-check"></i></button></td>
                                        </form>
                                        <td class="text-center">Rp<?= number_format($row['subtotal'], 0, ',', '.')  ?></td>
                                        <td>
                                            <form action="<?= base_url('member/cart/delete') ?>" method="POST">
                                                <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <div class="alert alert-warning text-center" role="alert">
                                    Keranjang Sewa Masih Kosong
                                </div>
                            <?php endif ?>
                            <tr>
                                <td colspan="6"><strong>Total:</strong></td>
                                <td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($cart, 'subtotal')), 0, ',', '.');   ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <?php if ($cart == null) : ?>

                    <?php else : ?>
                        <a href="<?= base_url('member/cart/checkout') ?>" class="btn btn-success float-right">Lanjutkan <i class="fas fa-angle-right"></i></a>
                    <?php endif ?>

                    <a href="<?= base_url()  ?>" class="btn btn-warning text-white"><i class="fas fa-angle-left"></i> Kembali Sewa</a>
                </div>
            </div>
        </div>
    </div>

</main>