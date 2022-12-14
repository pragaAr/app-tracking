<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1 class="ml-1"><?= $title ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
          <a href="<?= base_url('pengirimanlokal') ?>" class="btn btn-dark mr-1">
            <i class="fas fa-arrow-left"></i>
            Kembali
          </a>
        </div>
      </div>
    </div>

    <div class="section-body">
      <form action="<?= base_url('pengirimanlokal/prosesupdate') ?>" method="POST">
        <div class="row">
          <div class="col-lg col-md">
            <div class="card card-danger">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <h5>
                      Kd Delivery :
                      <span class="text-uppercase">
                        <?= $deliv->kd_delivlokal ?></span>
                    </h5>
                  </div>
                  <div class="col-lg-6 col-md-6 text-right">
                    <button type="submit" class="btn btn-warning rounded pt-1 pb-1 deliv-lokal-update" data-toggle="tooltip" title="Update Data Pengiriman">
                      <i class="fas fa-pencil-alt"></i>
                      Update Data
                    </button>
                  </div>
                </div>
                <p class="text-danger font-weight-bold">
                  Harap teliti dalam menginputkan data..!
                </p>
                <hr>
                <div class="form-row">
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="createdat">Tanggal<span class="text-danger">*</span></label>
                    <input type="text" name="createdat" id="createdat" class="form-control" value="<?= date('d-m-Y H:i:s', strtotime($deliv->createdAt)) ?>" required readonly>
                    <input type="hidden" name="kddelivlokal" class="form-control text-uppercase" value="<?= $deliv->kd_delivlokal ?>" required readonly>
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="cabid">Asal<span class="text-danger">*</span></label>
                    <input type="text" name="cabid" class="form-control text-uppercase" value="<?= $deliv->nama_cab ?>" required readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-lg-5 col-md-5">
                    <label for="kuririd">Nama Loper<span class="text-danger">*</span></label>
                    <select name="kuririd" id="kuririd" class="form-control select2" required oninvalid="this.setCustomValidity('Nama Kurir wajib di isi!')" oninput="setCustomValidity('')">
                      <option value="<?= $deliv->kurir_id ?>"><?= ucwords($deliv->nama_user) ?></option>
                      <?php foreach ($kurir as $data) : ?>
                        <option value="<?= $data->id_user ?>"><?= ucwords($data->nama_user) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-5 col-md-5">
                    <label for="idpaket">Reccu<span class="text-danger">*</span></label>
                    <select name="idpaket" id="idpaket" class="form-control select2 idpaket">
                      <option value="" selected disabled>Pilih Reccu</option>
                      <?php foreach ($penlok as $data) : ?>
                        <option value="<?= $data->id_paket ?>"><?= $data->reccu ?> - <?= strtoupper($data->kd_paket) ?></option>
                      <?php endforeach ?>
                    </select>
                    <input type="hidden" name="reccu" readonly>
                    <input type="hidden" name="kdpaket" readonly>
                    <input type="hidden" name="status" id="status" class="form-control text-capitalize" value="paket disiapkan untuk dikirim ke alamat tujuan" required readonly>
                  </div>
                  <div class="form-group col-lg-2 col-md-2" style="margin-top:28px">
                    <button type="button" class="btn btn-primary btn-block pt-2 pb-2" id="addrecculokal" disabled>
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
          <div class="col-lg col-md">
            <div class="card">
              <div class="card-body">
                <h5>List Reccu</h5>
                <hr>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dtrecculokal">
                    <thead class="text-center">
                      <tr>
                        <th>
                          <strong>Reccu - Kd Paket</strong>
                        </th>
                        <th>
                          <strong>Status</strong>
                        </th>
                        <th>
                          <strong>Actions</strong>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php $no = 1;
                      foreach ($detail as $detail) : ?>
                        <input type="hidden" name="reccuold_hidden[]" value="<?= $detail->reccu ?>" readonly>
                        <tr class="tbdetail">
                          <td class="text-uppercase">
                            <?= $detail->reccu ?> - <?= $detail->kd_paket ?>
                            <input type="hidden" name="reccu_hidden[]" value="<?= $detail->reccu ?>" readonly>
                          </td>
                          <td class="text-capitalize">
                            <?= $detail->status ?>
                            <input type="hidden" name="status_hidden[]" value="<?= $detail->status ?>" readonly>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger" id="btn-hapus-reccu" data-toggle="tooltip" title="Hapus Reccu" data-reccu="<?= $detail->reccu ?>">
                              <i class="fas fa-times"></i>
                            </button>
                          </td>
                        </tr>
                        <?php $no++ ?>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
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

<!-- JS Library -->
<script src="<?= base_url('theme/assets/js/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/responsive.bootstrap4.min.js') ?>"></script>

<!-- Template JS File -->
<script src="<?= base_url('theme/assets/js/scripts.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/clock.js') ?>"></script>

<!-- Page Specific JS File -->
<script src="<?= base_url('theme/assets/js/custom.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/update-delivlokal.js') ?>"></script>

<script>
  $(".select2").select2();
</script>
</body>

</html>