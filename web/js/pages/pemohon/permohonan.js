const cloud = new Puller();

let slideControl = {
  current: 1,
  next: function () {
    let page = slideControl.current < $(".permohonan-slider-wrapper .screen").length ? slideControl.current + 1 : slideControl.current;
    slideControl.go(page);
  },
  prev: function () {
    let page = slideControl.current > 1 ? slideControl.current - 1 : slideControl.current;
    slideControl.go(page);
  },
  go: function (n) {
    if (n > 0 && n <= $(".permohonan-slider-wrapper .screen").length && n != slideControl.current) {
      if (n == 1) {
        reset();
      }
      $(`.permohonan-slider-wrapper .screen[data-screen=${slideControl.current}]`).fadeOut("normal", function () {
        if (slideControl.current == 2) {
          $(`.permohonan-slider-wrapper .screen[data-screen=${n}]`).find("input").val("");
          $(`.permohonan-slider-wrapper .screen[data-screen=${n}]`).find("textarea").val("");
        }
        $(`.permohonan-slider-wrapper .screen[data-screen=${n}]`)
          .css("display", "flex")
          .hide()
          .fadeIn("normal", function () {
            slideControl.current = n;
          });
      });
    }
  },
};

function uploadBtnClick(e) {
  console.log($(this));
  const data = new FormData();
  data.append("id", $("#paper-action").find("input[name=id]").val());
  data.append($(this).attr("name"), $(this)[0].files[0]);
  $.ajax({
    type: "POST",
    url: baseUrl + `/api/permohonan`,
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success: (response) => {
      let timestamp = new Date().getTime();
      const isFotoPdf = response.data.file.includes(".pdf") ? "pdf" : "image";
      $(".detail-dokumen .list-card button[data-name=file]")
        .closest(".btn-wrapper")
        .find("a")
        .attr("href", baseUrl + response.data.file + "?timestamp=" + timestamp)
        .attr("data-type", isFotoPdf);
      Toast.fire({
        icon: "success",
        title: "Data Berhasil disimpan",
      });
    },
  });
}

$("body").on("click", "#paper-action .paper-content .btn#action-send", function (e) {
  const paper = $(this).closest(".paper-fold");
  const id = paper.find("input[name=id]").val();
  const permohonan = cloud.get("permohonan").find((x) => x.id == id);
  const keperluan = paper.find("textarea[name=keperluan]");

  data = {};
  if (keperluan.val().trim() == "") {
    keperluan.closest(".input-field").effect("shake");
    return;
  }
  data.id = id;
  data.keperluan = keperluan.val();
  switch (permohonan.jenis) {
    case 4:
      break;
    case 5:
      break;
    default:
      const keterangan = paper.find("textarea[name=keterangan]");
      if (keterangan.val().trim() == "") {
        keterangan.closest(".input-field").effect("shake");
        return;
      }
      data.keterangan = keterangan.val();
      break;
  }
  switch (permohonan.status) {
    case 2:
      data.status = 1;
      break;
    case 4:
      data.status = 3;
      break;
  }
  Swal.fire({
    title: "Kirim Permohonan",
    text: `Anda yakin untuk mengirim permohonan ini kembali?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Kirim",
  }).then((result) => {
    if (result.isConfirmed) {
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

$("body").on("click", ".list-card button", function (e) {
  let input = $(`<input type="file" name="${$(this).data("name")}" accept="image/*, application/pdf" />`);
  input.on("change", uploadBtnClick);
  input.trigger("click");
});

$("body").on("click", "#ongoing .btn-action", function (e) {
  const id = $(this).data("id");
  $("#paper-action input[name=id]").val(id);
  const permohonan = cloud.get("permohonan").find((x) => x.id == id);
  const dokumen = $("#paper-action .paper-content .detail-dokumen");
  dokumen.empty().append(`<div class="round-title"><span>Dokumen</span></div>`);

  $("#paper-action p#detail-jenis").text(getJenisSurat(permohonan.jenis));
  $("#paper-action p#detail-catatan").text(permohonan.catatan);

  const detail = $("#paper-action .paper-content .detail-permohonan");
  detail.empty().append(`<div class="round-title"><span>Detail Permohonan</span></div>`);
  const formAutosave = $(`<form action="" method="POST" class="form-autosave" class="row"></form>`);
  formAutosave
    .append(`<input type="hidden" name="id" value="${permohonan.id}">`)
    .append(`<div class="input-field col s12"><textarea id="keperluan" name="keperluan" class="materialize-textarea">${permohonan.keperluan}</textarea><label for="keperluan">Keperluan</label></div>`);
  if (![4, 5].includes(permohonan.jenis)) {
    formAutosave.append(`<div class="input-field col s12"><textarea id="keterangan" name="keterangan" class="materialize-textarea">${permohonan.keterangan}</textarea><label for="keterangan">Keterangan</label></div>`);
  }
  detail.append(formAutosave);

  if (permohonan.jenis == 5) {
    const isFotoPdf = permohonan.file.includes(".pdf") ? `data-type="pdf"` : "";
    dokumen.append(
      `<div class="list-card"><p>Foto Rumah</p><div class="btn-wrapper"><button class="btn btn-small waves-effect waves-light green" data-name="file"><span><i class="material-icons">upload</i></span></button><a href="${permohonan.file}" class="btn btn-small waves-effect waves-light blue" data-fancybox ${isFotoPdf}><span><i class="material-icons">visibility</i></span></a></div>`
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

  M.updateTextFields();
  setTimeout(function () {
    M.textareaAutoResize($(`textarea`));
  }, 500);
  console.log(permohonan);
});
$("body").on("click", "#ongoing .btn-detail", function (e) {
  const id = $(this).data("id");
  $("#paper-detail input[name=id]").val(id);
  const permohonan = cloud.get("permohonan").find((x) => x.id == id);
  const dokumen = $("#paper-detail .paper-content .detail-dokumen");
  dokumen.empty().append(`<div class="round-title"><span>Dokumen</span></div>`);

  $("#paper-detail p#detail-jenis").text(getJenisSurat(permohonan.jenis));
  const stts = getStatusSurat(permohonan.status);
  $("#paper-detail div#detail-status").empty().append(`<span class="pill-status ${stts.color} darken-3">${stts.text}</span>`);
  $("#paper-detail p#detail-catatan").text(permohonan.catatan);

  const detail = $("#paper-detail .paper-content .detail-permohonan");
  detail.empty().append(`<div class="round-title"><span>Keperluan</span></div>`).append(`<div class="col s12"><p>${permohonan.keperluan}</p></div>`);
  if (![4, 5].includes(permohonan.jenis)) {
    detail.append(`<div class="round-title col s12"><span>Keterangan</span></div>`).append(`<div class="col s12"><p>${permohonan.keterangan}</p></div>`);
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

function savePermohonan(data, callback) {
  $.ajax({
    type: "POST",
    url: baseUrl + `/api/permohonan`,
    data: data,
    success: function (response) {
      if (callback !== undefined && typeof callback === "function") {
        callback(response);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      Toast.fire({
        icon: "error",
        title: "Gagal",
      });
    },
  });
}

$("body").on("saving", ".form-autosave", function (e, el, form) {
  const data = {
    id: $(form).find("input[name=id]").val(),
  };
  data[el.attr("name")] = el.val().trim();

  savePermohonan(data, function (response) {
    $(".form-autosave").trigger("saved", [el, form]);
    $(el).removeClass("update");
    console.log(response);
  });
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
        status: "< 7",
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
        data: "status",
        render: (data) => {
          const StatusSurat = ["Belum Berjalan", "Menunggu Acc RT", "Aksi Pra RT", "Pra Agenda", "Aksi Pra Agenda", "Diagendakan", "Tertandatangani", "Tercetak"];
          const WarnaStatus = ["gray", "orange", "red", "orange", "red", "orange", "purple", "green"];
          // span pill materialize
          return `<span class="pill-status ${WarnaStatus[parseInt(data)]} darken-3">${StatusSurat[parseInt(data)]}</span>`;
        },
      },
      {
        data: "id",
        render: (data, type, row) => {
          const aksiBtn = `<button class="btn waves-effect waves-light btn-small red btn-action paper-trigger" type="button" data-id="${data}" target="paper-action"><i class="material-icons">chevron_right</i>
          </button>`;
          const detailBtn = `<button class="btn waves-effect waves-light btn-small green btn-detail paper-trigger" type="button" data-id="${data}" target="paper-detail"><i class="material-icons">chevron_right</i>
          </button>`;
          switch (row.status) {
            case 2:
              return aksiBtn;
            case 4:
              return aksiBtn;
            default:
              return detailBtn;
          }
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
        status: 7,
      },
    },
    responsive: true,
    columns: [{ data: "jenis" }, { data: "status" }],
  });
  cloud.addCallback("permohonan", (data) => {
    tableOngoing.ajax.reload();
    tableHistory.ajax.reload();
  });
  $(".permohonan-slider-wrapper .screen").first().css("display", "flex").hide().fadeIn();
  $(".permohonan-slider-wrapper .screen").last().find("button.next").hide();
  $("select").formSelect();
});

function reset() {
  $("input").val("");
  $("input[type=radio]:checked").prop("checked", false);
  $("textarea").val("");
}

$("body").on("click", ".permohonan-slider-wrapper .screen button.add", function () {
  reset();
  slideControl.next();
});
$("body").on("click", ".permohonan-slider-wrapper .screen button.next", function () {
  const screen = $(this).closest(".screen");
  if (screen.data("screen") == 2) {
    if (screen.find("input[name=jenis]:checked").length == 0) {
      screen.find(".main").effect("shake");
      return;
    }
  }
  if (screen.data("screen") == 3) {
    let input = screen.find("input");
    input = input.length == 0 ? screen.find("textarea") : input;
    if (input.length > 0 && input.val() == "") {
      screen.find(".main").effect("shake");
      return;
    }
    switch ($("input[name=jenis]:checked").data("value")) {
      case 4:
        slideControl.go(6);
        return;
      case 5:
        slideControl.go(5);
        return;
      default:
        break;
    }
  }
  if (screen.data("screen") == 4) {
    let input = screen.find("input");
    input = input.length == 0 ? screen.find("textarea") : input;
    if (input.length > 0 && input.val() == "") {
      screen.find(".main").effect("shake");
      return;
    }
    slideControl.go(6);
    return;
  }
  if (screen.data("screen") == 5) {
    let input = screen.find("input[name=file]");
    if (input[0].files.length == 0) {
      screen.find(".main").effect("shake");
      return;
    }
  }
  slideControl.next();
});
$("body").on("click", ".permohonan-slider-wrapper .screen button.prev", function (e) {
  const screen = $(this).closest(".screen");
  switch (screen.data("screen")) {
    case 6:
      switch ($("input[name=jenis]:checked").data("value")) {
        case 4:
          slideControl.go(3);
          return;
        case 5:
          slideControl.go(5);
          return;
        default:
          console.log("defaul");
          slideControl.go(4);
          return;
      }
    case 5:
      slideControl.go(3);
      return;
    default:
      slideControl.prev();
      return;
  }
});

function sendSuccess(response) {
  slideControl.go(1);
  console.log(response);
  cloud.pull("permohonan");
  Toast.fire({
    icon: "success",
    title: "Data Berhasil disimpan",
  });
}

$("body").on("click", ".permohonan-slider-wrapper .screen button.send", function (e) {
  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Data yang anda masukkan akan disimpan",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Kirim",
  }).then((result) => {
    if (result.isConfirmed) {
      const jenis = $("input[name=jenis]:checked").data("value");
      let data = {};
      switch (jenis) {
        case 4:
          data.keperluan = $(".permohonan-slider-wrapper textarea[name=keperluan]").val();
          break;
        case 5:
          data = new FormData();
          data.append("id_pemohon", cloud.get("profil").id);
          data.append("jenis", jenis);
          data.append("keperluan", $(".permohonan-slider-wrapper textarea[name=keperluan]").val());
          data.append("file", $(".permohonan-slider-wrapper input[name=file]")[0].files[0]);
          $.ajax({
            type: "POST",
            url: baseUrl + `/api/permohonan`,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: sendSuccess,
          });
          return;
        default:
          data.keperluan = $(".permohonan-slider-wrapper textarea[name=keperluan]").val();
          data.keterangan = $(".permohonan-slider-wrapper textarea[name=keterangan]").val();
          break;
      }
      data.id_pemohon = cloud.get("profil").id;
      data.jenis = jenis;
      $.ajax({
        type: "POST",
        url: baseUrl + `/api/permohonan`,
        data: data,
        success: sendSuccess,
      });
    }
  });
});
