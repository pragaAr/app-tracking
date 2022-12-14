<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
          <a href="<?= base_url('pengirimanagen') ?>" class="btn btn-dark float-right">
            <i class="fas fa-arrow-left"></i>
            Kembali
          </a>
        </div>
      </div>
    </div>

    <div class="section-body">
      <form action="<?= base_url('pengirimanagen/proses') ?>" method="POST" id="form-tambah">
        <div class="row">
          <div class="col-lg-6">
            <div class="card  card-danger">
              <div class="card-body">
                <h5>Data Delivery</h5>
                <p class="text-danger font-weight-bold">
                  Harap teliti dalam menginputkan data..!
                </p>
                <hr>
                <div class="form-row">
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="kddelivagen">Kode Delivery</label>
                    <input type="text" name="kddelivagen" id="kddelivagen" class="form-control text-uppercase" value="<?= $kdkirim ?>" required readonly>
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="createdat">Tanggal</label>
                    <input type="text" name="createdat" id="createdat" class="form-control" value="<?= date('d-m-Y') ?>" required readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-lg col-md">
                    <label for="kuririd">Nama Loper<span class="text-danger">*</span></label>
                    <select name="kuririd" id="kuririd" class="form-control select2" required oninvalid="this.setCustomValidity('Nama Kurir wajib di isi!')" oninput="setCustomValidity('')">
                      <option value="" selected disabled>Pilih Loper</option>
                      <?php foreach ($kurir as $data) : ?>
                        <option value="<?= $data->id_user ?>"><?= ucwords($data->nama_user) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card  card-danger">
              <div class="card-body">
                <h5>Data Reccu</h5>
                <p class="text-danger font-weight-bold">
                  Harap teliti dalam menginputkan data..!
                </p>
                <hr>
                <div class="form-row">
                  <div class="form-group col-lg-12 col-md-12">
                    <label for="status">Status Pengiriman</label>
                    <input type="text" name="status" id="status" class="form-control text-capitalize" value="paket disiapkan untuk dikirim ke pool - <?= $kota->nama_kota ?>" required readonly>
                  </div>
                  <div class="form-group col-lg-8 col-md-8">
                    <label for="idpaket">No Reccu<span class="text-danger">*</span></label>
                    <select name="idpaket" id="idpaket" class="form-control select2 idpaket" required oninvalid="this.setCustomValidity('Reccu wajib di isi!')" oninput="setCustomValidity('')">
                      <option value="" selected disabled>Pilih Reccu</option>
                      <?php foreach ($penagen as $data) : ?>
                        <option value="<?= $data->id_paket ?>"><?= $data->reccu ?> - <?= strtoupper($data->kd_paket) ?></option>
                      <?php endforeach ?>
                    </select>
                    <input type="hidden" class="form-control" name="reccu" readonly>
                    <input type="hidden" class="form-control" name="kdpaket" readonly>
                  </div>
                  <div class="form-group col-lg-4 col-md-4" style="margin-top:28px">
                    <button class="btn btn-primary btn-block pt-2 pb-2" type="button" id="tambah" disabled>
                      <i class="fas fa-plus"></i>
                      Tambah
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-danger">
              <div class="card-body">
                <h5>List Reccu</h5>
                <hr>
                <div class="table-responsive">
                  <table class="table table-bordered" id="cart" width="100%" cellspacing="0">
                    <thead align="center">
                      <tr>
                        <td>
                          <strong>Reccu - Kd Paket</strong>
                        </td>
                        <td>
                          <strong>Actions</strong>
                        </td>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot align="center">
                      <tr>
                        <td> </td>
                        <td>
                          <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Simpan">
                            <i class="fa fa-save"></i>
                            Simpan
                          </button>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
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
<script src="<?= base_url('theme/assets/js/jquery/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/popper/popper.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/bootstrap/bootstrap-4.3.1.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/jquery/nicescroll.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/jquery/momment.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/select2.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/stisla.js') ?>"></script>

<!-- Template JS File -->
<script src="<?= base_url('theme/assets/js/scripts.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/clock.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/delivagen.js') ?>"></script>

<script>
  $(".select2").select2();
</script>
</body>

</html>