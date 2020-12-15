<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-8 pt-3">
            <div class="card">
                <div class="card-header">
                    Edit Kategori
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('admin/category/update'); ?>">
                        <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Nama Ketegori</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title" value="<?= $edit['title'] ?>">
                                <?php echo form_error('title', '<small class="alert-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
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