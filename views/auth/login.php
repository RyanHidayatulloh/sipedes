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
                <img src="https://i.imgur.com/ypAbAYt.png" alt="" class="responsive-img circle" style="width:100px;">
                <h5>Masuk</h5>
            </div>
        </div>

        <!-- Form Username Input Section -->

        <div class="col s12 m12 l12">
            <div class="input-field">
                <i class="material-icons prefix">person</i>
                <input type="text" name="username" id="username" value="<?= $data['username'] ?? '' ?>" required>
                <label for="username">Email / NIK</label>
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

        <!-- Form Chekbox (Remember Me) Input Section -->

        <div class="left">
            <label>
                <input type="checkbox" name="rememberMe" <?= $data['rememberMe'] ?? '' ? 'checked' : '' ?> />
                <span>Ingat Saya</span>
            </label>
        </div>
        <br><br>

        <!-- Form Button Section  -->

        <div class="center">
            <button type="submit" class="btn waves-effect waves-light">Masuk</button>
        </div>

        <!-- Form "Register Now" And "Forgot Password" Link Section. -->

        <div class="" style="font-size:14px;"><br>
            <a href="<?= Url::to(['auth/register']) ?>" class="left">Buat Akun</a>
            <a href="" class="right ">Lupa Password</a>
        </div><br>
    </div>
</form>