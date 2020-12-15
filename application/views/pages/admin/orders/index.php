<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <?= $this->session->flashdata('message')  ?>
            <div class="card">
                <div class="card-header">
                    Daftar Sewa
                    <div class="float-right">
                        <form action="<?= base_url('admin/orders/search') ?>" method="POST">
                            <div class="input-group">
                                <input type="text" name="keyword" value="<?= $this->session->userdata('keyword') ?>" class="form-control form-control-sm" placeholder="Cari..." aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                                <div class="input-group-append" id="button-addon4">
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="all">All Result</option>
                                        <option value="1">Sudah Dibayar</option>
                                        <option value="0">Belum Dibayar</option>
                                    </select>
                                    <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Nama </th>
                                <th scope="col">Telepon</th>
                                <th class="text-center" scope="col">Status Pembayaran</th>
                                <th scope="col">Total</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($transaksi) : ?>
                                <?php foreach ($transaksi as $row) :  ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <th>
                                            <a href="<?= base_url('admin/orders/detail/') . $row['invoice'] ?>"><?= $row['invoice']  ?></a>
                                        </th>
                                        <td><?= ucwords($row['name'])  ?></td>
                                        <td><?= $row['phone']  ?></td>
                                        <td class="text-center">
                                            <?php if ($row['status_pembayaran'] == 0) : ?>
                                                <i class="badge badge-warning">Belum dibayar</i>
                                            <?php elseif ($row['status_pembayaran'] == 1) : ?>
                                                <i class="badge badge-primary">Menunggu Konfirmasi</i>
                                            <?php else : ?>
                                                <i class="badge badge-success">Sudah dibayar</i>
                                            <?php endif ?>
                                        </td>
                                        <td><b>Rp<?= number_format($row['total'], 2, ',', '.') ?></b></td>
                                        <td>
                                            <form action="<?= base_url('admin/orders/update/') . $row['invoice'] ?>" method="POST">
                                                <div class="input-group">
                                                    <select name="konfirmasi" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                        <option selected>--Pilihan--</option>
                                                        <?php if ($row['status_pembayaran'] >= 1) : ?>
                                                        <?php else : ?>
                                                            <option value="0">Belum dibayar</option>
                                                        <?php endif ?>
                                                        <option value="2">Sudah Dibayar</option>
                                                    </select>
                                                    <button class="btn btn-outline-secondary" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </td>
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