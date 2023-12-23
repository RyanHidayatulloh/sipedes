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
        if ($id) {
            $data = $this->modelClass::where('id_user', $id == true ? Yii::$app->user->getId() : $id)->first();
        } else {
            $data = $this->modelClass::get();
        }
    }
}