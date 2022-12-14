   <!-- Main Content -->
   <div class="main-content">
     <div class="updated" data-flashdata="<?= $this->session->flashdata('updated'); ?>"></div>
     <section class="section">

       <div class="section-body">
         <div class="card">
           <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-3">
               <p class="font-weight-bold mt-0 mb-0"><?= $title ?></p>
               <a href="<?= base_url('kurir') ?>" class="btn btn-dark btn-sm">
                 <i class="fas fa-arrow-left"></i>
                 Kembali
               </a>
             </div>
             <p class="font-weight-bold">Kd Delivery : <?= strtoupper($this->uri->segment(3)) ?></p>
             <hr>
             <div class="table">
               <table class="table table-bordered" id="dataTables">
                 <thead class="text-center">
                   <th width="15%"><strong>Reccu</strong></th>
                   <th width="5%"><strong>Aksi</strong></th>
                 </thead>
                 <tbody class="text-center">
                   <?php foreach ($kirim as $data) : ?>
                     <tr>
                       <td>
                         <?= $data->reccu ?>-<?= strtoupper($data->kd_paket) ?>
                       </td>

                       <?php if ($data->sentAt == null) { ?>
                         <td>
                           <a href="" data-id="<?= $data->id_detaillokal ?>" class="btn btn-sm btn-primary btn-terkirim">
                             <i class="fas fa-pencil-alt"></i>
                           </a>
                         </td>
                       <?php } else { ?>
                         <td>
                           <button class="btn btn-sm btn-success" title="Terkirim" disabled>
                             <i class="fas fa-check"></i>
                           </button>
                         </td>
                       <?php } ?>
                     </tr>
                   <?php endforeach ?>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
     </section>
   </div>

   <!-- updatePaketTerkirim -->
   <form action="<?= base_url('kurir/updatepengiriman') ?>" method="post">
     <div class="modal fade" id="updatePaketTerkirim" tabindex="-1" aria-labelledby="updatePaketTerkirimLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="updatePaketTerkirimLabel">Update Status Paket</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body body-update-paket">
             <div class="form-group">
               <label for="reccu">Reccu</label>
               <input type="text" class="form-control reccu" name="reccu" required readonly>
               <input type="hidden" class="form-control iddetaillokal" name="iddetaillokal" required readonly>
               <input type="hidden" class="form-control kddelivlokal" name="kddelivlokal" required readonly>
             </div>
             <div class="form-group">
               <label for="penerima">Penerima</label>
               <input type="text" class="form-control" name="penerima" id="penerima" required oninvalid="this.setCustomValidity('Penerima wajib di isi!')" oninput="setCustomValidity('')">
             </div>
           </div>
           <div class="modal-footer">
             <button type="submit" class="btn btn-primary">Update</button>
           </div>
         </div>
       </div>
     </div>
   </form>