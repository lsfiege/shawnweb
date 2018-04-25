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
    <!-- Color picker -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
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
    <script type="text/javascript" src="/js/sweetalert2.min.js"></script>
    <!-- elFinder JS (REQUIRED) -->
    <script type="text/javascript" src="/plugins/elFinder-2.1/js/elfinder.min.js"></script>
    <script type="text/javascript" src="/plugins/elFinder-2.1/js/i18n/elfinder.es.js"></script>
    <!-- Color picker -->
    <script type="text/javascript" src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

    <?php $usuario = unserialize($_SESSION['Usuario']); ?>

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript">
        $().ready(function () {
            var elf = $('#elfinder').elfinder({
                url: '/php/connector.php',  // connector URL (REQUIRED)
                customData: {usuario_id: "<?= $usuario->getId(); ?>"},
                lang: 'es',             // language (OPTIONAL)
                height: 450
            }).elfinder('instance');
        });
    </script>

    <!-- Color picker initialization -->
    <script>
        $(function () {
            $('#selected_preset_color').colorpicker({
                useAlpha: false,
            }).on('colorpickerChange colorpickerCreate', function (e) {
                $('#selected_preset_color_x').val(e.color._r / 255);
                $('#selected_preset_color_y').val(e.color._g / 255);
                $('#selected_preset_color_z').val(e.color._b / 255);
            });

            $('#selected_preset_edge_color').colorpicker({
                useAlpha: false
            }).on('colorpickerChange colorpickerCreate', function (e) {
                $('#selected_preset_edge_color_x').val(e.color._r / 255);
                $('#selected_preset_edge_color_y').val(e.color._g / 255);
                $('#selected_preset_edge_color_z').val(e.color._b / 255);
            });
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
                        <?= ($usuario->getNombre()); ?>
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
               id="contact-tab-vis" data-toggle="tab"
               href="#visualizacion"
               role="tab"
               aria-controls="contact"
               aria-selected="false">
                <i class="fas fa-eye"></i>
                Parámetros de visualización
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
                            <input type="button" value="Crear Proyecto" name="crear_proyecto"
                                   class="btn btn-outline-primary"
                                   onClick="crear_proyecto(); return false;"/>
                            <input type="button" value="Modificar Proyecto" name="modificar_proyecto"
                                   class="btn btn-outline-secondary"
                                   onClick="modificar_proyecto(); return false;"/>
                            <input type="button" value="Eliminar Proyecto" name="eliminar_proyecto"
                                   class="btn btn-outline-danger"
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
            <div id="panel_control" class="col-12 mt-3">
                <div id="control" class="container-fluid">
                    <div class="col-12">
                        <h3>Parámetros de Control de Simulación</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-center">
                                <div class="form-group">
                                    <label class="">Proyecto de Simulación</label>
                                    <select id="control_proy_simul" class="form-control"
                                            onChange="cargarArchConf('control_proy_simul', 'archivos_conf_div', 'control_archivo_conf'); return false;">
                                        <option selected disabled>Seleccione un Proyecto</option>
                                        <?php $proyectos = $usuario->listarProyectos($usuario); ?>
                                        <?php foreach ($proyectos as $proy) { ?>
                                            <option id="controlproy_<?= $proy->id ?>"><?= $proy->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Archivo de configuración</label>
                                    <div id="archivos_conf_div" class="form-group">
                                        <span>-</span>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Parámetros de escenario</h4>

                                    <div class="form-group">
                                        <label for="load_snapshot">
                                            Cargar escenario generado
                                        </label>
                                        <input type="checkbox" id="load_snapshot"
                                               onchange="loadSelectSnapshots();return false;">
                                        <div id="div_snapshots" class="form-group"></div>
                                    </div>

                                    <div id="world_settings">

                                        <div class="form-group">
                                            <label>count:</label>
                                            <input type="text" id="count" value="" class="form-control"/>
                                            <input type="text" id="count_anterior" hidden/>
                                        </div>

                                        <div class="form-group">
                                            <label>width:</label>
                                            <input type="text" id="rect_world_width" value="" class="form-control"/>
                                            <input type="text" id="rect_world_width_anterior" hidden/>
                                        </div>

                                        <div class="form-group">
                                            <label>height:</label>
                                            <input type="text" id="rect_world_height" value=""
                                                   class="form-control"/>
                                            <input type="text" id="rect_world_height_anterior" hidden/>
                                        </div>

                                        <div class="form-group">
                                            <label>seed:</label>
                                            <input type="text" id="seed" value="" class="form-control"/>
                                            <input type="text" id="seed_anterior" hidden/>
                                        </div>

                                        <div id="save_world_div" class="form-group">
                                            <label for="save_world">¿Desea guardar un snapshot de escenario?</label>
                                            <small>Guardarndo snapshots podrá reutilizar la disposición de los nodos en otras
                                                simulaciones
                                            </small>
                                            <input type="checkbox" id="save_world">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4>Parámetros de simulación</h4>

                                    <div class="form-group">
                                        <label>range:</label>
                                        <input type="text" id="range" value="" class="form-control"/>
                                        <input type="text" id="range_anterior" hidden/>
                                    </div>

                                    <div class="form-group">
                                        <label>max iterations:</label>
                                        <input type="text" id="max_iterations" value="" class="form-control"/>
                                        <input type="text" id="max_iterations_anterior" hidden/>
                                    </div>

                                    <div class="form-group">
                                        <label>Modelo de Borde:</label>
                                        <select id="modelo_borde" disabled="disabled" class="form-control">
                                            <option value="0" selected disabled>Seleccione un Modelo de Borde
                                            </option>
                                            <option value="simple">simple</option>
                                            <option value="list">list</option>
                                            <option value="grid">grid</option>
                                            <option value="fast_list">fast_list</option>
                                        </select>
                                        <input type="text" id="modelo_borde_anterior" hidden/>
                                    </div>

                                    <div class="form-group">
                                        <label>Modelo de Comunicación:</label>
                                        <select id="modelo_comunicacion" disabled="disabled"
                                                class="form-control">
                                            <option value="0" selected disabled>Seleccione un Modelo de
                                                Comunicación
                                            </option>
                                            <option value="disk_graph">Unit Disk Graph (UDG)</option>
                                            <option value="rim">Radio Irregularity Model (RIM)</option>
                                            <option value="qudg">Unit Disk Graph (Q-UDG)</option>
                                            <option value="stochastic">Stochastic</option>

                                        </select>
                                        <input type="text" id="modelo_comunicacion_anterior" hidden/>
                                    </div>

                                    <div class="form-group">
                                        <label>Modelo de Transmisión:</label>
                                        <select id="modelo_transmision" disabled="disabled"
                                                class="form-control">
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
                                        <input type="text" id="modelo_transmision_anterior" hidden/>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-primary"
                                        name="guardar_control"
                                        onclick="show_vis_panel(); return false;">
                                    Siguiente
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="visualizacion" role="tabpanel" aria-labelledby="home-tab">
            <div id="panel_visualizacion" class="col-12 mt-3">
                <div id="parametros_visualizacion" class="container-fluid">
                    <div class="col-12">
                        <h3>Parámetros de Visualización</h3>
                    </div>

                    <div class="row">

                        <div class="col-12 form-center">
                            <div class="form-group">
                                <label class="">Proyecto de Simulación</label>
                                <select id="vis_proy_simul" class="form-control"
                                        onChange="cargarArchConfVis(); return false;">
                                    <option selected disabled>Seleccione un Proyecto</option>
                                    <?php $proyectos = $usuario->listarProyectos($usuario);
                                    foreach ($proyectos as $proy) : ?>
                                        <option id="controlproy_<?= $proy->id ?>"><?= $proy->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Archivo de configuración</label>
                                <div id="vis_archivos_conf_div" class="form-group">
                                    <span>-</span>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-12">
                                    <h3>Configurar visualizaciones</h3>

                                    <div class="col-12 mb-5">
                                        <label for="vis_preset">Cargar desde Preset</label>
                                        <select name="vis_preset" id="vis_preset" class="form-control"
                                                onchange="cargarCamposPreset(); return false;">

                                            <option value="default" selected>Por defecto</option>

                                            <?php foreach ($usuario->getPresets() as $preset): ?>
                                                <option value="<?= $preset['id'] ?>"><?= $preset['preset_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-6">
                                    <h4>Configurar nodos y conexiones</h4>
                                    <p>
                                        <small>Puede configurar el aspecto de los nodos y las conexiones
                                            salientes de cada uno.
                                        </small>
                                    </p>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="selected_preset_color">Color:</label>
                                            <input type="text"
                                                   id="selected_preset_color"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6" style="display: none">
                                        <div class="col-4">
                                            <div class="form-inline">
                                                <label>X</label>
                                                <input type="text"
                                                       id="selected_preset_color_x"
                                                       disabled
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-inline">
                                                <label>Y</label>
                                                <input type="text"
                                                       id="selected_preset_color_y"
                                                       disabled
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-inline">
                                                <label>Z</label>
                                                <input type="text"
                                                       id="selected_preset_color_z"
                                                       disabled
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="selected_preset_size">Tamaño:</label>
                                            <input type="text"
                                                   id="selected_preset_size"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="selected_preset_shape">Forma:</label>
                                            <select id="selected_preset_shape" class="form-control">
                                                <option value="1">Circulo</option>
                                                <option value="2">Cuadrado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="col-12">
                                        <h5>Conexiones salientes del nodo
                                            <small>(node edge)</small>
                                        </h5>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="selected_preset_edge_color">Color:</label>
                                            <input type="text"
                                                   id="selected_preset_edge_color"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6" style="display: none">
                                        <div class="col-4">
                                            <div class="form-inline">
                                                <label>X</label>
                                                <input type="text"
                                                       id="selected_preset_edge_color_x"
                                                       disabled
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-inline">
                                                <label>Y</label>
                                                <input type="text"
                                                       id="selected_preset_edge_color_y"
                                                       disabled
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-inline">
                                                <label>Z</label>
                                                <input type="text"
                                                       id="selected_preset_edge_color_z"
                                                       disabled
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="selected_preset_edge_width">Ancho de
                                                línea:</label>
                                            <input type="text"
                                                   id="selected_preset_edge_width"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-inline">
                                        <label for="selected_preset_name">Nombre Preset:</label>
                                        <input type="text"
                                               id="selected_preset_name"
                                               class="form-control">

                                        <button id="btn-save-user-preset"
                                                disabled class="btn btn-sm btn-info ml-3"
                                                onclick="guardar_preset_usuario(); return false;">
                                            Guardar en mis presets
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12 mt-5">
                                    <div class="form-row">
                                        <div class="col-6">
                                            <button class="btn btn-block btn-primary"
                                                    onclick="load_config_to_vis_table();return false;">
                                                <i class="fa fa-check-circle"></i>
                                                Utilizar
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button id="btn-delete-preset"
                                                    disabled
                                                    class="btn btn-block btn-outline-danger"
                                                    onclick="eliminar_preset_usuario(); return false;">
                                                <i class="fa fa-trash"></i>
                                                Eliminar preset
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div id="node_config_list" class="mb-5">

                                    <table id="vis_configs_table" class="table tables-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nodo: color rgb</th>
                                            <th style="display:none;">Nodo: color x</th>
                                            <th style="display:none;">Nodo: color y</th>
                                            <th style="display:none;">Nodo: color z</th>
                                            <th>Nodo: tamaño</th>
                                            <th>Nodo: forma</th>
                                            <th>Nodo linea: color rgb</th>
                                            <th style="display:none;">Nodo linea: color x</th>
                                            <th style="display:none;">Nodo linea: color y</th>
                                            <th style="display:none;">Nodo linea: color z</th>
                                            <th>Nodo linea: tamaño</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block btn-primary"
                                            name="guardar_control"
                                            onClick="guardar_param_arch_conf_vis(); return false;">
                                        <i class="far fa-save"></i>
                                        Generar Configuración
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="compilacion" role="tabpanel" aria-labelledby="contact-tab">
            <div id="salida_compilacion" class="col-12 mt-3">
                <div id="compilacion">
                    <div class="col-12">
                        <h3>Salida de compilación</h3>
                    </div>

                    <div class="col-12 mb-2">
                        <div class="botones_accion form-inline">
                            <select id="compil_proy_simul" class="form-control">
                                <option selected disabled>Seleccione un Proyecto</option>
                                <?php foreach ($proyectos as $proy) { ?>
                                    <option id="compilproy_<?= $proy->id ?>"><?= $proy->nombre ?></option>
                                <?php } ?>
                            </select>

                            <button type="button"
                                    class="btn btn-primary pull-right"
                                    name="compilar"
                                    onClick="compilar(); return false;">
                                <i class="far fa-sun"></i>
                                Compilar
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <textarea id="txa_copilar" class="form-control-lg" rows="23" style="width: 100%!important;"
                                  placeholder="Resultado de la compilación"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="ejecucion" role="tabpanel" aria-labelledby="contact-tab">
            <div id="salida_ejecucion" class="col-12 mt-3">
                <div id="ejecucion">
                    <div class="col-12">
                        <h3>Salida de ejecución</h3>
                    </div>

                    <div class="col-12 mb-2 p-0">
                        <div class="botones_accion form-inline">
                            <form class="form-inline col-12"
                                  action="/modulos/simulacion/controlador/simulacion.class.php"
                                  method="GET">
                                <div class="col-6 p-0">
                                    <select id="ejec_proy_simul" class="form-control"
                                            onChange="cargarArchConf('ejec_proy_simul', 'ejec_span_arch_conf', 'ejec_arch_conf'); return false;">
                                        <option selected disabled>Seleccione un Proyecto</option>
                                        <?php foreach ($proyectos as $proy) { ?>
                                            <option id="ejecproy_<?= $proy->id ?>"><?= $proy->nombre ?></option>
                                        <?php } ?>
                                    </select>

                                    <span id="ejec_span_arch_conf"> </span>

                                </div>

                                <div class="col-6 p-0">
                                    <div style="float: right !important;">
                                        <button type="button" class="btn btn-primary" name="ejecutar"
                                                onClick="ejecutar_proyecto(); return false;">
                                            <i class="fas fa-play"></i>
                                            Ejecutar
                                        </button>

                                        <input id="proyecto_id_ejecucion" type="hidden" value=""
                                               name="proyecto_id"/>

                                        <button class="btn btn-outline-info" type="submit" value="Descargar"
                                                name="descargar-proyecto">
                                            <i class="fas fa-download"></i>
                                            Descargar
                                        </button>

                                        <a id="link_salida_pdf"
                                           class="btn btn-link"
                                           href="http://<?= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']; ?>/modulos/simulacion/controlador/simulacion.class.php"
                                           target="_blank">
                                            <i class="fas fa-eye"></i>
                                            Visualizar
                                        </a>

                                        <button type="button" class="btn btn-outline-dark"
                                                onclick="clearElement('txa_ejecutar'); return false;">
                                            <i class="fas fa-eraser"></i>
                                            Limpiar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12">
                        <textarea class="form-control" style="width: 100%!important;" id="txa_ejecutar" rows="23"
                                  placeholder="Resultado de la simulación"></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'footer.php'); ?>

</body>
</html>