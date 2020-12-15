<main role="main" class="container">
    <div class="row">
        <?php $this->load->view('layout/menu') ?>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4><?= $detail['title'] ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-thumbnail" style="width: 200px;" src="<?= base_url('assets/images/product/') . $detail['image'] ?>">
                        </div>
                        <div class="col-md-8">
                            <p>
                                <?= $detail['description'] ?>
                            </p>
                            <hr>
                            Harga: <strong>Rp<?= number_format($detail['price'], 0, ',', '.')   ?></strong>
                            <hr>
                            Stock <?= $detail['is_available'] == 1 ? '<span class="badge badge-primary">Tersedia</span>' : '<span class="badge badge-danger">Kosong</span>'  ?>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-warning text-white" href="<?= base_url() ?>"><i class="fas fa-angle-left"></i> Kembali</a>
                        </div>
                        <div class="col-md-6">
                            <form action="<?= base_url('member/cart/create') ?>" method="POST">
                                <input type="hidden" name="price" value="<?= $detail['price']; ?>">
                                <input type="hidden" name="kode_produk" value="<?= $detail['kode_produk']; ?>">
                                <div class="input-group">
                                    <input name="qty" type="number" value="1" min="1" class="form-control" <?= $detail['is_available'] == 0 ? 'disabled' : '' ?>>
                                    <div class="input-group-append">
                                        <button type="submit" <?= $detail['is_available'] == 0 ? 'disabled' : '' ?> class="btn btn-primary">Add to Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>