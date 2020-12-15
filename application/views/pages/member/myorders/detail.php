<main role="main" class="container">
    <?= $this->session->flashdata('message')  ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Detail Orders <strong>#<?= $detail['invoice'] ?></strong>
                    <div class="float-right">
                        <?php if ($detail['status_pembayaran'] == 1) : ?>
                            <span class="badge badge-pill badge-primary">
                                Menunggu Konfirmasi
                            </span>
                        <?php elseif ($detail['status_pembayaran'] == 2) : ?>
                            <span class="badge badge-pill badge-success">
                                Sudah dibayar
                            </span>
                        <?php else : ?>
                            <span class="badge badge-pill badge-warning">
                                Belum dibayar
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="card-body">
                    <p>Nama Konsumen: <b><?= ucwords($detail['name'])  ?></b></p>
                    <p>Telepon : <b><?= $detail['phone'] ?></b></p>
                    <p>Alamat: <b><?= $detail['address']  ?></b></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 350px">Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Qty</th>
                                <th>Tgl Sewa</th>
                                <th>Tgl Kembali</th>
                                <th>Tgl Pengembalian</th>
                                <th class="text-center">Subtotal</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk as $row) :  ?>
                                <tr>
                                    <td>
                                        <p><img class="img-thumbnail" style="width: 80px;" src="<?= base_url('assets/images/product/') . $row['image'] ?>" alt=""><strong><?= $row['title'] ?></strong></p>
                                    </td>
                                    <td class="text-center">Rp<?= number_format($row['price'], 2, ',', '.') ?></td>
                                    <td class="text-center"><?= $row['qty'] ?></td>
                                    <td><?= $row['tgl_sewa'] ?></td>
                                    <td><?= $row['tgl_kembali'] ?></td>
                                    <td><?= $row['tgl_pengembalian'] ?></td>
                                    <td class="text-center"><?= number_format($row['subtotal'], 2, ',', '.') ?></td>
                                    <td>
                                        <?= $row['status_sewa'] == 1 ? '<span class="badge badge-info">Sudah Kembali</span>' : '<span class="badge badge-warning">Belum Kembali</span>' ?>
                                    </td>
                                    <td><?= number_format($row['denda'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td colspan="6"><strong>Total:</strong></td>
                                <td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($produk, 'subtotal')), 2, ',', '.');   ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="8"><strong>Denda Keterlambatan:</strong></td>
                                <td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($produk, 'denda')), 2, ',', '.');   ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php if ($detail['status_pembayaran'] >= 1) : ?>

                <?php else : ?>
                    <div class="card-footer">
                        <a href="<?= base_url('member/my_orders/confirm/') . $detail['invoice'] ?>" class="btn btn-success">Konfirmasi Pembayaran</a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>

</main>