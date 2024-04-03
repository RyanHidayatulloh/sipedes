const cloud = new Puller();

$("body").on("click", ".paper-trigger[target=paper-action]", function () {
  const id = $(this).data("id");
  $("#paper-action form")[0]?.reset();
  $("#paper-action iframe#print-cetak").attr("src", `${baseUrl}/panel/print?id=${id}&t=${Date.now()}`);
});

$("body").on("click", "#btn-cetak", function (e) {
  $("#paper-action iframe#print-cetak")[0].contentWindow.print();
});

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/pengguna", {
    name: "profil",
  });
  await cloud.add("http://sipedes.project/api/permohonan", {
    name: "permohonan",
  });
  const tableReady = $("#ready table").DataTable({
    processing: true,
    ajax: {
      url: baseUrl + "/api/permohonan",
      type: "GET",
      data: {
        wrap: "data",
        status: "6",
      },
    },
    responsive: true,
    columns: [
      {
        data: "created_at",
        render: (data) => {
          return moment(data).tz("Asia/Jakarta").format("YYYY-MM-DD");
        },
      },
      {
        data: "jenis",
        render: (data) => {
          return getJenisSurat(data);
        },
      },
      {
        data: "pemohon.biodata.nama",
      },
      {
        data: "id",
        render: (data) => {
          return `<button class="btn waves-effect waves-light btn-small blue btn-action paper-trigger" type="button" data-id="${data}" target="paper-action"><i class="material-icons">chevron_right</i>
            </button>`;
        },
      },
    ],
  });
  const tablePrinted = $("#print table").DataTable({
    processing: true,
    ajax: {
      url: baseUrl + "/api/permohonan",
      type: "GET",
      data: {
        wrap: "data",
        status: "7",
      },
    },
    responsive: true,
    columns: [
      {
        data: "updated_at",
        render: (data) => {
          return moment(data).tz("Asia/Jakarta").format("YYYY-MM-DD");
        },
      },
      {
        data: "jenis",
        render: (data) => {
          return getJenisSurat(data);
        },
      },
      {
        data: "pemohon.biodata.nama",
      },
      {
        data: "catatan",
      },
      {
        data: "status",
        render: (data) => {
          const StatusSurat = ["Belum Berjalan", "Menunggu Acc RT", "Aksi Pra RT", "Pra Agenda", "Aksi Pra Agenda", "Diagendakan", "Tertandatangani", "Tercetak"];
          const WarnaStatus = ["gray", "yellow", "red", "yellow", "red", "yellow", "purple", "green"];
          // span pill materialize
          return `<span class="pill-status ${WarnaStatus[parseInt(data)]} darken-3">${StatusSurat[parseInt(data)]}</span>`;
        },
      },
    ],
  });
  $("select").formSelect();
  cloud.addCallback("permohonan", (data) => {
    tableReady.ajax.reload();
    tablePrinted.ajax.reload();
  });
});
