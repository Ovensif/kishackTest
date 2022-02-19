</div>
</div>
<!-- Default JS -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url() ?>assets/js/defaultJS/adminlte.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/js/defaultJS/demo.js"></script>
<script src="<?= base_url() ?>assets/js/defaultJS/pages/dashboard2.js"></script>
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>

<script>
    <?php if ($this->session->flashdata('alert')) : ?>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: 'error',
            title: '<?= $this->session->flashdata('alert') ?>'
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')) : ?>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        
        Toast.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success') ?>'
        });
    <?php endif; ?>
</script>

<!-- Print all JS Below! -->
<?php foreach ($js_files as $key_js => $value_js) : ?>
    <script src="<?= $value_js ?>"></script>
<?php endforeach; ?>