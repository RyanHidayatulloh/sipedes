<?php

namespace app\controllers\api;

use app\models\Pengguna as Model;
use Yii;
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
        $data = $this->modelClass::find($post['id']);
        $data->password_hash = Yii::$app->security->generatePasswordHash($post['password']);
    }
}
