<main role="main" class="container">
    <div class="row">
        <?php $this->load->view("layout/menu"); ?>
        <div class="col-md-9">
            <div class="card">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="img-thumbnail" style="width: 180px;" src="<?= base_url('assets/images/profil/') . $user['image'] ?> " alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <p>Nama: <strong><?= $user['name'] ?></strong></p>
                                <p>Alamat Email: <strong><?= $user['email']  ?></strong></p>
                                <a href="#" class="btn btn-info">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>