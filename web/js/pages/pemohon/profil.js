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

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/pengguna", { name: "profil" });
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
    data[el.attr("name")] = el.val().trim();
    $.ajax({
      type: "POST",
      url: baseUrl + `/api/pengguna`,
      data: data,
      success: function (response) {
        $(".form-autosave").trigger("saved", [el, form]);
        console.log(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Toast.fire({
          icon: "error",
          title: "Gagal",
        });
      },
    });
  });
});
