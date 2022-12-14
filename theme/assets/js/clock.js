jam();
function jam() {
  const weekday = [
    "Minggu",
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jumat",
    "Sabtu",
  ];
  const monthly = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "Mei",
    "Juni",
    "Juli",
    "Agust",
    "Sept",
    "Okt",
    "Nov",
    "Dec",
  ];
  var e = document.getElementById("jam"),
    d = new Date(),
    h,
    m,
    s,
    tanggal,
    month,
    day,
    year;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());
  month = monthly[d.getMonth()];
  day = weekday[d.getDay()];
  year = d.getFullYear();
  tanggal = d.getDate();

  e.innerHTML =
    day +
    ", " +
    tanggal +
    " " +
    month +
    " " +
    year +
    "  " +
    h +
    ":" +
    m +
    ":" +
    s;

  setTimeout("jam()", 1000);
}

function set(e) {
  e = e < 10 ? "0" + e : e;
  return e;
}
