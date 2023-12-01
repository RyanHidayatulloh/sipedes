<?php

use app\models\Enums\Agama;
use app\models\Enums\Hubungan;
use app\models\Enums\JenisKelamin;
use app\models\Enums\Kewarganegaraan;
use app\models\Enums\Pekerjaan;
use app\models\Enums\Pendidikan;
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
                    <div class="row paper-content">
                        <div class="col s12">
                            <ul class="collection">

                            </ul>
                            <div class="card yellow darken-3 nothing" style="padding: 1rem;">
                                <p>Belum ada anggota</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="paper-fold from-bottom" id="paper1">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Tambah Anggota</p>
                            <a class="btn-floating btn-small waves-effect waves-light paper-folder right"><i
                                    class="material-icons">close</i></a>
                        </div>
                    </div>
                    <div class="row paper-content">
                        <div class="col s12">
                            <div class="container">
                                <form id="form-anggota" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id">
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
                                                <input id="email" name="email" type="email" class="validate">
                                                <label for="email">Email</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="no_hp" name="no_hp" type="tel" class="validate">
                                                <label for="no_hp">Nomor HP</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="jenis_kelamin">
                                                    <option value="" disabled selected>Jenis Kelamin</option>
                                                    <?php foreach (JenisKelamin::forSelect() as $v): ?>
                                                    <option value="<?= $v ?>"><?= $v ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label>Jenis Kelamin</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="tempat_lahir" name="tempat_lahir" type="text"
                                                    class="validate" required>
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                            </div>
                                            <div class="input-field">
                                                <input type="text" id="tgl_lahir" name="tgl_lahir" class="datepicker"
                                                    required>
                                                <label for="tgl_lahir">Tanggal Lahir</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="pendidikan">
                                                    <option value="" disabled selected>Pilih Pendidikan Terakhir
                                                    </option>
                                                    <?php foreach (Pendidikan::forSelect() as $v): ?>
                                                    <option value="<?= $v ?>"><?= $v ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label>Pendidikan Terakhir</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="pekerjaan">
                                                    <option value="" disabled selected>Pilih Pekerjaan</option>
                                                    <?php foreach (Pekerjaan::forSelect() as $v): ?>
                                                    <option value="<?= $v ?>"><?= $v ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label>Pekerjaan</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="hubungan">
                                                    <option value="" disabled selected>Pilih Hubungan Dalam Keluarga
                                                    </option>
                                                    <?php foreach (Hubungan::forSelect() as $v): ?>
                                                    <option value="<?= $v ?>"><?= $v ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label>Hubungan Dalam Keluarga</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="kawin">
                                                    <option value="" disabled selected>Pilih Status Perkawinan</option>
                                                    <option value="0">Belum Kawin</option>
                                                    <option value="1">Sudah Kawin</option>
                                                </select>
                                                <label>Status Perkawinan</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="kewarganegaraan">
                                                    <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                                    <?php foreach (Kewarganegaraan::forSelect() as $v): ?>
                                                    <option value="<?= $v ?>"><?= $v ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label>Status Kewarganegaraan</label>
                                            </div>
                                            <div class="input-field">
                                                <select name="agama">
                                                    <option value="" disabled selected>Pilih Agama</option>
                                                    <?php foreach (Agama::forSelect() as $v): ?>
                                                    <option value="<?= $v ?>"><?= $v ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label>Agama</label>
                                            </div>
                                        </div>
                                        <div class="col s12 m6">
                                            <div class="input-field">
                                                <textarea id="alamat" name="alamat" class="materialize-textarea"
                                                    data-length="128" required></textarea>
                                                <label for="alamat">Alamat</label>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input id="rt" name="rt" type="text" class="validate">
                                                    <label for="rt">RT</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="rw" name="rw" type="text" class="validate">
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
                                                    required>
                                                <label for="kodepos">Kode Pos</label>
                                            </div>

                                            <div class="row preview-container hide">
                                                <div class="col s6"><img src="" alt="foto" id="foto-preview"
                                                        width="100">
                                                </div>
                                                <div class="col s6 center preview-ktp hide"><a href="#!"
                                                        class="preview-card-link" target="_blank"><i
                                                            class="material-icons">visibility</i>
                                                        KTP</a><small>Lihat
                                                        File
                                                        KTP</small></div>
                                            </div>

                                            <label>Input Foto</label>
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Pilih</span>
                                                    <input type="file" name="foto"
                                                        accept="image/png, image/gif, image/jpeg"
                                                        onchange="loadFile(event)" required />
                                                </div>

                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Upload file" />
                                                </div>
                                            </div>

                                            <label>Input File KTP</label>
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Pilih</span>
                                                    <input type="file" name="ktp"
                                                        accept="image/png, image/gif, image/jpeg, application/pdf"
                                                        required />
                                                </div>

                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Upload file" />
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<template id="anggota-item">
    <li class="collection-item avatar">
        <img src="<?= Url::to('@web/img/profil/avatar.jpg') ?>" class="circle profil"></img>
        <span class="title">Nova Adi Saputra</span>
        <p>3328162711010002
        </p>
        <div class="secondary-content">
            <a class="btn-floating btn-small waves-effect waves-light yellow darken-3 paper-trigger btn-edit"
                target="paper1"><i class="material-icons">edit</i></a>
            <a class="btn-floating btn-small waves-effect waves-light red btn-delete"><i
                    class="material-icons">delete</i></a>
        </div>
    </li>
</template>

<?php $this->beginBlock('script'); ?>
<script src="<?= Url::to('@web/js/pages/anggota.js') ?>"></script>
<?php $this->endBlock(); ?>