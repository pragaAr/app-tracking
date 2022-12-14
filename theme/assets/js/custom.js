"use strict";

// number only start
$("#minimal").on("keypress", function (key) {
  if (key.charCode < 48 || key.charCode > 57) return false;
});

$("#perkg").on("keypress", function (key) {
  if (key.charCode < 48 || key.charCode > 57) return false;
});

$("#editminimal").on("keypress", function (key) {
  if (key.charCode < 48 || key.charCode > 57) return false;
});

$("#editperkg").on("keypress", function (key) {
  if (key.charCode < 48 || key.charCode > 57) return false;
});
// number only end

// maskmoney start
$(function () {
  $("#editminimal").on("keydown keyup click change blur input", function (e) {
    $(this).val(format($(this).val()));
  });
});

$(function () {
  $("#editperkg").on("keydown keyup click change blur input", function (e) {
    $(this).val(format($(this).val()));
  });
});

$(function () {
  $("#minimal").on("keydown keyup click change blur input", function (e) {
    $(this).val(format($(this).val()));
  });
});

$(function () {
  $("#perkg").on("keydown keyup click change blur input", function (e) {
    $(this).val(format($(this).val()));
  });
});

// maskmoney end

// swal start
const userlogin = $(".userlogin").data("flashdata");

if (userlogin) {
  Swal.fire({
    icon: "success",
    title: "Login berhasil!",
    text: userlogin,
  });
}

const inserted = $(".inserted").data("flashdata");

if (inserted) {
  Swal.fire({
    icon: "success",
    title: "Success!",
    text: inserted,
  });
}

const updated = $(".updated").data("flashdata");

if (updated) {
  Swal.fire({
    icon: "success",
    title: "Updated!",
    text: updated,
  });
}

const deleted = $(".deleted").data("flashdata");

if (deleted) {
  Swal.fire({
    icon: "success",
    title: "Deleted!",
    text: deleted,
  });
}

$(".btn-delete").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah anda yakin ?",
    text: "Data akan di hapus!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Batal",
    confirmButtonText: "Ya, Hapus !",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

// $(".deliv-in-update").on("click", function () {
//   Swal.fire({
//     title: "Apakah anda yakin ?",
//     text: "Status akan di update!",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonColor: "#3085d6",
//     cancelButtonColor: "#d33",
//     cancelButtonText: "Batal",
//     confirmButtonText: "Ya, Update !",
//   }).then((result) => {
//     if (result.value) {
//       document.location.href = href;
//     }
//   });
// });
// swal end

// modal start
$("#addCab").on("shown.bs.modal", function () {
  $('input[name="namacab"]').focus();
});
$("#addKota").on("shown.bs.modal", function () {
  $('input[name="namakota"]').focus();
});
$("#addPenjualan").on("shown.bs.modal", function () {
  $('input[name="reccu"]').focus();
});
$("#addPenlok").on("shown.bs.modal", function () {
  $('input[name="reccu"]').focus();
});
$("#addPenagen").on("shown.bs.modal", function () {
  $('input[name="reccu"]').focus();
});
// modal end

// datatables start
$("#dtalamat").DataTable({
  processing: true,
  serverside: true,
  lengthChange: false,
  language: {
    searchPlaceholder: "Cari Alamat..",
    search: "",
  },
});

$("#dtcab").DataTable({
  processing: true,
  serverside: true,
  lengthChange: false,
  language: {
    searchPlaceholder: "Cari Cabang..",
    search: "",
  },
});

$("#dtdeliv").DataTable({
  processing: true,
  serverside: true,
  lengthChange: false,
  language: {
    searchPlaceholder: "Cari Pengiriman..",
    search: "",
  },
});

$("#dtreccu").DataTable({
  processing: true,
  serverside: true,
  lengthChange: false,
  language: {
    searchPlaceholder: "Cari Reccu..",
    search: "",
  },
});

$("#dtdelivcab").DataTable({
  processing: true,
  serverside: true,
  info: false,
  lengthMenu: [
    [25, 50, 100, -1],
    [25, 50, 100, "All"],
  ],
  columnDefs: [
    {
      targets: -1,
      orderable: false,
      searchable: false,
    },
  ],
});

// $("#dtdelivcab").DataTable({
//   processing: true,
//   serverside: true,
//   lengthChange: true,
//   info: false,
//   paging: false,
//   language: {
//     searchPlaceholder: "Cari Pengiriman..",
//     search: "",
//   },
// });

$("#dtkota").DataTable({
  processing: true,
  serverside: true,
  lengthChange: false,
  language: {
    searchPlaceholder: "Cari Kota..",
    search: "",
  },
});

$("#dtongkir").DataTable({
  processing: true,
  serverside: true,
  lengthChange: false,
  language: {
    searchPlaceholder: "Cari Ongkir..",
    search: "",
  },
});

$("#dtpenjualan").DataTable({
  processing: true,
  serverside: true,
  lengthChange: false,
  language: {
    searchPlaceholder: "Cari Penjualan..",
    search: "",
  },
});

$("#dtuser").DataTable({
  processing: true,
  serverside: true,
  lengthChange: false,
  language: {
    searchPlaceholder: "Cari User..",
    search: "",
  },
});
// datatables end

// cek reccu start
$("#reccu").on("keyup", function () {
  $.ajax({
    url: "http://localhost/app-tracking/cek/cekDataReccu",
    type: "POST",
    dataType: "json",
    data: {
      reccu: $("#reccu").val(),
    },
    success: function (data) {
      if (data.length > 0) {
        setTimeout(() => {
          $(".output")
            .show()
            .html(
              "<span class='text-danger font-weight-bold'>Reccu sudah digunakan..!</span>"
            )
            .fadeIn("slow");
          $('select[name="kotaasal"]').prop("disabled", true);
          $('select[name="kotatujuan"]').prop("disabled", true);
          $('select[name="cabtujuan"]').prop("disabled", true);
          $('input[name="kdpaket"]').prop("readonly", true);
          $('input[name="koli"]').prop("readonly", true);
          $('input[name="pengirim"]').prop("readonly", true);
          $('input[name="penerima"]').prop("disabled", true);
          $("button#add-penjualan").prop("disabled", true);
        }, 300);
      } else {
        setTimeout(() => {
          $(".output")
            .show()
            .html("<span class='text-success font-weight-bold'></span>")
            .fadeIn("slow");
          $('select[name="kotaasal"]').prop("disabled", false);
          $('select[name="kotatujuan"]').prop("disabled", false);
          $('select[name="cabtujuan"]').prop("disabled", false);
          $('input[name="kdpaket"]').prop("readonly", false);
          $('input[name="koli"]').prop("readonly", false);
          $('input[name="pengirim"]').prop("readonly", false);
          $('input[name="penerima"]').prop("disabled", false);
          $("button#add-penjualan").prop("disabled", false);
        }, 300);
      }
    },
  });
});
// cek reccu end

// cek reccunew start
$("#reccunew").on("keyup", function () {
  if ($("#reccunew").val() != $(".reccu").val()) {
    $.ajax({
      url: "http://localhost/app-tracking/cek/cekDataReccu",
      type: "POST",
      dataType: "json",
      data: {
        reccu: $("#reccunew").val(),
      },
      success: function (data) {
        if (data.length > 0) {
          setTimeout(() => {
            $(".output")
              .show()
              .html(
                "<span class='text-danger font-weight-bold'>Reccu sudah digunakan..!</span>"
              )
              .fadeIn("slow");
            $('select[name="kotaasal"]').prop("disabled", true);
            $('select[name="kotatujuan"]').prop("disabled", true);
            $('select[name="cabtujuan"]').prop("disabled", true);
            $('input[name="kdpaket"]').prop("readonly", true);
            $('input[name="koli"]').prop("readonly", true);
            $('input[name="pengirim"]').prop("readonly", true);
            $('input[name="penerima"]').prop("disabled", true);
            $("button#btn-edit").prop("disabled", true);
          }, 300);
        } else {
          setTimeout(() => {
            $(".output")
              .show()
              .html("<span class='text-success font-weight-bold'></span>")
              .fadeIn("slow");
            $('select[name="kotaasal"]').prop("disabled", false);
            $('select[name="kotatujuan"]').prop("disabled", false);
            $('select[name="cabtujuan"]').prop("disabled", false);
            $('input[name="kdpaket"]').prop("readonly", false);
            $('input[name="koli"]').prop("readonly", false);
            $('input[name="pengirim"]').prop("readonly", false);
            $('input[name="penerima"]').prop("disabled", false);
            $("button#btn-edit").prop("disabled", false);
          }, 300);
        }
      },
    });
  }
});
// cek reccunew end

//  update alamat
$(".btn-edit-alamat").on("click", function (e) {
  e.preventDefault();
  const idalamat = $(this).data("idalamat");
  $.ajax({
    url: "http://localhost/app-tracking/alamat/getId",
    type: "POST",
    dataType: "json",
    data: {
      id_alamat: idalamat,
    },
    success: function (data) {
      $(".kotaid").val(data.kota_id).trigger("change");
      $(".alamat").val(data.alamat);
      $(".daerah").val(data.daerah);
      $(".notelp").val(data.notelp);
      $(".kdpos").val(data.kdpos);
      $(".idalamat").val(data.id_alamat);
    },
  });

  $("#editAlamat").modal("show");
});

//  update cab
$(".btn-edit-cab").on("click", function (e) {
  e.preventDefault();
  const idcab = $(this).data("idcab");
  $.ajax({
    url: "http://localhost/app-tracking/cabang/getId",
    type: "POST",
    dataType: "json",
    data: {
      id_cab: idcab,
    },
    success: function (data) {
      $(".idcab").val(data.id_cab);
      $(".kdcab").val(data.kd_cab);
      $(".namacab").val(data.nama_cab);
      $(".kotacab").val(data.kota_id).trigger("change");
      $(".jeniscab").val(data.jenis_cab);
    },
  });

  $("#editCab").modal("show");
});

//  update kota
$(".btn-edit-kota").on("click", function (e) {
  e.preventDefault();
  const idkota = $(this).data("idkota");
  $.ajax({
    url: "http://localhost/app-tracking/kota/getId",
    type: "POST",
    dataType: "json",
    data: {
      id_kota: idkota,
    },
    success: function (data) {
      $(".idkota").val(data.id_kota);
      $(".kdkota").val(data.kd_kota);
      $(".namakota").val(data.nama_kota);
    },
  });

  $("#editKota").modal("show");
});

//  update ongkir
$(".btn-edit-ongkir").on("click", function (e) {
  e.preventDefault();
  const idongkir = $(this).data("idongkir");
  $.ajax({
    url: "http://localhost/app-tracking/ongkir/getId",
    type: "POST",
    dataType: "json",
    data: {
      id_ongkir: idongkir,
    },
    success: function (data) {
      $(".idongkir").val(data.id_ongkir);
      $(".kotaasal").val(data.kotaasal_id).trigger("change");
      $(".kotatujuan").val(data.kotatujuan_id).trigger("change");
      $(".minimal").val(format(data.minimal));
      $(".perkg").val(format(data.perkg));
      $(".estimasi").val(data.estimasi);
    },
  });

  $("#editOngkir").modal("show");
});

//  update penjualan
$(".btn-edit-penjualan").on("click", function (e) {
  e.preventDefault();
  const idpaket = $(this).data("idpaket");
  $.ajax({
    url: "http://localhost/app-tracking/penjualan/getId",
    type: "POST",
    dataType: "json",
    data: {
      id_paket: idpaket,
    },
    success: function (data) {
      $(".idpaket").val(data.id_paket);
      $(".reccu").val(data.reccu);
      $(".reccunew").val(data.reccu);
      $(".kdpaket").val(data.kd_paket);
      $(".koli").val(data.koli);
      $(".pengirim").val(data.pengirim);
      $(".penerima").val(data.penerima);
      $(".kotaasal").val(data.kotaasal_id).trigger("change");
      $(".kotatujuan").val(data.kotatujuan_id).trigger("change");
      $(".cabasal").val(data.cabasal_id).trigger("change");
      $(".cabtujuan").val(data.cabtujuan_id).trigger("change");
    },
  });

  $("#editPenjualan").modal("show");
});

//  update penjualan agen
$(".btn-edit-penagen").on("click", function (e) {
  e.preventDefault();
  const idpaket = $(this).data("idpaket");
  $.ajax({
    url: "http://localhost/app-tracking/penjualanagen/getId",
    type: "POST",
    dataType: "json",
    data: {
      id_paket: idpaket,
    },
    success: function (data) {
      $(".idpaket").val(data.id_paket);
      $(".reccu").val(data.reccu);
      $(".reccunew").val(data.reccu);
      $(".kdpaket").val(data.kd_paket);
      $(".koli").val(data.koli);
      $(".pengirim").val(data.pengirim);
      $(".penerima").val(data.penerima);
      $(".namakotaasal").val(data.kotaasal);
      $(".kotaasal").val(data.kotaasal_id);
      $(".kotatujuan").val(data.kotatujuan_id).trigger("change");
      $(".cabtujuan").val(data.cabtujuan_id).trigger("change");
      $(".cabasal").val(data.cabasal_id);
    },
  });

  $("#editPenagen").modal("show");
});

//  update penjualan lokal
$(".btn-edit-penlok").on("click", function (e) {
  e.preventDefault();
  const idpaket = $(this).data("idpaket");
  $.ajax({
    url: "http://localhost/app-tracking/penjualanlokal/getId",
    type: "POST",
    dataType: "json",
    data: {
      id_paket: idpaket,
    },
    success: function (data) {
      $(".idpaket").val(data.id_paket);
      $(".reccu").val(data.reccu);
      $(".reccunew").val(data.reccu);
      $(".kdpaket").val(data.kd_paket);
      $(".koli").val(data.koli);
      $(".pengirim").val(data.pengirim);
      $(".penerima").val(data.penerima);
      $(".namakotaasal").val(data.kotaasal);
      $(".kotaasal").val(data.kotaasal_id);
      $(".kotatujuan").val(data.kotatujuan_id).trigger("change");
      $(".cabtujuan").val(data.cabtujuan_id).trigger("change");
    },
  });

  $("#editPenlok").modal("show");
});

//  update user
$(".btn-edit-user").on("click", function (e) {
  e.preventDefault();
  const iduser = $(this).data("iduser");
  $.ajax({
    url: "http://localhost/app-tracking/user/getId",
    type: "POST",
    dataType: "json",
    data: {
      id_user: iduser,
    },
    success: function (data) {
      $(".iduser").val(data.id_user);
      $(".kotaid").val(data.userkota_id).trigger("change");
      $(".cabid").val(data.usercab_id).trigger("change");
      $(".nama").val(data.nama_user);
      $(".uname").val(data.username);
      $(".role").val(data.role_access).trigger("change");
    },
  });

  $("#editUser").modal("show");
});

var format = function (num) {
  var str = num.toString().replace("", ""),
    parts = false,
    output = [],
    i = 1,
    formatted = null;
  if (str.indexOf(".") > 0) {
    parts = str.split(".");
    str = parts[0];
  }
  str = str.split("").reverse();
  for (var j = 0, len = str.length; j < len; j++) {
    if (str[j] != ",") {
      output.push(str[j]);
      if (i % 3 == 0 && j < len - 1) {
        output.push(",");
      }
      i++;
    }
  }
  formatted = output.reverse().join("");
  return "" + formatted + (parts ? "." + parts[1].substr(0, 2) : "");
};
