<?php

namespace app\controllers\api;

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
                'data' => $data,
            ]);
        }
        if (Yii::$app->request->isDelete) {
            $data = $this->modelClass::find(Yii::$app->request->getBodyParam('id'));
            $this->beforeDelete($data);
            $data->delete();
            $this->afterDelete($data);
            return $this->asJson([
                'toast' => [
                    'icon' => 'success',
                    'title' => 'Data berhasil dihapus',
                ],
                'data' => $data,
            ]);
        }

        // Get data
        $data = $this->modelClass::all();

        $executor = $this->beforeIndex($data);
        
        if ($executor instanceof Response) {
            return $executor;
        }

        // Cek query field
        $q = Yii::$app->request->get();
        if (!$this->checkQueryField($q)) {
            return $this->asJson([
                'toast' => [
                    'icon' => 'error',
                    'title' => 'Kesalahan query field',
                ]]);
        }

        // get data by query jika ada query yang dikirim
        if (!empty($q)) {
            // gunakan find hanya menggunakan primary key
            if (count(array_keys($q)) == 1 && key_exists((new $this->modelClass())->getKeyName(), $q)) {
                $data = $this->modelClass::find($q[(new $this->modelClass())->getKeyName()]);
            } else {
                // gunakan query
                $data = $this->modelClass::where($q)->first();
            }
        }
        
        if (!empty($data) || empty($q)) {
            return $this->asJson($data);
        }
        return $this->asJson([
            'toast' => [
                'icon' => 'info',
                'title' => 'Data tidak ditemukan',
            ],
        ]);
    }

    public function beforeIndex(&$data)
    {
        return false;
    }
    public function beforeSave(&$data)
    {
    }
    public function afterSave(&$data)
    {
    }
    public function beforeDelete(&$data)
    {
    }
    public function afterDelete(&$data)
    {
    }

    protected function checkQueryField($q): bool
    {
        foreach (array_keys($q) as $key) {
            if (!in_array($key, [(new $this->modelClass())->getKeyName(), ...(new $this->modelClass())->getFillable()])) {
                return false;
            }
        }
        return true;
    }
}
