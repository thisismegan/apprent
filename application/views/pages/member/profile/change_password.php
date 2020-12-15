<main role="main" class="container">
    <div class="row">
        <?php $this->load->view('layout/menu') ?>
        <div class="col-md-9">
            <?= $this->session->flashdata('message') ?>
            <div class="card">
                <div class="card-header">
                    <h5>Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('member/profile/change_password/') ?>" method="POST">
                        <input type="hidden" value="<?= $user['id'] ?>" name="id">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Password Lama</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password lama">
                                <?= form_error('password', '<small class="alert-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Password Baru</label>
                            <div class="col-sm-6">
                                <input type="password" name="new_password" class="form-control" placeholder="Masukkan password baru">
                                <?= form_error('new_password', '<small class="alert-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="conf_newpassword" class="form-control" placeholder="Masukkan konfirmasi password baru">
                                <?= form_error('conf_newpassword', '<small class="alert-danger">', '</small>') ?>
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
</main>