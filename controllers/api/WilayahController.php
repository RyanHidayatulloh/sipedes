<?php

namespace app\controllers\api;

use app\models\Wilayah as Model;
use Illuminate\Database\Eloquent\Collection;
use Yii;

class WilayahController extends BaseRestApi
{
    public $modelClass = Model::class;

    public function beforeIndex(&$data)
    {
        $q = Yii::$app->request->get('q');
        if ($q == "all") {
            $data = json_decode(file_get_contents(Yii::$app->basePath . '/wilayah.json'), true);
        } else {
            $data = $this->modelClass::all()->filter(function (Model $wilayah) use ($q) {
                if ($q == null) {
                    return strlen($wilayah->kode) == 2;
                }
                return strlen($q) == 8 ? str_contains($wilayah->kode, "$q.") : str_contains($wilayah->kode, "$q.") && (strlen($wilayah->kode) == (strlen($q) + 3));
            })->values()->all();
        }
        return $this->asJson($data);
    }
}