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

         </div>
       </div>
     </div>

     <div class="section-body">
       <div class="card">
         <div class="card-body">
           <div class="table-responsive">
             <table class="table table-bordered" id="dtpenjualan">
               <thead>
                 <tr>
                   <th class="text-center">No</th>
                   <th>Reccu</th>
                   <th>Asal</th>
                   <th>Kd Paket</th>
                   <th>Pengirim</th>
                   <th>Penerima</th>
                   <th>Waktu</th>
                   <th class="text-center">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $no = 1;
                  foreach ($pencab as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= $data->reccu ?></td>
                     <td><?= strtoupper($data->cabasal) ?></td>
                     <td><?= strtoupper($data->kd_paket) ?> - <?= $data->koli ?> Koli</td>
                     <td><?= strtoupper($data->pengirim) ?> - <?= strtoupper($data->kotaasal) ?></td>
                     <td><?= strtoupper($data->penerima) ?> - <?= strtoupper($data->kotatujuan) ?></td>
                     <td>
                       <?= date('d-m-Y H:i:s', strtotime($data->createdAt)) ?>
                     </td>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="<?= base_url('penjualancabang/detail/') . $data->reccu; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="Detail">
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