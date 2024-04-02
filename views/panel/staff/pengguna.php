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
                                <div class="col s12 center">
                                    <button class="btn waves-effect waves-light paper-trigger green" target="paper-add"
                                        type="button">Tambah</button>
                                </div>
                                <div class="content" style="padding: 1rem;">
                                    <div id="pengguna" class="col s12">
                                        <table class="striped highlight">
                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
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

                <div class="paper-fold from-right" id="paper-add">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Tambah Pengguna Baru</p>
                            <a class="btn-floating btn-small waves-effect waves-light paper-folder red right">
                                <i class="material-icons">close</i>
                            </a>
                        </div>
                    </div>
                    <div class="row paper-content">
                        <div class="container">
                            <form action="" method="POST" class="row" id="form-add" enctype="multipart/form-data">
                                <div class="profil-picture center"
                                    style="display: flex;justify-content: center;align-items: center;flex-direction: column;gap: 0.5rem;">
                                    <img src="<?=Url::to('@web/uploads/foto/avatar.jpg')?>" alt="picture"
                                        style="width: 10rem;height: 10rem; border-radius: 50%; object-fit: cover">
                                    <div class="file-field input-field" style="max-width: 15rem">
                                        <div class="btn btn-small">
                                            <span><i class="material-icons">upload</i></span>
                                            <input type="file" id="picture" name="picture" accept="image/*">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text"
                                                placeholder="Unggah Foto Profil">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-field col m6 s12">
                                    <input id="name" type="text" name="name" class="validate" required>
                                    <label for="name">Nama</label>
                                </div>
                                <div class="input-field col m6 s12">
                                    <input id="email" type="email" name="email" class="validate" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-field col m6 s12">
                                    <input id="nid" type="text" name="nid" class="validate" required>
                                    <label for="nid">NIDN / NIK</label>
                                </div>
                                <div class="input-field col m6 s12">
                                    <select name="role">
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="kades">Kepala Desa</option>
                                        <option value="staf">Staff</option>
                                        <option value="rt">RT</option>
                                        <option value="pemohon">Pemohon</option>
                                    </select>
                                    <label>Role Pengguna</label>
                                </div>
                                <div class="input-field col m6 s12">
                                    <input id="password" type="password" name="password" class="validate" required>
                                    <label for="password">Kata Sandi</label>
                                </div>
                                <div class="input-field col m6 s12">
                                    <input id="password_confirm" type="password" name="password_confirm" class="validate" required>
                                    <label for="password_confirm">Konfirmasi Kata Sandi</label>
                                </div>
                                <div class="input-field col s12 center">
                                    <button class="btn waves-effect waves-light" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="paper-fold from-right" id="paper-action">
                    <div class="row">
                        <div class="col s12">
                            <p class="left title">Detail Pengguna</p>
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
                                        <div class="input-field col s12" style="display: none">
                                            <input id="nomor" name="nomor" class="validate" type="text"></input>
                                            <label for="nomor">Nomor Surat</label>
                                        </div>
                                        <div class="center">
                                            <button class="btn waves-effect waves-light" type="button"
                                                id="action-send">Kirim</button>
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
<script src="<?=Url::to('@web/js/pages/staf/pengguna.js')?>"></script>
<?php $this->endBlock();?>