<?php

namespace app\controllers\api;

use app\models\Pengguna as Model;
use Yii;
use yii\web\UploadedFile;

class UserController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeSave(&$data)
    {
        $post = Yii::$app->request->post();
        $data = $this->modelClass::find($post['id'] ?? Yii::$app->user->id);
        $data->fill($post);
    }

    public function afterSave(&$data)
    {
        $picture = UploadedFile::getInstanceByName('picture');
        if ($picture) {
            $picture->saveAs(Yii::$app->basePath . "/web/img/profil/" . Yii::$app->user->id . '.' . $picture->extension);
            $data->picture = Yii::$app->user->id . '.' . $picture->extension;
        }

        $data->save();
    }
}