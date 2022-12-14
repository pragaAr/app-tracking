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
           <a href="<?= base_url('user') ?>" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
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
             <table class="table table-bordered" id="dtuser">
               <thead>
                 <tr>
                   <th class="text-center">No</th>
                   <th>Kota Asal</th>
                   <th>Cabang</th>
                   <th>Nama User</th>
                   <th>Username</th>
                   <th>Role</th>
                   <th class="text-center">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $no = 1;
                  foreach ($user as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= ucwords($data->nama_kota) ?></td>
                     <td><?= strtoupper($data->nama_cab) ?></td>
                     <td><?= ucwords($data->nama_user) ?></td>
                     <td><?= $data->username ?></td>
                     <?php if ($data->role_access == 'superadmin') { ?>
                       <td>Admin Pusat</td>
                     <?php } elseif ($data->role_access == 'admcab') { ?>
                       <td>Admin <?= strtoupper($data->nama_cab) ?></td>
                     <?php } elseif ($data->role_access == 'admagen') { ?>
                       <td>Admin <?= strtoupper($data->nama_cab) ?></td>
                     <?php } else { ?>
                       <td>Loper <?= strtoupper($data->nama_cab) ?></td>
                     <?php } ?>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="" class="btn btn-warning btn-sm btn-edit-user" data-iduser="<?= $data->id_user ?>" data-toggle="tooltip" title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                         </a>
                         <a href="<?= base_url('user/delete/') . $data->id_user; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
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

 <!-- addUser -->
 <form action="<?= base_url('user') ?>" method="post">
   <div class="modal fade" id="addUser" data-backdrop="static" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-bold" id="addUserLabel">Tambah Data User</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="row">
             <div class="col-lg col-md">
               <div class="form-group">
                 <label class="font-weight-bold" for="kotaid">Kota Asal<span class="text-danger">*</span></label>
                 <select name="kotaid" class="form-control select2" required oninvalid="this.setCustomValidity('Kota Asal wajib di isi!')" oninput="setCustomValidity('')">
                   <option value="">Pilih Kota Asal</option>
                   <?php foreach ($kota as $kota) : ?>
                     <option value="<?= $kota->id_kota ?>"><?= ucwords($kota->nama_kota) ?></option>
                   <?php endforeach ?>
                 </select>
               </div>
               <div class="form-group">
                 <label class="font-weight-bold" for="cabid">Cabang<span class="text-danger">*</span></label>
                 <select name="cabid" class="form-control select2" required oninvalid="this.setCustomValidity('Cabang wajib di isi!')" oninput="setCustomValidity('')">
                   <option value="">Pilih Cabang Asal</option>
                   <?php foreach ($cab as $cab) : ?>
                     <option value="<?= $cab->id_cab ?>"><?= strtoupper($cab->nama_cab) ?></option>
                   <?php endforeach ?>
                 </select>
               </div>
               <div class="form-group">
                 <label class="font-weight-bold" for="nama">Nama User<span class="text-danger">*</span></label>
                 <input type="text" class="form-control text-capitalize" name="nama" required oninvalid="this.setCustomValidity('Nama User wajib di isi!')" oninput="setCustomValidity('')">
               </div>
             </div>
             <div class="col-lg-6 col-md">
               <div class="form-group">
                 <label class="font-weight-bold" for="uname">Username<span class="text-danger">*</span></label>
                 <input type="text" class="form-control" name="uname" required oninvalid="this.setCustomValidity('Username wajib di isi!')" oninput="setCustomValidity('')">
               </div>
               <div class="form-group">
                 <label class="font-weight-bold" for="pass">Password<span class="text-danger">*</span></label>
                 <input type="password" class="form-control" name="pass" required oninvalid="this.setCustomValidity('Password wajib di isi!')" oninput="setCustomValidity('')">
               </div>
               <div class="form-group">
                 <label class="font-weight-bold" for="role">Role<span class="text-danger">*</span></label>
                 <select name="role" class="form-control" required oninvalid="this.setCustomValidity('Role wajib di isi!')" oninput="setCustomValidity('')">
                   <option value="">Pilih Role</option>
                   <option value="admcab">Admin Cabang</option>
                   <option value="admagen">Admin Agen</option>
                   <option value="kurir">Kurir</option>
                   <option value="mandor">Mandor</option>
                 </select>
               </div>
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

 <!-- edit user -->
 <form action="<?= base_url('user/update') ?>" method="post">
   <div class="modal fade" id="editUser" data-backdrop="static" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="editUserLabel">Edit Data User</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="row">
             <div class="col-lg col-md">
               <div class="form-group">
                 <label class="font-weight-bold" for="kotaid">Kota Asal<span class="text-danger">*</span></label>
                 <input type="hidden" name="iduser" class="iduser">
                 <select name="kotaid" class="form-control select2 kotaid" required oninvalid="this.setCustomValidity('Kota Asal wajib di isi!')" oninput="setCustomValidity('')">
                   <option value="">Pilih Kota Asal</option>
                   <?php foreach ($kotaedit as $kota) : ?>
                     <option value="<?= $kota->id_kota ?>"><?= ucwords($kota->nama_kota) ?></option>
                   <?php endforeach ?>
                 </select>
               </div>
               <div class="form-group">
                 <label class="font-weight-bold" for="cabid">Cabang<span class="text-danger">*</span></label>
                 <select name="cabid" class="form-control select2 cabid" required oninvalid="this.setCustomValidity('Cabang wajib di isi!')" oninput="setCustomValidity('')">
                   <option value="">Pilih Cabang Asal</option>
                   <?php foreach ($cabedit as $cab) : ?>
                     <option value="<?= $cab->id_cab ?>"><?= strtoupper($cab->nama_cab) ?></option>
                   <?php endforeach ?>
                 </select>
               </div>
               <div class="form-group">
                 <label class="font-weight-bold" for="nama">Nama User<span class="text-danger">*</span></label>
                 <input type="text" class="form-control text-capitalize nama" name="nama" required oninvalid="this.setCustomValidity('Nama User wajib di isi!')" oninput="setCustomValidity('')">
               </div>
             </div>
             <div class="col-lg-6 col-md">
               <div class="form-group">
                 <label class="font-weight-bold" for="uname">Username<span class="text-danger">*</span></label>
                 <input type="text" class="form-control uname" name="uname" required oninvalid="this.setCustomValidity('Username wajib di isi!')" oninput="setCustomValidity('')">
               </div>
               <div class="form-group">
                 <label class="font-weight-bold" for="pass">Password<span class="text-danger">*</span></label>
                 <input type="password" class="form-control" name="pass" required oninvalid="this.setCustomValidity('Password wajib di isi!')" oninput="setCustomValidity('')">
               </div>
               <div class="form-group">
                 <label class="font-weight-bold" for="role">Role<span class="text-danger">*</span></label>
                 <select name="role" class="form-control role" required oninvalid="this.setCustomValidity('Role wajib di isi!')" oninput="setCustomValidity('')">
                   <option value="">Pilih Role</option>
                   <option value="admcab">Admin Cabang</option>
                   <option value="admagen">Admin Agen</option>
                   <option value="kurir">Kurir</option>
                 </select>
               </div>
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