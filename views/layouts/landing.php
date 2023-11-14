<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    <!-- Import google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro|Ubuntu" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Import AOS Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Custom css stylesheet -->
    <link rel="stylesheet" type="text/css" media="screen" href="/css/landing.css" />
</head>

<body>
    <!-- Nav bar -->
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper container">
                <a href="#!" class="brand-logo">SIPEDES</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li class="active"><a class="waves-effect waves-light" href="#">Home</a></li>
                    <li><a class="waves-effect waves-light" href="about.html">About</a></li>
                    <li><a class="waves-effect waves-light" href="team.html">Team</a></li>
                    <li><a class="waves-effect waves-light" href="contact.html">Contact</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Nav side bar for mobile -->
    <ul class="sidenav" id="mobile-demo">
        <li class="active"><a class="waves-effect " href="#"><i class="material-icons">home</i> Home</a></li>
        <li><a class="waves-effect " href="about.html"><i class="material-icons">person</i> About Us</a></li>
        <li><a class="waves-effect " href="team.html"><i class="material-icons">wc</i> Meet the Team</a></li>
        <li><a class="waves-effect " href="contact.html"><i class="material-icons">short_text</i> Contact Us</a></li>
    </ul>
    <!-- /nav bar -->
    <div class="container-fluid">
        <!-- Top head row -->
        <div class="row row1">
            <div class="container">
                <div class="row">
                    <div class="col m6" id="home-heading">
                        <h1 class="text-shadow">SISTEM INFORMASI PELAYANAN UMUM DAN ADMINISTRASI DESA <span
                                id="main-head-blue"> BUNIWAH </span></h1>
                        <p class="flow-text" data-aos="fade-right">Hadir untuk membantu efektifitas dan efisiensi
                            pengelolaan proses pelayanan administrasi pembuatan surat-menyurat di desa buniwah</p>
                        <a href="#!" class="btn">Daftar</a>
                    </div>
                    <div class="col m6" id="home-top-image" data-aos="fade-left">
                        <picture>
                            <source media="(min-width: 650px)" srcset="/resources/images/index-row1.png">
                            <source media="(min-width: 465px)" srcset="/resources/images/index-row1.png">
                            <img src="/resources/images/index-row1.png" alt="" style="width:auto;">
                        </picture>
                    </div>
                </div>
            </div>
        </div>
        <!-- About row -->
        <div class="row row2">
            <div class="container">
                <div class="row">

                    <div class="col s12 center">
                        <h1 data-aos="zoom-out-up">WAKTU PELAYANAN</h1>
                        <div class="row">
                            <div class="col s12 m6" data-aos="flip-left">
                                <img src="/resources/images/time.png" alt="" width="50">
                            </div>
                            <div class="col s12 m6">
                                <ul class="left flow-text grey-text text-lighten-5" data-aos="fade-left">
                                    <li><b><i class="medium material-icons">schedule</i> asdasd</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Showcase row -->
        <div class="row row3">
            <div class="container fluid">
                <div class="row">
                    <div class="col m6 offset-m3 s12">
                        <div class="card hoverable" data-aos="zoom-in">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="/resources/images/career.jpg">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">Prosedur Pelayanan<i
                                        class="material-icons right">more_vert</i></span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">
                                    Prosedur Pelayanan<i class="material-icons right">close</i></span>
                                <ol>
                                    <li>
                                        <strong>Half-Life 2</strong>
                                        <p>Fight aliens, wear a head crab, learn about gravity</p>
                                    </li>
                                    <li>
                                        <strong>Halo: Combat Evolved</strong>
                                        <p>Fight aliens, wear an AI, learn about screen peeking siblings</p>
                                    </li>
                                    <li>
                                        <strong>Team Fortress 2</strong>
                                        <p>Fight non-alien residents, wear hats, learn about teamwork</p>
                                    </li>
                                    <li>
                                        <strong>Tribes</strong>
                                        <p>Ski, slip, and slide your way to victory</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer">
        <div class="container">
            <div class="row center">
                <div class="col s12">
                    <h5 class="white-text">Alamat Kantor</h5>
                    <p class="grey-text text-lighten-4">Jl KH WAHID HASYIM No.KM 2 Gudril Desa Buniwah Kecamatan
                        Sirampog
                        Kabupaten Brebes Jawa Tengah</p>
                    <iframe width="100%" height="531" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        id="gmap_canvas"
                        src="https://maps.google.com/maps?width=1455&amp;height=531&amp;hl=en&amp;q=R333+FM%20Buniwah%20Sirampog+(Balai%20Desa%20Buniwah)&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>


                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container center">
                SIPEDES @
                <?= date("Y") ?>
            </div>
        </div>
    </footer>
    <!-- /Footer -->
    <!-- Back to top button -->
    <a href="#" id="scroll" style="display: none;"><span></span></a>
    <!-- jQuery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript for Materialize-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Custom javascript script -->
    <script src="/scripts/landing.js"></script>
    <!-- AOS Script link -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>

</html>