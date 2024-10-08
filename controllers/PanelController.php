<?php

namespace app\controllers;

use app\models\Enums\JenisKelamin;
use app\models\Enums\JenisSurat;
use app\models\Penduduk;
use app\models\Pengguna;
use app\models\Permohonan;
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
        // Pengguna::all()->each(function ($pengguna) {
        //     Penduduk::where(['nik' => $pengguna->nid])->update(['id_user' => $pengguna->id]);
        // });
        $this->view->title = 'dashboard';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/index');
    }
    public function actionPermohonan()
    {
        $this->view->title = 'permohonan';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/permohonan');
    }
    public function actionCetak()
    {
        $this->view->title = 'cetak';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/cetak');
    }
    public function actionPengguna()
    {
        $this->view->title = 'pengguna';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/pengguna');
    }
    public function actionLaporan()
    {
        $this->view->title = 'laporan';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/laporan');
    }

    public function actionProfil()
    {
        $this->view->title = 'profil';
        return $this->render(key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) . '/profil', [
            'user' => Yii::$app->user->identity,
        ]);
    }

    public function actionPrint()
    {
        $id = Yii::$app->request->get('id');
        if (!$id) {
            return null;
        }
        $kades = Pengguna::whereRelation('assignments', 'item_name', "kades")->get()[0];
        $permohonan = Permohonan::with("pemohon")->find($id);
        $this->view->title = $permohonan->pemohon->biodata->nama;
        return $this->renderPartial("print/$permohonan->jenis", [
            'surat' => $permohonan,
            'kades' => $kades,
        ]);
    }
}
