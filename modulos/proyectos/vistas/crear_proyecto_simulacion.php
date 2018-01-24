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

<div class="col">
    <a class="btn btn-sm btn-outline-secondary float-left"
       href=" <?= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/simulacion/vistas/simulacion_wsn.php' ?> ">
        Volver
    </a>
</div>

<div class="container">

    <div class="center-block text-center">
        <h2 class="form-signin-heading">Crear Proyecto de Simulación</h2>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'mensajes_notificacion.php'); ?>
    </div>

    <form action="/modulos/proyectos/controlador/proyectos.class.php" method="POST" class="form-signin">

        <div class="form-group">
            <label for="nombre-proyecto">Nombre del proyecto*</label>
            <input type="text"
                   id="nombre-proyecto"
                   name="nombre-proyecto"
                   class="form-control"
                   value=""
                   autofocus required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="4" cols="20"></textarea>
        </div>

        <small id="form-help" class="form-text text-muted">(*)Campos obligatorios</small>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="Crear Proyecto" name="crear-proyecto"/>
        </div>
    </form>

    <div class="center-block text-center">
        <p>Complete el formulario con los datos para crear un Proyecto de Simulación</p>
    </div>

</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'footer.php'); ?>
</body>
</html>
