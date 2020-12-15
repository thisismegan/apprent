<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-8 pt-3">
            <div class="card">
                <div class="card-header">
                    Edit Produk
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('admin/product/update'); ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                            <input type="hidden" value="<?= $edit['product_id'] ?>" name="id">
                            <label for="title" class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title" value="<?= $edit['product_title'] ?>">
                                <?php echo form_error('title', '<small class="alert-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input name="price" type="text" class="form-control" id="harga" value="<?= $edit['price'] ?>">
                                <?php echo form_error('price', '<small class="alert-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="kategori">
                                    <option value="<?= $edit['id_category'] ?>"><?= $edit['title'] ?></option>
                                    <?php foreach ($kategori as $row) : ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea rows="6" name="description" type="text" class="form-control" id="editor1"><?= $edit['description']; ?></textarea>
                                <?php echo form_error('description', '<small class="alert-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/images/product/') . $edit['image'] ?>" alt="" class="img-thumbnail" style="width: 60%;">
                            </div>
                            <div class="col-sm-6">
                                <input name="image" type="file" class="form-control" id="image" value="<?= $edit['image'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option value="1">Tersedia</option>
                                    <option value="0">Kosong</option>
                                </select>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>