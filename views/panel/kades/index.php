<?php

use yii\helpers\Url;
?>
<div class="pemohon dashboard">
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except">
            <p>Surat Teragendakan</p>
            <p><b class="count-berjalan">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except">
            <p>Surat Tertandatangani</p>
            <p><b class="count-reject">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except">
            <p>Surat Tercetak</p>
            <p><b class="count-accept">0</b></p>
        </div>
    </div>
</div>


<?php $this->beginBlock('script'); ?>
<script src="<?= Url::to('@web/js/pages/dashboard/kades.js') ?>"></script>
<?php $this->endBlock(); ?>