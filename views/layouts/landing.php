<!--
Author:
SHUBHAM PRAKASH
LinkedIn: https://www.linkedin.com/in/ishubhamprakash/
GitHub: https://github.com/i-shubhamprakash
-->

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
                        <h1 class="text-shadow">FIND BALANCE WITH <span id="main-head-blue"> BENIFICIARY </span></h1>
                        <p class="flow-text" data-aos="fade-right">Feeling stuck? At a crossroads in your career or
                            emotional life? Even the
                            strongest among us can feel lost, unsure, ambivalent, or unhappy at times. As a Counselling
                            Professional, I can help you understand and manage whatever life throws at you, and how to
                            do it successfully. I believe that you have the strength not just to survive, but to
                            thrive!</p>
                    </div>
                    <div class="col m6" id="home-top-image" data-aos="fade-left">
                        <picture>
                            <source media="(min-width: 650px)" srcset="/resources/images/index-row1.jpg">
                            <source media="(min-width: 465px)" srcset="/resources/images/index-row1.jpg">
                            <img src="/resources/images/index-row1.jpg" alt="" style="width:auto;">
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
                        <h1 data-aos="zoom-out-up">LEARN MORE ABOUT ME</h1>
                        <div class="row">
                            <div class="col s12 m6" data-aos="flip-left">
                                <img src="/resources/images/shubham.jpg" alt="" style="width:auto;" class="circle">
                            </div>
                            <div class="col s12 m6">
                                <p class="flow-text" data-aos="fade-left">Fully-certified, I’ve been successfully
                                    coaching clients
                                    throughout the
                                    kolkata area and facilitating their self-growth. If you are feeling overwhelmed by
                                    life’s
                                    demands, my services aim to introduce clarity and self-motivation. I also teach
                                    techniques
                                    to better manage the emotional gauntlet of modern life.</p>

                                <a href="/contact.html" class="btn">Get In Touch</a>
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
                    <div class="col s12 m7">
                        <div class="card hoverable" data-aos="zoom-in">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="/resources/images/career.jpg">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">Career Coaching<i
                                        class="material-icons right">more_vert</i></span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">
                                    CAREER COACHING<i class="material-icons right">close</i></span>
                                <p>Do you feel like you are always adding new tasks to your to-do list but never
                                    crossing anything out? My specialization in Career Coaching will help guide and
                                    inspire you to achieve more of your personal and professional goals. Get in touch
                                    today and start taking control of your life with my Career Coaching tools and
                                    techniques.Career Coaching</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="card hoverable" data-aos="zoom-in-left">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="/resources/images/relationship.jpg">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">Relationship Coaching<i
                                        class="material-icons right">more_vert</i></span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">
                                    RELATIONSHIP COACHING<i class="material-icons right">close</i></span>
                                <p>Sometimes, it seems as if life just has it in for us and we can never catch a break.
                                    In reality, there will always be moments we have little to no control over but,
                                    what we can always control is how we react to those moments. With my Relationship
                                    Coaching sessions, you’ll learn about acceptance and how to exert your power of
                                    choice over whatever life may throw at you.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card hoverable" data-aos="zoom-out-up">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="/resources/images/life.jpg">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">Life Coaching<i
                                        class="material-icons right">more_vert</i></span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">LIFE COACHING<i
                                        class="material-icons right">close</i></span>
                                <p>Life Coaching can be one of the keys to a happier, healthier life. My job is to give
                                    you the tools and techniques to achieve a balanced and fulfilling life. After
                                    several Life Coaching sessions, you will become well-versed at handling issues
                                    whenever and wherever they arise. Call now to schedule a session.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quote row -->
        <div class="row row4">
            <div class="container-flex">
                <div class="row">
                    <div class="col s12 m5 center quote" data-aos="fade-right">
                        <h3>“Our life is what our thoughts make it”</h3>
                        <p class="flow-text author">Marcus Aurelius</p>
                    </div>
                    <div class="col s12 m7" data-aos="fade-left">
                        <img src="/resources/images/index-row-quote.jpg" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Footer Content</h5>
                    <p class="grey-text text-lighten-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos
                        cum dolorem natus distinctio cumque, consequatur sed, vel voluptate suscipit soluta sint vero
                        necessitatibus hic nisi! A vero nemo sapiente officia.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Made with <i class="material-icons">favorite</i> by <a
                    href="https://www.linkedin.com/in/ishubhamprakash/" targget="_blank">i-shubhamprakash</a>
                <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
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