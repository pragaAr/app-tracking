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
           <a href="<?= base_url('penjualanagen') ?>" class="btn btn-primary" data-toggle="modal" data-target="#addPenagen">
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
             <table class="table table-bordered" id="dtpenjualan">
               <thead>
                 <tr>
                   <th class="text-center">No</th>
                   <th>Reccu</th>
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
                  foreach ($penagen as $data) : ?>
                   <tr>
                     <td class="text-center"><?= $no ?>.</td>
                     <td><?= $data->reccu ?></td>
                     <td><?= strtoupper($data->kd_paket) ?> - <?= $data->koli ?> Koli</td>
                     <td><?= strtoupper($data->pengirim) ?> - <?= strtoupper($data->kotaasal) ?></td>
                     <td><?= strtoupper($data->penerima) ?> - <?= strtoupper($data->kotatujuan) ?></td>
                     <td>
                       <?= date('d-m-Y H:i:s', strtotime($data->createdAt)) ?>
                     </td>
                     <td class="text-center">
                       <div class="btn-group" role="group">
                         <a href="" class="btn btn-warning btn-sm btn-edit-penagen" data-idpaket="<?= $data->id_paket ?>" data-toggle="tooltip" title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                         </a>
                         <a href="<?= base_url('penjualanagen/detail/') . $data->reccu; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="Detail">
                           <i class="fas fa-eye"></i>
                         </a>
                         <?php if ($data->agenSentAt == null) { ?>
                           <a href="<?= base_url('penjualanagen/delete/') . $data->reccu; ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
                             <i class="fas fa-trash"></i>
                           </a>
                         <?php } else { ?>

                         <?php } ?>
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

 <!-- addPenagen -->
 <form action="<?= base_url('penjualanagen') ?>" method="post">
   <div class="modal fade" id="addPenagen" data-backdrop="static" role="dialog" aria-labelledby="addPenagenLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-bold" id="addPenagenLabel">Tambah Data Paket</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <span class="text-danger font-weight-bold">Harap teliti saat menginputkan data..!</span>
           <hr>
           <div class="form-row">
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="reccu">Reccu<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase" name="reccu" id="reccu" maxlength="6" minlength="6" required oninvalid="this.setCustomValidity('Reccu wajib di isi!')" oninput="setCustomValidity('')">
               <div class="output"></div>
             </div>
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="kdpaket">Kd Paket<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase" name="kdpaket" id="kdpaket" required oninvalid="this.setCustomValidity('Kd Paket wajib di isi!')" oninput="setCustomValidity('')">
             </div>
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="koli">Koli<span class="text-danger">*</span></label>
               <input type="number" class="form-control text-uppercase" name="koli" id="koli" required oninvalid="this.setCustomValidity('Koli wajib di isi!')" oninput="setCustomValidity('')">
             </div>
           </div>
           <div class="form-row">
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="pengirim">Pengirim<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase" name="pengirim" id="pengirim" required oninvalid="this.setCustomValidity('Pengirim wajib di isi!')" oninput="setCustomValidity('')">
             </div>
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="penerima">Penerima<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase" name="penerima" id="penerima" required oninvalid="this.setCustomValidity('Penerima wajib di isi!')" oninput="setCustomValidity('')">
             </div>
           </div>
           <div class="form-row">
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="kotaasal">Kota Asal<span class="text-danger">*</span></label>
               <input type="hidden" class="form-control" name="kotaasal" id="kotaasal" value="<?= $asal->id_kota ?>" required readonly>
               <input type="text" class="form-control text-uppercase" name="namakotaasal" id="namakotaasal" value="<?= $asal->nama_kota ?>" required readonly>
             </div>
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="kotatujuan">Kota Tujuan<span class="text-danger">*</span></label>
               <select name="kotatujuan" class="form-control select2" required oninvalid="this.setCustomValidity('Kota tujuan wajib di isi!')" oninput="setCustomValidity('')">
                 <option value="" selected>Pilih Kota Tujuan</option>
                 <?php foreach ($kotatujuan as $tujuan) : ?>
                   <option value="<?= $tujuan->id_kota ?>"><?= strtoupper($tujuan->nama_kota) ?></option>
                 <?php endforeach ?>
               </select>
             </div>
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="cabtujuan">Cabang Tujuan<span class="text-danger">*</span></label>
               <select name="cabtujuan" class="form-control select2" required oninvalid="this.setCustomValidity('Kota tujuan wajib di isi!')" oninput="setCustomValidity('')">
                 <option value="" selected>Pilih Cab Tujuan</option>
                 <?php foreach ($cabtujuan as $cab) : ?>
                   <option value="<?= $cab->id_cab ?>"><?= strtoupper($cab->nama_cab) ?></option>
                 <?php endforeach ?>
               </select>
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" id="add-penjualan" class="btn btn-primary">Simpan</button>
         </div>
       </div>
     </div>
   </div>
 </form>

 <!-- editPenagen -->
 <form action="<?= base_url('penjualanagen/update') ?>" method="post">
   <div class="modal fade" id="editPenagen" data-backdrop="static" role="dialog" aria-labelledby="editPenagenLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="editPenagenLabel">Edit Data Penjualan</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <span class="text-danger font-weight-bold">Harap teliti saat menginputkan data..!</span>
           <hr>
           <div class="form-row">
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="reccunew">Reccu<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase reccunew" name="reccunew" id="reccunew" maxlength="6" minlength="6" required oninvalid="this.setCustomValidity('Reccu wajib di isi!')" oninput="setCustomValidity('')">
               <input type="hidden" name="reccu" class="form-control reccu" readonly>
               <div class="output"></div>
             </div>
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="kdpaket">Kd Paket<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase kdpaket" name="kdpaket" required oninvalid="this.setCustomValidity('Kd Paket wajib di isi!')" oninput="setCustomValidity('')">
             </div>
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="koli">Koli<span class="text-danger">*</span></label>
               <input type="number" class="form-control text-uppercase koli" name="koli" required oninvalid="this.setCustomValidity('Koli wajib di isi!')" oninput="setCustomValidity('')">
             </div>
           </div>
           <div class="form-row">
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="pengirim">Pengirim<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase pengirim" name="pengirim" required oninvalid="this.setCustomValidity('Pengirim wajib di isi!')" oninput="setCustomValidity('')">
             </div>
             <div class="form-group col-lg-6 col-md">
               <label class="font-weight-bold" for="penerima">Penerima<span class="text-danger">*</span></label>
               <input type="text" class="form-control text-uppercase penerima" name="penerima" required oninvalid="this.setCustomValidity('Penerima wajib di isi!')" oninput="setCustomValidity('')">
             </div>
           </div>
           <div class="form-row">
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="kotaasal">Kota Asal<span class="text-danger">*</span></label>
               <input type="hidden" class="form-control" name="kotaasal" id="kotaasal" value="<?= $asal->id_kota ?>" required readonly>
               <input type="hidden" class="form-control text-uppercase cabasal" name="cabasal" id="cabasal" required readonly>
               <input type="text" class="form-control text-uppercase" name="namakotaasal" id="namakotaasal" value="<?= $asal->nama_kota ?>" required readonly>
             </div>
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="kotatujuan">Kota Tujuan<span class="text-danger">*</span></label>
               <select name="kotatujuan" class="form-control kotatujuan select2" required oninvalid="this.setCustomValidity('Kota tujuan wajib di isi!')" oninput="setCustomValidity('')">
                 <option value="" selected>Pilih Kota Tujuan</option>
                 <?php foreach ($kotatujuan as $tujuan) : ?>
                   <option value="<?= $tujuan->id_kota ?>"><?= strtoupper($tujuan->nama_kota) ?></option>
                 <?php endforeach ?>
               </select>
             </div>
             <div class="form-group col-lg-4 col-md">
               <label class="font-weight-bold" for="cabtujuan">Cabang Tujuan<span class="text-danger">*</span></label>
               <select name="cabtujuan" class="form-control cabtujuan select2" required oninvalid="this.setCustomValidity('Kota tujuan wajib di isi!')" oninput="setCustomValidity('')">
                 <option value="" selected>Pilih Cab Tujuan</option>
                 <?php foreach ($cabtujuan as $cab) : ?>
                   <option value="<?= $cab->id_cab ?>"><?= strtoupper($cab->nama_cab) ?></option>
                 <?php endforeach ?>
               </select>
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" id="btn-edit" class="btn btn-primary">Update</button>
         </div>
       </div>
     </div>
   </div>
 </form>