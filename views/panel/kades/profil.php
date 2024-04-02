<?php

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
                                            <span>Biodata</span>
                                        </div>
                                        <form action="" method="POST" class="form-autosave" class="row">
                                            <div class="col s12">
                                                <div class="input-field col m6 s12">
                                                    <input id="name" type="text" name="name" class="validate" required>
                                                    <label for="name">Nama</label>
                                                </div>
                                                <div class="input-field col m6 s12">
                                                    <input id="email" type="email" name="email" class="validate" required>
                                                    <label for="email">Email</label>
                                                </div>
                                                <div class="input-field col m6 s12">
                                                    <input id="nid" type="text" name="nid" class="validate" required>
                                                    <label for="nid">NIDN</label>
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
<script src="<?=Url::to('@web/js/pages/admin/profil.js')?>"></script>
<?php $this->endBlock();?>