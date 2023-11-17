<?php
use app\assets\PanelAsset;

/** @var yii\web\View $this */
/** @var string $content */

PanelAsset::register($this);
$this->registerCsrfMetaTags();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEDES</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php $this->head() ?>
    <!-- Compiled and minified CSS -->
    <?php if (isset($this->blocks['style'])): ?>
    <?= $this->blocks['style'] ?>
    <?php endif; ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="outside">
        <?= $this->render('panel-topbar') ?>
        <div class="inside">
            <div class="container">
                <?= $content ?>
            </div>
        </div>
    </div>
    <script>
    let message = <?= json_encode(Yii::$app->session->getAllFlashes()) ?>;
    let page = '<?= $this->title ?? 'dashboard' ?>';
    </script>
    <?php if (isset($this->blocks['script'])): ?>
    <?= $this->blocks['script'] ?>
    <?php endif; ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>