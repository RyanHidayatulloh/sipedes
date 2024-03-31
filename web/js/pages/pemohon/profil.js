const cloud = new Puller();

$("body").on("click", ".paper-trigger", function () {
  $("#form-password").trigger("reset");
});

$("body").on("submit", "#form-password", function (e) {
  e.preventDefault();
  let formData = new FormData(this);
  if (formData.get("password") == formData.get("password2")) {
    $.ajax({
      type: "POST",
      url: baseUrl + `/api/pengguna`,
      data: {
        id: cloud.get("profil").id,
        password: formData.get("password"),
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
          icon: data.toast.icon,
          title: data.toast.title,
        });
      },
    });
  } else {
    Toast.fire({
      icon: "error",
      title: "Password Tidak Sama",
    });
  }
});

function saveProfil(data, callback) {
  data.id = cloud.get("profil").id;
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

function uploadBtnClick(e) {
  console.log($(this));
  const data = new FormData();
  data.append("id", cloud.get("profil").id);
  data.append($(this).attr("name"), $(this)[0].files[0]);
  $.ajax({
    type: "POST",
    url: baseUrl + `/api/pengguna`,
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success: (response) => {
      let timestamp = new Date().getTime();
      $(this).closest(".file-field").find(".file-path").val("");
      $(".profile-image img").attr("src", baseUrl + response.data.picture + "?timestamp=" + timestamp);
      $(".profil-avatar img").attr("src", baseUrl + response.data.picture + "?timestamp=" + timestamp);
      if (response.data.biodata.ktp) {
        $(".list-card button[data-name=ktp]").closest(".btn-wrapper").find("a").removeClass("hide").attr("href", response.data.biodata.ktp);
      }
      if (response.data.biodata.kk) {
        $(".list-card button[data-name=kk]").closest(".btn-wrapper").find("a").removeClass("hide").attr("href", response.data.biodata.kk);
      }
      Toast.fire({
        icon: "success",
        title: "Data Berhasil disimpan",
      });
    },
  });
}

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/pengguna", { name: "profil" });
  cloud.add("http://sipedes.project/api/wilayah", { name: "wilayah", data: { q: "all" } }).then(() => {
    initWilayah(cloud.get("profil").biodata);
  });
  $.each(cloud.get("profil").biodata, function (k, v) {
    $(`input[name=${k}]`).val(v);
    $(`textarea[name=${k}]`)?.val(v);
    const select = $(`select[name=${k}] option`);
    if (select.length > 0) {
      $.each(select, function (i, s) {
        if ($(s).text() == v) $(`select[name=${k}]`).val($(s).val());
      });
    }
  });
  M.updateTextFields();
  M.textareaAutoResize($(`textarea`));
  $("select").formSelect();

  $("body").on("saving", ".form-autosave", function (e, el, form) {
    const user = cloud.get("profil");
    const data = {
      id: user.id,
    };
    if (el.is(".datepicker")) {
      data[el.attr("name")] = form;
    } else {
      data[el.attr("name")] = el.val().trim();
    }

    saveProfil(data, function (response) {
      $(".form-autosave").trigger("saved", [el, form]);
      if ($(el).prop("tagName") == "SELECT") {
        $(el).closest(".select-wrapper").find("input.select-dropdown").removeClass("update");
      } else {
        $(el).removeClass("update");
      }
      console.log(response);
    });
  });
  $("body").on("change", "select.wilayah[name=provinsi]", function (e) {
    const data = {
      provinsi: $(this).find("option:selected").text(),
    };
    saveProfil(data, function (response) {
      Toast.fire({
        icon: "success",
        title: "Data Berhasil disimpan",
      });
    });
  });
  $("body").on("change", "select.wilayah[name=kota]", function (e) {
    const data = {
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
  $("body").on("change", "select.wilayah[name=kecamatan]", function (e) {
    const data = {
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
  $("body").on("change", "select.wilayah[name=desa]", function (e) {
    const data = {
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
  $("body").on("change", "input[type=file]", uploadBtnClick);
  $("body").on("click", ".list-card button", function (e) {
    let input = $(`<input type="file" name="${$(this).data("name")}" accept="image/*, application/pdf" />`);
    input.on("change", uploadBtnClick);
    input.trigger("click");
  });
});
