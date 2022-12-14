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
           <a href="<?= base_url('ongkir') ?>" class="btn btn-primary" data-toggle="modal" data-target="#addOngkir">
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
             <table class="table table-bordered" id="dtongkir">
               <thead>
                 <tr>
                   <th class="text-center">No</th>
                   <th>Kota Asal</th>
                   <th>Kota Tujuan</th>
                   <th>Minimal</th>
                   <th>PerKg</th>
                   <th>Estimasi</th>
                   <th class="text-center">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $no = 1;
                  foreach ($ongkir as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= strtoupper($data->asal) ?></td>
                     <td><?= strtoupper($data->tujuan) ?></td>
                     <td>Rp. <?= number_format($data->minimal) ?></td>
                     <td>Rp. <?= number_format($data->perkg) ?></td>
                     <td><?= ucwords($data->estimasi) ?></td>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="" class="btn btn-warning btn-sm btn-edit-ongkir" data-idongkir="<?= $data->id_ongkir ?>" data-toggle="tooltip" title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                         </a>
                         <a href="<?= base_url('ongkir/delete/') . $data->id_ongkir; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
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

 <!-- addOngkir -->
 <form action="<?= base_url('ongkir') ?>" method="post">
   <div class="modal fade" id="addOngkir" data-backdrop="static" role="dialog" aria-labelledby="addOngkirLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-bold" id="addOngkirLabel">Tambah Data Ongkir</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="form-group">
             <label class="font-weight-bold" for="kotaasal">Kota Asal<span class="text-danger">*</span></label>
             <select name="kotaasal" class="select2 form-control text-capitalize" required oninvalid="this.setCustomValidity('Kota Asal wajib di isi!')" oninput="setCustomValidity('')">
               <option value="" selected disabled>Pilih Kota Asal</option>
               <?php foreach ($kotaasal as $kota) : ?>
                 <option value="<?= $kota->id_kota ?>"><?= ucwords($kota->nama_kota) ?></option>
               <?php endforeach ?>
             </select>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="kotatujuan">Kota Tujuan<span class="text-danger">*</span></label>
             <select name="kotatujuan" class="select2 form-control text-capitalize" required oninvalid="this.setCustomValidity('Kota Tujuan wajib di isi!')" oninput="setCustomValidity('')">
               <option value="" selected disabled>Pilih Kota Tujuan</option>
               <?php foreach ($kotatujuan as $kota) : ?>
                 <option value="<?= $kota->id_kota ?>"><?= ucwords($kota->nama_kota) ?></option>
               <?php endforeach ?>
             </select>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="minimal">Minimal<span class="text-danger">*</span></label>
             <input type="text" class="form-control" name="minimal" id="minimal" required oninvalid="this.setCustomValidity('Minimal wajib di isi!')" oninput="setCustomValidity('')">
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="perkg">PerKg<span class="text-danger">*</span></label>
             <input type="text" name="perkg" id="perkg" class="form-control" required oninvalid="this.setCustomValidity('PerKg wajib di isi!')" oninput="setCustomValidity('')">
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="estimasi">Estimasi<span class="text-danger">*</span></label>
             <input type="text" name="estimasi" class="form-control text-uppercase" required oninvalid="this.setCustomValidity('Estimasi wajib di isi!')" oninput="setCustomValidity('')">
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
       </div>
     </div>
   </div>
 </form>

 <!-- editOngkir -->
 <form action="<?= base_url('ongkir/update') ?>" method="post">
   <div class="modal fade" id="editOngkir" data-backdrop="static" role="dialog" aria-labelledby="editOngkirLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="editOngkirLabel">Edit Data Ongkir</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <hr>
           <div class="form-group">
             <label class="font-weight-bold" for="kotaasal">Kota Asal</label>
             <input type="hidden" name="idongkir" class="idongkir">
             <select name="kotaasal" class="form-control select2 text-capitalize kotaasal" required oninvalid="this.setCustomValidity('Kota Asal wajib di isi!')" oninput="setCustomValidity('')">
               <option value="">Pilih Kota</option>
               <?php foreach ($asal as $kota) : ?>
                 <option value="<?= $kota->id_kota ?>"><?= ucwords($kota->nama_kota) ?></option>
               <?php endforeach ?>
             </select>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="kotatujuan">Kota Tujuan</label>
             <select name="kotatujuan" class="form-control select2 text-capitalize kotatujuan" required oninvalid="this.setCustomValidity('Kota Tujuan wajib di isi!')" oninput="setCustomValidity('')">
               <option value="">Pilih Kota</option>
               <?php foreach ($tujuan as $kota) : ?>
                 <option value="<?= $kota->id_kota ?>"><?= ucwords($kota->nama_kota) ?></option>
               <?php endforeach ?>
             </select>
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="minimal">Minimal</label>
             <input type="text" class="form-control minimal" name="minimal" id="editminimal" required oninvalid="this.setCustomValidity('Minimal wajib di isi!')" oninput="setCustomValidity('')">
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="perkg">PerKg</label>
             <input type="text" class="form-control perkg" name="perkg" id="editperkg" required oninvalid="this.setCustomValidity('PerKg wajib di isi!')" oninput="setCustomValidity('')">
           </div>
           <div class="form-group">
             <label class="font-weight-bold" for="estimasi">Estimasi</label>
             <input type="text" class="form-control text-uppercase estimasi" name="estimasi" required oninvalid="this.setCustomValidity('Estimasi wajib di isi!')" oninput="setCustomValidity('')">
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Update</button>
         </div>
       </div>
     </div>
   </div>
 </form>