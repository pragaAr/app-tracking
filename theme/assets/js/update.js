// pengiriman dari agen start
$(".btn-detail-agen").on("click", function (e) {
  e.preventDefault();
  let kd = $(this).data("id");

  $.ajax({
    url: "http://localhost/app-tracking/pengirimanagen/listdetail",
    type: "POST",
    dataType: "json",
    data: {
      kd_delivagen: kd,
    },
    success: function (data) {
      $(".kd").html(kd);
      $('input[name="kddeliv"]').val(kd);

      $("#delivAgen").modal("show");

      let datadetail = "";
      let formdetail = "";

      $.each(data, function (key, value) {
        datadetail += "<tr>";
        datadetail +=
          "<td class='text-uppercase'>" +
          value.reccu +
          "-" +
          value.kd_paket +
          "</td>";
        datadetail += "<td class='text-capitalize'>" + value.status + "</td>";
        datadetail += "</tr>";

        if (value.sentAt === null) {
          $(".update-deliv-agen").prop("disabled", false);
        } else {
          $(".update-deliv-agen").prop("disabled", true);
        }
      });

      $(".tbody-detail-agen").html(datadetail);

      $.each(data, function (key, value) {
        formdetail +=
          '<input type="hidden" class="form-control" name="reccu_hidden[]" value="' +
          value.reccu +
          '"readonly>';
      });
      $(".form-deliv-agen").html(formdetail);
    },
  });
});
// pengiriman dari agen end

// pengiriman dari cabang start
$(".btn-detail-in").on("click", function (e) {
  e.preventDefault();
  let kddeliv = $(this).data("id");

  $.ajax({
    url: "http://localhost/app-tracking/pengirimanmasuk/listdetail",
    type: "POST",
    dataType: "json",
    data: {
      kd_delivcab: kddeliv,
    },
    success: function (data) {
      $(".kd").html(kddeliv);
      $('input[name="kddeliv"]').val(kddeliv);

      $("#delivIn").modal("show");

      let datadetail = "";
      let formdetail = "";

      $.each(data, function (key, value) {
        datadetail += "<tr>";
        datadetail +=
          "<td class='text-uppercase'>" +
          value.reccu +
          "-" +
          value.kd_paket +
          "</td>";
        datadetail += "<td class='text-capitalize'>" + value.status + "</td>";
        datadetail += "</tr>";

        if (value.sentAt === null) {
          $(".update-deliv-in").prop("disabled", false);
        } else {
          $(".update-deliv-in").prop("disabled", true);
        }
      });

      $(".tbody-detail-in").html(datadetail);

      $.each(data, function (key, value) {
        formdetail +=
          '<input type="hidden" class="form-control" name="reccu_hidden[]" value="' +
          value.reccu +
          '"readonly>';
      });
      $(".form-deliv-in").html(formdetail);
    },
  });
});
// pengiriman dari cabang end
