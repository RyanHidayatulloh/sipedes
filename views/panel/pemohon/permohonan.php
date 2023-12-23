<?php

use app\models\Enums\JenisSurat;
use yii\helpers\Url;

/** @var yii\web\View $this */
?>

<div class="row">
    <div class="col s12">
        <div class="sbs-wrapper">
            <div class="sbs-sub">
                <h4>Ajukan Permohonan Baru</h4>
                <form action="" method="post" id="form-ajuan">
                    <div class="input-field">
                        <select name="jenis">
                            <option value="" disabled selected>Jenis Surat</option>
                            <?php foreach (JenisSurat::forSelect() as $k => $v) : ?>
                            <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Jenis Surat</label>
                    </div>
                    <div class="input-field">
                        <textarea id="keperluan" name="keperluan" class="materialize-textarea" required></textarea>
                        <label for="keperluan">Keperluan</label>
                    </div>
                    <div class="input-field">
                        <textarea id="keterangan" name="keterangan" class="materialize-textarea" required></textarea>
                        <label for="keterangan">Keterangan</label>
                    </div>
                    <button type="submit" class="btn">Ajukan</button>
                </form>
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
                                <th>Jenis Surat</th>
                                <th>Nomor Surat</th>
                                <th>Status</th>
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
                                <th>Jenis Surat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('script'); ?>
<script src="<?= Url::to('@web/js/pages/pemohon/permohonan.js') ?>"></script>
<?php $this->endBlock(); ?>