<?php

namespace app\controllers\api;

use app\models\Keluarga as Model;
use Yii;
use yii\rest\ActiveController;

class KeluargaController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeIndex($data)
    {
        return $data->load('anggota');
    }
}
