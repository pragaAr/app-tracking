<body>
  <div id="app">
    <div class="userlogin" data-flashdata="<?= $this->session->flashdata('userlogin'); ?>"></div>
    <div class="flashrole" data-flashdata="<?= $this->session->flashdata('flashrole'); ?>"></div>
    <div class="userlogout" data-flashdata="<?= $this->session->flashdata('userlogout'); ?>"></div>
    <div class="wrongdata" data-flashdata="<?= $this->session->flashdata('wrongdata'); ?>"></div>
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4  mt-2">
            <div class="login-brand mb-4">
              <img src="<?= base_url('theme/assets/img/logo-brand.png') ?>" alt="logo" width="250">
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="<?= base_url('auth') ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Username anda apa ?
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="pass" class="control-label">Password</label>
                      <input type="password" class="form-control" id="pass" name="pass" tabindex="2" required>
                      <div class="invalid-feedback">
                        Password nya apa ?
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block mt-4" tabindex="4">
                        Login
                      </button>
                    </div>
                </form>
              </div>
              <div class="text-center mt-3 mb-3">
                <div class="bullet"></div>
                Copyright &copy; 2022
                <div class="bullet"></div>
                <br>
                <a href="https://hira-express.com/" target="_blank">PT. Hira Adya Naranata</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>