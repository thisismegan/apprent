<main role="main" class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <?= $this->session->flashdata('message') ?>
                    Lupa Kata Sandi
                </div>
                <div class="card-body">
                    <form action="<?= base_url('auth/forgot_password') ?>" method="POST">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email yang terdaftar">
                                <?= form_error('email', '<small class="alert-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="<?= base_url('assets/libs/jquery/') ?>jquery-3.5.1.min.js"></script>
<script src="<?= base_url('assets/libs/bootstrap/js/') ?>bootstrap.bundle.min.js"></script>