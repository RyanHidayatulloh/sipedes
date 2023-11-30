<?php

use app\models\Keluarga;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var Keluarga $keluarga */
?>
<div class="row">
    <div class="col s12">
        <div class="card book">
            <div class="paper-wrap">
                <div class="paper-main">
                    <form action="<?= Url::to(['api/keluarga']) ?>" class="form-profil" method="POST"
                        enctype="multipart/form-data" style="height: inherit;">
                        <input type="hidden" name="id_user" value="<?= Yii::$app->user->identity->id ?>">
                        <div class="row center">
                            <div class="col s12">
                                <button type="submit" class="waves-effect waves-light btn">
                                    <i class="material-icons">save</i>
                                </button>
                            </div>
                        </div>
                        <div class="row paper-content">
                            <div class="col center l6 s12">
                                <div class="row" style="padding: 0 3.5rem;">
                                    <div class="input-field col s12">
                                        <input disabled value="<?= Yii::$app->user->identity->email ?>" type="text"
                                            id="email">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col input-field s12">
                                        <input disabled value="<?= Yii::$app->user->identity->nid ?>" type="text"
                                            id="nid">
                                        <label for="nid">Nomor KK</label>
                                    </div>
                                    <div class="col input-field s10">
                                        <input disabled value="<?= Yii::$app->user->identity->name ?>" type="text"
                                            id="name">
                                        <label for="name">Nama Lengkap</label>
                                    </div>
                                    <div class="col button-bar s2">
                                        <a class="waves-effect waves-light btn-small paper-trigger" target="paper1">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </div>
                                    <div class="col input-field s12">
                                        <select name="id_kepala_keluarga">
                                            <option value="" disabled selected>Pilih Kepala Keluarga</option>
                                            <?php foreach ($keluarga->anggota as $a): ?>
                                            <option value="<?= $a->id ?>"
                                                <?= $keluarga->id_kepala_keluarga == $a->id ? 'selected' : '' ?>>
                                                <?= $a->nama ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label>Kepala Keluarga</label>
                                    </div>
                                    <?php if ($keluarga->kk): ?>
                                    <div class="col s12">
                                        <a href="<?= Url::to('@web/uploads/kk/' . $keluarga->kk) ?>"
                                            class="preview-card-link" target="_blank">
                                            <i class="material-icons">visibility</i>
                                            Lihat File KK</a>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col l6 s12">
                                <div class="container">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="input-field">
                                                <textarea id="alamat" name="alamat" class="materialize-textarea"
                                                    data-length="128"><?= $keluarga->alamat ?></textarea>
                                                <label for="alamat">Alamat</label>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input id="rt" name="rt" type="text" class="validate"
                                                        value="<?= $keluarga->rt ?>">
                                                    <label for="rt">RT</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="rw" name="rw" type="text" class="validate"
                                                        value="<?= $keluarga->rw ?>">
                                                    <label for="rw">RW</label>
                                                </div>
                                            </div>
                                            <div class="input-field">
                                                <select name="provinsi">
                                                    <option value="" disabled selected>Pilih Provinsi</option>
                                                </select>
                                                <label>Provinsi</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="kota">
                                                    <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                                                </select>
                                                <label>Kabupaten / Kota</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="kecamatan">
                                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                                </select>
                                                <label>Kecamatan</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="desa">
                                                    <option value="" disabled selected>Pilih Desa</option>
                                                </select>
                                                <label>Desa</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="kodepos" name="kodepos" type="number" class="validate"
                                                    value="<?= $keluarga->kodepos ?>">
                                                <label for="kodepos">Kode Pos</label>
                                            </div>
                                            <label>Input File KK</label>
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Pilih</span>
                                                    <input type="file" name="kk"
                                                        accept="image/png, image/gif, image/jpeg, application/pdf" />
                                                </div>

                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Upload file" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="paper-fold from-bottom" id="paper1">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Atur Info Pengguna</p>
                            <a class="btn-floating btn-small waves-effect waves-light paper-folder right">
                                <i class="material-icons">close</i>
                            </a>
                        </div>
                    </div>
                    <div class="row paper-content">
                        <form action="<?= Url::to(['api/user']) ?>" class="form-profil" method="POST"
                            enctype="multipart/form-data">
                            <div class="col s12">
                                <div class="container">
                                    <div class="row">
                                        <div class="col center l6 s12">
                                            <div>
                                                <img src="<?= Url::to('@web/img/profil/' . $user->picture) ?>"
                                                    class="circle" alt="profil" height="200" id="foto-preview">
                                            </div>
                                        </div>
                                        <div class="col l6 s12">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="name" name="name" type="text" class="validate"
                                                            value="<?= $user->name ?>">
                                                        <label for="name">Nama Pengguna</label>
                                                    </div>
                                                    <label>Input Foto</label>
                                                    <div class="file-field input-field">
                                                        <div class="btn">
                                                            <span>Pilih</span>
                                                            <input type="file" name="picture"
                                                                accept="image/png, image/gif, image/jpeg"
                                                                onchange="loadFile(event)" />
                                                        </div>

                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text"
                                                                placeholder="Upload file" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="center">
                                                <button type="submit"
                                                    class="btn waves-effect waves-light">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('script'); ?>

<script>
const daerah = [];

<?php if ($keluarga->provinsi): ?>
daerah.push('<?= $keluarga->provinsi ?>');
<?php endif; ?>
<?php if ($keluarga->kota): ?>
daerah.push('<?= $keluarga->kota ?>');
<?php endif; ?>
<?php if ($keluarga->kecamatan): ?>
daerah.push('<?= $keluarga->kecamatan ?>');
<?php endif; ?>
<?php if ($keluarga->desa): ?>
daerah.push('<?= $keluarga->desa ?>');
<?php endif; ?>

if (daerah.length > 0) {
    setDaerah(...daerah);
}

function loadFile(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('foto-preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

$('.form-profil').on('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        error: function(jqXHR, textStatus, errorThrown) {
            Toast.fire({
                icon: "error",
                title: "Gagal"
            });
            console.log(textStatus, errorThrown);
        },
        success: function(data, textStatus, jqXHR) {
            Toast.fire({
                icon: data.toast.icon,
                title: data.toast.title
            });
            console.log(data);
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
    });
});
</script>

<?php $this->endBlock(); ?>