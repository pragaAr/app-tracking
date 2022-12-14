 <!-- Main Content -->
 <div class="main-content">
   <div class="inserted" data-flashdata="<?= $this->session->flashdata('inserted'); ?>"></div>
   <div class="updated" data-flashdata="<?= $this->session->flashdata('updated'); ?>"></div>
   <div class="deleted" data-flashdata="<?= $this->session->flashdata('deleted'); ?>"></div>
   <section class="section">
     <div class="section-header">
       <h1><?= $title ?></h1>
       <div class="section-header-breadcrumb">
       </div>
     </div>

     <div class="section-body">
       <div class="card">
         <div class="card-body">
           <div class="table-responsive">
             <table class="table table-bordered" id="dtdeliv">
               <thead>
                 <tr>
                   <th class="text-center">No</th>
                   <th>Kd Delivery</th>
                   <th>Asal</th>
                   <th>Tujuan</th>
                   <th>Plat No</th>
                   <th>Reccu</th>
                   <th>Waktu</th>
                   <th class="text-center">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $no = 1;
                  foreach ($deliv as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= strtoupper($data->kd_delivcab) ?></td>
                     <td><?= strtoupper($data->asal) ?></td>
                     <td><?= strtoupper($data->tujuan) ?></td>
                     <td><?= strtoupper($data->platno) ?></td>
                     <td><?= $data->total_reccu ?> Reccu</td>
                     <?php if ($data->updatedAt == null) { ?>
                       <td>
                         <?= date('d-m-Y H:i:s', strtotime($data->createdAt)) ?>
                         <i class="far fa-clock text-secondary ml-3" data-toggle="tooltip" title="Dalam Perjalanan"></i>
                       </td>
                     <?php } else { ?>
                       <td>
                         <?= date('d-m-Y H:i:s', strtotime($data->createdAt)) ?>
                         <i class="fas fa-check text-success ml-3" data-toggle="tooltip" title="Sudah Tiba"></i>
                       </td>
                     <?php } ?>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="<?= base_url('pengirimanmasuk/detail/') . $data->kd_delivcab ?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="Detail">
                           <i class="fas fa-eye"></i>
                         </a>
                       </div>
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
   </section>
 </div>

 <!-- delivIn -->
 <div class="modal fade" id="delivIn" tabindex="-1" aria-labelledby="delivInLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable modal-xl">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="delivInLabel">Detail Data</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="table-responsive">
           <form action="<?= base_url('pengirimanmasuk/update') ?>" method="post">
             <div class="d-flex justify-content-between align-items-center">
               <p class="font-weight-bold">Kd Delivery : <span class="text-danger text-uppercase kd"></span></p>
               <input type="hidden" class="form-control" name="kddeliv" value="" readonly>
               <div class="form-deliv-in">

               </div>
               <button type="submit" class="btn btn-warning mb-2 update-deliv-in" title="Update kedatangan truck">Update</button>
             </div>
             <hr>
             <div class="table-responsive">
               <table class="table table-bordered" id="dtdeliv-in" width="100%" cellspacing="0">
                 <thead class="text-center">
                   <tr>
                     <th><strong>Reccu - Kd Paket</strong></th>
                     <th><strong>Status Reccu</strong></th>
                   </tr>
                 </thead>
                 <tbody class="text-center tbody-detail-in">
                 </tbody>
               </table>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>