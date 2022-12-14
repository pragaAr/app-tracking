<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title><?= $title ?></title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700" rel="stylesheet">

  <!-- Custom stlylesheet -->
  <link rel="stylesheet" href="<?= base_url('theme/assets/css/error.css') ?>" />

</head>

<body>

  <div id="notfound">
    <div class="notfound">
      <div class="notfound-404">
        <h1>Oops!</h1>
        <h2>404 - Halaman tidak ditemukan</h2>
      </div>
      <?php if (empty($this->session->userdata('id_user'))) { ?>
        <a href="<?= base_url('auth') ?>">Kembali</a>
      <?php } elseif ($this->session->userdata('role_access') == 'kurir') { ?>
        <a href="<?= base_url('kurir') ?>">Kembali</a>
      <?php } elseif ($this->session->userdata('role_access') == 'admcab') { ?>
        <a href="<?= base_url('dashboard') ?>">Kembali</a>
      <?php } else { ?>
        <a href="<?= base_url('dashboard') ?>">Kembali</a>
      <?php } ?>
    </div>
  </div>

</body>

</html>