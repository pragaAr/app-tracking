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
           <a href="<?= base_url('cabang') ?>" class="btn btn-primary" data-toggle="modal" data-target="#addCab">
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
                   <th>Kd Cabang</th>
                   <th>Kota</th>
                   <th>Nama Cabang</th>
                   <th>Jenis</th>
                   <th class="text-center">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $no = 1;
                  foreach ($cabang as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= strtoupper($data->kd_cab) ?></td>
                     <td><?= ucwords($data->nama_kota) ?></td>
                     <td><?= strtoupper($data->nama_cab) ?></td>
                     <td><?= ucwords($data->jenis_cab) ?></td>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="" class="btn btn-warning btn-sm btn-edit-cab" data-idcab="<?= $data->id_cab ?>" data-toggle="tooltip" title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                         </a>
                         <a href="<?= base_url('cabang/delete/') . $data->id_cab; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
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

 <!-- addCab -->
 <form action="<?= base_url('cabang') ?>" method="post">
   <div class="modal fade" id="addCab" data-backdrop="static" role="dialog" aria-labelledby="addCabLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-bold" id="addCabLabel">Tambah Data Cabang</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="form-group">
             <label class="font-weight-bold" for="kdcab">Kode Cabang<span class="text-danger">*</span></label>
             <input type="text" class="form-control text-uppercase" name="kdcab" id="kdcab" value="<?= $kdcab ?>" readonly>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="namacab">Nama Cabang<span class="text-danger">*</span></label>
             <input type="text" class="form-control text-uppercase" name="namacab" id="namacab" required oninvalid="this.setCustomValidity('Nama Cabang wajib di isi!')" oninput="setCustomValidity('')">
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="kotacab">Kota<span class="text-danger">*</span></label>
             <select name="kotacab" class="form-control select2 text-capitalize" required oninvalid="this.setCustomValidity('Kota wajib di isi!')" oninput="setCustomValidity('')">
               <option value="" selected disabled>Pilih Kota</option>
               <?php foreach ($kota as $kota) : ?>
                 <option value="<?= $kota->id_kota ?>"><?= ucwords($kota->nama_kota) ?></option>
               <?php endforeach ?>
             </select>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="jeniscab">Jenis Cabang<span class="text-danger">*</span></label>
             <select name="jeniscab" id="jeniscab" class="form-control text-capitalize" required oninvalid="this.setCustomValidity('Jenis Cabang wajib di isi!')" oninput="setCustomValidity('')">
               <option value="" selected disabled>Pilih Jenis</option>
               <option value="cabang">Cabang</option>
               <option value="agen">Agen</option>
             </select>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
       </div>
     </div>
   </div>
 </form>

 <!-- editCab -->
 <form action="<?= base_url('cabang/update') ?>" method="post">
   <div class="modal fade" id="editCab" data-backdrop="static" role="dialog" aria-labelledby="editCabLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="editCabLabel">Edit Data Cabang</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="form-group">
             <label class="font-weight-bold" for="kdcab">Kd Cabang</label>
             <input type="hidden" name="idcab" class="idcab">
             <input type="text" class="form-control text-uppercase kdcab" name="kdcab" required readonly>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="namacab">Nama Cabang</label>
             <input type="text" class="form-control text-uppercase namacab" name="namacab" required oninvalid="this.setCustomValidity('Nama Cabang wajib di isi!')" oninput="setCustomValidity('')">
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="kotacab">Kota</label>
             <select name="kotacab" class="form-control select2 kotacab" required oninvalid="this.setCustomValidity('Kota wajib di isi!')" oninput="setCustomValidity('')">
               <option value="">Pilih Kota</option>
               <?php foreach ($edit as $kota) : ?>
                 <option value="<?= $kota->id_kota ?>"><?= ucwords($kota->nama_kota) ?></option>
               <?php endforeach ?>
             </select>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="jeniscab">Jenis Cabang</label>
             <select name="jeniscab" class="form-control text-capitalize jeniscab" required oninvalid="this.setCustomValidity('Jenis Cabang wajib di isi!')" oninput="setCustomValidity('')">
               <option value="">Pilih Jenis</option>
               <option value="cabang">Cabang</option>
               <option value="agen">Agen</option>
             </select>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Update</button>
         </div>
       </div>
     </div>
   </div>
 </form>