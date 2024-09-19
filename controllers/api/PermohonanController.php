<?php

namespace app\controllers\api;

use app\models\Enums\JenisSurat;
use app\models\Permohonan as Model;
use app\models\Permohonan;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class PermohonanController extends BaseRestApi
{
    public $modelClass = Model::class;
    
    public $bulan = [
        "01" => "I",
        "02" => "II",
        "03" => "III",
        "04" => "IV",
        "05" => "V",
        "06" => "VI",
        "07" => "VII",
        "08" => "VIII",
        "09" => "IX",
        "10" => "X",
        "11" => "XI",
        "12" => "XII",
    ];

    public function beforeIndex(&$data)
    {
        $id = Yii::$app->request->get('id_user');
        $wrap = Yii::$app->request->get('wrap');
        $status = Yii::$app->request->get('status');
        if ($id) {
            $data = $this->modelClass::with('pemohon.biodata')->where('id_pemohon', $id);
        } else {
            $data = $this->modelClass::with('pemohon.biodata');
        }
        if ($status) {
            $data = strlen($status) == 1 ? $data->where('status', $status) : $data->where('status', explode(' ', $status)[0], explode(' ', $status)[1]);
        }
        $data = $data->get();
        if ($wrap != null) {
            $data = [$wrap => $data];
        }

        return $this->asJson($data);
    }

    public function beforeSave(&$data)
    {
        $id = Yii::$app->request->post('id');
        $post = Yii::$app->request->post();
        if ($id) {
            $data = $this->modelClass::find($id);
        } else {
            $data = new $this->modelClass();
            $data->id_pemohon = Yii::$app->user->id;
        }
        $data->fill($post);
        $length = count(Permohonan::where("status", ">=", 5)->get()) + 1;
        $data->nomor = JenisSurat::toKodeSurat($data->jenis) . "/" . $length . "/" . $this->bulan[date('m')] . "/" . date("Y");
    }
    public function afterSave(&$data)
    {
        $file = UploadedFile::getInstanceByName('file');
        if ($file) {
            $ext = $file->getExtension();
            $filename = $data->id . '.' . $ext;
            $file->saveAs("uploads/permohonan/$filename");
            $data->fill([
                "file" => $filename,
            ])->save();
        }
    }
}
