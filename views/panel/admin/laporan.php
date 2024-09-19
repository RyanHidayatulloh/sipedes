<?php

use yii\helpers\Url;
?>
<div class="row">
    <div class="col s12">
        <div class="card book">
            <div class="paper-wrap">
                <div class="paper-main">
                    <div class="scaffold">
                        <div class="content">
                            <div class="row">
                                <div class="col m6 s12 offset-m3">
                                    <form action="" method="POST">
                                        <div class="input-field col s6">
                                            <input type="text" class="datepicker" name="tgl_awal"
                                                placeholder="Tanggal Awal">
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="text" class="datepicker" name="tgl_akhir"
                                                placeholder="Tanggal Akhir">
                                        </div>
                                        <div class="switch center">
                                            <label>
                                                <input type="checkbox" name="aksi">
                                                <span class="lever"></span>
                                                Tampilkan Semua
                                            </label>
                                        </div>
                                        <div class="center btn-laporan">
                                            <button class="btn waves-effect waves-light green"
                                                type="button">Terapkan</button>
                                            <a class="btn waves-effect waves-light blue" role="button" href="#!"><i
                                                    class="material-icons">print</i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <table class="striped highlight responsive-table" id="laporan"
                                        style="width: 100%;border: 1px solid;">
                                        <thead>
                                            <tr>
                                                <th style="border: 1px solid;">No</th>
                                                <th style="border: 1px solid;">Tanggal TTD</th>
                                                <th style="border: 1px solid;">NIK</th>
                                                <th style="border: 1px solid;">Nama</th>
                                                <th style="border: 1px solid;">Jenis Surat</th>
                                                <th style="width: 30%;border: 1px solid;">Keperluan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <tr>
                                                <td colspan="6" class="center" style="border: 1px solid;">Tidak ada data</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('script');?>
<script src="<?=Url::to('@web/js/pages/kades/laporan.js')?>"></script>
<?php $this->endBlock();?>