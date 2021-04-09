<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Daftar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="icon" href="<?php echo base_url('assets/img/favicon.png') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <div class="black"></div>
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo base_url() ?>"><b>DAFTAR SISWA</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Silahkan masukan nis dan tanggal lahir anda</p>

      <?php if ($error = $this->session->flashdata('error')): ?>
        <span class="alert-error d-error hidden"><?php echo $error ?></span>
      <?php endif ?>
      <?php if ($warning = $this->session->flashdata('warning')): ?>
        <span class="alert-warning d-warning hidden"><?php echo $warning ?></span>
      <?php endif ?>
      <?php if ($success = $this->session->flashdata('success')): ?>
        <span class="alert-success d-success hidden"><?php echo $success ?></span>
      <?php endif ?>
      <?php if ($message = $this->session->flashdata('message')): ?>
        <span class="alert-success d-message hidden"><?php echo $message ?></span>
      <?php endif ?>

      <?php if (validation_errors()): ?>
      <div class="alert alert-danger"><?php echo validation_errors() ?></div>
      <?php endif ?>

      <form method="post">
        <div class="form-group has-feedback">
          <input autocomplete="off"  autofocus="" type="text" class="form-control nis" placeholder="Nis" required="" name="nis">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input autocomplete="off" type="date" class="form-control" placeholder="tgl" required="" name="tgl">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input autocomplete="off" type="text" class="form-control" placeholder="email" required="" name="email">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input autocomplete="off" type="password" class="form-control" placeholder="password" required="" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input autocomplete="off" type="password" class="form-control" placeholder="konfirmasi password" required="" name="konfirmasi_password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('vendor/lte/') ?>bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('vendor/lte/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url('vendor/lte/') ?>plugins/iCheck/icheck.min.js"></script>
  <script src="<?php echo base_url('vendor/sweetalert/sweetalert.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/alert.js') ?>"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>
</html>
