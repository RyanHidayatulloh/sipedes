const cloud = new Puller();

$(document).ready(async function () {
  await cloud.add(baseUrl + "/api/pengguna", {
    name: "profil",
  });
  await cloud.add(baseUrl + "/api/permohonan", {
    name: "permohonan",
  });

  $(".count-berjalan").text(cloud.get("permohonan").filter((x) => parseInt(x.status) == 5).length);
  $(".count-reject").text(cloud.get("permohonan").filter((x) => parseInt(x.status) == 6).length);
  $(".count-accept").text(cloud.get("permohonan").filter((x) => parseInt(x.status) == 7).length);
});
