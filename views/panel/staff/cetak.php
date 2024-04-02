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
                                        <li class="tab col s3"><a href="#ready">Surat Siap Cetak</a></li>
                                        <li class="tab col s3"><a href="#print">Surat Tercetak</a></li>
                                    </ul>
                                </div>
                                <div class="content" style="padding: 1rem;">
                                    <div id="ready" class="col s12">
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
                                    <div id="print" class="col s12">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="paper-fold from-right" id="paper-action">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Cetak Surat</p>
                            <a class="btn-floating btn-small waves-effect waves-light paper-folder red right">
                                <i class="material-icons">close</i>
                            </a>
                        </div>
                    </div>
                    <div class="row paper-content">
                        <div class="container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('script');?>
<script src="<?=Url::to('@web/js/pages/staf/cetak.js')?>"></script>
<?php $this->endBlock();?>