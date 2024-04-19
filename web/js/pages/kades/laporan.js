const cloud = new Puller();

$(".datepicker").datepicker({
  format: "yyyy-mm-dd",
  i18n: {
    months: [
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
      "Desember",
    ],
    monthsShort: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "Mei",
      "Jun",
      "Jul",
      "Agt",
      "Sep",
      "Okt",
      "Nov",
      "Des",
    ],
    weekdays: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"],
    weekdaysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    weekdaysAbbrev: ["M", "S", "S", "R", "K", "J", "S"],
  },
  onSelect: function (v) {
    $(".form-autosave").trigger("saving", [$(this.el), formatDate(v)]);
  },
});

const blankd = `<tr><td colspan="6" class="center">Tidak ada data</td></tr>`;

function printTable() {
  var divToPrint = document.getElementById("laporan");
  newWin = window.open("");
  newWin.document.write(`
  <style>
    @media print {
      @page {
        size: a4;
      }
    }
  </style>
  <img src="${baseUrl}/img/kop.png" alt="kop" class="kop" style="width: 100%;">
  <h1 style="text-align: center;">LAPORAN SURAT</h1>
  ${divToPrint.outerHTML}`);
  setTimeout(function () {
    newWin.print();
    newWin.close();
  }, 100);
}

function getDateFilter() {
  const all = $("input[name=aksi]").prop("checked");
  const awal = $("input[name=tgl_awal]");
  const akhir = $("input[name=tgl_akhir]");
  if (all) return null;
  if (awal.val() == "" || akhir.val() == "") return null;
  return {
    start: awal.val(),
    end: akhir.val(),
  };
}

$("body").on("change", "input[name=aksi]", function (e) {
  const all =
    $("input[name=aksi]:checked").length == $("input[name=aksi]").length;
  const awal = $("input[name=tgl_awal]");
  const akhir = $("input[name=tgl_akhir]");
  if (all) {
    $("input[name=tgl_awal]").prop("disabled", true);
    $("input[name=tgl_akhir]").prop("disabled", true);
    M.updateTextFields();
  } else {
    $("input[name=tgl_awal]").prop("disabled", false);
    $("input[name=tgl_akhir]").prop("disabled", false);
  }
});

$("body").on("click", ".btn-laporan button", async function (e) {
  await cloud.pull("permohonan");
  const q = getDateFilter();
  const d = cloud.get("permohonan");
  let result = [];

  if (q) {
    const start = moment(q.start);
    const end = moment(q.end);
    result = d.filter((data) => {
      const n = moment(data.tgl_ttd);
      return data.status >= 6 && n.isBetween(start, end, null, "[]");
    });
  } else {
    result = d.filter((data) => data.status >= 6);
  }

  const tb = $("table#laporan tbody");
  tb.empty();

  if (result.length == 0) {
    tb.append(blankd);
  } else {
    result.forEach((data) => {
      const JenisSurat = {
        1: "Surat Pengantar",
        2: "Surat Keterangan",
        3: "Surat Keterangan Usaha",
        4: "Surat Pengantar Catatan Kepolisian",
        5: "Surat Keterangan Tidak Mampu",
        6: "Surat Keterangan Domisili Tempat Tinggal",
      };
      tb.append(`
        <tr>
          <td style="border: 1px solid;">${data.id}</td>
          <td style="border: 1px solid;">${data.tgl_ttd}</td>
          <td style="border: 1px solid;">${data.pemohon.biodata.nik}</td>
          <td style="border: 1px solid;">${data.pemohon.biodata.nama}</td>
          <td style="border: 1px solid;">${
            JenisSurat[parseInt(data.jenis)]
          }</td>
          <td style="border: 1px solid;">${data.keperluan.replace(
            /\n/g,
            "<br>"
          )}</td>
        </tr>
      `);
    });
  }
  console.log(result);
});
$("body").on("click", ".btn-laporan a.btn", async function (e) {
  printTable();
});

$(document).ready(async function () {
  await cloud.add(baseUrl + "/api/pengguna", {
    name: "profil",
  });
  await cloud.add(baseUrl + "/api/permohonan", {
    name: "permohonan",
  });

  $("input[name=aksi]").prop("checked", true);
  $("input[name=aksi]").trigger("change");

  const tb = $("table#laporan tbody");
  tb.empty();
  $(".btn-laporan button").trigger("click");
});
