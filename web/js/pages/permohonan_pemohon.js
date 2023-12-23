const cloud = new Puller();

$(document).ready(async function () {
  await cloud.add("http://sipedes.project/api/keluarga", { name: "keluarga", data: { id_user: true } });
  await cloud.add("http://sipedes.project/api/permohonan", { name: "permohonan", data: { id_user: true } });
});
