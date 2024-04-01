<?php

use yii\helpers\Url;
?>
<div class="row center">
    <div class="card">
        <div class="icon"><i class="material-icons">email</i></div>
        <h1 class="count-berjalan">0</h1>
        <h5>Permohonan Surat</h5>
        <a href="<?=Url::to(['panel/permohonan'])?>" class="waves-effect waves-light btn">Buat</a>
    </div>
</div>
<div class="row" style="margin-bottom: 0;">
    <div class="card except">
        <p>Jumlah Permohonan Selesai</p>
        <p><b class="count-selesai">0</b></p>
    </div>
</div>


<?php $this->beginBlock('script'); ?>
<script src="<?= Url::to('@web/js/pages/pemohon/index.js') ?>"></script>
<?php $this->endBlock(); ?>