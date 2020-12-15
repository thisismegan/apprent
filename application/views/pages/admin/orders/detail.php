<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <?= $this->session->flashdata('message') ?>
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
                                Sudah Dibayar
                            </span>
                        <?php else : ?>
                            <span class="badge badge-pill badge-warning">
                                Belum Dibayar
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
                                <th>Lama Sewa</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk as $row) :  ?>
                                <tr>
                                    <td>
                                        <p><img class="img-thumbnail" style="width: 80px;" src="<?= base_url('assets/images/product/') . $row['image'] ?>" alt=""><strong><?= $row['title'] ?></strong></p>
                                    </td>
                                    <td class="text-center">Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= $row['qty'] ?></td>
                                    <td><?= $row['tgl_sewa'] ?></td>
                                    <td><?= $row['tgl_kembali'] ?></td>
                                    <td>
                                        <?= abs((strtotime($row['tgl_kembali']) - strtotime($row['tgl_sewa']))) / (60 * 60 * 24); ?> Hari
                                    </td>
                                    <td class="text-center">Rp<?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td colspan="6"><strong>Total:</strong></td>
                                <td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($produk, 'subtotal')), 0, ',', '.');   ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <?php if ($bukti) : ?>
                    <div class="mt-2 mb-3">
                        <div class="row">
                            <div class=" col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        Bukti Transfer
                                    </div>
                                    <div class="card-body">
                                        <p>Dari rekening: <b><?= $bukti['account_number'] ?></b></p>
                                        <p>Atas nama: <b><?= ucwords($bukti['account_name']) ?></b></p>
                                        <p>Nominal: <b><?= number_format($bukti['nominal'], 0, ',', '.') ?></b></p>
                                        <p>Catatan: <b><?= $bukti['note'] ?></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="img-thumbnail" width="250px" src="<?= base_url('assets/images/bukti/') . $bukti['image'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <?php if ($detail['status_pembayaran'] == 2) : ?>

                    <?php else : ?>
                        <div class="card-footer">
                            <form action="<?= base_url('admin/orders/update/') . $detail['invoice'] ?>" method="POST">
                                <div class="input-group">
                                    <select name="konfirmasi" id="" class="form-control">
                                        <?php if ($bukti) : ?>

                                        <?php else : ?>
                                            <option value="0">Belum Dibayar</option>
                                        <?php endif ?>
                                        <option value="1">Menunggu Konfirmasi</option>
                                        <option value="2">Konfirmasi Pembayaran</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif ?>
                <?php else : ?>
                    <div class="alert alert-warning text-center">
                        Menunggu Pembayaran
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>


</main>