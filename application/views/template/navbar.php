<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li>
              <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                <i class="fas fa-bars"></i>
              </a>
            </li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <span class="text-white font-weight-bold mt-1" id="jam"></span>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block font-weight-bold">
                <span>Hi, <?= $this->session->userdata('username') ?></span>
              </div>
            </a>
            <?php if ($this->session->userdata('user_role') == 'admin') { ?>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= base_url('user/update/') . $this->session->userdata('id_user') ?>" class="dropdown-item has-icon">
                  <i class="far fa-user"></i>
                  Edit Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon font-weight-bold text-danger">
                  <i class="fas fa-sign-out-alt"></i>
                  Logout
                </a>
              </div>
            <?php } else { ?>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon font-weight-bold text-danger">
                  <i class="fas fa-sign-out-alt"></i>
                  Logout
                </a>
              </div>
            <?php } ?>
          </li>
        </ul>
      </nav>