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
                    <div class="scaffold">
                        <div class="content">
                            <div class="row">
                                <div class="col s12">
                                    <div class="container">
                                        <table class="biodata">
                                            <tr>
                                                <th>Nama</th>
                                                <td>: <span class="nama"></span></td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>: <span class="nik"></span></td>
                                            </tr>
                                            <tr>
                                                <th>No. KK</th>
                                                <td>: <span class=" nokk"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>: <span class="jenis_kelamin"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Tempat, Tgl. Lahir</th>
                                                <td>: <span class="tempat_lahir"></span>, <span
                                                        class="tgl_lahir"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Pendidikan</th>
                                                <td>: <span class="pendidikan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan</th>
                                                <td>: <span class="pekerjaan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Hubungan</th>
                                                <td>: <span class="hubungan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Status Perkawinan</th>
                                                <td>: <span class="status_perkawinan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Kewarganegaraan</th>
                                                <td>: <span class="kewarganegaraan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Agama</th>
                                                <td>: <span class="agama"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>: <span class="alamat"></span></td>
                                            </tr>
                                            <tr>
                                                <th>RT</th>
                                                <td>: <span class="rt"></span></td>
                                            </tr>
                                            <tr>
                                                <th>RW</th>
                                                <td>: <span class="rw"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Desa</th>
                                                <td>: <span class="desa"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Kecamatan</th>
                                                <td>: <span class="kecamatan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Kota</th>
                                                <td>: <span class="kota"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Provinsi</th>
                                                <td>: <span class="provinsi"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Kode Pos</th>
                                                <td>: <span class="kodepos"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nav flex-center"><a class="waves-effect waves-light btn-small paper-trigger"
                                target="paper1">
                                <i class="material-icons">key</i> Ubah Kata Sandi
                            </a></div>
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

<?php $this->beginBlock('script'); ?>
<script src="<?= Url::to('@web/js/pages/pemohon/profil.js') ?>"></script>
<?php $this->endBlock(); ?>