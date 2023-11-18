<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PanelController extends Controller
{
    public $layout = 'panel';
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
    public function actionIndex()
    {
        $this->view->title = 'dashboard';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/index');
    }
    public function actionPermohonan()
    {
        $this->view->title = 'permohonan';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/permohonan');
    }
    public function actionPemohon()
    {
        $this->view->title = 'pemohon';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/pemohon');
    }
    public function actionLaporan()
    {
        $this->view->title = 'laporan';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/laporan');
    }

    public function actionAnggota()
    {
        $this->view->title = 'anggota';
        return $this->render('pemohon/anggota');
    }

    public function actionProfil()
    {
        $this->view->title = 'profil';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/profil');
    }
}
