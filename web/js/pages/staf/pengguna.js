const cloud = new Puller();

let pemohonInit = false;

function saveProfil(data, callback) {
  pemohonInit = false;
  $.ajax({
    type: "POST",
    url: baseUrl + `/api/pengguna`,
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

$("body").on("change", "#paper-add input[name=picture]", function (e) {
  if (this.files && this.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#paper-add .profil-picture img").attr("src", e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
  }
});

$("body").on("click", ".paper-trigger[target=paper-add]", function (e) {
  $("#paper-add img[alt=picture]").attr("src", baseUrl + "/uploads/foto/avatar.jpg");
  $("#paper-add form")[0].reset();
});
$("body").on("click", ".paper-trigger[target=paper-admin]", function (e) {
  $("#paper-admin form")[0].reset();
  $("#paper-admin form").find("input[name=id]").val($(this).data("id"));
  const user = cloud.get("pengguna").find((x) => x.id == $(this).data("id"));

  $("#paper-admin .profil-avatar img").attr("src", `${user.picture}?t=${Date.now()}`);

  $("#paper-admin input[name=name]").val(user.name);
  $("#paper-admin input[name=nid]").val(user.nid);
  $("#paper-admin input[name=email]").val(user.email);
  M.updateTextFields();
});
$("body").on("click", ".paper-trigger[target=paper-pemohon]", function (e) {
  pemohonInit = true;
  $("#paper-pemohon form")[0].reset();
  $("#paper-pemohon form").find("input[name=id]").val($(this).data("id"));
  const pemohon = cloud.get("pengguna").find((x) => x.id == $(this).data("id"));

  $("#paper-pemohon .profil-avatar img").attr("src", `${pemohon.picture}?t=${Date.now()}`);

  let ktpPdf = pemohon.biodata.ktp?.includes(".pdf") ? "pdf" : "image";
  let kkPdf = pemohon.biodata.kk?.includes(".pdf") ? "pdf" : "image";
  $("#paper-pemohon button[data-name=ktp]")
    .closest(".btn-wrapper")
    .find("a")
    .attr("href", baseUrl + pemohon.biodata.ktp + "?t=" + Date.now())
    .attr("data-type", ktpPdf);
  $("#paper-pemohon button[data-name=kk]")
    .closest(".btn-wrapper")
    .find("a")
    .attr("href", baseUrl + pemohon.biodata.kk + "?t=" + Date.now())
    .attr("data-type", kkPdf);

  $("#paper-pemohon form").find("input[name=id]").val($(this).data("id"));
  setTimeout(function () {
    initWilayah(pemohon.biodata);
    $.each(timeTrigger, function (i, v) {
      clearTimeout(v);
    });
    pemohonInit = false;
  }, 1000);
  $.each(pemohon.biodata, function (k, v) {
    if (k == "id") return;
    $(`#paper-pemohon form input[name=${k}]`).val(v);
    $(`#paper-pemohon form textarea[name=${k}]`)?.val(v);
    const select = $(`#paper-pemohon form select[name=${k}] option`);
    if (select.length > 0) {
      $.each(select, function (i, s) {
        if ($(s).text() == v) $(`#paper-pemohon form select[name=${k}]`).val($(s).val());
      });
    }
  });
  M.updateTextFields();
  M.textareaAutoResize($("textarea"));
  $("select").formSelect();
  $.each(timeTrigger, function (i, v) {
    clearTimeout(v);
  });
});
$("body").on("saving", "#paper-admin .form-autosave", function (e, el, form) {
  const user = cloud.get("pengguna").find((x) => x.id == $(form).find("input[name=id]").val());
  const data = {
    id: user.id,
  };

  saveProfil(data, function (response) {
    $("#paper-admin .form-autosave").trigger("saved", [el, form]);
    cloud.pull("pengguna");
    console.log(response);
  });
});
$("body").on("saving", "#paper-pemohon .form-autosave", function (e, el, form) {
  const user = cloud.get("pengguna").find((x) => x.id == $(form).find("input[name=id]").val());
  const data = {
    id: user.id,
  };
  if (el.is(".datepicker")) {
    data[el.attr("name")] = form;
  } else {
    data[el.attr("name")] = el.val()?.trim();
  }

  saveProfil(data, function (response) {
    $("#paper-pemohon .form-autosave").trigger("saved", [el, form]);
    if ($(el).prop("tagName") == "SELECT") {
      $(el).closest(".select-wrapper").find("input.select-dropdown").removeClass("update");
    } else {
      $(el).removeClass("update");
    }
    cloud.pull("pengguna");
    console.log(response);
  });
});
$("body").on("click", ".paper-trigger[target=paper-password]", function (e) {
  $("#form-password").trigger("reset");
  $("#form-password").find("input[name=id]").val($(this).data("id"));
});

$("body").on("submit", "#form-password", function (e) {
  e.preventDefault();
  let formData = new FormData(this);
  if (formData.get("passwordch") != formData.get("passwordch_confirm")) {
    Toast.fire({
      icon: "error",
      title: "Password Tidak Sama",
    });
    return;
  }
  $.ajax({
    type: "POST",
    url: baseUrl + `/api/pengguna`,
    data: {
      id: formData.get("id"),
      password: formData.get("passwordch"),
    },
    error: function (jqXHR, textStatus, errorThrown) {
      Toast.fire({
        icon: "error",
        title: "Gagal",
      });
      console.log(textStatus, errorThrown);
    },
    success: function (data, textStatus, jqXHR) {
      $(".paper-folder").trigger("click");
      Toast.fire({
        icon: "success",
        title: "Berhasil disimpan",
      });
    },
  });
});

$("body").on("submit", "#form-add", function (e) {
  e.preventDefault();
  let data = new FormData(this);
  if (data.get("picture").name.trim() == "") {
    data.delete("picture");
  }
  if ($(this).find("select[name=role]").val() == "" || $(this).find("select[name=role]").val() == null) {
    $(this).find("select[name=role]").closest(".input-field").effect("shake");
    return;
  }
  if (data.get("password") != data.get("password_confirm")) {
    $(this).find("input[name=password]").closest(".input-field").effect("shake");
    $(this).find("input[name=password_confirm]").closest(".input-field").effect("shake");
    return;
  }
  data.delete("password_confirm");
  $.ajax({
    type: "POST",
    url: baseUrl + `/api/pengguna/register`,
    data: data,
    cache: false,
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
      if (data.toast?.icon == "error") {
        Toast.fire({
          icon: data.toast.icon,
          title: data.toast.title,
        });
        return;
      }
      $("#paper-add img[alt=picture]").attr("src", baseUrl + "/uploads/foto/avatar.jpg");
      $("#paper-add form")[0].reset();
      $(".paper-folder").trigger("click");
      cloud.pull("pengguna");
      Toast.fire({
        icon: "success",
        title: "Berhasil disimpan",
      });
    },
  });
});

$(document).ready(async function () {
  await cloud.add(baseUrl + "/api/pengguna", {
    name: "profil",
  });
  await cloud.add(baseUrl + "/api/pengguna/all", {
    name: "pengguna",
  });
  await cloud.add(baseUrl + "/api/wilayah", { name: "wilayah", data: { q: "all" } });
  const tablePengguna = $("#pengguna table").DataTable({
    processing: true,
    ajax: {
      url: baseUrl + "/api/pengguna/all",
      type: "GET",
      data: {
        wrap: "data",
      },
    },
    responsive: true,
    columns: [
      {
        data: "assignments[0].item_name",
        render: (data) => {
          return `<span class="pill-status ${getRole(data).color} darken-3">${getRole(data).text}</span>`;
        },
      },
      {
        data: "name",
      },
      {
        data: "id",
        render: (data, type, row) => {
          const btnPw = `<button class="btn waves-effect waves-light btn-small orange btn-action paper-trigger" type="button" data-id="${data}" target="paper-password"><i class="material-icons">vpn_key</i>
          </button>`;
          if (row.assignments[0].item_name == "pemohon") {
            return `<div style="display: flex; gap: 0.25rem">${btnPw}<button class="btn waves-effect waves-light btn-small blue btn-action paper-trigger" type="button" data-id="${data}" target="paper-pemohon"><i class="material-icons">edit</i>
            </button></div>`;
          } else {
            return `<div style="display: flex; gap: 0.25rem">${btnPw}<button class="btn waves-effect waves-light btn-small blue btn-action paper-trigger" type="button" data-id="${data}" target="paper-admin"><i class="material-icons">edit</i>
            </button></div>`;
          }
        },
      },
    ],
  });
  $("select").formSelect();
  cloud.addCallback("pengguna", (data) => {
    tablePengguna.ajax.reload();
  });
});

$("body").on("change", "#paper-pemohon form select.wilayah[name=provinsi]", function (e) {
  if (pemohonInit) return;
  const data = {
    id: $("#paper-pemohon form input[name=id]").val(),
    provinsi: $(this).find("option:selected").text(),
  };
  saveProfil(data, function (response) {
    Toast.fire({
      icon: "success",
      title: "Data Berhasil disimpan",
    });
  });
});
$("body").on("change", "#paper-pemohon form select.wilayah[name=kota]", function (e) {
  if (pemohonInit) return;
  const data = {
    id: $("#paper-pemohon form input[name=id]").val(),
    provinsi: $("select[name=provinsi]").find("option:selected").text(),
    kota: $(this).find("option:selected").text(),
  };
  saveProfil(data, function (response) {
    Toast.fire({
      icon: "success",
      title: "Data Berhasil disimpan",
    });
  });
});
$("body").on("change", "#paper-pemohon form select.wilayah[name=kecamatan]", function (e) {
  if (pemohonInit) return;
  const data = {
    id: $("#paper-pemohon form input[name=id]").val(),
    provinsi: $("select[name=provinsi]").find("option:selected").text(),
    kota: $("select[name=kota]").find("option:selected").text(),
    kecamatan: $(this).find("option:selected").text(),
  };
  saveProfil(data, function (response) {
    Toast.fire({
      icon: "success",
      title: "Data Berhasil disimpan",
    });
  });
});
$("body").on("change", "#paper-pemohon form select.wilayah[name=desa]", function (e) {
  if (pemohonInit) return;
  const data = {
    id: $("#paper-pemohon form input[name=id]").val(),
    provinsi: $("select[name=provinsi]").find("option:selected").text(),
    kota: $("select[name=kota]").find("option:selected").text(),
    kecamatan: $("select[name=kecamatan]").find("option:selected").text(),
    desa: $(this).find("option:selected").text(),
  };
  saveProfil(data, function (response) {
    Toast.fire({
      icon: "success",
      title: "Data Berhasil disimpan",
    });
  });
});

function uploadBtnClick(e, id, callback) {
  if (id == undefined) {
    Toast.fire({
      icon: "error",
      title: "ID Tidak Ditemukan",
    });
    return;
  }
  const data = new FormData();
  data.append("id", id);
  data.append($($(e)[0].target).attr("name"), $(e)[0].target.files[0]);
  $.ajax({
    type: "POST",
    url: baseUrl + `/api/pengguna`,
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success: (response) => {
      if (callback !== undefined && typeof callback === "function") {
        callback(response);
      }
    },
  });
}

$("body").on("change", "input[name=avatar]", function (e) {
  const id = $(this).closest("form").find("input[name=id]").val();
  uploadBtnClick(e, id, (response) => {
    $(this).closest("form").find(".profil-avatar img").attr("src", `${response.data.picture}?t=${Date.now()}`);
  });
});

$("body").on("click", "#paper-pemohon form .list-card button", function (e) {
  const id = $(this).closest("form").find("input[name=id]").val();
  let input = $(`<input type="file" name="${$(this).data("name")}" accept="image/*, application/pdf" />`);
  input.on("change", function (e) {
    uploadBtnClick(e, id, function (response) {
      Toast.fire({
        icon: "success",
        title: "Data Berhasil disimpan",
      });
    });
  });
  console.log(input);
  input.trigger("click");
});
