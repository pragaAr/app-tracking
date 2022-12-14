<!-- Main Content -->
<div class="main-content">
  <div class="updated" data-flashdata="<?= $this->session->flashdata('updated'); ?>"></div>
  <section class="section">
    <div class="section-header">
      <h1><?= $title ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
          <a href="<?= base_url('pengirimanmasuk') ?>" class="btn btn-dark">
            <i class="fas fa-arrow-left"></i>
            Kembali
          </a>
        </div>
      </div>
    </div>

    <div class="section-body">
      <form action="<?= base_url('pengirimanmasuk/updatedata') ?>" method="post">
        <div class="card ">
          <div class="card-header d-flex justify-content-between align-items-center">
            <p class="font-weight-bold">
              Kd Delivery : <span class="text-danger text-uppercase"><?= $deliv->kd_delivcab ?></span>
              <input type="hidden" class="form-control" name="kddeliv" value="<?= $deliv->kd_delivcab ?>" readonly>
            </p>
            <?php if ($deliv->updatedAt == null) { ?>
              <button type="submit" class="btn btn-warning rounded deliv-in-update" data-toggle="tooltip" title="Update kedatangan truck">
                <i class="fas fa-pencil-alt"></i>
                Update
              </button>
            <?php } else { ?>
              <button type="button" class="btn btn-secondary rounded" data-toggle="tooltip" title="Truck telah sampai">
                <i class="fas fa-pencil-alt"></i>
                Update
              </button>
            <?php } ?>

          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 col-md col-sm">
                <p class="font-weight-bold">
                  Asal&emsp;&emsp;&ensp;&nbsp;&nbsp;&nbsp; : &nbsp; <?= strtoupper($deliv->asal) ?>
                </p>
                <p class="font-weight-bold">
                  Tujuan&emsp;&ensp;&nbsp;&nbsp; : &nbsp; <?= strtoupper($deliv->tujuan) ?>
                </p>
                <p class="font-weight-bold">
                  Jml Reccu&nbsp;&nbsp; : &nbsp; <?= $deliv->total_reccu ?> Reccu
                </p>
              </div>
              <div class="col-lg-6 col-md col-sm">
                <p class="font-weight-bold">
                  Plat No&emsp;&ensp; : &nbsp; <?= strtoupper($deliv->platno) ?>
                </p>
                <p class="font-weight-bold">
                  Waktu&emsp;&emsp; : &nbsp; <?= date('d-m-Y H:i:s', strtotime($deliv->createdAt)) ?>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h5>List Reccu</h5>
            <div class="table-responsive">
              <table class="table table-bordered" id="dtreccu">
                <thead class="text-center">
                  <tr>
                    <th>
                      <strong>No.</strong>
                    </th>
                    <th>
                      <strong>Reccu - Kd Paket</strong>
                    </th>
                    <th>
                      <strong>Status</strong>
                    </th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php $no = 1;
                  foreach ($detail as $detail) : ?>
                    <tr>
                      <td><?= $no ?>.</td>
                      <td><?= $detail->reccu ?> - <?= strtoupper($detail->kd_paket) ?></td>
                      <input type="hidden" class="form-control" name="reccu_hidden[]" value="<?= $detail->reccu ?>" readonly>
                      <?php
                      if ($detail->sentAt === null) { ?>
                        <td>
                          <?= ucwords($detail->status) ?>
                          <i class="far fa-clock text-secondary ml-3" data-toggle="tooltip" title="Belum Terkirim"></i>
                        </td>
                      <?php } else { ?>
                        <td>
                          <?= ucwords($detail->status) ?>
                          <i class="fas fa-check text-success ml-3" data-toggle="tooltip" title="Sudah Terkirim"></i>
                        </td>
                      <?php } ?>
                    </tr>
                    <?php $no++ ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </form>
  </section>
</div>