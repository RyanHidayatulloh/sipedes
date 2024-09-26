<?php

use app\assets\PanelAsset;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var string $content */

PanelAsset::register($this);
$this->registerCsrfMetaTags();
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEDES</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php $this->head()?>
    <!-- Compiled and minified CSS -->
    <?php if (isset($this->blocks['style'])): ?>
    <?=$this->blocks['style']?>
    <?php endif;?>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <?php if (!Yii::$app->user->isGuest): ?>
    <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('<?=env('PUSHER_APP_KEY')?>', {
        cluster: 'ap1'
    });
    </script>
    <?php endif;?>
</head>

<body>
    <?php $this->beginBody()?>
    <div class="outside">
        <?=$this->render('panel-topbar')?>
        <div class="inside">
            <div
                class="container <?=key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId()))?> <?=$this->title ?? 'dashboard'?>">
                <?=$content?>
            </div>
        </div>
    </div>
    <script>
    const baseUrl = '<?=Url::base('http')?>';
    let message = <?=json_encode(Yii::$app->session->getAllFlashes())?>;
    let page = '<?=$this->title ?? 'dashboard'?>';

    function notifyMe(data = {}) {
        if (!("Notification" in window)) {
            // Check if the browser supports notifications
            alert("This browser does not support desktop notification");
        } else if (Notification.permission === "granted") {
            // Check whether notification permissions have already been granted;
            // if so, create a notification
            const notification = new Notification(data?.title ?? 'Notifikasi SIPEDES', {
                body: data?.message ?? '',
                icon: data?.icon ?? '',
            });
            notification.onclick = function() {
                window.open(data.status == 6 ? baseUrl + "/panel/cetak" : baseUrl + "/panel/permohonan");
            }
            // …
        } else if (Notification.permission !== "denied") {
            // We need to ask the user for permission
            Notification.requestPermission().then((permission) => {
                // If the user accepts, let's create a notification
                if (permission === "granted") {
                    const notification = new Notification(data?.title ?? 'Notifikasi SIPEDES', {
                        body: data?.message ?? '',
                        icon: data?.icon ?? '',
                    });
                    notification.onclick = function() {
                        window.open(data.status == 6 ? baseUrl + "/panel/cetak" : baseUrl +
                            "/panel/permohonan");
                    }
                }
            });
        }
    }
    </script>
    <?php $this->endBody()?>
    <?php if (!Yii::$app->user->isGuest): ?>
    <script>
    const channel = pusher.subscribe('permohonan');
    $(document).ready(function() {
        cloud.add(origin + "/api/pengguna", {
            name: "me",
        }).then(me => {
            console.log(me);
            channel.bind('status', (pusherData) => {
                let isNotify = false;
                switch (me.assignments[0].item_name) {
                    case 'kades':
                        if (pusherData.status == 5) isNotify = true;
                        break;
                    case 'admin':
                        isNotify = true;
                        break;
                    case 'staff':
                        if (pusherData.status == 3) isNotify = true;
                        if (pusherData.status == 6) isNotify = true;
                        break;
                    case 'rt':
                        if (pusherData.status == 1) isNotify = true;
                        break;
                    case 'pemohon':
                        if (pusherData.status == 2) isNotify = true;
                        if (pusherData.status == 4) isNotify = true;
                        if (pusherData.status == 7) isNotify = true;
                        break;
                }
                if (isNotify) notifyMe(pusherData);
            });
        });
    });
    </script>
    <?php endif;?>
    <?php if (isset($this->blocks['script'])): ?>
    <?=$this->blocks['script']?>
    <?php endif;?>
</body>

</html>
<?php $this->endPage()?>