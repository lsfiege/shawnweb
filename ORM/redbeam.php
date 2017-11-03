<?php 

require ('rb.php');

require ('env.php');

R::setup('pgsql:host='.$host.';dbname='.$db_name,
            $db_user_name,$db_password);
    
/*R::setup('pgsql:host=localhost;dbname=shawnprueba',
        'postgres','postgres');*/


R::debug( false );


/**
 * Conectar a la base de datos por linea de comandos
 * sudo -u postgres psql
 */
?>