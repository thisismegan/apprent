<main role="main" class="container">
    <div class="row">
        <?php $this->load->view('layout/menu') ?>
        <div class="col-md-10">
            <?= $this->session->flashdata('message') ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-2">
                        <div class="card-body">
                            <form action="<?= base_url('member/profile/update_pic') ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="old_image" value="<?= $profil['image'] ?>">
                                <input type="hidden" name="id" value="<?= $profil['id'] ?>">
                                <img class="img-thumbnail" style="width: 280px;" src="<?= base_url('assets/images/profil/') . $profil['image'] ?>" alt="">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control input-sm" name="image">
                                </div>
                                <button type="submit" class="btn btn-info">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Biodata Diri</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Nama</b></p>
                                    <p><b>Email</b></p>
                                    <p><b>Telepon</b></p>
                                    <p><b>Alamat</b></p>
                                </div>
                                <div class="col-md-9">
                                    <p><?= ucwords($profil['name']) ?></p>
                                    <p><?= $profil['email'] ?></p>
                                    <p><?= $profil['phone'] ?></p>
                                    <p><?= $profil['address'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('member/profile/edit/') . $profil['id'] ?>" class="btn btn-info float-right">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>