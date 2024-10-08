<?php

namespace app\controllers\api;

use app\models\Penduduk;
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
            $data = $this->modelClass::with('biodata', 'assignments')->find($id);
        } else {
            $data = $this->modelClass::with('assignments')->find($id);
        }

        return $this->asJson($data);
    }

    public function actionAll()
    {
        $data = $this->modelClass::with('biodata', 'assignments')->get();
        $wrap = Yii::$app->request->get('wrap');
        if ($wrap != null) {
            $data = [$wrap => $data];
        }
        return $this->asJson($data);
    }
    public function actionRegister()
    {
        $post = Yii::$app->request->post();
        if (!isset($post["role"])) {
            return $this->asJson([
                'toast' => [
                    'icon' => 'error',
                    'title' => 'Role tidak boleh kosong',
                ],
            ]);
        }

        if ($this->modelClass::where('email', $post["email"])->exists() || $this->modelClass::where('nid', $post["nid"])->exists()) {
            return $this->asJson([
                'toast' => [
                    'icon' => 'error',
                    'title' => 'Email atau NID/NIK sudah terdaftar',
                ],
            ]);
        }

        $data = new $this->modelClass();
        $data->password_hash = Yii::$app->security->generatePasswordHash($post['password']);
        $data->fill($post)->save();

        $auth = Yii::$app->authManager;
        $roleass = $auth->createRole($post["role"]);
        $auth->add($roleass);
        $auth->assign($roleass, $data->id);

        if ($post["role"] == "pemohon") {
            $biodata = new Penduduk();
            $biodata->fill([
                "id_user" => $data->id,
                "nama" => $data->name,
                "nik" => $data->nid,
            ])->save();
        }

        $picture = UploadedFile::getInstanceByName('picture');
        if ($picture) {
            $ext = $picture->getExtension();
            $filename = $data->id . '.' . $ext;
            $picture->saveAs("uploads/foto/$filename");
            $data->fill([
                "picture" => $filename,
            ])->save();
        }

        return $this->asJson($data);
    }

    public function beforeSave(&$data)
    {
        $post = Yii::$app->request->post();
        $data = $this->modelClass::with('biodata')->find($post['id']);
        if (isset($post['password'])) {
            $data->password_hash = Yii::$app->security->generatePasswordHash($post['password']);
        }
        if ($data->assignments[0]->item_name === 'pemohon') {
            $data->biodata->fill($post)->save();
            if (isset($post['nama'])) {
                $data->name = $post['nama'];
            }
            if (isset($post['nik'])) {
                $data->nid = $post['nik'];
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
        } else {
            $picture = UploadedFile::getInstanceByName('avatar');
            if ($picture) {
                $ext = $picture->getExtension();
                $filename = $post['id'] . '.' . $ext;
                $picture->saveAs("uploads/foto/$filename");
                $data->fill([
                    "picture" => $filename,
                ])->save();
            }
            $data->fill($post);
        }
    }
}
