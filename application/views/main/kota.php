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
           <a href="<?= base_url('kota') ?>" class="btn btn-primary" data-toggle="modal" data-target="#addKota">
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
             <table class="table table-bordered" id="dtkota">
               <thead>
                 <tr>
                   <th class="text-center">No</th>
                   <th>Kd Kota</th>
                   <th>Nama Kota</th>
                   <th class="text-center">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $no = 1;
                  foreach ($kota as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= strtoupper($data->kd_kota) ?></td>
                     <td><?= strtoupper($data->nama_kota) ?></td>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="" class="btn btn-warning btn-sm btn-edit-kota" data-idkota="<?= $data->id_kota ?>" data-toggle="tooltip" title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                         </a>
                         <a href="<?= base_url('kota/delete/') . $data->id_kota; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
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

 <!-- addKota -->
 <form action="<?= base_url('kota') ?>" method="post">
   <div class="modal fade" id="addKota" aria-labelledby="addKotaLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-bold" id="addKotaLabel">Tambah Data Kota</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="form-group">
             <label class="font-weight-bold" for="kdkota">Kode Kota<span class="text-danger">*</span></label>
             <input type="text" class="form-control text-uppercase" name="kdkota" id="kdkota" value="<?= $kdkota ?>" readonly>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="namakota">Nama Kota<span class="text-danger">*</span></label>
             <input type="text" class="form-control text-uppercase" name="namakota" id="namakota" required oninvalid="this.setCustomValidity('Nama Kota wajib di isi!')" oninput="setCustomValidity('')">
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
       </div>
     </div>
   </div>
 </form>

 <!-- edit kota -->
 <form action="<?= base_url('kota/update') ?>" method="post">
   <div class="modal fade" id="editKota" tabindex="-1" role="dialog" aria-labelledby="editKotaLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="editKotaLabel">Edit Data Kota</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="form-group">
             <label class="font-weight-bold" for="kdkota">Kd Kota</label>
             <input type="hidden" name="idkota" class="idkota">
             <input type="text" class="form-control text-uppercase kdkota" name="kdkota" required readonly>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="namakota">Nama Kota<span class="text-danger">*</span></label>
             <input type="text" class="form-control text-uppercase namakota" name="namakota" required>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Update</button>
         </div>
       </div>
     </div>
   </div>
 </form>