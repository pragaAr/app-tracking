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
           <?php if ($this->uri->segment(1) == 'penjualan') { ?>
             <a href="<?= base_url('penjualan') ?>" class="btn btn-dark" data-toggle="tooltip" title="Kembali">
               <i class="fas fa-arrow-left"></i>
               Kembali
             </a>
           <?php } elseif ($this->uri->segment(1) == 'penjualanagen') { ?>
             <a href="<?= base_url('penjualanagen') ?>" class="btn btn-dark" data-toggle="tooltip" title="Kembali">
               <i class="fas fa-arrow-left"></i>
               Kembali
             </a>
           <?php } elseif ($this->uri->segment(1) == 'penjualancabang') { ?>
             <a href="<?= base_url('penjualancabang') ?>" class="btn btn-dark" data-toggle="tooltip" title="Kembali">
               <i class="fas fa-arrow-left"></i>
               Kembali
             </a>
           <?php } else { ?>
             <a href="<?= base_url('penjualanlokal') ?>" class="btn btn-dark" data-toggle="tooltip" title="Kembali">
               <i class="fas fa-arrow-left"></i>
               Kembali
             </a>
           <?php } ?>
         </div>
       </div>
     </div>

     <div class="section-body">
       <div class="row">
         <div class="col-lg-6 col-md">
           <div class="card">
             <div class="card-body">
               <div class="section-title font-weight-bold mt-0">Data Paket</div>
               <hr>
               <table class="table table-borderles">
                 <tbody class="font-weight-bold">
                   <tr>
                     <th scope="col"><strong>Reccu</strong></th>
                     <td>:</td>
                     <td> <?= strtoupper($penjualan->reccu); ?></td>
                   </tr>
                   <tr>
                     <th scope="col"><strong>Kd Paket</strong></th>
                     <td>:</td>
                     <td> <?= strtoupper($penjualan->kd_paket); ?></td>
                   </tr>
                   <tr>
                     <th scope="col"><strong>Asal</strong></th>
                     <td>:</td>
                     <td> <?= strtoupper($penjualan->cabasal); ?></td>
                   </tr>
                   <tr>
                     <th scope="col"><strong>Tujuan</strong></th>
                     <td>:</td>
                     <td> <?= strtoupper($penjualan->cabtujuan); ?></td>
                   </tr>
                   <tr>
                     <th scope="col"><strong>Pengirim</strong></th>
                     <td>:</td>
                     <td> <?= ucwords($penjualan->pengirim); ?>, <?= ucwords($penjualan->kotaasal); ?></td>
                   </tr>
                   <tr>
                     <th scope="col"><strong>Penerima</strong></th>
                     <td>:</td>
                     <td> <?= ucwords($penjualan->penerima); ?>, <?= ucwords($penjualan->kotatujuan); ?></td>
                   </tr>
                   <tr>
                     <th scope="col"><strong>Tanggal Kirim</strong></th>
                     <td>:</td>
                     <td><?= date('d-m-Y H:i:s', strtotime($penjualan->createdAt)); ?></td>
                   </tr>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
         <div class="col-lg-6 col-md">
           <div class="card">
             <div class="card-body">
               <div class="section-title font-weight-bold mt-0">Status Paket</div>
               <hr>
               <?php foreach ($track as $track) : ?>
                 <ul class="timeline">
                   <li>
                     <div class="row">
                       <div class="col-lg-6 col-md-6">
                         <p class="font-weight-bold">
                           Reccu : <?= $track->reccu ?>
                         </p>
                       </div>
                       <div class="col-lg-6 col-md-6">
                         <p>
                           <?= date('H:i:s d-m-Y', strtotime($track->createdAt)) ?>
                         </p>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col-lg col-md">
                         <?= ucwords($track->status) ?>
                       </div>
                     </div>
                   </li>
                   <hr>
                 </ul>
               <?php endforeach ?>
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>
 </div>