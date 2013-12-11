<?php
include_once '../Controlador/Controlador-Negocio/Ctlr_MODELO.php';
require ('xajax/xajax.inc.php');
$xajax = new xajax();
include_once 'functionsAJAX.php';
$ctlrModelo = new Ctlr_MODELO();
?>
<html>
    <head>
        <title>CINEMARELAX|en nuestros cines , el cine se ve diferente</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-panels.min.js"></script>
        <script src="js/init.js"></script>
        <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-wide.css" />
        </noscript>
        <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
        <?php
        $xajax->printJavascript("xajax/");
        ?>
    </head>
    <body>

        <!-- Header -->
        <div id="header" class="skel-panels-fixed">

            <div class="top">

                <!-- Logo -->
                <div id="logo">
                    <span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
                    <h1 id="title">MILTON YESID FERNANDEZ GONZALEZ</h1>
                    <span class="byline">Administrador</span>
                </div>

                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        <li><a href="#top" id="top-link" class="skel-panels-ignoreHref"><span class="icon icon-home">Películas en cartelera</span></a></li>
                        <li><a href="#portfolio" id="portfolio-link" class="skel-panels-ignoreHref"><span class="icon icon-th">Compra</span></a></li>
                        <li><a href="#about" id="about-link" class="skel-panels-ignoreHref"><span class="icon icon-user">Session Financiera</span></a></li>
                        <li><a href="#contact" id="contact-link" class="skel-panels-ignoreHref"><span class="icon icon-envelope">Contact</span></a></li>
                    </ul>
                </nav>

            </div>

            <div class="bottom">

                <!-- Social Icons -->
                <ul class="icons">
                    <li><a href="#" class="icon icon-twitter"><span>Twitter</span></a></li>
                    <li><a href="#" class="icon icon-facebook"><span>Facebook</span></a></li>
                    <li><a href="#" class="icon icon-github"><span>Github</span></a></li>
                    <li><a href="#" class="icon icon-dribbble"><span>Dribbble</span></a></li>
                    <li><a href="#" class="icon icon-envelope"><span>Email</span></a></li>
                </ul>

            </div>

        </div>

        <!-- Main -->
        <div id="main">

            <!-- Intro -->
            <section id="top" class="one">
                <div class="container">


                    <header>
                        <h2 class="alt">PELICULAS EN CARTELERA</h2>
                    </header>

                    <p>Se presenta la lista de películas</p>
                    <?php
                    include_once 'peliculasUI.php';
                    ?>

                    <footer>
                        <a href="" class="button scrolly">PARA REALIZAR LA COMPRA DE UNA BOLETA  A UNA FUNCION , ES NECESARIO PRESIONAR EL BOTON DE COMPRAR EN LA RESPECTIVA PELICULA, AL EFECTUARLO DIRIGASE A LA SECCION DE COMPRA</a>
                    </footer>

                </div>
            </section>

            <!-- Portfolio -->
            <section id="portfolio" class="two">
                <div class="container">
                   
                    <header>
                        <h2>COMPRA DE BOLETAS</h2>
                    </header>
 <div id="boleta">
                    </div>
                    <div id="sillas">
                        <a href="" class="button scrolly">Para poder comprar una boleta , debe oprimir el botón de comprar en cualquier de nuestras peliculas presentes,RECUERDE SOMOS CINERELAX,somos su CINEMA</a>

                    </div><BR>
                    <BR><BR><BR><BR><BR><BR><BR><BR>
                </div>
            </section>

            <!-- About Me -->
            <section id="about" class="three">
                <div class="container">

                    <header>
                        <h2>Session financiera</h2>
                    </header>

                    <a href="#costos" onClick ="xajax_setCostos()" class="button scrolly">Recordamos que la información presentada es confidencial , SUS ROLES COMO ADMINISTRADOR LE PERMITEN VISUALIZAR LA INFORMACIÓN , no obstante lo prevee de los deberes con nuestro CINEMARELAX,oprima para ver y/o actualizar la informaciòn de ganancias por cada sala</a>
                        <a href="" class="button scrolly">
                            <div id="costos">
                            </div>
                        </a>
                    <br>
                    <br>  <br>  <br>  <br>
                </div>
            </section>

            <!-- Contact -->
            <section id="contact" class="four">
                <div class="container">

                    <header>
                        <h2>Contact</h2>
                    </header>

                    <p>Es muy importante para nosotros contar con sus aportes , escribanos sus sugerencia y/o reclamos,ESTAMOS MEJORANDO</p>

                    <form method="post" action="#">
                        <div class="row half">
                            <div class="6u"><input type="text" class="text" name="name" placeholder="Name" /></div>
                            <div class="6u"><input type="text" class="text" name="email" placeholder="Email" /></div>
                        </div>
                        <div class="row half">
                            <div class="12u">
                                <textarea name="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="12u">
                                <a href="#" class="button submit">Send Message</a>
                            </div>
                        </div>
                    </form>

                </div>
            </section>

        </div>

        <!-- Footer -->
        <div id="footer">

            <!-- Copyright -->
            <div class="copyright">
                <p>&copy; 2013 MILTON YESID FERNANDEZ GONZALEZ.</p>
                <ul class="menu">


                </ul>
            </div>

        </div>

    </body>
</html>

