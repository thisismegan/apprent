<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <?= $this->session->flashdata('message')  ?>
            <div class="card">
                <div class="card-header">
                    <?= $title  ?>
                    <a href="<?= base_url('admin/category/create') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Tambah</a>
                    <div class="float-right">
                        <form action="<?= base_url('admin/customers') ?>" method="POST">
                            <div class="input-group">
                                <input type="text" value="<?= $this->session->userdata('keyword') ?>" name="keyword" autocomplete="off" autofocus class="form-control form-control-sm" placeholder="Cari..." aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                                <div class="input-group-append" id="button-addon4">
                                    <input type="hidden" name="submit">
                                    <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                                    <a href="<?= base_url('admin/customers/reset') ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eraser"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Telepon</th>
                                <th scope="col">Status Sewa</th>
                                <th scope="col">Status Member</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($customer) : ?>
                                <?php foreach ($customer as $row) :  ?>
                                    <tr>
                                        <th scope="row"><?= ++$page ?></th>
                                        <td><?= $row['name']  ?></td>
                                        <td><?= $row['phone']  ?></td>
                                        <td></td>
                                        <td><?= $row['is_active'] == 1 ? '<i class="badge badge-primary">active</i>' : '<i class="badge badge-danger">Non Active</i>'   ?></td>
                                        <td>
                                            <form action="<?= base_url('admin/category/delete/') . $row['id'] ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <a class="btn btn-warning btn-sm" href="<?= base_url('admin/category/edit/') . $row['id'] ?>"><i class="fas fa-edit"></i></a>
                                                <button onclick="return confirm('are you sure?')" href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-warning text-center" role="alert">
                                            Data tidak ditemukan
                                        </div>
                                    </td>

                                </tr>
                            <?php endif ?>

                        </tbody>
                    </table>
                    <?= $pagination  ?>
                </div>
            </div>
        </div>
    </div>
</main>