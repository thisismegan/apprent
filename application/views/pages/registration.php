<main role="main" class="container">

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    Form Registration
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('auth/registration') ?>">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="name" value="<?php echo set_value('name'); ?>">
                                <?= form_error('name', '<small class="alert-danger">', '</small>');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo set_value('email'); ?>">
                                <?= form_error('email', '<small class="alert-danger">', '</small>');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type="number" name="phone" class="form-control" id="phone" <?php echo set_value('phone'); ?>>
                                <?= form_error('phone', '<small class="alert-danger">', '</small>');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Alamat Domisili</label>
                            <div class="col-sm-9">
                                <textarea name="address" rows="5" class="form-control" id="address"><?php echo set_value('address'); ?></textarea>
                                <?= form_error('address', '<small class="alert-danger">', '</small>');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="inputPassword3">
                                <?= form_error('password', '<small class="alert-danger">', '</small>');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="conf_password" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="conf_password" class="form-control" id="inputPassword3">
                                <?= form_error('conf_password', '<small class="alert-danger">', '</small>');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>