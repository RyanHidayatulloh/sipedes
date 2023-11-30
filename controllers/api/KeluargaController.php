<?php

namespace app\controllers\api;

use app\models\Keluarga as Model;
use Yii;
use yii\web\UploadedFile;

class KeluargaController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeIndex(&$data)
    {
        $id = Yii::$app->request->get('id_user');
        $data = $id ? $this->modelClass::with('anggota', 'kepala')->where('id_user', $id)->first() : $this->modelClass::with('anggota', 'kepala')->get();
    }

    public function beforeSave(&$data)
    {
        $post = Yii::$app->request->post();
        if ($id = $post['id'] ?? $post['id_user']) {
            unset($post['id'], $post['id_user']);
            $data = $this->modelClass::where(['id' => $id])->orWhere(['id_user' => $id])->first();
            if ($post)
                $data->fill($post);
        } else {
            $data->id_keluarga = $data->id_keluarga ?? $this->modelClass::where(['id_user' => Yii::$app->user->getId()])->first()->id;
        }
    }

    public function afterSave(&$data)
    {
        $kk = UploadedFile::getInstanceByName('kk');
        if ($kk) {
            $kk->saveAs(Yii::$app->basePath . "/web/uploads/kk/" . Yii::$app->user->identity->nid . '.' . $kk->extension);
            $data->kk = Yii::$app->user->identity->nid . '.' . $kk->extension;
        }

        $data->save();
    }
}