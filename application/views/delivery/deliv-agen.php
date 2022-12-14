 <!-- Main Content -->
 <div class="main-content">
   <div class="inserted" data-flashdata="<?= $this->session->flashdata('inserted'); ?>"></div>
   <div class="updated" data-flashdata="<?= $this->session->flashdata('updated'); ?>"></div>
   <div class="deleted" data-flashdata="<?= $this->session->flashdata('deleted'); ?>"></div>
   <section class="section">
     <div class="section-header">
       <h1><?= $title ?></h1>
       <div class="section-header-breadcrumb">
         <?php if ($this->session->userdata('role_access') == 'admagen') { ?>
           <div class="breadcrumb-item">
             <a href="<?= base_url('pengirimanagen/adddeliv') ?>" class="btn btn-primary">
               <i class="fas fa-plus"></i>
               Tambah
             </a>
           </div>
         <?php } ?>
       </div>
     </div>

     <div class="section-body">
       <div class="card">
         <div class="card-body">
           <div class="table-responsive">
             <table class="table table-bordered" id="dtdeliv" width="100%">
               <thead>
                 <tr>
                   <th class="text-center">No</th>
                   <th>Kd Delivery</th>
                   <th>Agen</th>
                   <th>Loper</th>
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
                     <td><?= strtoupper($data->kd_delivagen) ?></td>
                     <td><?= strtoupper($data->nama_cab) ?></td>
                     <td><?= strtoupper($data->nama_user) ?></td>
                     <td><?= $data->total_reccu ?> Reccu</td>
                     <?php if ($data->updatedAt == null) { ?>
                       <td>
                         <?= date('d-m-Y H:i:s', strtotime($data->createdAt)) ?>
                         <i class="far fa-clock text-secondary ml-3" data-toggle="tooltip" title="Perjalanan ke Cabang"></i>
                       </td>
                       <?php
                        if ($this->session->userdata('role_access') == 'admagen') { ?>
                         <td class="text-center">
                           <div class="btn-group" role="group">
                             <a href="<?= base_url('pengirimanagen/updatedeliv/') . $data->kd_delivagen; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                               <i class="fas fa-pencil-alt"></i>
                             </a>
                             <a href="<?= base_url('pengirimanagen/detail/') . $data->kd_delivagen; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="Detail">
                               <i class="fas fa-eye"></i>
                             </a>
                             <a href="<?= base_url('pengirimanagen/delete/') . $data->kd_delivagen; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
                               <i class="fas fa-trash"></i>
                             </a>
                           </div>
                         </td>
                       <?php } else { ?>
                         <td class="text-center">
                           <a href="#" data-id="<?= $data->kd_delivagen ?>" class="btn btn-success btn-sm btn-detail-agen" data-toggle="tooltip" title="Detail">
                             <i class="fas fa-eye"></i>
                           </a>
                         </td>
                       <?php } ?>
                     <?php } else { ?>
                       <td>
                         <?= date('d-m-Y H:i:s', strtotime($data->createdAt)) ?>
                         <i class="fas fa-check text-success ml-3" data-toggle="tooltip" title="Sampai di Cabang"></i>
                       </td>
                       <?php
                        if ($this->session->userdata('role_access') == 'admagen') { ?>
                         <td class="text-center">
                           <div class="btn-group" role="group">
                             <a href="<?= base_url('pengirimanagen/detail/') . $data->kd_delivagen; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="Detail">
                               <i class="fas fa-eye"></i>
                             </a>
                             <a href="<?= base_url('pengirimanagen/delete/') . $data->kd_delivagen; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
                               <i class="fas fa-trash"></i>
                             </a>
                           </div>
                         </td>
                       <?php } else { ?>
                         <td class="text-center">
                           <a href="#" data-id="<?= $data->kd_delivagen ?>" class="btn btn-success btn-sm btn-detail-agen" data-toggle="tooltip" title="Detail">
                             <i class="fas fa-eye"></i>
                           </a>
                         </td>
                       <?php } ?>
                     <?php } ?>
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

 <!-- delivAgen -->
 <div class="modal fade" id="delivAgen" tabindex="-1" aria-labelledby="delivAgenLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="delivAgenLabel">Detail Data</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="table-responsive">
           <form action="<?= base_url('pengirimanagen/update') ?>" method="post">
             <div class="d-flex justify-content-between">
               <p class="font-weight-bold">Kd Pengiriman Agen: <span class="text-danger text-uppercase kd"></span></p>
               <input type="hidden" class="form-control" name="kddeliv" value="" readonly>
               <div class="form-deliv-agen">

               </div>
               <button type="submit" class="btn btn-warning mb-2 update-deliv-agen" data-toggle="tooltip" title="Update Kedatangan Loper">Update</button>
             </div>
             <hr>
             <table class="table table-bordered" width="100%" cellspacing="0">
               <thead class="text-center">
                 <tr>
                   <th><strong>Reccu - Kd Paket</strong></th>
                   <th><strong>Status Kirim</strong></th>
                 </tr>
               </thead>
               <tbody class="text-center tbody-detail-agen">
               </tbody>
             </table>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>