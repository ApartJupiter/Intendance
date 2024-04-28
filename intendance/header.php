<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php 
  ob_start();
  $title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "Home";
  ?>
  <title><?php echo $title ?></title>
  <?php ob_end_flush() ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2/css/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap4-toggle.min.css">
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">
	<script src="assets/plugins/jquery/js/jquery.min.js"></script>
  <link rel="stylesheet" href="assets/plugins/jquery/css/jquery-ui.min.css">
  <script src="assets/plugins/jquery/js/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>