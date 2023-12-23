<?php

namespace app\controllers\api;

use app\models\Permohonan as Model;
use Yii;

class PermohonanController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeIndex(&$data)
    {
        $id = Yii::$app->request->get('id_user');
        if ($id) {
            $data = $this->modelClass::with('pemohon', 'anggota')->where('id_pemohon', $id == true ? Yii::$app->user->getId() : $id)->first();
        } else {
            $data = $this->modelClass::with('pemohon', 'anggota')->get();
        }
    }
}