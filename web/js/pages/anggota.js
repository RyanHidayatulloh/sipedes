const cloud = new Puller();

function addAnggota(anggota, keluarga) {
  let te = $($("#anggota-item").html());
  te.find(".profil").attr(
    "src",
    baseUrl + "/uploads/foto/anggota/" + anggota.foto
  );
  te.find(".title").text(anggota.nama);
  te.find("p")
    .text(anggota.nik)
    .after(`<span class="pill blue">${anggota.hubungan}</span>`);
  if (anggota.id == keluarga.id_kepala_keluarga) {
    te.find("p")
      .text(anggota.nik)
      .after(`<span class="pill green">Kepala Keluarga</span>`);
  }
  te.find(".btn-edit").attr("data-id", anggota.id);
  te.find(".btn-delete").attr("data-id", anggota.id);
  $(".collection").append(te);
}

function loadFile(event) {
  $(`.preview-container`).removeClass("hide");
  var reader = new FileReader();
  reader.onload = function () {
    var output = document.getElementById("foto-preview");
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}

$(document).ready(async function () {
  await cloud.add(baseUrl + "/api/wilayah", {
    name: "wilayah",
    data: { q: "all" },
  });
  await cloud.add(baseUrl + "/api/keluarga", {
    name: "keluarga",
    data: { id_user: true },
  });
  cloud
    .addCallback("keluarga", (data) => {
      $(".collection").empty();
      data.anggota.length > 0
        ? $(".nothing").addClass("hide")
        : $(".nothing").removeClass("hide");
      data.anggota.forEach((anggota) => addAnggota(anggota, data));
    })
    .pull("keluarga");
  W.init({ dataset: cloud.get("wilayah") });
});

$("#form-anggota").on("submit", function (e) {
  e.preventDefault();
  let formData = new FormData(this);
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
    url: baseUrl + "/api/anggota",
    data: formData,
    contentType: false,
    processData: false,
    error: function (jqXHR, textStatus, errorThrown) {
      Toast.fire({
        icon: "error",
        title: "Gagal",
      });
      console.log(textStatus, errorThrown);
    },
    success: function (data, textStatus, jqXHR) {
      Toast.fire({
        icon: data.toast.icon,
        title: data.toast.title,
      });
      $(".paper-folder").trigger("click");
      cloud.pull("keluarga");
    },
  });
});

$("body").on("click", ".paper-trigger", function (e) {
  $("#form-anggota")[0].reset();
  W.reset();
  $(`input:file[name=foto]`).attr("required", !$(this).hasClass("btn-edit"));
  $(`input:file[name=ktp]`).attr("required", !$(this).hasClass("btn-edit"));
  $(".left.title").text(
    $(this).hasClass("btn-edit") ? "Edit Anggota" : "Tambah Anggota"
  );
  if ($(this).hasClass("btn-edit")) {
    let anggota = cloud
      .get("keluarga")
      .anggota.find((a) => a.id == $(this).data("id"));
    $(`.preview-container`).removeClass("hide");
    $(`.preview-ktp`)
      .removeClass("hide")
      .find(".preview-card-link")
      .attr("href", baseUrl + "/uploads/ktp/anggota/" + anggota.ktp);
    $(`#foto-preview`).attr(
      "src",
      baseUrl + "/uploads/foto/anggota/" + anggota.foto
    );
    Object.entries(anggota).forEach(([i, v]) => {
      if (["tgl_lahir"].includes(i)) {
        $(`input[name=${i}]`).val(new Date(v).toLocaleDateString("en-GB"));
        return;
      }
      if (["provinsi", "kota", "kecamatan", "desa", "foto", "ktp"].includes(i))
        return;
      $(`input[name=${i}], select[name=${i}], textarea[name=${i}]`).val(v);
    });
    $(`select`).formSelect();
    M.textareaAutoResize($("textarea[name=alamat]"));
    M.updateTextFields();
    setTimeout(() => {
      W.set([anggota.provinsi, anggota.kota, anggota.kecamatan, anggota.desa]);
    }, 200);
  } else {
    $(`.preview-ktp`).addClass("hide");
    $(`.preview-container`).addClass("hide");
    $(`input:hidden[name=id]`).val("");
  }
});

$("body").on("click", ".btn-delete", function (e) {
  e.preventDefault();
  let id = $(this).data("id");
  Swal.fire({
    title: "Apakah Anda Yakin?",
    text: "Data yang di hapus tidak dapat dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "DELETE",
        url: baseUrl + "/api/anggota",
        data: {
          id: id,
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Toast.fire({
            icon: "error",
            title: "Gagal",
          });
          console.log(textStatus, errorThrown);
        },
        success: function (data, textStatus, jqXHR) {
          Toast.fire({
            icon: data.toast.icon,
            title: data.toast.title,
          });
          cloud.pull("keluarga");
        },
      });
    }
  });
});
