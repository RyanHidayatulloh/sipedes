<?php

namespace app\controllers\api;

use app\models\Penduduk as Model;
use Yii;

// use yii\web\UploadedFile;

class PendudukController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeIndex(&$data)
    {
        $id = Yii::$app->request->get('id_user');
        if ($id == true) {
            $data = $this->modelClass::where('id_user', Yii::$app->user->getId())->first();
            if (empty($data)) {
                return $this->asJson([
                    'toast' => [
                        'icon' => 'error',
                        'title' => 'Anda tidak login sebagai penduduk',
                    ],
                ])->setStatusCode(401, 'Anda tidak login sebagai penduduk');
            }
        }
    }
}
