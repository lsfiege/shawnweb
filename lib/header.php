<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Redes de Sensores Remotos, Simulaci&oacute;n Basada en la Web, Simulador Shawn">
    <meta name="keywords" content="Wireless Sensor Networks, Web Based Simulation, Shawn Simulator">
    <meta name="description" content="Simulaci&oacute;n de WSN Basada en Web mediante la utilizaci&oacute;n de Shawn">
    <meta name="author" content="Bareiro, Santiago Hernan">
    <title>ShawnWeb - Simulaci&oacute;n de WSN Basada en la Web</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/sticky-footer.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/shawnweb.css">

    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/shawn_web.js"></script>
    <!-- Bootstrap -->
    <script src="/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <?php if (is_null($usuario)): ?>
            <a class="link_home"
               href=" <?= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/login/vistas/iniciar_sesion.php' ?> ">
                ShawnWEB
            </a>
        <?php else: ?>
            <a class="link_home"
               href=" <?= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/simulacion/vistas/simulacion_wsn.php' ?> ">
                ShawnWEB
            </a>
        <?php endif; ?>

        <small>
            Simulación de WSN Basada en la Web
        </small>
    </h5>

    <?php if (is_null($usuario)): ?>
        <a class="btn btn-outline-primary"
           href="<?= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/login/vistas/registrar_usuario.php' ?>">
            Registrarme
        </a>
    <?php else: ?>
        <nav class="my-2 my-md-0 mr-md-3 justify-content-end">
            <ul class="nav justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nav-ayuda" data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        Ayuda
                    </a>
                    <div class="dropdown-menu" aria-labelledby="nav-ayuda">
                        <a class="dropdown-item" href="https://github.com/itm/shawn">Shawn Wiki</a>
                        <a class="dropdown-item" href="http://shawn.sourceforge.net/doc/api/">Shawn API</a>
                        <a class="dropdown-item" href="/papers">Shawn Papers</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nav-user" data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        <?php echo($usuario->getNombre()); ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="nav-user">
                        <a class="dropdown-item" href="/modulos/usuarios/vistas/modificar_datos_perfil.php">Modificar
                            Perfil</a>
                        <a class="dropdown-item" href="/modulos/login/controlador/logout.class.php">Salir</a>
                    </div>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>