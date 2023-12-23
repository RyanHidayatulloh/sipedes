<?php

use yii\helpers\Url;

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
                    <?= Yii::$app->user->identity->name != '' ? Yii::$app->user->identity->name : Yii::$app->user->identity->nid ?>
                </p>
                <p class="role">
                    <?= key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) ?>
                </p>
            </div>
            <div class="profile-image">
                <a class='dropdown-trigger' href='#' data-target='dropdown-profile'><img class="circle"
                        src="<?= Url::to('@web/img/profil/' . Yii::$app->user->identity->picture) ?>" alt="avatar"></a>
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
            <?php if (key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'staff') : ?>
            <li class="waves-effect waves-light" data-page="pemohon">
                <a href="<?= Url::to(['panel/pemohon']) ?>">Pemohon</a>
            </li>
            <?php endif; ?>
            <?php if (key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'kades') : ?>
            <li class="waves-effect waves-light" data-page="laporan">
                <a href="<?= Url::to(['panel/laporan']) ?>">Laporan</a>
            </li>
            <?php endif; ?>
            <?php if (key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) != 'staff') : ?>
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
    <?php if (key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'staff') : ?>
    <li data-page="pemohon">
        <a href="<?= Url::to(['panel/pemohon']) ?>">Pemohon</a>
    </li>
    <?php endif; ?>
    <?php if (key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'kades') : ?>
    <li data-page="laporan">
        <a href="<?= Url::to(['panel/laporan']) ?>">Laporan</a>
    </li>
    <?php endif; ?>
    <?php if (key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'pemohon') : ?>
    <li class="waves-effect waves-light" data-page="anggota">
        <a href="<?= Url::to(['panel/anggota']) ?>">Anggota</a>
    </li>
    <?php endif; ?>
    <?php if (key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) != 'staff') : ?>
    <li data-page="profil">
        <a href="<?= Url::to(['panel/profil']) ?>">Profil</a>
    </li>
    <?php endif; ?>
</ul>