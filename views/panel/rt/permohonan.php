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
                                <div class="col s12">
                                    <ul class="tabs tabs-fixed-width">
                                        <li class="tab col s3"><a href="#ongoing">Permohonan Berjalan</a></li>
                                        <li class="tab col s3"><a href="#accept">Permohonan Disetujui</a></li>
                                        <li class="tab col s3"><a href="#reject">Permohonan Ditolak</a></li>
                                    </ul>
                                </div>
                                <div class="content" style="padding: 1rem;">
                                    <div id="ongoing" class="col s12">
                                        <table class="striped highlight">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jenis Surat</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="accept" class="col s12">
                                        <table class="striped highlight">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jenis Surat</th>
                                                    <th>Nama</th>
                                                    <th>Catatan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="reject" class="col s12">
                                        <table class="striped highlight">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jenis Surat</th>
                                                    <th>Nama</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="paper-fold from-right" id="paper-action">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Tindak Lanjut Permohonan Surat</p>
                            <a class="btn-floating btn-small waves-effect waves-light paper-folder red right">
                                <i class="material-icons">close</i>
                            </a>
                        </div>
                    </div>
                    <div class="row paper-content">
                        <div class="container">
                            <input type="hidden" name="id">
                            <div class="row">
                                <div class="col m6 s12">
                                    <div class="round-title"><span>Detail Pemohon</span></div>
                                    <table>
                                        <tr>
                                            <th>Nama</th>
                                            <td>: <span class="detail-nama"></span></td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td>: <span class="detail-nik"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>: <span class="detail-jenis_kelamin"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: <span class="detail-alamat"></span></td>
                                        </tr>
                                    </table>
                                    <div class="detail-dokumen">
                                    </div>
                                </div>
                                <div class="col m6 s12">
                                    <div class="detail-permohonan">
                                    </div>
                                    <div class="round-title"><span>Tindak Lanjut</span></div>
                                    <form action="" class="row" method="POST">
                                        <div class="input-field col s12">
                                            <textarea id="catatan" name="catatan"
                                                class="materialize-textarea"></textarea>
                                            <label for="catatan">Catatan</label>
                                        </div>
                                        <div class="switch center">
                                            <label>
                                                Tolak
                                                <input type="checkbox" name="aksi">
                                                <span class="lever"></span>
                                                Terima
                                            </label>
                                        </div>
                                        <div class="center">
                                            <button class="btn waves-effect waves-light" type="button" id="action-send">Kirim</button>
                                        </div>
                                    </form>
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
<script src="<?=Url::to('@web/js/pages/rt/permohonan.js')?>"></script>
<?php $this->endBlock();?>