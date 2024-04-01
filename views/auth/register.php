<?php

use yii\helpers\Url;

?>
<form method="POST" id="login-page">
    <div class="card-panel z-depth-5">
        <div class="row margin">
            <div class="col s12 m12 l12 center">
                <h4>SIPEDES</h4>
                <p>Sistem Pelayanan Umum dan Administrasi Desa<br><b>Buniwah</b>
                </p>
                <h5>Buat Akun</h5>
            </div>
        </div>

        <!-- Form Username Input Section -->

        <div class="col s12 m12 l12">
            <div class="input-field">
                <i class="material-icons prefix">email</i>
                <input type="email" name="email" id="email" value="<?= $data['email'] ?? '' ?>" required>
                <label for="email">Email</label>
            </div>
        </div>

        <div class="col s12 m12 l12">
            <div class="input-field">
                <i class="material-icons prefix">credit_card</i>
                <input type="text" name="nid" id="nid" value="<?= $data['nid'] ?? '' ?>" required>
                <label for="nid">NIK</label>
            </div>
        </div>

        <!-- Form Password Input Section -->

        <div class="col m12 l12">
            <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
        </div>

        <div class="col m12 l12">
            <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <input type="password" name="password_confirm" id="password_confirm" required>
                <label for="password_confirm">Konfirmasi Password</label>
            </div>
        </div>

        <!-- Form Button Section  -->

        <div class="center">
            <button type="submit" name="login" class="btn waves-effect waves-light">Daftar</button>
        </div>

        <!-- Form "Register Now" And "Forgot Password" Link Section. -->

        <div class="center" style="font-size:14px;"><br>
            Sudah memiliki akun ?
            <a href="<?= Url::to(['auth/login']) ?>">Masuk</a>
        </div>
    </div>
</form>