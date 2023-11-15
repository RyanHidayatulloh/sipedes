<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEDES</title>

    <!-- Import google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro|Ubuntu" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/1.1.34/">
    <!-- Import AOS Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Custom css stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/css/auth.css" />
</head>

<body class="cyan">


    <!-- Form Section -->

    <form action="" method="GET" id="login-page">
        <!-- Change The Form Method From Here-->
        <div class="card-panel z-depth-5">

            <!-- Form Logo Section  -->

            <div class="row margin">
                <div class="col s12 m12 l12 center">
                    <img src="https://i.imgur.com/ypAbAYt.png" alt="" class="responsive-img circle"
                        style="width:100px;">
                    <p>QUERYMINE Login Page Templates</p>
                </div>
            </div>

            <!-- Form Username Input Section -->

            <div class="col s12 m12 l12">
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                    <input type="text" name="username" id="username">
                    <label for="username">Username</label>
                </div>
            </div>

            <!-- Form Password Input Section -->

            <div class="col m12 l12">
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password" id="password">
                    <label for="password">Password</label>
                </div>
            </div>

            <!-- Form Chekbox (Remember Me) Input Section -->

            <div class="left">
                <label>
                    <input type="checkbox" />
                    <span>Red</span>
                </label>
            </div>
            <br><br>

            <!-- Form Button Section  -->

            <div class="center">
                <input type="submit" value="Login" name="login" class="btn waves-effect waves-light "
                    style="width:100%; background-color: #ff4081;">
            </div>

            <!-- Form "Register Now" And "Forgot Password" Link Section. -->

            <div class="" style="font-size:14px;"><br>
                <a href="" class="left">Register Now!</a>
                <a href="" class="right ">Forgot Password?</a>
            </div><br>
        </div>
    </form>
    <!-- jQuery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript for Materialize-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>