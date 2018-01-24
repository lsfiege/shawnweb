<?php
//inicia la sesion
session_start();
if (($_SESSION['Usuario'] == null)) {
    header('Location: http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/login/controlador/logout.class.php');
}
require($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'modelo'.DIRECTORY_SEPARATOR.'Usuario.class.php');
$usuario = unserialize($_SESSION['Usuario']);
?>

<?php
require($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'header.php'); ?>

<?php
$proyectos = $usuario->listarProyectos($usuario);
?>

<div class="col">
    <a class="btn btn-sm btn-outline-secondary float-left"
       href=" <?= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/simulacion/vistas/simulacion_wsn.php' ?> ">
        Volver
    </a>
</div>

<div class="container-fluid">

    <div class="center-block text-center">
        <h2>Modificar Proyecto de Simulación</h2>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'mensajes_notificacion.php'); ?>
    </div>

    <div id="contenido_internas" class="container-fluid">
        <div id="tabla_interna" class="col">
            <table id="tablas" class="table table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descrpción</th>
                    <th>Fecha de Creación</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($proyectos as $proy) { ?>
                    <tr>
                        <td><?php echo $proy->nombre; ?></td>
                        <td><?php echo $proy->descripcion; ?></td>
                        <td>
                            <?php
                            $unaFechaCreacion = new DateTime($proy->fechacreacion);
                            echo $unaFechaCreacion->format('d-m-Y H:i:s');
                            ?>
                        </td>
                        <td><input type="button" value="Modificar" name="modificar" class="btn btn-outline-info"
                                   onClick="cargar_datos_modif_proy(<?php echo "'".$proy->id."'" ?>); return false;"/>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="center-block text-center">
            <p>Seleccione el proyecto que desea modificar y complete los datos del formulario</p>
        </div>

        <div id="formulario_interna" class="col-sm-5">
            <div class="card">
                <form action="/modulos/proyectos/controlador/proyectos.class.php" method="POST" class="card-body">

                    <div class="form-group">
                        <label>Nombre del proyecto*</label>
                        <input id="txt_nom_proy" type="text" class="form-control" name="nombre-proyecto" value=""
                               autofocus
                               required>
                        <input id="txt_proyecto_id" type="hidden" name="proyecto_id" value="">
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea id="txa_descrip" name="descripcion" class="form-control" rows="4" cols="20">
                        </textarea>
                    </div>

                    <small id="form-help" class="form-text text-muted">(*)Campos obligatorios</small>

                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-block btn-primary" value="Modificar Proyecto"
                               name="modificar-proyecto"/>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'footer.php'); ?>
</body>
</html>
