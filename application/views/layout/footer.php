<!-- <div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
    </div>
</div> -->

<script src="<?= base_url('assets/libs/jquery/') ?>jquery-3.5.1.min.js"></script>
<script src="<?= base_url('assets/libs/bootstrap/js/') ?>bootstrap.bundle.min.js"></script>
<!-- ckeditor js -->
<script src="<?= base_url('assets') ?>/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- donuts chart -->
<script src="<?= base_url('assets') ?>/js/flot/jquery.flot.min.js" type="text/javascript"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?= base_url('assets') ?>/js/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?= base_url('assets') ?>/js/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>
</body>

</html>