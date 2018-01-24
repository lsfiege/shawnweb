<?php
//muestra mensajes de error en php
//ini_set('display_startup_errors',1);
//ini_set('display_errors',1);
//error_reporting(-1);
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'header.php'); ?>

<div class="container">

    <div class="center-block text-center">
        <h2 class="form-signin-heading">Formulario de Inicio de Sesión</h2>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'mensajes_notificacion.php'); ?>
    </div>

    <form action="/modulos/login/controlador/login.class.php" method="POST" class="form-signin">
        <div class="form-group">
            <label for="nombre-usuario">Nombre de Usuario</label>
            <input type="text"
                   id="nombre-usuario"
                   name="nombre-usuario"
                   class="form-control"
                   placeholder="Nombre de Usuario"
                   value=""
                   autofocus required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password"
                   id="password"
                   name="password"
                   class="form-control"
                   value=""
                   required>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="Iniciar Sesión" name="iniciar-sesion"/>
        </div>
    </form>

    <div class="center-block text-center">
        <p>Complete el formulario con los datos para iniciar sesión o
            <a href="<?= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/login/vistas/registrar_usuario.php' ?>">
                puede crear una cuenta</a>
        </p>
    </div>

</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'footer.php'); ?>
</body>
</html>