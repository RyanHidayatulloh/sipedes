<?php

use app\models\Enums\JenisSurat;
use app\models\Pengguna;
use yii\helpers\Url;

/** @var yii\web\View $this */

$pengguna = Pengguna::with("biodata")->find(Yii::$app->user->getId())->append("completed");
?>

<?php if (!$pengguna->completed) : ?>
    <div class="row">
        <div class="list-card">
            <p>Anda Belum Melengkapi seluruh data, Harap lengkapi seluruh data terlebih dahulu!</p>
            <div class="btn-wrapper">
                <a href="<?= Url::to(['panel/profil']) ?>" class="waves-effect waves-light btn green"><i class="material-icons">edit</i></a>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col s12">
            <div class="sbs-wrapper">
                <div class="sbs-sub">
                    <h4>Ajukan Permohonan Baru</h4>
                    <div class="permohonan-slider-wrapper">
                        <div class="screen add" data-screen="1">
                            <small>Buat <br> Permohonan Baru</small>
                            <button class="btn waves-effect waves-light green add" type="button"><i class="material-icons">note_add</i></button>
                        </div>
                        <div class="screen" data-screen="2">
                            <small>Pilih Jenis Surat</small>
                            <div class="main">
                                <?php foreach (JenisSurat::forSelect() as $k => $v) : ?>
                                    <p>
                                        <label>
                                            <input name="jenis" type="radio" data-value="<?= $k ?>" />
                                            <span><?= $v ?></span>
                                        </label>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                            <div class="slide-nav">
                                <button class="btn waves-effect waves-light blue prev" type="button"><i class="material-icons">chevron_left</i></button>
                                <button class="btn waves-effect waves-light blue next" type="button"><i class="material-icons">chevron_right</i></button>
                            </div>
                        </div>
                        <div class="screen" data-screen="3">
                            <small>Keperluan</small>
                            <div class="main row">
                                <div class="input-field col s12">
                                    <textarea id="keperluan" name="keperluan" type="text" class="materialize-textarea validate" placeholder="Keperluan ..."></textarea>
                                </div>
                            </div>
                            <div class="slide-nav">
                                <button class="btn waves-effect waves-light blue prev" type="button"><i class="material-icons">chevron_left</i></button>
                                <button class="btn waves-effect waves-light blue next" type="button"><i class="material-icons">chevron_right</i></button>
                            </div>
                        </div>
                        <div class="screen" data-screen="4">
                            <small>Keterangan</small>
                            <div class="main row">
                                <div class="input-field col s12">
                                    <textarea id="keterangan" name="keterangan" type="text" class="materialize-textarea validate" placeholder="keterangan ..."></textarea>
                                </div>
                            </div>
                            <div class="slide-nav">
                                <button class="btn waves-effect waves-light blue prev" type="button"><i class="material-icons">chevron_left</i></button>
                                <button class="btn waves-effect waves-light blue next" type="button"><i class="material-icons">chevron_right</i></button>
                            </div>
                        </div>
                        <div class="screen" data-screen="5">
                            <small>Foto</small>
                            <div class="main">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" name="file" accept="image/*, application/pdf">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="slide-nav">
                                <button class="btn waves-effect waves-light blue prev" type="button"><i class="material-icons">chevron_left</i></button>
                                <button class="btn waves-effect waves-light blue next" type="button"><i class="material-icons">chevron_right</i></button>
                            </div>
                        </div>
                        <div class="screen" data-screen="6">
                            <small>Kirim</small>
                            <div class="main">
                                <p>Sebelum mengirim, pastikan semua data sudah benar</p>
                            </div>
                            <div class="slide-nav">
                                <button class="btn waves-effect waves-light blue prev" type="button"><i class="material-icons">chevron_left</i></button>
                                <button class="btn waves-effect waves-light green send" type="button"><i class="material-icons" style="font-size: small">send</i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sbs-main">
                    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                        <li class="tab"><a class="active" href="#ongoing">Permohonan Berjalan</a></li>
                        <li class="tab"><a href="#history">Riwayat Permohonan</a></li>
                    </ul>
                    <div id="ongoing" class="col s12">
                        <table class="striped highlight" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Surat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div id="history" class="col s12">
                        <table class="striped highlight" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Surat</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="paper-fold from-right" id="paper-action">
                        <div class="row">
                            <div class="col s12">
                                <p class="left title">Tindak Lanjut Penolakan Permohonan</p>
                                <a class="btn-floating btn-small waves-effect waves-light paper-folder red right">
                                    <i class="material-icons">close</i>
                                </a>
                            </div>
                        </div>
                        <div class="row paper-content">
                            <div class="container">
                                <div class="form-autosave-loader" style="z-index: 2; margin-top: 1rem; margin-right: 4rem">
                                    <img src="<?= Url::to('@web/img/spinner.gif') ?>" alt="spinner"><i class="material-icons">check_circle</i><span>Simpan Otomatis</span>
                                </div>
                                <input type="hidden" name="id">
                                <div class="row">
                                    <div class="col m6 s12">
                                        <div class="round-title"><span>Jenis Surat</span></div>
                                        <p id="detail-jenis"></p>
                                        <div class="detail-dokumen">
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="round-title"><span>Catatan</span></div>
                                        <p id="detail-catatan"></p>
                                        <div class="detail-permohonan">
                                        </div>
                                        <div class="center">
                                            <button class="btn waves-effect waves-light" type="button" id="action-send" style="margin: 0;">Kirim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="paper-fold from-right" id="paper-detail">
                        <div class="row">
                            <div class="col s12">
                                <p class="left title">Detail Permohonan</p>
                                <a class="btn-floating btn-small waves-effect waves-light paper-folder red right">
                                    <i class="material-icons">close</i>
                                </a>
                            </div>
                        </div>
                        <div class="row paper-content">
                            <div class="container">
                                <input type="hidden" name="id">
                                <div class="row">
                                    <div class="col m6 s12">
                                        <div class="round-title"><span>Jenis Surat</span></div>
                                        <p id="detail-jenis"></p>
                                        <div class="detail-dokumen">
                                        </div>
                                    </div>
                                    <d class="col m6 s12">
                                        <div class="round-title"><span>Status</span></div>
                                        <div id="detail-status" class="center"></div>
                                        <div class="round-title"><span>Catatan</span></div>
                                        <p id="detail-catatan"></p>
                                        <div class="detail-permohonan">
                                        </div>
                                    </d>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<?php $this->beginBlock('script'); ?>
<script src="<?= Url::to('@web/js/pages/pemohon/permohonan.js') ?>"></script>
<?php $this->endBlock(); ?>