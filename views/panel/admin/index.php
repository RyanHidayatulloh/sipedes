<?php

use yii\helpers\Url;
?>
<div class="pemohon dashboard">
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Menunggu Konfirmasi RT</p>
            <p><b class="count-1">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Menunggu Aksi RT</p>
            <p><b class="count-2">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Konfirmasi RT</p>
            <p><b class="count-3">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Menunggu Aksi Staff</p>
            <p><b class="count-4">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Diagendakan</p>
            <p><b class="count-5">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Ditandatangani</p>
            <p><b class="count-6">0</b></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0; gap: 0;">
        <div class="card except" style="margin: 0;">
            <p>Dicetak</p>
            <p><b class="count-7">0</b></p>
        </div>
    </div>
</div>


<?php $this->beginBlock('script');?>
<script src="<?=Url::to('@web/js/pages/dashboard/admin.js')?>"></script>
<?php $this->endBlock();?>