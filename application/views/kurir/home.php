   <!-- Main Content -->
   <div class="main-content">
     <div class="userlogin" data-flashdata="<?= $this->session->flashdata('userlogin'); ?>"></div>
     <section class="section">
       <div class="section-header">
         <h1><?= $title ?></h1>

       </div>

       <div class="section-body">
         <div class="section-body">
           <div class="card">
             <div class="card-body">
               <p class="font-weight-bold">List Pengiriman</p>
               <hr>
               <div class="table">
                 <table class="table table-bordered">
                   <thead class="text-center">
                     <th><strong>Kd Kirim</strong></th>
                     <th><strong>Aksi</strong></th>
                   </thead>
                   <tbody class="text-center">
                     <?php foreach ($kirim as $data) : ?>
                       <tr>
                         <td>
                           <?= strtoupper($data->kd_delivlokal) ?>
                           <i class="fas fa-info-circle text-secondary mr-2" data-toggle="tooltip" title="<?= $data->total_reccu ?> Reccu"></i>
                         </td>
                         <td>
                           <a href="<?= base_url('kurir/detail/') . $data->kd_delivlokal ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Detail">
                             <i class="fas fa-eye"></i>
                           </a>
                         </td>
                       </tr>
                     <?php endforeach ?>
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
       </div>
     </section>
   </div>