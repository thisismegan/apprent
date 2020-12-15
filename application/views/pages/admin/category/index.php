<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <?= $this->session->flashdata('message')  ?>
            <div class="card">
                <div class="card-header">
                    Kategori
                    <a href="<?= base_url('admin/category/create') ?>" class="btn btn-info btn-sm float-right"><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($category as $row) :  ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $row['title']  ?></td>
                                    <td>
                                        <form action="<?= base_url('admin/category/delete/') . $row['id'] ?>" method="POST">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <a class="btn btn-warning btn-sm" href="<?= base_url('admin/category/edit/') . $row['id'] ?>"><i class="fas fa-edit"></i></a>
                                            <button onclick="return confirm('are you sure?')" href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $i++;  ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>









</main>