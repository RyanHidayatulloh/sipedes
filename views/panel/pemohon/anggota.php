<?php

use yii\helpers\Url;

/** @var yii\web\View $this */
?>
<div class="row">
    <div class="col s12">
        <div class="card book">
            <div class="paper-wrap">
                <div class="paper-main">
                    <div class="row center">
                        <div class="col s12">
                            <a class="waves-effect waves-light btn paper-trigger" target="paper1">Tambah Anggota</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <ul class="collection">
                                <li class="collection-item avatar hide">
                                    <img src="<?= Url::to('@web/img/profil/avatar.jpg') ?>" class="circle profil"></img>
                                    <span class="title">Nova Adi Saputra</span>
                                    <p>3328162711010002 <br>
                                        <span class="pill">Kepala Keluarga</span>
                                    </p>
                                    <div class="secondary-content">
                                        <a class="btn-floating btn-small waves-effect waves-light yellow darken-3 paper-trigger"
                                            target="paper1"><i class="material-icons">edit</i></a>
                                        <a class="btn-floating btn-small waves-effect waves-light red"><i
                                                class="material-icons">delete</i></a>
                                    </div>
                                </li>
                                <li class="collection-item avatar">
                                    <img src="<?= Url::to('@web/img/profil/avatar.jpg') ?>" class="circle profil"></img>
                                    <span class="title">Nova Adi Saputra</span>
                                    <p>3328162711010002 <br>
                                        <span class="pill">Kepala Keluarga</span>
                                    </p>
                                    <div class="secondary-content">
                                        <a class="btn-floating btn-small waves-effect waves-light yellow darken-3 paper-trigger"
                                            target="paper1"><i class="material-icons">edit</i></a>
                                        <a class="btn-floating btn-small waves-effect waves-light red"><i
                                                class="material-icons">delete</i></a>
                                    </div>
                                </li>
                            </ul>
                            <div class="card yellow darken-3 nothing" style="padding: 1rem;">
                                <p>Belum ada anggota</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="paper-fold from-bottom active" id="paper1">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Tambah Anggota</p>
                            <a class="btn-floating btn-small waves-effect waves-light paper-folder right"><i
                                    class="material-icons">close</i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="container">
                                <form>
                                    <div class="row">
                                        <div class="col s12 m6">
                                            <div class="input-field">
                                                <input id="nama" name="nama" type="text" class="validate" required>
                                                <label for="nama">Nama Lengkap</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="nik" name="nik" type="text" class="validate" required>
                                                <label for="nik">NIK</label>
                                            </div>
                                            <div class="input-field">
                                                <select>
                                                    <option value="" disabled selected>Jenis Kelamin</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                <label>Materialize Select</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="tempat_lahir" name="tempat_lahir" type="text"
                                                    class="validate" required>
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                            </div>
                                            <div class="input-field">
                                                <input type="text" id="tanggal_lahir" name="tanggal_lahir"
                                                    class="datepicker" required>
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                            </div>
                                        </div>
                                        <div class="col s12 m6">a</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('script'); ?>

<script>
function refreshData() {
    $.getJSON(`<?= Url::to(['api/keluarga']) ?>`, {
            id_user: '<?= Yii::$app->user->identity->id ?>',
        },
        function(data, textStatus, jqXHR) {
            $('.collection-item:not(.hide)').remove();
            if (data.anggota.length > 0) {
                console.log(data.anggota);
                $('.nothing').addClass('hide');
            } else {
                $('.nothing').removeClass('hide');
            }
        }
    );
}
</script>

<?php $this->endBlock(); ?>