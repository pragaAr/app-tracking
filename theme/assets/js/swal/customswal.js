const flashData = $(".flash-data").data("flashdata");

if (flashData) {
  Swal.fire({
    icon: "success",
    title: "Selamat,",
    text: flashData,
    type: "success",
  });
}
