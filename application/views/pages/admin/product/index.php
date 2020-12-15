<style>
    .link-product {
        color: black;
    }
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <?= $this->session->flashdata('message')  ?>
            <div class="card">
                <div class="card-header">
                    Product
                    <a href="<?= base_url('admin/product/create') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Tambah</a>
                    <div class="float-right">
                        <form action="<?= base_url('admin/product/search') ?>" method="POST">
                            <div class="input-group">
                                <input type="text" name="keyword" value="<?= $this->session->userdata('keyword') ?>" class="form-control form-control-sm" placeholder="Cari..." aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                                <div class="input-group-append" id="button-addon4">
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="all">all Product</option>
                                        <option value="1">Tersedia</option>
                                        <option value="0">Kosong</option>
                                    </select>
                                    <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                                    <a href="<?= base_url('admin/product/reset') ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eraser"></i></a>
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
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($product) : ?>
                                <?php foreach ($product as $row) :  ?>
                                    <tr>
                                        <th scope="row"><?= ++$page ?></th>
                                        <td><a class="link-product" href="<?= base_url('admin/product/detail/') . $row['product_id'] ?>"><?= substr($row['product_title'], 0, 15)   ?></a></td>
                                        <td>
                                            <img src="<?= base_url('assets/images/product/') . $row['image'] ?>" class="img-thumbnail" style="width: 80px;" alt="">
                                        </td>
                                        <td><?= $row['title']  ?></td>
                                        <td>Rp<?= number_format($row['price'], 0, ',', '.')   ?></td>
                                        <td>
                                            <?= $row['is_available'] == 1 ? '<span class="badge badge-primary">Tersedia</span>' : '<span class="badge badge-danger">Kosong</span>'  ?>
                                        </td>
                                        <td>
                                            <form action="<?= base_url('admin/product/delete/') . $row['id'] ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $row['product_id'] ?>">
                                                <a class="btn btn-warning btn-sm" href="<?= base_url('admin/product/edit/') . $row['product_id'] ?>"><i class="fas fa-edit"></i></a>
                                                <button onclick="return confirm('are you sure?')" href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <a class="btn btn-info btn-sm" href="<?= base_url('admin/product/detail/') . $row['product_id'] ?>"><i class="fas fa-list"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-warning text-center" role="alert">
                                            Data tidak ditemukan
                                        </div>
                                    </td>
                                </tr>
                            <?php endif ?>
                        </tbody>

                    </table>
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</main>