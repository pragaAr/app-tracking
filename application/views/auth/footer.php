<!-- General JS Scripts -->
<script src="<?= base_url('theme/assets/js/jquery/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/popper/popper.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/bootstrap/bootstrap-4.3.1.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/jquery/nicescroll.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/jquery/momment.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/stisla.js') ?>"></script>

<script src="<?= base_url('theme/assets/js/scripts.js') ?>"></script>

<script src="<?= base_url('theme/assets/js/swal/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/swal/customswal.js') ?>"></script>


<script>
  const flashrole = $('.flashrole').data('flashdata');

  if (flashrole) {
    Swal.fire({
      icon: 'error',
      title: 'Eheemmm!!',
      text: flashrole,
    });
  }

  const wrongdata = $('.wrongdata').data('flashdata');

  if (wrongdata) {
    Swal.fire({
      icon: 'error',
      title: 'Ops!',
      text: wrongdata,
    });
  }

  const userlogout = $('.userlogout').data('flashdata');

  if (userlogout) {
    Swal.fire({
      icon: 'success',
      title: 'Anda telah keluar',
      text: userlogout,
    });
  }

  const userregister = $('.userregister').data('flashdata');

  if (userregister) {
    Swal.fire({
      icon: 'success',
      title: 'Registrasi berhasil !',
      text: userregister,
    });
  }
</script>

</body>

</html>