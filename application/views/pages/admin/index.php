<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="card mt-3 pt-3 pl-3 pb-3 text-center">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Jumlah Orderan Masuk
                    </div>
                    <div class="card-body">
                        <img style="width: 100px;" src="<?= base_url('assets/images/icon/orders.png') ?>" alt="">
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('admin/orders') ?>" class="btn btn-success"><?= $this->db->count_all_results('transaksi') ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Jumlah User Terdaftar
                    </div>
                    <div class="card-body">
                        <img style="width: 100px;" src="<?= base_url('assets/images/icon/users.png') ?>" alt="">
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('admin/customers') ?>" class="btn btn-success"><?= $this->db->count_all_results('user') ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Jumlah Produk
                    </div>
                    <div class="card-body">
                        <img style="width: 100px;" src="<?= base_url('assets/images/icon/product.png') ?>" alt="">
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('admin/product') ?>" class="btn btn-success"><?= $this->db->count_all_results('product') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>