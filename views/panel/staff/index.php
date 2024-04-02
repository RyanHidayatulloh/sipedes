<?php

use yii\helpers\Url;
?>
<div class="pemohon dashboard">
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Permohonan Berjalan</p>
            <p><b class="count-berjalan">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Permohonan Ditolak</p>
            <p><b class="count-reject">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Permohonan Disetujui</p>
            <p><b class="count-accept">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Permohonan Siap Dicetak</p>
            <p><b class="count-ttd">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Permohonan Tercetak</p>
            <p><b class="count-print">0</b></p>
        </div>
    </div>
</div>


<?php $this->beginBlock('script'); ?>
<script src="<?= Url::to('@web/js/pages/dashboard/staf.js') ?>"></script>
<?php $this->endBlock(); ?>