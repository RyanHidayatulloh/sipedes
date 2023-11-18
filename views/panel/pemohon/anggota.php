<?php

use yii\helpers\Url;
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
                                <li class="collection-item avatar">
                                    <img src="<?= Url::to('@web/img/profil/avatar.jpg') ?>" class="circle profil"></img>
                                    <span class="title">Nova Adi Saputra</span>
                                    <p>3328162711010002 <br>
                                        <span class="pill">Kepala Keluarga</span>
                                    </p>
                                    <div class="secondary-content">
                                        <a class="btn-floating btn-small waves-effect waves-light yellow darken-3 paper-trigger" target="paper1"><i class="material-icons">edit</i></a>
                                        <a class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="paper-fold from-bottom" id="paper1">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Tambah Anggota</p>
                            <a class="btn-floating btn-small waves-effect waves-light paper-folder right"><i class="material-icons">close</i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="container">
                                a
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>