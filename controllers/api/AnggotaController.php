<?php

namespace app\controllers\api;

use app\models\Keluarga;
use app\models\KeluargaAnggota as Model;
use Yii;
use yii\web\UploadedFile;

class AnggotaController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeIndex(&$data)
    {
        $id = Yii::$app->request->get("id");
        $data = $id ? $this->modelClass::find($id) : $this->modelClass::all();
    }

    public function beforeSave(&$data)
    {
        if ($id = Yii::$app->request->post('id')) {
            $data = $this->modelClass::find($id);
            $data->fill(Yii::$app->request->post());
        } else {
            $data->id_keluarga = $data->id_keluarga ?? Keluarga::where(['id_user' => Yii::$app->user->getId()])->first()->id;
        }
    }

    public function afterSave(&$data)
    {
        $foto = UploadedFile::getInstanceByName('foto');
        if ($foto) {
            $foto->saveAs(Yii::$app->basePath . "/web/uploads/foto/anggota/" . $data->nik . '.' . $foto->extension);
            $data->foto = $data->nik . '.' . $foto->extension;
        }

        $ktp = UploadedFile::getInstanceByName('ktp');
        if ($ktp) {
            $ktp->saveAs(Yii::$app->basePath . "/web/uploads/ktp/anggota/" . $data->nik . '.' . $ktp->extension);
            $data->ktp = $data->nik . '.' . $ktp->extension;
        }

        $data->save();
    }
}
