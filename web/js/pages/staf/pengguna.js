const cloud = new Puller();

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
      if (data.toast.icon == "error") {
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
        icon: data.toast.icon,
        title: data.toast.title,
      });
    },
  });
});

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/pengguna", {
    name: "profil",
  });
  await cloud.add("http://sipedes.project/api/pengguna/all", {
    name: "pengguna",
  });
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
        render: (data) => {
          return `<button class="btn waves-effect waves-light btn-small blue btn-action paper-trigger" type="button" data-id="${data}" target="paper-action"><i class="material-icons">chevron_right</i>
          </button>`;
        },
      },
    ],
  });
  $("select").formSelect();
  cloud.addCallback("pengguna", (data) => {
    tablePengguna.ajax.reload();
  });
});
