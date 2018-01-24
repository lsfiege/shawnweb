<?php
//inicia la sesion
session_start();

if (($_SESSION['Usuario'] == null)) {
    header('Location: http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/login/controlador/logout.class.php');
}
require($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'modelo'.DIRECTORY_SEPARATOR.'Usuario.class.php');

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
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" media="screen" href="/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/plugins/elFinder-2.1/css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/theme.css">
    <!-- App css -->
    <link rel="stylesheet" type="text/css" media="screen" href="/css/shawnweb.css">

    <!-- Jquery -->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <!-- jquery-ui -->
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="/js/bootstrap.bundle.min.js"></script>
    <!-- App js -->
    <script type="text/javascript" src="/js/shawn_web.js"></script>
    <!-- elFinder JS (REQUIRED) -->
    <script type="text/javascript" src="/plugins/elFinder-2.1/js/elfinder.min.js"></script>
    <script type="text/javascript" src="/plugins/elFinder-2.1/js/i18n/elfinder.es.js"></script>

    <?php $usuario = unserialize($_SESSION['Usuario']); ?>

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript">
        $().ready(function () {
            var elf = $('#elfinder').elfinder({
                url: '/php/connector.php',  // connector URL (REQUIRED)
                customData: {usuario_id: "<?php echo $usuario->getId(); ?>"},
                lang: 'es',             // language (OPTIONAL)
                height: 370
            }).elfinder('instance');
        });
    </script>
</head>
<body>
<header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">
            <a class="link_home"
               href=" <?= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/simulacion/vistas/simulacion_wsn.php' ?> ">
                ShawnWEB
            </a>
            <small>
                Simulación de WSN Basada en la Web
            </small>
        </h5>

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
    </div>
</header>

<main role="main" class="container-fluid">

    <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active"
               id="home-tab" data-toggle="tab"
               href="#gestion"
               role="tab"
               aria-controls="home"
               aria-selected="true">
                <i class="fas fa-archive"></i>
                Gestión de archivos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               id="profile-tab" data-toggle="tab"
               href="#control"
               role="tab"
               aria-controls="profile"
               aria-selected="false">
                <i class="fas fa-code"></i>
                Control de Simulación
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               id="contact-tab" data-toggle="tab"
               href="#compilacion"
               role="tab"
               aria-controls="contact"
               aria-selected="false">
                <i class="far fa-sun"></i>
                Compilación
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               id="contact-tab" data-toggle="tab"
               href="#ejecucion"
               role="tab"
               aria-controls="contact"
               aria-selected="false">
                <i class="fas fa-play"></i>
                Ejecución
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="gestion" role="tabpanel" aria-labelledby="home-tab">
            <div id="panel_desarrollo" class="col-12 mt-3">
                <div id="arbol_archivos">
                    <div class="col-12">
                        <h3>Árbol de gestión archivos de Proyectos de Simulación</h3>
                    </div>

                    <div class="col-12 mb-2">
                        <div class="botones_accion">
                            <input type="button" value="Crear Proyecto" name="crear_proyecto" class="btn btn-outline-primary"
                                   onClick="crear_proyecto(); return false;"/>
                            <input type="button" value="Modificar Proyecto" name="modificar_proyecto" class="btn btn-outline-secondary"
                                   onClick="modificar_proyecto(); return false;"/>
                            <input type="button" value="Eliminar Proyecto" name="eliminar_proyecto" class="btn btn-outline-danger"
                                   onClick="eliminar_proyecto(); return false;"/>
                        </div>
                    </div>

                    <div class="col-12">
                        <!-- Element where elFinder will be created (REQUIRED) -->
                        <div id="elfinder"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="control" role="tabpanel" aria-labelledby="profile-tab">
            <article id="panel_control" class="col-12 mt-3">
                <section id="control">
                    <h3>Parámetros de Control de Simulación</h3>
                    <div class="botones_accion">
                        <input type="button" value="Guardar" name="guardar_control"
                               onClick="guardar_param_arch_conf(); return false;"/>
                    </div>
                    <div class="btn_control">
                        <div class="lbls">
                            <div class="lbl_parametro">
                                <label class="">Proyecto de Simulaci&oacute;n</label>
                            </div>
                            <div class="lbl_parametro">
                                <label class="">Archivo de configuraci&oacute;n</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>count:</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>range:</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>width:</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>height:</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>seed:</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>max iterations:</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>Modelo de Borde:</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>Modelo de Comunicaci&oacute;n:</label>
                            </div>
                            <div class="lbl_parametro">
                                <label>Modelo de Transmisi&oacute;n:</label>
                            </div>
                        </div>
                        <div class="inps">
                            <div class="txt_parametro">
                                <select id="control_proy_simul"
                                        onChange="cargarArchConf('control_proy_simul', 'archivos_conf_div', 'control_archivo_conf'); return false;">
                                    <option selected disabled>Seleccione un Proyecto</option>
                                    <?php $proyectos = $usuario->listarProyectos($usuario); ?>
                                    <?php foreach ($proyectos as $proy) { ?>
                                        <option id="controlproy_<?php echo $proy->id ?>"><?php echo $proy->nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div id="archivos_conf_div" class="txt_parametro">
                                <span>-</span>
                            </div>

                            <div class="txt_parametro">
                                <input type="text" id="count" value="" size="15"/>
                                <input type="text" id="count_anterior"/>
                            </div>
                            <div class="txt_parametro">
                                <input type="text" id="range" value="" size="15"/>
                                <input type="text" id="range_anterior"/>
                            </div>
                            <div class="txt_parametro">
                                <input type="text" id="rect_world_width" value="" size="10"/>
                                <input type="text" id="rect_world_width_anterior"/>
                            </div>
                            <div class="txt_parametro">
                                <input type="text" id="rect_world_height" value="" size="10"/>
                                <input type="text" id="rect_world_height_anterior"/>
                            </div>
                            <div class="txt_parametro">
                                <input type="text" id="seed" value="" size="20"/>
                                <input type="text" id="seed_anterior"/>
                            </div>
                            <div class="txt_parametro">
                                <input type="text" id="max_iterations" value="" size="15"/>
                                <input type="text" id="max_iterations_anterior"/>
                            </div>
                            <div class="txt_parametro">
                                <select id="modelo_borde" disabled="disabled">
                                    <option value="0" selected disabled>Seleccione un Modelo de Borde</option>
                                    <option value="simple">simple</option>
                                    <option value="list">list</option>
                                    <option value="grid">grid</option>
                                    <option value="fast_list">fast_list</option>
                                </select>
                                <input type="text" id="modelo_borde_anterior"/>
                            </div>
                            <div class="txt_parametro">
                                <select id="modelo_comunicacion" disabled="disabled">
                                    <option value="0" selected disabled>Seleccione un Modelo de Comunicaci&oacute;n
                                    </option>
                                    <option value="disk_graph">Unit Disk Graph (UDG)</option>
                                    <option value="rim">Radio Irregularity Model (RIM)</option>
                                    <option value="qudg">Unit Disk Graph (Q-UDG)</option>
                                    <option value="stochastic">Stochastic</option>

                                </select>
                                <input type="text" id="modelo_comunicacion_anterior"/>
                            </div>
                            <div class="txt_parametro">
                                <select id="modelo_transmision" disabled="disabled">
                                    <option value="0" selected disabled>Seleccione un Modelo de Transmi&oacute;n
                                    </option>
                                    <option value="csma">Csma</option>
                                    <option value="zigbee_csma">Zigbee Csma</option>
                                    <option value="maca">Maca</option>
                                    <option value="random_drop">Random Drop</option>
                                    <option value="aloha">Aloha</option>
                                    <option value="slotted_aloha">Slotted Aloha</option>
                                    <option value="traces">Traces</option>

                                </select>
                                <input type="text" id="modelo_transmision_anterior"/>
                            </div>
                        </div>
                    </div>
                </section>
            </article>
        </div>

        <div class="tab-pane fade" id="compilacion" role="tabpanel" aria-labelledby="contact-tab">
            <article id="salida_compilacion" class="col-12 mt-3">
                <section id="compilacion">
                    <header>
                        <h3>Salida de compilaci&oacute;n</h3>
                        <div class="botones_accion">
                            <select id="compil_proy_simul">
                                <option selected disabled>Seleccione un Proyecto</option>
                                <?php foreach ($proyectos as $proy) { ?>
                                    <option id="compilproy_<?php echo $proy->id ?>"><?php echo $proy->nombre ?></option>
                                <?php } ?>
                            </select>
                            <input type="button" value="Compilar" name="compilar" onClick="compilar(); return false;"/>
                        </div>
                    </header>
                    <textarea id="txa_copilar" rows="23" placeholder="Resultado de la compilaci&oacute;n"></textarea>
                </section>
            </article>
        </div>

        <div class="tab-pane fade" id="ejecucion" role="tabpanel" aria-labelledby="contact-tab">
            <article id="salida_ejecucion" class="col-12 mt-3">
                <section id="ejecucion">
                    <header>
                        <h3>Salida de ejecuci&oacute;n</h3>
                        <div class="botones_accion">
                            <form action="/modulos/simulacion/controlador/simulacion.class.php" method="GET">
                                <select id="ejec_proy_simul"
                                        onChange="cargarArchConf('ejec_proy_simul', 'ejec_span_arch_conf', 'ejec_arch_conf'); return false;">
                                    <option selected disabled>Seleccione un Proyecto</option>
                                    <?php foreach ($proyectos as $proy) { ?>
                                        <option id="ejecproy_<?php echo $proy->id ?>"><?php echo $proy->nombre ?></option>
                                    <?php } ?>
                                </select>
                                <span id="ejec_span_arch_conf"> </span>
                                <input type="button" value="Ejecutar" name="ejecutar"
                                       onClick="ejecutar_proyecto(); return false;"/>

                                <input id="proyecto_id_ejecucion" type="hidden" value="" name="proyecto_id"/>
                                <input type="submit" value="Descargar" name="descargar-proyecto"/>
                                <a id="link_salida_pdf"
                                   href="http://<?php echo $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']; ?>/modulos/simulacion/controlador/simulacion.class.php"
                                   target="_blank">Visualizar</a>
                            </form>
                        </div>
                    </header>
                    <textarea id="txa_ejecutar" rows="23" placeholder="Resultado de la simulaci&oacute;n"></textarea>
                </section>
            </article>
        </div>

    </div>

</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'footer.php'); ?>

</body>
</html>