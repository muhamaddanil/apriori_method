<!-- jQuery -->
<script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="<?php echo base_url(); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<!-- <script src="<?php echo base_url(); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url(); ?>dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>dist/js/pages/dashboard.js"></script>
<script src="<?php echo base_url(); ?>dist/js/pages/my_dashboard.js"></script>


<!-- DataTables  & Plugins -->
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(function run() {
        $("#tabel_1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 25,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "responsive": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        <?php if (isset($kombinasi)) { //PHP
            for ($i = 0; $i <= $input_jml_kombinasi; $i++) { ?> //PHP

                $("#tabel_analisis_<?php echo $i ?>").DataTable({
                    "responsive": true,
                    // "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    "paging": true,
                    // "lengthChange": false,
                    "pageLength": 25,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "responsive": true,
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        <?php } // PHP
        } ?> // PHP

        $('.select2').select2({
            allowClear: true,
            width: "resolve",
            theme: "classic"
        });

    });

    $('.btn-kombinasi').click(function() {
        index = $('.btn-kombinasi').index(this)

        $('.kombinasi-table').hide();
        $('.kombinasi-table:eq(' + index + ')').show();

        $('.btn-kombinasi').css("background-color", "#acddb7");
        $('.btn-kombinasi:eq(' + index + ')').css("background-color", "#28a745");

    });
</script>
</body>

</html>