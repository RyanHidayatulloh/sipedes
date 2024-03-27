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
    $(`select[name=${k}]`)?.val(v);
  });
  M.updateTextFields();
  M.textareaAutoResize($(`textarea`));
  $('select').formSelect();
});
