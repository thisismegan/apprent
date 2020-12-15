<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-10 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profil</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/profile') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" readonly value="<?= $profile['email'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="<?= $profile['name'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Telepon</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="phone" value="<?= $profile['phone'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="address" id="editor1" cols="30" rows="10"><?= $profile['address'] ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/images/profil/') . $profile['image'] ?>" class="img-thumbnail" style="width: 180px;" alt="">
                            </div>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-warning text-white">Cancel</a>
                    <button class="btn btn-success float-right" type="submit">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</main>