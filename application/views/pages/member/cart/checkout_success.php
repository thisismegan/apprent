<main role="main" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Checkout Berhasil
                </div>
                <div class="card-body">
                    <h5>Nomor Order: <?= $transaksi['invoice'] ?></h5>
                    <p>Terima kasih sudah berbelanja.</p>
                    <p>Silahkan melakukan pembayaran untuk bisa kami proses selanjutnya dengan cara:</p>
                    <ol>
                        <li>Lakukan pembayaran ke rekening <strong>BCA 34345888905</strong> a/n <b>MgTechno</b></li>
                        <li>Sertakan keterangan dengan nomor order: <strong><?= $transaksi['invoice'] ?></strong></li>
                        <li>Total pembayaran: <strong>Rp<?= number_format($transaksi['total'], 0, ',', '.')  ?></strong></li>
                    </ol>
                    <p>Jika sudah, Silahkan kirimkan bukti transfer dihalaman konfirmasi atau bisa <a href="<?= base_url() ?>">klik disini</a></p>
                    <a href="<?= base_url() ?>" class="btn btn-primary"><i class="fas fa-angle-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>

</main>