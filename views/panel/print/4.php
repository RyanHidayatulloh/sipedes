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
    <style>
    table th {
        vertical-align: top;
    }

    table td {
        vertical-align: top;
    }
    </style>
</head>

<body>
    <div class="kertas">
        <img src="<?=Url::to('@web/img/kop.png')?>" alt="kop" class="kop">
        <p>Kode Desa : 29052003</p>
        <br>
        <p style="text-align: center;"><b><u>SURAT PENGANTAR CATATAN KEPOLISIAN</u></b></p>
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
                    <td>Agama</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->agama?></td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->status_perkawinan?></td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>No. KTP/NIK</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->nik?></td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->pekerjaan?></td>
                </tr>
                <tr>
                    <td>9.</td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?=$surat->pemohon->biodata->desa?>, RT.<?=$surat->pemohon->biodata->rt?> /
                        RW.<?=$surat->pemohon->biodata->rw?></td>
                </tr>
            </table>
            <p style="text-indent: 24pt;">Berdasarkan Surat Keterangan dari Ketua Rukun Warga 002 Nomor 013 Tanggal 21
                Februari 2024 dan menurut pengakuan dari yang bersangkutan sampai saat ini belum pernah tersangkut
                yustisi/urusan kepolisian.</p>
            <p style="text-indent: 24pt;">Surat keterangan ini diperlukan untuk <?=$surat->keperluan?></p>
            <p style="text-indent: 24pt;">Demikian Surat Keterangan ini kami buat atas permintaan yang bersangkutan dan
                dapat dipergunakan sebagaimana mestinya</p>
        </div>
        <div style="display: flex; justify-content: space-between; text-align: center; margin-top: 48pt">
            <div
                style="display: flex; justify-content: flex-end; text-align: center; flex-direction: column; align-items: end;">
                <div>
                    <p><br>Pemohon</p>
                    <p style="margin-top: 48pt;"><?=$surat->pemohon->biodata->nama?></p>
                </div>
            </div>
            <div
                style="display: flex; justify-content: flex-end; text-align: center; flex-direction: column; align-items: end;">
                <div>
                    <p>Mengetahui,<br>Camat Sirampog</p>
                    <p style="margin-top: 48pt;">( ________________ )</p>
                </div>
            </div>
            <div
                style="display: flex; justify-content: flex-end; text-align: center; flex-direction: column; align-items: end;">
                <div>
                    <p>Buniwah, <?=Carbon::parse($surat->tgl_ttd)->format('d F Y')?></p>
                    <p><br> Kepala Desa Buniwah</p>
                    <p style="margin-top: 48pt;"><?=$kades->name?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>