const cloud = new Puller();

$(document).ready(async function () {
  cloud.add(baseUrl + "/api/pengguna", {
    name: "profil",
  });
  cloud
    .add(baseUrl + "/api/permohonan", {
      name: "permohonan",
    })
    .then((permohonan) => {
      const statusPermohonan = {};
      permohonan.forEach((x) => {
        if (!statusPermohonan[x.status]) {
          statusPermohonan[x.status] = 0;
        }
        statusPermohonan[x.status]++;
      }); // 1: berjalan, 2: reject, 3: accept, 4: ttd, 5: print, 6: ttd, 7: print
      $.each(statusPermohonan, function (code, count) {
        $(".count-" + code).text(count);
      });
    });
});
