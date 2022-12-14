<footer class="main-footer fixed-bottom" style="z-index:890">
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
<script src="<?= base_url('theme/assets/js/jquery/nicescroll.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/jquery/momment.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/stisla.js') ?>"></script>

<!-- JS Libraies -->
<script src="<?= base_url('theme/assets/js/swal/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/datatables/responsive.bootstrap4.min.js') ?>"></script>

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="<?= base_url('theme/assets/js/scripts.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/swal/customswal.js') ?>"></script>
<script src="<?= base_url('theme/assets/js/clock.js') ?>"></script>

<script>
  $(document).ready(function() {
    $('#dataTables').DataTable({
      "processing": true,
      "serverside": true,
      "info": false,
      lengthChange: false,

      // "paging": false,
      language: {
        searchPlaceholder: "Cari Reccu..",
        search: ""
      },
      lengthMenu: [
        [15, 25, 50, 100, -1],
        [15, 25, 50, 100, "All"]
      ],
      columnDefs: [{
        targets: -1,
        orderable: false,
        searchable: false
      }]
    });

  });
</script>

<script>
  const userlogin = $('.userlogin').data('flashdata');

  if (userlogin) {
    Swal.fire({
      icon: 'success',
      title: 'Selamat Datang!',
      text: userlogin,
    });
  }

  const updated = $('.updated').data('flashdata');

  if (updated) {
    Swal.fire({
      icon: 'success',
      title: 'Updated!',
      text: updated,
    });
  }
</script>

<script>
  //  update paket terkirim
  $(".btn-terkirim").on("click", function(e) {
    e.preventDefault();
    const id = $(this).data("id");
    $.ajax({
      url: "http://localhost/app-tracking/kurir/getPaketId",
      type: "POST",
      dataType: "json",
      data: {
        id_delivlokal: id,
      },
      success: function(data) {
        console.log(data)
        $(".kddelivlokal").val(data.kd_delivlokal);
        $(".iddetaillokal").val(data.id_detaillokal);
        $(".reccu").val(data.reccu);
      },
    });

    $("#updatePaketTerkirim").modal("show");
    $("#updatePaketTerkirim").on("shown.bs.modal", function() {
      $('input[name="penerima"]').focus();
    });
  });
</script>

</body>

</html>