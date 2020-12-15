<style>
    .text-link {
        color: black;
    }
</style>

<main role="main" class="container">
    <?= $this->session->flashdata('message') ?>
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('assets/images/banner/1.png') ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/images/banner/2.png') ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/images/banner/3.png') ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- end carousell -->
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Pencarian
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('home/search') ?>" method="POST">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Kategori
                        </div>
                        <ul class="list-group list-group-flush">
                            <a href="<?= base_url() ?>">
                                <li class="list-group-item">Semua Kategori</li>
                            </a>
                            <?php foreach ($kategori as $row) : ?>
                                <a href="<?= base_url('home/category/') . $row['id'] ?>">
                                    <li class="list-group-item"><i class="fas fa-angle-right"></i> <?= $row['title'] ?></li>
                                </a>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col-md-3 -->
        <?php if ($product) : ?>
            <div class="col-md-9">
                <div class="row">
                    <?php foreach ($product as $row) : ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <a href="<?= base_url('home/detail/') . $row['product_id'] ?>">
                                        <img src="<?= base_url('assets/images/product/') . $row['image']  ?>" class="card-img-top" style="max-height: 180px;">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a href="<?= base_url('home/detail/') . $row['product_id'] ?>" class="text-link">
                                        <h5 class="card-title"><?= ucwords(substr($row['product_title'], 0, 25)) ?></h5>
                                    </a>
                                    <p class="card-text"><strong>Rp<?= number_format($row['price'], 0, ',', '.')   ?></strong></p>
                                    <?= $row['is_available'] == 1 ? '<span class="badge badge-primary">Tersedia</span>' : '<span class="badge badge-danger">Kosong</span>'  ?>
                                </div>
                                <div class="card-footer">
                                    <form action="<?= base_url('member/cart/create') ?>" method="POST">
                                        <input type="hidden" name="price" value="<?= $row['price']; ?>">
                                        <input type="hidden" name="kode_produk" value="<?= $row['product_id']; ?>">
                                        <div class="input-group">
                                            <input name="qty" type="number" value="1" min="1" class="form-control" <?= $row['is_available'] == 0 ? 'disabled' : '' ?>>
                                            <div class="input-group-append">
                                                <button type="submit" <?= $row['is_available'] == 0 ? 'disabled' : '' ?> class="btn btn-info">Add to Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <?= $this->pagination->create_links(); ?>
            </div>
            <!-- end col-md-9 -->
        <?php else : ?>
            <div class="col-md-9">
                <div class="alert alert-warning text-center" role="alert">
                    Produk tidak ditemukan
                </div>
            </div>
        <?php endif ?>
    </div>
    <!-- end row -->
</main>