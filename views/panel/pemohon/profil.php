<?php

use app\models\Enums\Agama;
use app\models\Enums\Hubungan;
use app\models\Enums\JenisKelamin;
use app\models\Enums\Kewarganegaraan;
use app\models\Enums\Pekerjaan;
use app\models\Enums\Pendidikan;
use app\models\Enums\StatusPerkawinan;
use app\models\Pengguna;
use yii\helpers\Url;

/** @var yii\web\View $this */

$pengguna = Pengguna::with("biodata")->find(Yii::$app->user->getId());
?>
<div class="row">
    <div class="col s12">
        <div class="card book">
            <div class="paper-wrap">
                <div class="paper-main">
                    <div class="scaffold">
                        <div class="content">
                            <div class="row">
                                <div class="col s12">
                                    <div class="container">
                                        <div class="form-autosave-loader">
                                            <img src="<?=Url::to('@web/img/spinner.gif')?>" alt="spinner"><i
                                                class="material-icons">check_circle</i><span>Simpan Otomatis</span>
                                        </div>
                                        <h4 class="center" style="margin-bottom: 1rem">Profil</h4>
                                        <div class="profil-avatar">
                                            <img src="<?=Url::to('@web/uploads/foto/' . $user->picture)?>" alt="avatar">
                                            <div class="file-field input-field">
                                                <div class="btn btn-small">
                                                    <span><i class="material-icons">upload</i></span>
                                                    <input type="file" id="avatar" name="avatar" accept="image/*">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Unggah Foto Profil">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="round-title">
                                            <span>Dokumen</span>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="list-card">
                                                    <p>KTP</p>
                                                    <div class="btn-wrapper">
                                                        <a target="_blank" href="<?=$pengguna->biodata->ktp ?? "#!"?>"
                                                            class="btn btn-small waves-effect waves-light blue" <?=$pengguna->biodata->ktp ? "" : "style='display: none'"?>>
                                                            <span><i class="material-icons">visibility</i></span>
                                                        </a>
                                                        <button class="btn btn-small waves-effect waves-light green" data-name="ktp">
                                                            <span><i class="material-icons">upload</i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="list-card">
                                                    <p>Kartu Keluarga</p>
                                                    <div class="btn-wrapper">
                                                        <a target="_blank" href="<?=$pengguna->biodata->kk ?? "#!"?>"
                                                            class="btn btn-small waves-effect waves-light blue" <?=$pengguna->biodata->kk ? "" : "style='display: none'"?>>
                                                            <span><i class="material-icons">visibility</i></span>
                                                        </a>
                                                        <button class="btn btn-small waves-effect waves-light green" data-name="kk">
                                                            <span><i class="material-icons">upload</i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="round-title">
                                            <span>Biodata</span>
                                        </div>
                                        <form action="" method="POST" class="form-autosave" class="row">
                                            <div class="col s12 m6">
                                                <div class="input-field col s12">
                                                    <input id="nama" type="text" name="nama" class="validate" required>
                                                    <label for="nama">Nama</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="nik" type="text" name="nik" class="validate" required>
                                                    <label for="nik">NIK</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="nokk" type="text" name="nokk" class="validate" required>
                                                    <label for="nokk">Nomor KK</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="jenis_kelamin">
                                                        <option value="" disabled selected>Jenis Kelamin</option>
                                                        <?php foreach (JenisKelamin::forSelect() as $k => $v): ?>
                                                        <option value="<?=$v?>"><?=$v?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label>Jenis Surat</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="tempat_lahir" type="text" name="tempat_lahir"
                                                        class="validate" required>
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="tgl_lahir" type="text" name="tgl_lahir"
                                                        class="validate datepicker" required>
                                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="pendidikan">
                                                        <option value="" disabled selected>Pilih Pendidikan Terakhir
                                                        </option>
                                                        <?php foreach (Pendidikan::forSelect() as $k => $v): ?>
                                                        <option value="<?=$v?>"><?=$v?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label>Pendidikan Terakhir</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="pekerjaan">
                                                        <option value="" disabled selected>Pilih Pekerjaan</option>
                                                        <?php foreach (Pekerjaan::forSelect() as $k => $v): ?>
                                                        <option value="<?=$v?>"><?=$v?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label>Pekerjaan</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="hubungan">
                                                        <option value="" disabled selected>Pilih Hubungan</option>
                                                        <?php foreach (Hubungan::forSelect() as $k => $v): ?>
                                                        <option value="<?=$v?>"><?=$v?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label>Hubungan dalam KK</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="status_perkawinan">
                                                        <option value="" disabled selected>Pilih Status Perkawinan
                                                        </option>
                                                        <?php foreach (StatusPerkawinan::forSelect() as $k => $v): ?>
                                                        <option value="<?=$v?>"><?=$v?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label>Status Perkawinan</label>
                                                </div>
                                            </div>
                                            <div class="col s12 m6">
                                                <div class="input-field col s12">
                                                    <select name="kewarganegaraan">
                                                        <option value="" disabled selected>Pilih Kewarganegaraan
                                                        </option>
                                                        <?php foreach (Kewarganegaraan::forSelect() as $k => $v): ?>
                                                        <option value="<?=$v?>"><?=$v?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label>Kewarganegaraan</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="agama">
                                                        <option value="" disabled selected>Pilih Agama
                                                        </option>
                                                        <?php foreach (Agama::forSelect() as $k => $v): ?>
                                                        <option value="<?=$v?>"><?=$v?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label>Agama</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <textarea id="alamat" name="alamat" class="materialize-textarea"
                                                        required></textarea>
                                                    <label for="alamat">Alamat</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="rt" type="text" name="rt" class="validate" required>
                                                    <label for="rt">RT</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="rw" type="text" name="rw" class="validate" required>
                                                    <label for="rw">RW</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="provinsi" class="wilayah">
                                                        <option value="" disabled selected>Pilih Provinsi</option>
                                                    </select>
                                                    <label>Provinsi</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="kota" class="wilayah">
                                                        <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                                                    </select>
                                                    <label>Kota/Kabupaten</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="kecamatan" class="wilayah">
                                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                                    </select>
                                                    <label>Kecamatan</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select name="desa" class="wilayah">
                                                        <option value="" disabled selected>Pilih Desa</option>
                                                    </select>
                                                    <label>Desa</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="kodepos" type="text" name="kodepos" class="validate"
                                                        required>
                                                    <label for="kodepos">Kode POS</label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nav flex-center">
                            <a class="waves-effect waves-light btn-small paper-trigger nv-button" target="paper1">
                                <i class="material-icons">key</i> Ubah Kata Sandi
                            </a>
                        </div>
                    </div>
                </div>
                <div class="paper-fold from-bottom" id="paper1">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Ubah Kata Sandi</p>
                            <a class="btn-floating btn-small waves-effect waves-light paper-folder right">
                                <i class="material-icons">close</i>
                            </a>
                        </div>
                    </div>
                    <div class="row paper-content">
                        <div class="col s12">
                            <div class="container">
                                <form id="form-password" action="" method="POST">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input id="password" name="password" type="password" class="validate"
                                                required>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input id="password2" name="password2" type="password" class="validate"
                                                required>
                                            <label for="password2">Konfirmasi Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light right" type="submit"
                                                name="action"> Simpan <i class="material-icons right">send</i>
                                            </button>
                                        </div>
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

<?php $this->beginBlock('script');?>
<script src="<?=Url::to('@web/js/pages/pemohon/profil.js')?>"></script>
<?php $this->endBlock();?>