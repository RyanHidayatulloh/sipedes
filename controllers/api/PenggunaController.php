<?php

namespace app\controllers\api;

use app\models\Pengguna as Model;
use Yii;
use yii\web\UploadedFile;

// use yii\web\UploadedFile;

class PenggunaController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeIndex(&$data)
    {
        $id = Yii::$app->user->getId();
        $role = key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId()));

        if ($role == 'pemohon') {
            $data = $this->modelClass::with('biodata')->find($id);
        } else {
            $data = $this->modelClass::find($id);
        }

        return $this->asJson($data);
    }

    public function beforeSave(&$data)
    {
        $post = Yii::$app->request->post();
        $data = $this->modelClass::with('biodata')->find($post['id']);
        $data->biodata->fill($post)->save();
        if (isset($post['nama'])) {
            $data->name = $post['nama'];
        }
        if (isset($post['password'])) {
            $data->password_hash = Yii::$app->security->generatePasswordHash($post['password']);
        }
        $files = [
            "avatar" => UploadedFile::getInstanceByName('avatar'),
            "ktp" => UploadedFile::getInstanceByName('ktp'),
            "kk" => UploadedFile::getInstanceByName('kk'),
        ];
        foreach ($files as $k => $f) {
            if ($f) {
                $ext = $f->getExtension();
                $filename = $post['id'] . '.' . $ext;
                switch ($k) {
                    case 'avatar':
                        $f->saveAs("uploads/foto/$filename");
                        $data->fill([
                            "picture" => $filename,
                        ])->save();
                        break;
                    default:
                        $save = $f->saveAs("uploads/$k/$filename");
                        $data->biodata->fill([
                            $k => $filename,
                        ])->save();
                        break;
                }
            }
        }
    }
}