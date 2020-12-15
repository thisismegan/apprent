<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <?= $this->session->flashdata('message') ?>
            <div class="card">
                <div class="card-header">
                    <h4>Form Pengembalian Produk</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-6">
                        <form action="<?= base_url('admin/pengembalian/search') ?>" method="POST">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Masukan invoice">
                                <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Nama </th>
                            <th scope="col">Telepon</th>
                            <th class="text-center" scope="col">Status Pembayaran</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($produk) : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($produk as $kembali) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <th>
                                        <a href="<?= base_url("admin/pengembalian/detail/") . $kembali['invoice'] ?>"> <?= $kembali['invoice'] ?></a>
                                    </th>
                                    <td><?= ucwords($kembali['name']) ?></td>
                                    <td><?= $kembali['phone'] ?></td>
                                    <td class="text-center"><?= $kembali['status_pembayaran'] == 2 ? '<span class="badge bg-success">Sudah Bayar</span>' : '<span class="badge bg-warning">Belum bayar</span>' ?></td>
                                    <td><b>Rp<?= number_format($kembali['total'], 2, ',', '.') ?></b></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-warning text-center" role="alert">
                                        Data tidak ditemukan
                                    </div>
                                </td>
                            </tr>

                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</main>