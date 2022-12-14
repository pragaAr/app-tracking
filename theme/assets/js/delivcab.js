$(document).ready(function () {
  $("tfoot").hide();

  $(document).keypress(function (event) {
    if (event.which == "13") {
      event.preventDefault();
    }
  });

  $("#idpaket").on("input", function () {
    $.ajax({
      url: "http://localhost/app-tracking/pengirimancabang/getDataPaketId",
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

  $(document).on("click", "#tambah", function (e) {
    const data_keranjang = {
      idpaket: $('select[name="idpaket"]').val(),
      reccu: $('input[name="reccu"]').val(),
      kdpaket: $('input[name="kdpaket"]').val(),
      status: $('input[name="status"]').val(),
    };

    $.ajax({
      url: "http://localhost/app-tracking/pengirimancabang/cart",
      type: "POST",
      data: data_keranjang,
      success: function (data) {
        if ($('select[name="idpaket"]').val() == data_keranjang.idpaket)
          $('option[value="' + data_keranjang.idpaket + '"]').hide();

        reset();
        $("#tambah").prop("disabled", true);

        $("table#cart tbody").append(data);

        $("tfoot").show();
        $('[data-toggle="tooltip"]').tooltip();
      },
    });

    if ($('select[name="tujuan"]').val() == "") {
      $("button#simpan").prop("disabled", true);
    } else {
      $("button#simpan").prop("disabled", false);
    }
  });

  $(document).on("click", "#tombol-hapus", function () {
    $(this).closest(".row-cart").remove();

    if ($("tbody").children().length == 0) $("tfoot").hide();
  });

  $('button[type="submit"]').on("click", function () {
    $('select[name="idpaket"]').prop("disabled", true);
    $('input[name="status"]').prop("disabled", true);
  });

  function reset() {
    $("#idpaket").val(null).trigger("change");
  }
});
