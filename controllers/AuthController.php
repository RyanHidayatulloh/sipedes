<?php
namespace app\controllers;

use app\models\LoginForm;
use app\models\Pengguna;
use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    public $layout = 'auth';
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'OPTION'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
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
        return $this->redirect('/auth/login');
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $user = Pengguna::where('nik', $data['username'])
                ->orWhere('email', $data['username'])
                ->first();
            if ($user) {
                $validator = User::findByUsername($user->nik);
                if ($validator->validatePassword($data['password'])) {
                    Yii::$app->user->login($validator, $data['rememberMe'] ?? false ? 3600 * 24 * 30 : 0);
                    return $this->goBack();
                }
            }
            Yii::$app->session->setFlash('error', 'Username / Password tidak sesuai');
        }
        return $this->render('login', [
            'data' => $data ?? [
                'username' => '',
                'password' => '',
                'rememberMe' => false,
            ],
        ]);
    }
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $data = Yii::$app->request->post();
        if (Yii::$app->request->isPost) {
            $check = Pengguna::where('nik', $data['nik'])->orWhere('email', $data['email'])->first();
            if ($check) {
                Yii::$app->session->setFlash('error', 'Username / Email sudah terdaftar');
            }
            if ($data['password'] != $data['password_confirm']) {
                Yii::$app->session->setFlash('error', 'Password tidak sesuai');
            }
            $user = new Pengguna;
            $user->nik = $data['nik'];
            $user->email = $data['email'];
            $user->password_hash = Yii::$app->security->generatePasswordHash($data['password']);
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->save();
            Yii::$app->user->login(User::findByUsername($user->nik));
            return $this->redirect(Url::to('panel/index'));
        }

        return $this->render('register', [
            'data' => $data ?? [
                'nik' => '',
                'email' => '',
            ]
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}