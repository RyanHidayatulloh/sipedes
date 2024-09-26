<?php

namespace app\controllers\api;

use app\models\Enums\JenisSurat;
use app\models\Enums\StatusSurat;
use app\models\Pengguna;
use app\models\Permohonan;
use app\models\Permohonan as Model;
use Pusher\Pusher;
use Yii;
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
        if (key(Yii::$app->authManager->getAssignments(Yii::$app->user->getId())) == 'rt') {
            $pengguna = Pengguna::find(Yii::$app->user->getId());
            $rt = (int) explode("-", explode(' ', $pengguna->rtrw)[0])[1];
            $rw = (int) explode("-", explode(' ', $pengguna->rtrw)[1])[1];
            $data = $data->whereHas('pemohon.biodata', function ($query) use ($rt, $rw) {
                $query->where('rt', $rt);
                $query->where('rw', $rw);
            });
            // $data = $data->has('pemohon.biodata');
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
        if ($status = Yii::$app->request->post('status')) {
            if ($status == 5) {
                $length = count(Permohonan::where("status", ">=", 5)->get()) + 1;
                $data->nomor = JenisSurat::toKodeSurat($data->jenis) . "/" . $length . "/" . $this->bulan[date('m')] . "/" . date("Y");
            }
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true,
            );
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $pushData['message'] = "Permohonan dengan ID " . $data->id . " milik " . $data->pemohon->biodata->nama  ." telah diubah status menjadi " . StatusSurat::from($status)->label();
            $pushData['id'] = $data->id;
            $pushData['status'] = (int) $status;
            $pusher->trigger('permohonan', 'status', $pushData);
        }
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