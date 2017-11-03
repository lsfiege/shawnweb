
<?php
    //Redirect a url de la pagina principal de simulacion. 
    //Si no esta logeado el usuario se redirecciona a la url de la pagina de login 
    header('Location: http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/modulos/simulacion/vistas/simulacion_wsn.php');
    
?>
