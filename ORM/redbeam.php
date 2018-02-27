<?php 

require ('rb.php');

require ('env.php');

R::setup('pgsql:host='.$host.';dbname='.$db_name,
            $db_user_name,$db_password);

R::ext('xdispense', function( $type ){
    return R::getRedBean()->dispense( $type );
});

R::debug( false );


/**
 * Conectar a la base de datos por linea de comandos
 * sudo -u postgres psql
 * Desde docker, conectarse al container www y ejecutar
 * psql -h db -p 5432 -U postgres
 * Donde db es el nombre del container de la base de datos
 */
?>