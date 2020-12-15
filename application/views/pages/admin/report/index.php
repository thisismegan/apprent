<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Laporan Transaksi Sewa </h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <form action="<?= base_url('admin/reports/export') ?>" method="POST">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" value="<?= date("Y-m-d", strtotime("-30 days", time())) ?>" name="tgl_awal">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_akhir">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <select name="status" class="form-select">
                                            <option value="0">Belum Kembali</option>
                                            <option value="1">Sudah Kembali</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Export</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>