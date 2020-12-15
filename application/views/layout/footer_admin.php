</div>
</div>
<script src="<?= base_url('assets/libs/jquery/jquery-3.5.1.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
<!-- ckeditor js -->
<script src="<?= base_url('assets') ?>/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- donuts chart -->
<script src="<?= base_url('assets') ?>/js/flot/jquery.flot.min.js" type="text/javascript"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?= base_url('assets') ?>/js/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?= base_url('assets') ?>/js/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Biodata Diri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/images/profil/') . $data['image'] ?>" class="img-thumbnail" style="width: 250px;" alt="">
                    </div>
                    <div class="col-md-3">
                        <p><b>Nama</b></p>
                        <p><b>Email</b></p>
                        <p><b>Telepon</b></p>
                        <p><b>Alamat</b></p>
                    </div>
                    <div class="col-md-4">
                        <p><?= $data['name'] ?></p>
                        <p><?= $data['email'] ?></p>
                        <p><?= $data['phone'] ?></p>
                        <p><?= $data['address'] ?></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-secondary">Logout</a>
                <a href="<?= base_url('admin/profile/') ?>" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
</body>

</html>