const cloud = new Puller();

$("body").on("submit", "#form-ajuan", function (e) {
  e.preventDefault();
  let valid = true;
  $.each($(".input-field:not(.hide) select"), function (i, el) {
    if (el.value == "") {
      valid = false;
      Toast.fire({
        icon: "error",
        title: $(el).attr("name") + " Harus Di isi",
      });
    }
  });
  if (!valid) {
    return false;
  }
  $.ajax({
    type: "POST",
    url: baseUrl + "/api/permohonan",
    data: $(this).serialize(),
    error: function (jqXHR, textStatus, errorThrown) {
      Toast.fire({
        icon: "error",
        title: "Gagal",
      });
    },
    success: function (data, textStatus, jqXHR) {
      Toast.fire({
        icon: data.toast.icon,
        title: data.toast.title,
      });
      cloud.pull("permohonan");
      $("#form-ajuan")[0].reset();
    },
  });
});

$("body").on("change", "#form-ajuan select[name=jenis]", function (e) {
  $("#form-ajuan .input-field textarea[name=keterangan]")
    .prop("disabled", false)
    .closest(".input-field")
    .removeClass("hide");
  $("#form-ajuan .input-field textarea[name=keperluan]")
    .prop("disabled", false)
    .closest(".input-field")
    .removeClass("hide");
  switch (e.target.value) {
    case "4":
      $("#form-ajuan .input-field textarea[name=keterangan]")
        .prop("disabled", true)
        .closest(".input-field")
        .addClass("hide");
      break;
    default:
      break;
  }
});

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/pengguna", {
    name: "profil",
  });
  await cloud.add("http://sipedes.project/api/permohonan", {
    name: "permohonan",
    data: { id_user: cloud.get("profil").id },
  });
  const tableOngoing = $("#ongoing table").DataTable({
    processing: true,
    ajax: {
      url: baseUrl + "/api/permohonan",
      type: "GET",
      data: {
        id_user: cloud.get("profil").id,
        wrap: "data",
        status: "< 4",
      },
    },
    columns: [
      {
        data: "jenis",
        render: (data) => {
          const JenisSurat = {
            1: "Surat Pengantar",
            2: "Surat Keterangan",
            3: "Surat Keterangan Usaha",
            4: "Surat Pengantar Catatan Kepolisian",
            5: "Surat Keterangan Tidak Mampu",
            6: "Surat Keterangan Domisili Tempat Tinggal",
          };
          return JenisSurat[parseInt(data)];
        },
      },
      {
        data: "nomor",
        render: (data) => {
          return data ? data : "-";
        },
      },
      {
        data: "status",
        render: (data) => {
          const StatusSurat = [
            "Belum Dibuat",
            "ACC RT",
            "Sudah Diagendakan",
            "Tertandatangani",
            "Tercetak",
          ];
          const WarnaStatus = ["red", "yellow", "cyan", "purple", "green"];
          // span pill materialize
          return `<span class="pill-status ${
            WarnaStatus[parseInt(data)]
          } darken-3">${StatusSurat[parseInt(data)]}</span>`;
        },
      },
    ],
  });
  const tableHistory = $("#history table").DataTable({
    processing: true,
    ajax: {
      url: baseUrl + "/api/permohonan",
      type: "GET",
      data: {
        id_user: cloud.get("profil").id,
        wrap: "data",
        status: 4,
      },
    },
    columns: [{ data: "jenis" }, { data: "status" }],
  });
  cloud.addCallback("permohonan", (data) => {
    tableOngoing.ajax.reload();
    tableHistory.ajax.reload();
  });
});
