<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title ?></h1>
      <div class="section-header-breadcrumb">

      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg col-md">
              <form action="" method="post">
                <div class="input-group">
                  <input type="text" class="form-control" name="reccu" id="reccu" placeholder="Cari Reccu Anda.." maxlength="6" autofocus>
                  <div class="input-group-append">
                    <button class="btn btn-dark" type="submit" id="track-btn">
                      <i class="fas fa-search"></i>
                      Search
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="card" id="card-timeline" style="display:none">
        <div class="card-body">
          <ul class="timeline" id="container-timeline">

          </ul>
        </div>
      </div>
    </div>
  </section>
</div>

<footer class="main-footer">
  <div class="footer-left">
    <div class="bullet"></div>
    &copy; 2022
    PT. Hira Adya Naranata
    <i class="fas fa-heart text-danger"></i>
    <div class="bullet"></div>
  </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="<?= base_url('theme/assets/js/jquery/jquery-3.3.1.min.js') ?>" crossorigin="anonymous"></script>
<script src="<?= base_url('theme/assets/js/popper/popper.min.js') ?>" crossorigin="anonymous"></script>
<script src="<?= base_url('theme/assets/js/bootstrap/bootstrap-4.3.1.min.js') ?>" crossorigin="anonymous"></script>
<script src="<?= base_url('theme/assets/js/jquery/nicescroll.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/jquery/momment.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/stisla.js') ?>"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="<?= base_url('theme/assets/js/scripts.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/track.js') ?>"></script>

</body>

</html>