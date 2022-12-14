<footer class="main-footer">
  <div class="footer-left">
    <div class="bullet"></div>
    &copy; 2022
    PT. Hira Adya Naranata
    <i class="fas fa-heart text-danger"></i>
    <div class="bullet"></div>
  </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="<?= base_url('theme/assets/js/jquery/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/popper/popper.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/bootstrap/bootstrap-4.3.1.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/select2.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/jquery/nicescroll.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/jquery/momment.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/stisla.js') ?>"></script>

<!-- JS Libraies -->
<script src="<?= base_url('theme/assets/js/chartjs/chartjs.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/swal/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/responsive.bootstrap4.min.js') ?>"></script>

<!-- Template JS File -->
<script src="<?= base_url('theme/assets/js/scripts.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/clock.js') ?>"></script>

<!-- Page Specific JS File -->
<script src="<?= base_url('theme/assets/js/custom.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/swal/customswal.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/update.js') ?>"></script>

<script>
  $(".select2").select2();
</script>

<script>
  $('.tombol-update').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
      title: 'Apakah anda yakin ?',
      text: 'Status akan diupdate!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Ya, Update !'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    })
  });
</script>


</body>

</html>