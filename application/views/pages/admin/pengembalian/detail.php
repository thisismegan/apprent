<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <?= $this->session->flashdata('message') ?>
            <div class="card">
                <div class="card-header">
                    Detail Sewa dari invoice <strong>#<?= $this->uri->segment('4') ?></strong>
                </div>
                <div class="card-body">
                    <p>Nama Konsumen: <b><?= ucwords($detail['name'])  ?></b></p>
                    <p>Telepon : <b><?= $detail['phone'] ?></b></p>
                    <p>Alamat: <b><?= $detail['address']  ?></b></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 280px">Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Qty</th>
                                <th>Tgl Sewa</th>
                                <th>Tgl Kembali</th>
                                <th>Lama Sewa</th>
                                <th class="text-center">Subtotal</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Tanggal Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pengembalian as $row) :  ?>
                                <tr>
                                    <td>
                                        <p><img class="img-thumbnail" style="width: 80px;" src="<?= base_url('assets/images/product/') . $row['image'] ?>" alt=""><strong><?= $row['title'] ?></strong></p>
                                    </td>
                                    <td class="text-center">Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= $row['qty'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($row['tgl_sewa'])) ?></td>
                                    <td><?= date('d-m-Y', strtotime($row['tgl_kembali'])) ?></td>
                                    <td>
                                        <?= abs((strtotime($row['tgl_kembali']) - strtotime($row['tgl_sewa']))) / (60 * 60 * 24); ?> Hari
                                    </td>
                                    <td class="text-center">Rp<?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($row['denda'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if ($row['status_pembayaran'] != 2) : ?>
                                            <b><?= $row['status_pembayaran'] == 0 ? '<span class="badge bg-warning">Menunggu Pembayaran</span>' : '<span class="badge bg-primary">Menunggu Konfirmasi</span>' ?></b>
                                        <?php else : ?>
                                            <b><?= $row['status_sewa'] == 1 ? '<span class="badge bg-success">Sudah Kembali</span>' : '<span class="badge bg-warning">Belum Kembali</span>' ?></b>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($row['status_pembayaran'] != 2) : ?>
                                        <?php else : ?>
                                            <form action="<?= base_url('admin/pengembalian/update/') . $row['id'] ?>" method="POST">
                                                <div class="input-group">
                                                    <input type="hidden" name="invoice" value="<?= $this->uri->segment('4') ?>">
                                                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                                    <input type="hidden" name="qty" value="<?= $row['qty'] ?>">
                                                    <input type="hidden" name="tgl_kembali" value="<?= $row['tgl_kembali'] ?>">
                                                    <?php if ($row['tgl_pengembalian'] == null) : ?>
                                                        <input type="date" name="tgl_pengembalian" class="form-control" value="<?= date('Y-m-d') ?>">
                                                    <?php else : ?>
                                                        <input type="date" name="tgl_pengembalian" class="form-control" value="<?= $row['tgl_pengembalian'] ?>">
                                                    <?php endif ?>
                                                    <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-check"></i></button>
                                                </div>
                                            </form>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td colspan="6"><strong>Total:</strong></td>
                                <td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($pengembalian, 'subtotal')), 0, ',', '.');   ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="7"><strong>Denda Keterlambatan: </strong></td>
                                <td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($pengembalian, 'denda')), 0, ',', '.');   ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</main>