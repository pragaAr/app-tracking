<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?= base_url('dashboard') ?>">Hira Express</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?= base_url('dashboard') ?>">HE</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Home</li>
      <li class="<?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
        <a href="<?= base_url('dashboard') ?>" class="nav-link">
          <i class="fas fa-fire"></i>
          <span class="font-weight-bold">Dashboard</span>
        </a>
      </li>
      <?php if ($this->session->userdata('role_access') == 'superadmin') { ?>
        <li class="menu-header">Data Manajemen</li>
        <li class="nav-item dropdown <?= $this->uri->segment(1) == 'alamat' || $this->uri->segment(1) == 'cabang' || $this->uri->segment(1) == 'kota' || $this->uri->segment(1) == 'ongkir' || $this->uri->segment(1) == 'user' ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-book"></i>
            <span class="font-weight-bold">Master</span>
          </a>
          <ul class="dropdown-menu">
            <li class="<?= $this->uri->segment(1) == 'alamat' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('alamat') ?>">Alamat</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'cabang' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('cabang') ?>">Cabang</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'kota' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('kota') ?>">Kota</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'ongkir' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('ongkir') ?>">Ongkir</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'user' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('user') ?>">User</a>
            </li>
          </ul>
        </li>
        <li class="menu-header">Operasional</li>
        <li class="nav-item dropdown <?= $this->uri->segment(1) == 'penjualanagen' || $this->uri->segment(1) == 'penjualan' || $this->uri->segment(1) == 'penjualanlokal' || $this->uri->segment(1) == 'penjualancabang' || $this->uri->segment(1) == 'filterretur' ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-boxes"></i>
            <span class="font-weight-bold">Penjualan</span>
          </a>
          <ul class="dropdown-menu">
            <li class="<?= $this->uri->segment(1) == 'penjualanagen' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('penjualanagen') ?>">Agen</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'penjualancabang' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('penjualancabang') ?>">Cabang</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'penjualanlokal' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('penjualanlokal') ?>">Daerah</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'penjualan' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('penjualan') ?>">OverAll</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown <?= $this->uri->segment(1) == 'pengiriman' || $this->uri->segment(1) == 'pengirimanagen' ||  $this->uri->segment(1) == 'pengirimancabang' || $this->uri->segment(1) == 'pengirimanmasuk' ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-clipboard"></i>
            <span class="font-weight-bold">Pengiriman</span>
          </a>
          <ul class="dropdown-menu">
            <li class="<?= $this->uri->segment(1) == 'pengirimanagen' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimanagen') ?>">Agen</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'pengirimancabang' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimancabang') ?>">Cabang</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'pengirimanlokal' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimanlokal') ?>">Daerah</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'pengirimanmasuk' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimanmasuk') ?>">Masuk</a>
            </li>
          </ul>
        </li>
      <?php } elseif ($this->session->userdata('role_access') == 'admcab') { ?>
        <li class="menu-header">Data Manajemen</li>
        <li class="nav-item dropdown <?= $this->uri->segment(1) == 'cabang' || $this->uri->segment(1) == 'user' ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-book"></i>
            <span class="font-weight-bold">Master</span>
          </a>
          <ul class="dropdown-menu">
            <li class="<?= $this->uri->segment(1) == 'cabang' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('cabang') ?>">Cabang</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'user' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('user') ?>">User</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown <?= $this->uri->segment(1) == 'penjualanagen' || $this->uri->segment(1) == 'penjualan' || $this->uri->segment(1) == 'penjualanlokal' || $this->uri->segment(1) == 'penjualancabang' || $this->uri->segment(1) == 'filterretur' ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-boxes"></i>
            <span class="font-weight-bold">Penjualan</span>
          </a>
          <ul class="dropdown-menu">
            <li class="<?= $this->uri->segment(1) == 'penjualanagen' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('penjualanagen') ?>">Agen</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'penjualancabang' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('penjualancabang') ?>">Cabang</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'penjualanlokal' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('penjualanlokal') ?>">Daerah</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown <?= $this->uri->segment(1) == 'pengirimanlokal' || $this->uri->segment(1) == 'pengirimanagen' ||  $this->uri->segment(1) == 'pengirimancabang' || $this->uri->segment(1) == 'pengirimanmasuk' ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-clipboard"></i>
            <span class="font-weight-bold">Pengiriman</span>
          </a>
          <ul class="dropdown-menu">
            <li class="<?= $this->uri->segment(1) == 'pengirimanagen' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimanagen') ?>">Agen</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'pengirimancabang' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimancabang') ?>">Cabang</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'pengirimanlokal' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimanlokal') ?>">Daerah</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'pengirimanmasuk' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimanmasuk') ?>">Masuk</a>
            </li>
          </ul>
        </li>
      <?php } elseif ($this->session->userdata('role_access') == 'mandor') { ?>
        <li class="nav-item dropdown <?= $this->uri->segment(1) == 'pengirimanagen' ||  $this->uri->segment(1) == 'pengirimancabang' || $this->uri->segment(1) == 'pengirimanmasuk' ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-clipboard"></i>
            <span class="font-weight-bold">Pengiriman</span>
          </a>
          <ul class="dropdown-menu">
            <li class="<?= $this->uri->segment(1) == 'pengirimanagen' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimanagen') ?>">Agen</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'pengirimancabang' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimancabang') ?>">Cabang</a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'pengirimanmasuk' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a href="<?= base_url('pengirimanmasuk') ?>">Masuk</a>
            </li>
          </ul>
        </li>
      <?php } else { ?>
        <li class="menu-header">Operasional</li>
        <li class="<?= $this->uri->segment(1) == 'penjualanagen' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
          <a href="<?= base_url('penjualanagen') ?>" class="nav-link">
            <i class="fas fa-boxes"></i>
            <span class="font-weight-bold">Penjualan</span>
          </a>
        </li>
        <li class="<?= $this->uri->segment(1) == 'pengirimanagen' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
          <a href="<?= base_url('pengirimanagen') ?>" class="nav-link">
            <i class="fas fa-clipboard"></i>
            <span class="font-weight-bold">Pengiriman</span>
          </a>
        </li>
      <?php } ?>
      <li class="<?= $this->uri->segment(1) == 'track' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
        <a href="<?= base_url('track') ?>" class="nav-link">
          <i class="fas fa-search"></i>
          <span class="font-weight-bold">Tracking</span>
        </a>
      </li>
      <li class="menu-header">
        <hr>
      </li>
      <li>
        <a href="<?= base_url('auth/logout') ?>" class="nav-link">
          <i class="fas fa-sign-out-alt text-danger font-weight-bold"></i>
          <span class="text-danger font-weight-bold">Logout</span>
        </a>
      </li>
    </ul>
  </aside>
</div>