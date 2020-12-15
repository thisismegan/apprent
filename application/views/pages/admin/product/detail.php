<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <div class="card">
                <div class="card-header text-center">
                    <b> <?= ucwords($detail['product_title'])  ?></b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/images/product/') . $detail['image'] ?>" class="img-thumbnail" style="width: 350px;" alt="...">
                        </div>
                        <div class="col-md-5">
                            <h5 class="card-title"><?= $detail['product_title']  ?></h5>
                            <p class="text-left"><?= $detail['description']  ?>.</p>
                            <h3>Rp<?= number_format($detail['price'], 2, ',', '.')  ?></h3>
                            Stock <?= $detail['is_available'] == 1 ? '<span class="badge badge-primary">Tersedia</span>' : '<span class="badge badge-danger">Kosong</span>'  ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a class="btn btn-warning float-right" href="<?= base_url('admin/product/edit/') . $detail['product_id'] ?>"><i class="fas fa-edit"></i></a>
                </div>
            </div>
        </div>
    </div>
</main>