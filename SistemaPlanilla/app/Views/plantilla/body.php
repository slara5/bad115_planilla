<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?= $navbar ?>
    <?= $sidebar ?>

    <div class="content-wrapper">
      <?= $breadcrumb ?>


      <section class="content">
        <div class="container-fluid">
          <?= $main ?>
        </div>
      </section>
    </div>
    <?= $footer ?>
  </div>
  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url() ?>/plugins/select2/js/select2.full.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url() ?>/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url() ?>/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url() ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url() ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url() ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url() ?>/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url() ?>/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url() ?>/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url() ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/plugins/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url() ?>/plugins/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>/plugins/demo.js"></script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()
      //Date range picker
      $('.date').datetimepicker({
        format: 'DD/MM/YYYY',
      });


    })
  </script>
</body>

</html>