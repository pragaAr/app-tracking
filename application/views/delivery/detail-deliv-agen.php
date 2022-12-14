<!-- Main Content -->
<div class="main-content">
  <div class="updated" data-flashdata="<?= $this->session->flashdata('updated'); ?>"></div>
  <section class="section">
    <div class="section-header">
      <h1><?= $title ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
          <a href="<?= base_url('pengirimanagen') ?>" class="btn btn-dark">
            <i class="fas fa-arrow-left"></i>
            Kembali
          </a>
        </div>
      </div>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <p class="font-weight-bold">
            Kd Delivery : <span class="text-danger text-uppercase"><?= $deliv->kd_delivagen ?></span>
          </p>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <p class="font-weight-bold">
                Agen&emsp;&emsp;&nbsp;&nbsp; : &nbsp; <?= strtoupper($deliv->nama_cab) ?>
              </p>
              <p class="font-weight-bold">
                Jml Reccu&nbsp;&nbsp; : &nbsp; <?= $deliv->total_reccu ?> Reccu
              </p>
            </div>
            <div class="col-lg-6 col-md-6">
              <p class="font-weight-bold">
                Loper&emsp;&emsp;&nbsp;&nbsp; : &nbsp; <?= strtoupper($deliv->nama_user) ?>
              </p>
              <p class="font-weight-bold">
                Waktu&emsp;&ensp;&nbsp;&nbsp; : &nbsp; <?= date('d-m-Y H:i:s', strtotime($deliv->createdAt)) ?>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h5>List Reccu</h5>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">No.</th>
                  <th>Reccu - Kd Paket</th>
                  <th class="text-center">Status Reccu</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($detail as $detail) : ?>
                  <tr>
                    <td class="text-center"><?= $no ?>.</td>
                    <td><?= $detail->reccu ?> - <?= strtoupper($detail->kd_paket) ?></td>
                    <?php
                    if ($detail->sentAt === null) { ?>
                      <td class="text-center">
                        <?= ucwords($detail->status) ?>
                        <i class="far fa-clock text-secondary ml-3" data-toggle="tooltip" title="Perjalanan ke Cabang"></i>
                      </td>
                    <?php } else { ?>
                      <td class="text-center">
                        <?= ucwords($detail->status) ?>
                        <i class="fas fa-check text-success ml-3" data-toggle="tooltip" title="Sampai di Cabang"></i>
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
  </section>
</div>