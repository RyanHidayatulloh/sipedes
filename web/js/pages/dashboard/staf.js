const cloud = new Puller();

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/pengguna", {
    name: "profil",
  });
  await cloud.add("http://sipedes.project/api/permohonan", {
    name: "permohonan",
  });

  $(".count-berjalan").text(cloud.get("permohonan").filter((x) => parseInt(x.status) == 3).length);
  $(".count-reject").text(cloud.get("permohonan").filter((x) => parseInt(x.status) == 4).length);
  $(".count-accept").text(cloud.get("permohonan").filter((x) => parseInt(x.status) == 5).length);
  $(".count-ttd").text(cloud.get("permohonan").filter((x) => parseInt(x.status) == 6).length);
  $(".count-print").text(cloud.get("permohonan").filter((x) => parseInt(x.status) == 7).length);
});
