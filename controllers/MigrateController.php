<?php

namespace app\controllers;

use app\libraries\Eloquent;
use app\models\Pengguna;
use app\models\User;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rbac\DbManager;
use yii\rbac\ManagerInterface;
use yii\web\Controller;

class MigrateController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        foreach (Manager::select('SHOW TABLES') as $table) {
            $table_array = get_object_vars($table);
            Yii::$app->eloquent->schema()->drop($table_array[key($table_array)]);
        }

        Yii::$app->eloquent->schema()->create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik')->unique()->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('auth_key');
            $table->string('password_hash')->nullable(false);
            $table->string('password_reset_token')->nullable();
            $table->string('name');
            $table->longText('picture')->nullable();
            $table->unsignedInteger('status')->nullable(false)->default(10);
            $table->string('verification_token')->nullable();
            $table->timestamps();
        });

        Yii::$app->eloquent->schema()->create('auth_assignment', function (Blueprint $table) {
            $table->string('item_name');
            $table->integer('user_id');
            $table->integer('created_at');
        });

        Yii::$app->eloquent->schema()->create('auth_item', function (Blueprint $table) {
            $table->string('name');
            $table->integer('type')->nullable(false);
            $table->text('description')->nullable();
            $table->text('rule_name')->nullable();
            $table->text('data')->nullable();
            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
        });

        Yii::$app->eloquent->schema()->create('auth_item_child', function (Blueprint $table) {
            $table->string('parent');
            $table->string('child');
        });

        Yii::$app->eloquent->schema()->create('auth_rule', function (Blueprint $table) {
            $table->string('name');
            $table->text('data')->nullable();
            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
        });

        Pengguna::truncate();
        Pengguna::create([
            'nik' => '123456',
            'email' => 'admin@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'name' => 'Admin',
            'status' => User::STATUS_ACTIVE,
        ]);
        Pengguna::create([
            'nik' => '654321',
            'email' => 'staf@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'name' => 'Staf',
            'status' => User::STATUS_ACTIVE,
        ]);
        Pengguna::create([
            'nik' => '7890',
            'email' => 'kades@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'name' => 'Kades',
            'status' => User::STATUS_ACTIVE,
        ]);
        Pengguna::create([
            'nik' => '0987',
            'email' => 'pemohon@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'name' => 'pemohon',
            'status' => User::STATUS_ACTIVE,
        ]);

        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $staff = $auth->createRole('staff');
        $auth->add($staff);
        $kades = $auth->createRole('kades');
        $auth->add($kades);
        $pemohon = $auth->createRole('pemohon');
        $auth->add($pemohon);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
        $auth->assign($staff, 2);
        $auth->assign($kades, 3);
        $auth->assign($pemohon, 4);


        return 'Migrasi telah berhasil, <a href="' . Yii::$app->homeUrl . '">Kembali</a>';
    }

    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof ManagerInterface) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }
}