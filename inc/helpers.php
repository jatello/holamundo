<?php
/**
 * Redirigir a una URL
 * 
 * @param $path
 */
function redirect_to( $path ){
    header('Location:' . SITE_URL . '/' . $path );
    die();
}


/**
 * Genera una cadena alfanumérica
 * 
 * @param action
 * 
 * @return string
 */

 function generate_hash( $action ){
     return md5( $action );
 }

/**
 * Compruieba si una secuencia alfanuum es correcta
 * @param action
 * @param hash
 * 
 * @return boot
 */

 function check_hash( $action, $hash){
     if (generate_hash($action) == $hash ){
         return true;
     }
     return false;
 }