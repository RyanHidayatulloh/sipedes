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
        $wrap = Yii::$app->request->get('wrap');
        $status = Yii::$app->request->get('status');
        if ($id) {
            $data = $this->modelClass::with('pemohon')->where('id_pemohon', $id);
        } else {
            $data = $this->modelClass::with('pemohon');
        }
        if ($status) {
            $data = strlen($status) == 1 ? $data->where('status', $status) : $data->where('status', explode(' ', $status)[0], explode(' ', $status)[1]);
        }
        $data = $data->get();
        if ($wrap != null) $data = [$wrap => $data];

        return $this->asJson($data);
    }

    public function beforeSave(&$data)
    {
        $id = Yii::$app->request->post('id');
        $post = Yii::$app->request->post();
        if ($id) {
            $data = $this->modelClass::find($id);
        } else {
            $data = new $this->modelClass();
            $data->id_pemohon = Yii::$app->user->id;
        }
        $data->fill($post);
    }
}
