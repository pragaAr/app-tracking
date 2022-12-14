<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg-light"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="<?= base_url('kurir') ?>" class="navbar-brand text-dark sidebar-gone-hide">
          Hira Express
        </a>
        <div class="navbar-nav">
          <a href="#" class="nav-link sidebar-gone-show text-dark" data-toggle="sidebar">
            <i class="fas fa-bars"></i>
          </a>
          <span class="text-dark font-weight-bold" id="jam"></span>
        </div>
      </nav>
      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a href="<?= base_url('kurir') ?>" class="nav-link">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#pengiriman" class="nav-link">
                <i class="fas fa-clipboard"></i>
                <span>Pengiriman</span>
              </a>
            </li>
            <hr>
            <li class="nav-item">
              <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                <i class="fas fa-sign-out-alt text-danger font-weight-bold"></i>
                <span class="text-danger font-weight-bold">
                  Logout
                </span>
              </a>
            </li>
          </ul>
        </div>
      </nav>