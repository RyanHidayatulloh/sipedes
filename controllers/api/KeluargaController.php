<?php

namespace app\controllers\api;

use app\models\Keluarga as Model;
use app\models\Keluarga;
use Yii;
use yii\rest\ActiveController;

class KeluargaController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeIndex(&$data)
    {
        $id = Yii::$app->request->get('id_user');
        $data = $id ? $this->modelClass::with('anggota')->where('id_user', $id)->first() : $this->modelClass::with('anggota')->get();
    }
}