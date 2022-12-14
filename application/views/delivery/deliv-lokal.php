 <!-- Main Content -->
 <div class="main-content">
   <div class="inserted" data-flashdata="<?= $this->session->flashdata('inserted'); ?>"></div>
   <div class="updated" data-flashdata="<?= $this->session->flashdata('updated'); ?>"></div>
   <div class="deleted" data-flashdata="<?= $this->session->flashdata('deleted'); ?>"></div>
   <section class="section">
     <div class="section-header">
       <h1><?= $title ?></h1>
       <div class="section-header-breadcrumb">
         <div class="breadcrumb-item">
           <a href="<?= base_url('pengirimanlokal/adddeliv') ?>" class="btn btn-primary">
             <i class="fas fa-plus"></i>
             Tambah
           </a>
         </div>
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
                   <th>Cabang</th>
                   <th>Loper</th>
                   <th>Reccu</th>
                   <th>Waktu</th>
                   <!-- <th class="text-center">Status</th> -->
                   <th class="text-center">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $no = 1;
                  foreach ($deliv as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= strtoupper($data->kd_delivlokal) ?></td>
                     <td><?= strtoupper($data->nama_cab) ?></td>
                     <td><?= strtoupper($data->nama_user) ?></td>
                     <td><?= $data->total_reccu ?> Reccu</td>
                     <td><?= date('d-m-Y H:i:s', strtotime($data->createdAt)) ?></td>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="<?= base_url('pengirimanlokal/updatedeliv/') . $data->kd_delivlokal; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                         </a>
                         <a href="<?= base_url('pengirimanlokal/detail/') . $data->kd_delivlokal; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="Detail">
                           <i class="fas fa-eye"></i>
                         </a>
                         <a href="<?= base_url('pengirimanlokal/delete/') . $data->kd_delivlokal; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
                           <i class="fas fa-trash"></i>
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