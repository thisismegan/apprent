<main role="main" class="container">
    <div class="row">
        <?php $this->load->view('layout/menu') ?>
        <div class="col-md-10">
            <div class="row">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Profile</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('member/profile/update/') ?>" method="POST">
                                <input type="hidden" value="<?= $edit['id'] ?>" name="id">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" class="form-control" value="<?= $edit['name'] ?>">
                                        <?= form_error('name', '<small class="alert-danger">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control" value="<?= $edit['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Telepon</label>
                                    <div class="col-sm-6">
                                        <input type="numeric" name="phone" class="form-control" value="<?= $edit['phone'] ?>">
                                        <?= form_error('phone', '<small class="alert-danger">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-6">
                                        <textarea name="address" class="form-control" cols="30" rows="6"><?= $edit['address'] ?></textarea>
                                        <?= form_error('address', '<small class="alert-danger">', '</small>') ?>
                                    </div>
                                </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info float-right" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>