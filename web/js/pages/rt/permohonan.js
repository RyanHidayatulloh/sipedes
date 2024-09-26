const cloud = new Puller();

$("body").on("click", "#paper-action .paper-content .btn#action-send", function (e) {
  const paper = $(this).closest(".paper-fold");
  const catatan = paper.find("textarea[name=catatan]");
  if (catatan.val().trim() == "") {
    catatan.closest(".input-field").effect("shake");
    return;
  }
  const aksi = paper.find("input[name=aksi]").is(":checked") ? "Menyetujui" : "Menolak";
  const status = paper.find("input[name=aksi]").is(":checked") ? 3 : 2;
  Swal.fire({
    title: "Kirim Permohonan",
    text: `Anda yakin untuk ${aksi} permohonan ini?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Kirim",
  }).then((result) => {
    if (result.isConfirmed) {
      data = {
        id: paper.find("input[name=id]").val(),
        status: status,
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
            title: "Perubahan Berhasil disimpan",
          });
        },
      });
      console.log(data);
    }
  });
});

$("body").on("click", "#ongoing .btn-action", function (e) {
  const id = $(this).data("id");
  $("#paper-action input[name=id]").val(id);
  const permohonan = cloud.get("permohonan").find((x) => x.id == id);
  const detail = $("#paper-action .paper-content .detail-permohonan");
  const dokumen = $("#paper-action .paper-content .detail-dokumen");
  detail.empty().append(`<div class="round-title"><span>Keperluan</span></div>`).append(`<p>${permohonan.keperluan.replace(/\n/g, "<br>")}</p>`);
  dokumen.empty().append(`<div class="round-title"><span>Dokumen</span></div>`);
  $("#paper-action .paper-content form")[0].reset();
  M.textareaAutoResize($("#paper-action .paper-content textarea"));
  $.each(permohonan.pemohon.biodata, function (k, v) {
    $(`.detail-${k}`).text(v);
  });
  if (![4, 5].includes(permohonan.jenis)) {
    detail.append(`<div class="round-title"><span>Keterangan</span></div>`).append(`<p>${permohonan.keterangan.replace(/\n/g, "<br>")}</p>`);
  }
  if (permohonan.jenis == 5) {
    const isFotoPdf = permohonan.file.includes(".pdf") ? `data-type="pdf"` : "";
    dokumen.append(
      `<div class="list-card"><p>Foto Rumah</p><div class="btn-wrapper"><a href="${permohonan.file}" class="btn btn-small waves-effect waves-light blue" data-fancybox ${isFotoPdf}><span><i class="material-icons">visibility</i></span></a></div>`
    );
  }
  dokumen.append(
    `<div class="list-card"><p>Foto Pemohon</p><div class="btn-wrapper"><a href="${permohonan.pemohon.picture}" class="btn btn-small waves-effect waves-light blue" data-fancybox><span><i class="material-icons">visibility</i></span></a></div>`
  );
  const isKtpPdf = permohonan.pemohon.biodata.ktp.includes(".pdf") ? `data-type="pdf"` : "";
  const isKkPdf = permohonan.pemohon.biodata.kk.includes(".pdf") ? `data-type="pdf"` : "";
  dokumen.append(
    `<div class="list-card"><p>KTP</p><div class="btn-wrapper"><a href="${permohonan.pemohon.biodata.ktp}" class="btn btn-small waves-effect waves-light blue" data-fancybox ${isKtpPdf}><span><i class="material-icons">visibility</i></span></a></div>`
  );
  dokumen.append(
    `<div class="list-card"><p>KK</p><div class="btn-wrapper"><a href="${permohonan.pemohon.biodata.kk}" class="btn btn-small waves-effect waves-light blue" data-fancybox ${isKkPdf}><span><i class="material-icons">visibility</i></span></a></div>`
  );
  console.log(permohonan);
});

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/pengguna", {
    name: "profil",
  });
  await cloud.add("http://sipedes.project/api/permohonan", {
    name: "permohonan",
  });
  const tableOngoing = $("#ongoing table").DataTable({
    processing: true,
    ajax: {
      url: baseUrl + "/api/permohonan",
      type: "GET",
      data: {
        wrap: "data",
        status: "1",
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
  const tableAccepted = $("#accept table").DataTable({
    processing: true,
    ajax: {
      url: baseUrl + "/api/permohonan",
      type: "GET",
      data: {
        wrap: "data",
        status: ">= 3",
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
  const tableRejected = $("#reject table").DataTable({
    processing: true,
    ajax: {
      url: baseUrl + "/api/permohonan",
      type: "GET",
      data: {
        wrap: "data",
        status: "2",
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
        data: "pemohon.biodata.nama",
      },
      {
        data: "catatan",
      },
    ],
  });
  $("select").formSelect();
  cloud.addCallback("permohonan", (data) => {
    tableOngoing.ajax.reload();
    tableAccepted.ajax.reload();
    tableRejected.ajax.reload();
  });
  channel.bind("status", (pusherData) => {
    tableOngoing.ajax.reload();
    tableAccepted.ajax.reload();
    tableRejected.ajax.reload();
  });
});
