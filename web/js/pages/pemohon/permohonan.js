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
    responsive: true,
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
          const StatusSurat = ["Belum Dibuat", "ACC RT", "Sudah Diagendakan", "Tertandatangani", "Tercetak"];
          const WarnaStatus = ["red", "yellow", "cyan", "purple", "green"];
          // span pill materialize
          return `<span class="pill-status ${WarnaStatus[parseInt(data)]} darken-3">${StatusSurat[parseInt(data)]}</span>`;
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
    responsive: true,
    columns: [{ data: "jenis" }, { data: "status" }],
  });
  cloud.addCallback("permohonan", (data) => {
    tableOngoing.ajax.reload();
    tableHistory.ajax.reload();
  });
  $(".permohonan-slider-wrapper .screen").first().css("display", "flex").hide().fadeIn();
  $(".permohonan-slider-wrapper .screen").last().find("button.next").hide();
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
