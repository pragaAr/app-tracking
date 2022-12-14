// edit reccu delivcab

$("#idpaket").on("input", function () {
  $.ajax({
    url: "http://localhost/app-tracking/pengirimanlokal/getDataPaketId",
    type: "POST",
    dataType: "json",
    data: {
      id_paket: $("#idpaket").val(),
    },
    success: function (data) {
      $('input[name="reccu"]').val(data.reccu);
      $('input[name="kdpaket"]').val(data.kd_paket);

      $("#addrecculokal").prop("disabled", false);
    },
  });
});

$(document).on("click", "#addrecculokal", function (e) {
  const data_update = {
    idpaket: $('select[name="idpaket"]').val(),
    reccu: $('input[name="reccu"]').val(),
    kdpaket: $('input[name="kdpaket"]').val(),
    status: $('input[name="status"]').val(),
  };

  $.ajax({
    url: "http://localhost/app-tracking/pengirimanlokal/cartupdate",
    type: "POST",
    data: data_update,
    success: function (data) {
      console.log(data);
      $(".idpaket").val(data.id_paket).trigger("change");

      $("table#dtrecculokal tbody").append(data);

      if ($(".tbdetail").length > 0) {
        $(".deliv-lokal-update").prop("disabled", false);
      }

      $("#addrecculokal").prop("disabled", true);
    },
  });
});

$(document).on("click", "#btn-hapus-reccu", function () {
  $(this).closest(".tbdetail").remove();

  if ($(".tbdetail").length < 1) {
    $(".deliv-lokal-update").prop("disabled", true);
  }
});
