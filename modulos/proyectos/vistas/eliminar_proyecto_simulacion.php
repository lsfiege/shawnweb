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
$proyectos = $usuario->listarProyectos($usuario); ?>

<div class="col">
    <a class="btn btn-sm btn-outline-secondary float-left"
       href=" <?= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/simulacion/vistas/simulacion_wsn.php' ?> ">
        Volver
    </a>
</div>

<div class="container-fluid">

    <div class="center-block text-center">
        <h2 class="form-signin-heading">Eliminar Proyecto de Simulación</h2>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'mensajes_notificacion.php'); ?>
    </div>

    <div id="contenido_internas">
        <div id="tabla_interna">
            <table id="tablas" class="table table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descrpci&oacute;n</th>
                    <th>Fecha de Creaci&oacute;n</th>
                    <th>Eliminar</th>
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
                        <td><input type="button" value="Eliminar" name="eliminar" class="btn btn-outline-danger"
                                   onClick="confirma_eliminar_proyecto(<?php echo "'".$proy->id."'" ?>); return false;"/>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="center-block text-center">
        <p>Seleccione el proyecto que desea eliminar</p>
    </div>

</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'footer.php'); ?>
</body>
</html>