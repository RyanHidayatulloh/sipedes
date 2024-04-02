const cloud = new Puller();

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/pengguna", {
    name: "profil",
  });
  await cloud.add("http://sipedes.project/api/permohonan", {
    name: "permohonan",
    data: { id_user: cloud.get("profil").id },
  });

  $(".count-berjalan").text(
    cloud.get("permohonan").filter((x) => parseInt(x.status) < 7).length
  );
  $(".count-selesai").text(
    cloud.get("permohonan").filter((x) => parseInt(x.status) == 7).length
  );
});
