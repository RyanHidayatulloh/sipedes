<?php
use yii\helpers\Url;

/** @var yii\web\View $this */
?>

<div class="row">
    <div class="col s12">
        <div class="sbs-wrapper">
            <div class="sbs-sub">a</div>
            <div class="sbs-main">b</div>
        </div>
    </div>
</div>

<?php $this->beginBlock('script'); ?>
<script src="<?= Url::to('@web/js/pages/permohonan_pemohon.js') ?>"></script>
<?php $this->endBlock(); ?>
