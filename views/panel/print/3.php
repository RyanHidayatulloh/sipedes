<?php
use Illuminate\Support\Carbon;
use yii\helpers\Url;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=Url::to('@web/css/print.css')?>">
</head>

<body>
    <div class="kertas">
        <img src="<?=Url::to('@web/img/kop.png')?>" alt="kop" class="kop">
        <p>Kode Desa : 29052003</p>
        <br>
        <p style="text-align: center;"><b><u>SURAT KETERANGAN USAHA</u></b></p>
        <p style="text-align: center;">NOMOR : <?=$surat->nomor?></p>
        <div
            style="text-align: justify; display: flex; flex-direction: column; gap: 16pt; margin-top: 24pt; padding: 0 24pt">
            <p style="text-indent: 24pt;">Yang bertanda tangan di bawah ini kami Kepala Desa Buniwah Kecamatan Sirampog
                Kabupaten Brebes Provinsi
                Jawa Tengah, menerangkan bahwa :</p>
            <table style="padding: 0 32pt">
                <tr>
                    <td>1.</td>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->nama?></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->jenis_kelamin?></td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->tempat_lahir?>,
                        <?=Carbon::parse($surat->pemohon->biodata->tgl_lahir)->locale('id')->format('d F Y')?></td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->kewarganegaraan?></td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>No. KTP/NIK</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->nik?></td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->pekerjaan?></td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->desa?>, RT.<?=$surat->pemohon->biodata->rt?> /
                        RW.<?=$surat->pemohon->biodata->rw?></td>
                </tr>
            </table>
            <p style="text-indent: 24pt;">Berdasarkan Surat Keterangan dari Ketua Rukun Tetangga Nomor 019 Tanggal 21
                Februari 2024. bahwa yang
                bersangkutan betul warga Desa Buniwah dan menurut pengakuan yang bersangkutan mempunyai usaha
                <?=$surat->keterangan?></p>
            <p style="text-indent: 24pt;">Surat keterangan ini diperlukan untuk <?=$surat->keperluan?></p>
            <p style="text-indent: 24pt;">Demikian Surat Keterangan ini kami buat atas permintaan yang bersangkutan dan
                dapat dipergunakan
                sebagaimana mestinya</p>
        </div>
        <div
            style="display: flex; justify-content: flex-end; margin-top: 24pt; text-align: center; flex-direction: column; align-items: end; margin-top: 48pt">
            <div>

                <p>Buniwah, <?=Carbon::parse($surat->tgl_ttd)->format('d F Y')?></p>
                <p>Kepala Desa Buniwah</p>
                <p style="margin-top: 48pt;"><?=$kades->name?></p>
            </div>
        </div>
    </div>
</body>

</html>