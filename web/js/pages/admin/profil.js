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
        $(".list-card button[data-name=ktp]")
          .closest(".btn-wrapper")
          .find("a")
          .fadeIn("normal", function () {
            $(this).attr("href", response.data.biodata.ktp);
          });
      }
      if (response.data.biodata.kk) {
        $(".list-card button[data-name=kk]")
          .closest(".btn-wrapper")
          .find("a")
          .fadeIn("normal", function () {
            $(this).attr("href", response.data.biodata.kk);
          });
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
  $("input[name=name]").val(cloud.get("profil").name);
  $("input[name=nid]").val(cloud.get("profil").nid);
  M.updateTextFields();

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
      $(".profile-view .name").text(response.data.name);
      $(".form-autosave").trigger("saved", [el, form]);
      if ($(el).prop("tagName") == "SELECT") {
        $(el).closest(".select-wrapper").find("input.select-dropdown").removeClass("update");
      } else {
        $(el).removeClass("update");
      }
      console.log(response);
    });
  });
  $("body").on("change", "input[type=file]", uploadBtnClick);
});
