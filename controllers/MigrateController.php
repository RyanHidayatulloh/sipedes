<?php

namespace app\controllers;

use app\libraries\Eloquent;
use app\models\Enums\Agama;
use app\models\Enums\Hubungan;
use app\models\Enums\JenisKelamin;
use app\models\Enums\Kewarganegaraan;
use app\models\Enums\Pekerjaan;
use app\models\Enums\Pendidikan;
use app\models\Keluarga;
use app\models\Pengguna;
use app\models\User;
use app\models\Wilayah;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('nid')->unique()->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('auth_key');
            $table->string('password_hash')->nullable(false);
            $table->string('password_reset_token')->nullable();
            $table->string('name');
            $table->longText('picture')->nullable()->default('avatar.jpg');
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

        Yii::$app->eloquent->schema()->create('keluarga', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_user')->nullable(false);
            $table->unsignedInteger('id_kepala_keluarga')->nullable(true);
            $table->longText('alamat')->nullable(true);
            $table->string('rt')->nullable(true);
            $table->string('rw')->nullable(true);
            $table->string('desa')->nullable(true);
            $table->string('kecamatan')->nullable(true);
            $table->string('kota')->nullable(true);
            $table->string('provinsi')->nullable(true);
            $table->string('kodepos')->nullable(true);
            $table->longText('kk')->nullable(true);
            $table->timestamps();
        });

        Yii::$app->eloquent->schema()->create('keluarga_anggota', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_keluarga')->nullable(true);
            $table->string('nama')->nullable(false);
            $table->string('nik')->unique()->nullable(false);
            $table->enum('jenis_kelamin', JenisKelamin::forSelect())->nullable(false);
            $table->string('tempat_lahir')->nullable(false);
            $table->date('tgl_lahir')->nullable(false);
            $table->enum('pendidikan', Pendidikan::forSelect())->nullable(false);
            $table->enum('pekerjaan', Pekerjaan::forSelect())->nullable(false);
            $table->enum('hubungan', Hubungan::forSelect())->nullable(false);
            $table->boolean('kawin')->nullable(false);
            $table->enum('kewarganegaraan', Kewarganegaraan::forSelect())->nullable(false);
            $table->enum('agama', Agama::forSelect())->nullable(false);
            $table->longText('alamat')->nullable(true);
            $table->string('rt')->nullable(false);
            $table->string('rw')->nullable(false);
            $table->string('desa')->nullable(false);
            $table->string('kecamatan')->nullable(false);
            $table->string('kota')->nullable(false);
            $table->string('provinsi')->nullable(false);
            $table->string('kodepos')->nullable(true);
            $table->string('no_hp')->nullable(true);
            $table->string('email')->nullable(true);
            $table->longText('foto')->default('avatar.jpg');
            $table->longText('ktp')->nullable(false);
            $table->timestamps();
        });

        Yii::$app->eloquent->schema()->create('wilayah', function (Blueprint $table) {
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();
        });

        Pengguna::truncate();
        Pengguna::create([
            'nid' => '654321',
            'email' => 'admin@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'name' => 'Admin',
            'status' => User::STATUS_ACTIVE,
        ]);
        Pengguna::create([
            'nid' => '123456',
            'email' => 'staf@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'name' => 'Staf',
            'status' => User::STATUS_ACTIVE,
        ]);
        Pengguna::create([
            'nid' => '7890',
            'email' => 'kades@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'name' => 'Kades',
            'status' => User::STATUS_ACTIVE,
        ]);
        Pengguna::create([
            'nid' => '0987',
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

        Keluarga::create([
            'id_user' => 4,
        ]);

        foreach (array_chunk(json_decode(file_get_contents(Yii::$app->basePath . '/wilayah.json'), true), 1000) as $t) {
            Wilayah::upsert($t, ['kode'], ['nama']);
        }

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