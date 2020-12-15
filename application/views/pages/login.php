<main role="main" class="container">
    <?= $this->session->flashdata('message') ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    Form Login
                </div>
                <div class="card-body">
                    <form action="<?= base_url('auth') ?>" method="POST">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input autofocus="true" type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
                                <?= form_error('email', '<small class="alert-danger">', '</small>')  ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control">
                                <?= form_error('password', '<small class="alert-danger">', '</small>')  ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </div>
                            <a href="<?= base_url('auth/forgot_password') ?>" class="float-right">Lupa Kata Sandi?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="<?= base_url('assets/libs/jquery/') ?>jquery-3.5.1.min.js"></script>
<script src="<?= base_url('assets/libs/bootstrap/js/') ?>bootstrap.bundle.min.js"></script>