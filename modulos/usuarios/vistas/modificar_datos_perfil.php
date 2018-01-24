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

<div class="container-fluid">

    <div class="center-block text-center">
        <h2 class="form-signin-heading">Modificación de Datos de Perfil</h2>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'mensajes_notificacion.php'); ?>
    </div>

    <form action="/modulos/usuarios/controlador/usuarios.class.php" method="POST" class="form-signin">

        <div class="form-group">
            <label for="nombre-usuario">Nombre de Usuario*</label>
            <input type="text"
                   id="nombre-usuario"
                   name="nombre-usuario"
                   class="form-control"
                   value="<?php echo $usuario->getNombre(); ?>"
                   autofocus
                   required>
        </div>

        <div class="form-group">
            <label for="email">E-mail*</label>
            <input type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   value="<?php echo $usuario->getEmail(); ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña*</label>
            <input type="password"
                   id="password"
                   name="password"
                   class="form-control"
                   value=""
                   required>
        </div>

        <div class="form-group">
            <label for="password-confirmar">Repetir Contraseña*</label>
            <input type="password"
                   id="password-confirmar"
                   name="password-confirmar"
                   class="form-control"
                   value=""
                   required>
        </div>

        <small id="form-help" class="form-text text-muted">(*)Campos obligatorios</small>

        <div class="form-group">
            <input type="submit" class="btn btn-block btn-primary" value="Modificar datos de perfil"
                   name="modificar-usuario"/>
        </div>
    </form>

    <div class="center-block text-center">
        <p>Complete el formulario para modifcar los datos del perfil</p>
    </div>

</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'footer.php'); ?>
</body>
</html>
