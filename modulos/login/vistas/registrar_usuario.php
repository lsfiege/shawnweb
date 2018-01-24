<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'header.php'); ?>

<div class="container">
    <div class="center-block text-center">
        <h2>Registro de Usuarios</h2>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'mensajes_notificacion.php'); ?>
    </div>

    <form action="/modulos/login/controlador/login.class.php" method="POST" class="form-signin">
        <div class="form-group">
            <label for="nombre-usuario">Nombre de Usuario*</label>
            <input type="text"
                   id="nombre-usuario"
                   name="nombre-usuario"
                   class="form-control"
                   value=""
                   autofocus required>
        </div>

        <div class="form-group">
            <label for="email">E-mail*</label>
            <input type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   value=""
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
            <input type="submit" class="btn btn-primary btn-block" value="Crear Cuenta de Usuario"
                   name="registrar-usuario"/>
        </div>
    </form>

    <div class="center-block text-center">
        <p>Complete el formulario para crear una cuenta de usuario e iniciar sesión</p>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'footer.php'); ?>
</body>
</html>
    
    