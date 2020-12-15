<main role="main" class="container">
    <?= $this->session->flashdata('message') ?>
    <div class="row">
        <?php $this->load->view('layout/menu') ?>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Konfirmasi Pembayaran
                    <div class="float-right">
                        <?php if ($confirm['status_pembayaran'] == 0) : ?>
                            <span class="badge badge-pill badge-warning">
                                Menunggu Pembayaran
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <form action="<?= base_url('member/my_orders/confirm/') . $confirm['invoice'] ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $confirm['id'] ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Transaksi</label>
                            <input type="text" class="form-control" value="<?= $confirm['invoice'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Dari rekening a.n</label>
                            <input type="text" name="name" class="form-control">
                            <?php echo form_error('name', '<small class="alert-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Rekening</label>
                            <input type="number" name="account_number" class="form-control">
                            <?php echo form_error('account_number', '<small class="alert-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Sebesar</label>
                            <input type="number" name="nominal" class="form-control">
                            <?php echo form_error('nominal', '<small class="alert-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Catatan</label>
                            <textarea cols="30" name="catatan" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Bukti Transfer</label>
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Konfirmasi Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>