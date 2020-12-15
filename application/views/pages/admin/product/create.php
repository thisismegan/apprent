<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php
    $urutan = (int) substr($kode['kodeTerbesar'], 3, 3);

    $urutan++;

    $huruf = "KD";
    $kodeBarang = $huruf . sprintf("%03s", $urutan);

    ?>
    <div class="row">
        <div class="col-md-8 pt-3">
            <div class="card">
                <div class="card-header">
                    Tambah Produk
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('admin/product/create'); ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kode_produk" class="col-sm-3 col-form-label">Kode Barang</label>
                            <input name="kode_produk" type="hidden" class="form-control" id="kode_produk" value="<?= $kodeBarang;  ?> ">
                            <div class="col-sm-9">
                                <input name="kode_produk" disabled type="text" class="form-control" id="kode_produk" value="<?= $kodeBarang;  ?> ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title" value="<?php echo set_value('title'); ?>">
                                <?php echo form_error('title', '<small class="alert-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input name="price" type="text" class="form-control" id="harga" value="<?php echo set_value('price'); ?>">
                                <?php echo form_error('price', '<small class="alert-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="kategori">
                                    <?php foreach ($kategori as $row) : ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea rows="10" name="description" type="text" class="form-control" id="editor1"><?php echo set_value('description'); ?></textarea>
                                <?php echo form_error('description', '<small class="alert-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <input name="image" type="file" class="form-control" id="image">
                                <?php if ($this->session->flashdata('image_error')) :  ?>
                                    <small class="text-danger form-text"></small>
                                    <?= $this->session->flashdata('image_error') ?>
                                <?php endif; ?>
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
                                <button type="submit" class="btn btn-info">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>