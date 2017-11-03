<?php
session_start();
session_destroy();
header('Location: http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/login/vistas/iniciar_sesion.php');
?>
