<main role="main" class="container">
    <div class="row">
        <?php $this->load->view('layout/menu') ?>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Daftar Sewa
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Nama</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php if ($myorders) : ?>
                            <tbody>
                                <?php foreach ($myorders as $row) :  ?>
                                    <tr>
                                        <td> <a href="<?= base_url('member/my_orders/detail/') . $row['invoice']  ?>"><strong>#<?= $row['invoice']  ?>
                                                    <?  ?></strong></a></td>
                                        <td><?= $row['name']  ?></td>
                                        <td>Rp<?= number_format($row['total'], 2, ',', '.')  ?></td>
                                        <td>
                                            <?php if ($row['status_pembayaran'] == 1) : ?>
                                                <span class="badge badge-pill badge-primary">Menunggu konfirmasi</span>
                                            <?php elseif ($row['status_pembayaran'] == 2) : ?>
                                                <span class="badge badge-pill badge-success">Sudah dibayar</span>
                                            <?php else : ?>
                                                <span class="badge badge-pill badge-warning">Menunggu Pembayaran</span>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        <?php else : ?>
                            <tbody>
                                <tr>
                                    <div class="alert alert-warning text-center" role="alert">
                                        Belum ada transaksi barang sewa
                                    </div>
                                </tr>
                            </tbody>
                        <?php endif ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main>