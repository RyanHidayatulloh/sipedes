const cloud = new Puller();

$("body").on("click", ".paper-trigger[target=paper-action]", function () {
  const id = $(this).data("id");
  $("#paper-action form")[0]?.reset();
  $("#paper-action iframe#print-cetak").attr("src", `${baseUrl}/panel/print?id=${id}&t=${Date.now()}`);
  $("#paper-action form [name=id]").val(id);
  $("#paper-action form [name=catatan]").val("Surat sudah bisa diambil di kantor kepala desa Buniwah");
  setTimeout(function () {
    M.textareaAutoResize($("textarea[name=catatan]"));
  }, 100);
});

$("body").on("click", "#btn-cetak", function (e) {
  $("#paper-action iframe#print-cetak")[0].contentWindow.print();
});

$("body").on("click", "#paper-action .paper-content .btn#action-send", function (e) {
  const paper = $(this).closest(".paper-fold");
  const catatan = paper.find("textarea[name=catatan]");
  if (catatan.val().trim() == "") {
    catatan.closest(".input-field").effect("shake");
    return;
  }
  Swal.fire({
    title: "Konfirmasi Cetak",
    text: `Anda yakin untuk mengkonfirmasi pencetakan permohonan ini?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Kirim",
  }).then((result) => {
    if (result.isConfirmed) {
      data = {
        id: paper.find("input[name=id]").val(),
        status: 7,
        catatan: catatan.val(),
      };
      $.ajax({
        type: "POST",
        url: baseUrl + "/api/permohonan",
        data: data,
        success: function (response) {
          cloud.pull("permohonan");
          paper.find(".paper-folder").trigger("click");
          Toast.fire({
            icon: "success",
            title: "Data Berhasil disimpan",
          });
        },
      });
      console.log(data);
    }
  });
});

$(document).ready(async function () {
  await cloud.add(origin + "/api/pengguna", {
    name: "profil",
  });
  await cloud.add(origin + "/api/permohonan", { 
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
