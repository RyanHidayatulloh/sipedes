<?php

namespace app\controllers\api;

use Illuminate\Database\Eloquent\Model;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class BaseRestApi extends ActiveController
{
    public $modelClass;
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $action;
    }

    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $data = new $this->modelClass(Yii::$app->request->post());
            $this->beforeSave($data);
            $data->save();
            $this->afterSave($data);
            return $this->asJson([
                'toast' => [
                    'icon' => 'success',
                    'title' => 'Data berhasil disimpan',
                ],
                'data' => $data
            ]);
        }
        $this->beforeIndex($data);
        return $this->asJson($data);
    }

    public function beforeIndex(&$data)
    {
        $data = $this->modelClass::all();
    }
    public function beforeSave(&$data)
    {
    }
    public function afterSave(&$data)
    {
    }
}