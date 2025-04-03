<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titulo_pagina ?></title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PORTAL_CSS . 'bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PORTAL_CSS . 'font-awesome.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PORTAL_CSS . 'elegant-icons.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PORTAL_CSS . 'plyr.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PORTAL_CSS . 'nice-select.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PORTAL_CSS . 'owl.carousel.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PORTAL_CSS . 'slicknav.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PORTAL_CSS . 'style.css') ?>" type="text/css">

<!-- recursos login -->
    
    <link rel="stylesheet" href="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS . '/toastr/toastr.min.css') ?>">
</head>

<body>

<div class="wrapper">

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                    <a href="<?= route_to('portal') ?>">
                        <img src="<?= base_url(RECURSOS_PORTAL_IMAGES . 'blockbuster/blockbuster_logo.png') ?>" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li ><a href="<?= route_to('portal') ?>">Inicio</a></li>
                                <li ><a href="<?= route_to('genero') ?>">Generos</a>
                                <?= ($is_logged == true ) ? '<li><a href="'.route_to('planes_portal').'">Planes</a></li>' : '' ?>
                                <!-- <li><a href="#"></a></li> -->
                                <!-- verificamos si el usuario está logueado, de ser correcto,
                                  mostramos la opción del nav de perfil -->
                                  <?= ($is_logged == true ) ? '<li><a href="'.route_to('perfil').'">Perfil</a></li>' : ''?>
                                <?= ($is_logged == true ) ? '<li><a href="'.route_to('pagos_portal').'">Pagos</a></li>' : ''?>

                                
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <!-- <a href="#" class="search-switch"><span class="icon_search"></span></a> -->

<!-- Comprobamos si se ha iniciado sesión
                        Si está logueado mostramos la opcion de salir, sino mostramos inicio de sesion -->
                        <?= ($is_logged == true ) ? 
                         '<a href="'.route_to('salir').'" class="btn-login"><span class="icon_profile"></span> Cerrar sesión</a>' : 
                         '<a href="'.route_to('inicio').'" class="btn-login"><span class="icon_profile"></span> Iniciar sesión</a>'?>

                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->


    <?= $this->renderSection('carrusel')?>
    <?= $this->renderSection('genero')?>
    <?= $this->renderSection('stream')?>
    <?= $this->renderSection('login')?>
    <?= $this->renderSection('content')?>




    

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                </div>


               





</div>
</div>
</div>
</div>
</section>
<!-- Product Section End -->

<!-- Footer Section Begin -->
<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    <a href="<?= route_to('portal') ?>"><img src="<?= base_url(RECURSOS_PORTAL_IMAGES . 'blockbuster/blockbuster_logo.png') ?>" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="<?= route_to('portal') ?>">Inicio</a></li>
                        <li><a href="<?= route_to('genero') ?>">Generos</a></li>
                        <!-- Comprobamos si se ha iniciado sesión
                        Si está logueado mostramos la opcion de salir, sino mostramos inicio de sesion -->
                        <?php if ($is_logged == true): ?>
                        <li><a href="<?= route_to('planes_portal') ?>">Contratar un Plan</a></li>
                        <li><a href="<?= route_to('salir') ?>">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="<?= route_to('inicio') ?>">Iniciar Sesión</a></li>
                    <?php endif; ?>


                    </ul>
                </div>
            </div>




            <div class="col-lg-3">
            <p class="footer__copyright__text">
    &copy; <script>document.write(new Date().getFullYear());</script> Blockbuster. Todos los derechos reservados. 


              </div>
          </div>
      </div>
  </footer>
  <!-- Footer Section End -->

  <!-- Search model Begin -->
  <div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- Js Plugins -->
<script src="<?= base_url(RECURSOS_PORTAL_JS . 'jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url(RECURSOS_PORTAL_JS . 'bootstrap.min.js') ?>"></script>
<script src="<?= base_url(RECURSOS_PORTAL_JS . 'player.js') ?>"></script>
<script src="<?= base_url(RECURSOS_PORTAL_JS . 'jquery.nice-select.min.js') ?>"></script>
<script src="<?= base_url(RECURSOS_PORTAL_JS . 'mixitup.min.js') ?>"></script>
<script src="<?= base_url(RECURSOS_PORTAL_JS . 'jquery.slicknav.js') ?>"></script>
<script src="<?= base_url(RECURSOS_PORTAL_JS . 'owl.carousel.min.js') ?>"></script>
<script src="<?= base_url(RECURSOS_PORTAL_JS . 'main.js') ?>"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    <?= show_message()?>
</script>

</body>

</html>