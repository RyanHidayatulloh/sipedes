<?php

use app\models\Pengguna;
use yii\helpers\Url;

$pengguna = Pengguna::with("biodata")->find(Yii::$app->user->getId());
?>
<div class="top-bar">
    <div class="top-profile">
        <a href="#" data-target="mobile-demo" class="sidenav-trigger">
            <i class="material-icons">menu</i>
        </a>
        <div class="hide-on-med-and-down">
            <h3 class="title">SIPEDES</h3>
            <p class="sub-title">Sistem Pelayanan Umum dan Administrasi Desa Buniwah</p>
        </div>
        <div class="profile-view">
            <div class="profile-detail hide-on-med-and-down">
                <p class="name">
                    <?= $pengguna->name != '' ? $pengguna->name : $pengguna->nid ?>
                </p>
                <p class="role">
                    <?= key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) ?>
                </p>
            </div>
            <div class="profile-image">
                <a class='dropdown-trigger' href='#' data-target='dropdown-profile'><img class="circle"
                        src="<?= Url::to('@web/uploads/foto/' . Yii::$app->user->identity->picture) ?>" alt="avatar"></a>
                <ul id='dropdown-profile' class='dropdown-content'>
                    <li>
                        <a id="logout-button" href="<?= Url::to(['auth/logout']) ?>">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="top-nav hide-on-med-and-down">
        <ul>
            <li class="waves-effect waves-light" data-page="dashboard">
                <a href="<?= Url::to(['panel/index']) ?>">Dashboard</a>
            </li>
            <li class="waves-effect waves-light" data-page="permohonan">
                <a href="<?= Url::to(['panel/permohonan']) ?>">Permohonan</a>
            </li>
            <?php if ((key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'staff') || key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'admin') : ?>
            <li class="waves-effect waves-light" data-page="cetak">
                <a href="<?= Url::to(['panel/cetak']) ?>">Cetak</a>
            </li>
            <li class="waves-effect waves-light" data-page="pengguna">
                <a href="<?= Url::to(['panel/pengguna']) ?>">Pengguna</a>
            </li>
            <?php endif; ?>
            <?php if ((key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'kades') || key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'admin') : ?>
            <li class="waves-effect waves-light" data-page="laporan">
                <a href="<?= Url::to(['panel/laporan']) ?>">Laporan</a>
            </li>
            <?php endif; ?>
            <?php if ((key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) != 'staff') && key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) != 'admin') : ?>
            <li class="waves-effect waves-light" data-page="profil">
                <a href="<?= Url::to(['panel/profil']) ?>">Profil</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<ul class="sidenav" id="mobile-demo">
    <li data-page="dashboard">
        <a href="<?= Url::to(['panel/index']) ?>">Dashboard</a>
    </li>
    <li data-page="permohonan">
        <a href="<?= Url::to(['panel/permohonan']) ?>">Permohonan</a>
    </li>
    <?php if ((key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'staff') || key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'admin') : ?>
    <li data-page="pemohon">
        <a href="<?= Url::to(['panel/pemohon']) ?>">Pemohon</a>
    </li>
    <?php endif; ?>
    <?php if ((key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'kades') || key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'admin') : ?>
    <li data-page="laporan">
        <a href="<?= Url::to(['panel/laporan']) ?>">Laporan</a>
    </li>
    <?php endif; ?>
    <?php if ((key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'pemohon') || key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'admin') : ?>
    <li class="waves-effect waves-light" data-page="anggota">
        <a href="<?= Url::to(['panel/anggota']) ?>">Anggota</a>
    </li>
    <?php endif; ?>
    <?php if ((key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) != 'staff') && key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) != 'admin') : ?>
    <li data-page="profil">
        <a href="<?= Url::to(['panel/profil']) ?>">Profil</a>
    </li>
    <?php endif; ?>
</ul>