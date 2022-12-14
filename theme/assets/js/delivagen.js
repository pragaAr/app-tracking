$(document).ready(function () {
  $("tfoot").hide();

  $(document).keypress(function (event) {
    if (event.which == "13") {
      event.preventDefault();
    }
  });

  $("#idpaket").on("input", function () {
    $.ajax({
      url: "http://localhost/app-tracking/pengirimanagen/getDataPaketId",
      type: "POST",
      dataType: "json",
      data: {
        id_paket: $("#idpaket").val(),
      },
      success: function (data) {
        $('input[name="reccu"]').val(data.reccu);
        $('input[name="kdpaket"]').val(data.kd_paket);

        $("#tambah").prop("disabled", false);
      },
    });
  });

  // check if this have or not value, affected to the button Tambah
  // $('select[name="idpaket"]').on("change", function () {
  //   if ($('select[name="idpaket"]').val() == "") {
  //     $("button#tambah").prop("disabled", true);
  //   } else {
  //     $("button#tambah").prop("disabled", false);
  //   }
  // });

  $("button#tambah").on("click", function (e) {
    const data_keranjang = {
      reccu: $('input[name="reccu"]').val(),
      kdpaket: $('input[name="kdpaket"]').val(),
      status: $('input[name="status"]').val(),
    };

    $.ajax({
      url: "http://localhost/app-tracking/pengirimanagen/cart",
      type: "POST",
      data: data_keranjang,
      success: function (data) {
        if ($('select[name="idpaket"]').val() == data_keranjang.reccu)
          $('option[value="' + data_keranjang.reccu + '"]').hide();

        $("#tambah").prop("disabled", true);

        $("table#cart tbody").append(data);

        $("tfoot").show();
        $('[data-toggle="tooltip"]').tooltip();
      },
    });
    reset();
  });

  $(document).on("click", "#tombol-hapus", function () {
    $(this).closest(".row-cart").remove();

    if ($("tbody").children().length == 0) $("tfoot").hide();
  });

  $('button[type="submit"]').on("click", function () {
    $('select[name="idpaket"]').prop("disabled", true);
    $('input[name="kdpaket"]').prop("disabled", true);
    $('input[name="status"]').prop("disabled", true);
  });

  function reset() {
    $(".idpaket").val(null).trigger("change");
    $('input[name="kdpaket"]').val("");
  }
});
