<?php

use yii\helpers\Url;
?>
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col center l4 s12"><img src="<?= Url::to('@web/img/profil/' . Yii::$app->user->identity->picture) ?>" class="circle" alt="profil" width="100%">
                        <a class="waves-effect waves-light btn-small">Ubah Profil</a>
                    </div>
                    <div class="col l8 s12">
                        <div class="container">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input disabled value="admin@gmail.com" type="text" id="email">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col input-field s12">
                                    <input disabled value="123456" type="text" id="nid">
                                    <label for="nid">Nomor KK</label>
                                </div>
                                <div class="col input-field s10">
                                    <input disabled value="Nova ADi Saputra" type="text" id="name">
                                    <label for="name">Nama Lengkap</label>
                                </div>
                                <div class="col button-bar s2">
                                    <a class="waves-effect waves-light btn-small edit-button"><i class="material-icons">edit</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>