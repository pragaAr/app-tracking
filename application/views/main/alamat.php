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
           <a href="<?= base_url('alamat') ?>" class="btn btn-primary" data-toggle="modal" data-target="#addAlamat">
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
             <table class="table table-bordered" id="dtalamat">
               <thead>
                 <tr>
                   <th class="text-center">No</th>
                   <th>Kota</th>
                   <th>Alamat</th>
                   <th>Daerah</th>
                   <th>No Telepon</th>
                   <th>Kd Pos</th>
                   <th class="text-center">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $no = 1;
                  foreach ($addr as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= strtoupper($data->nama_kota) ?></td>
                     <td><?= strtoupper($data->alamat) ?></td>
                     <td><?= strtoupper($data->daerah) ?></td>
                     <td><?= $data->notelp ?></td>
                     <td><?= $data->kdpos ?></td>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="" class="btn btn-warning btn-sm btn-edit-alamat" data-idalamat="<?= $data->id_alamat ?>" data-toggle="tooltip" title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                         </a>
                         <a href="<?= base_url('alamat/delete/') . $data->id_alamat; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
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

 <!-- addAlamat -->
 <form action="<?= base_url('alamat') ?>" method="post">
   <div class="modal fade" id="addAlamat" data-backdrop="static" role="dialog" aria-labelledby="addAlamatLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-bold" id="addAlamatLabel">Tambah Data Alamat</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="form-row">
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="kotaid">Kota<span class="text-danger">*</span></label>
               <select name="kotaid" class="form-control select2" required oninvalid="this.setCustomValidity('Kota wajib di isi!')" oninput="setCustomValidity('')">
                 <option value="">Pilih Kota</option>
                 <?php foreach ($kota as $kota) : ?>
                   <option value="<?= $kota->id_kota ?>"><?= strtoupper($kota->nama_kota) ?></option>
                 <?php endforeach ?>
               </select>
             </div>
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="daerah">Daerah<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase" name="daerah">
             </div>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="alamat">Alamat<span class="text-danger">*</span></label>
             <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control text-uppercase" required oninvalid="this.setCustomValidity('Alamat wajib di isi!')" oninput="setCustomValidity('')"></textarea>
           </div>
           <div class="form-row">
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="notelp">No Telepon<span class="text-danger">*</span></label>
               <input type="text" class="form-control" name="notelp" required oninvalid="this.setCustomValidity('No Telepon wajib di isi!')" oninput="setCustomValidity('')">
             </div>
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="kdpos">Kd Pos</label>
               <input type="text" class="form-control" name="kdpos">
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
       </div>
     </div>
   </div>
 </form>

 <!-- edit alamat -->
 <form action="<?= base_url('alamat/update') ?>" method="post">
   <div class="modal fade" id="editAlamat" data-backdrop="static" role="dialog" aria-labelledby="editAlamatLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="editAlamatLabel">Edit Data Alamat</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="form-row">
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="kotaid">Kota<span class="text-danger">*</span></label>
               <input type="hidden" class="form-control idalamat" name="idalamat" required>
               <select name="kotaid" class="form-control select2 kotaid" required oninvalid="this.setCustomValidity('Kota wajib di isi!')" oninput="setCustomValidity('')">
                 <option value="">Pilih Kota</option>
                 <?php foreach ($kotaedit as $kota) : ?>
                   <option value="<?= $kota->id_kota ?>"><?= strtoupper($kota->nama_kota) ?></option>
                 <?php endforeach ?>
               </select>
             </div>
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="daerah">Daerah<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase daerah" name="daerah">
             </div>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="alamat">Alamat<span class="text-danger">*</span></label>
             <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control text-uppercase alamat" required oninvalid="this.setCustomValidity('Alamat wajib di isi!')" oninput="setCustomValidity('')"></textarea>
           </div>
           <div class="form-row">
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="notelp">No Telepon<span class="text-danger">*</span></label>
               <input type="text" class="form-control notelp" name="notelp" required oninvalid="this.setCustomValidity('No Telepon wajib di isi!')" oninput="setCustomValidity('')">
             </div>
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="kdpos">Kd Pos</label>
               <input type="text" class="form-control kdpos" name="kdpos">
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Update</button>
         </div>
       </div>
     </div>
   </div>
 </form>