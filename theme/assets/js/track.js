const cardTimeline = document.getElementById("card-timeline");
const btn = document.getElementById("track-btn");
btn.addEventListener("click", async function (e) {
  e.preventDefault();
  const reccu = document.getElementById("reccu").value;
  var data = new FormData();
  data.append("reccu", reccu);

  const searchValue = await getResponse(data);
  cardTimeline.style.display = "block";
  timelineValue(searchValue);
});

async function getResponse(data) {
  const response = await fetch("http://localhost/app-tracking/track/getReccu", {
    method: "POST",
    body: data,
  });
  const resValue = await response.json();
  return resValue;
}

function timelineValue(searchValue) {
  let card = "";

  if (searchValue.length > 0) {
    searchValue.forEach((b) => (card += showTimelineValue(b)));
    const timeline = document.getElementById("container-timeline");
    timeline.innerHTML = card;
  } else {
    const timeline = document.getElementById("container-timeline");
    timeline.innerHTML = `<div class="card">
                            <div class="card-body">
                              <h5 class="text-center font-weight-bold text-secondary">No Reccu tidak ditemukan..</h5>
                            </div>
                          </div>`;
  }
}

function showTimelineValue(b) {
  const listMonth = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "December",
  ];

  d = new Date(b.createdAt);

  return (
    `<li>
            <a href="#" class="mr-3 font-weight-bold text-dark text-muted text-decoration-none">Reccu : ${b.reccu}</a>
            <a href="#" class="font-weight-bold text-dark text-muted text-decoration-none">` +
    d.getDate() +
    "-" +
    (d.getMonth() + 1) +
    "-" +
    d.getFullYear() +
    " " +
    d.getHours() +
    ":" +
    d.getMinutes() +
    `</a>
            <p class="text-capitalize">${b.status}</p>
            <hr>
          </li>`
  );
}
