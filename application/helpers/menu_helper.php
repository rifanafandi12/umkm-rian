<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
function activate_menu($controller, $method = '') {
    $CI =& get_instance();
    $segment1 = $CI->uri->segment(1);
    $segment2 = $CI->uri->segment(2);
    
    if ($method == '') {
        return ($segment1 == $controller && $segment2 == '') ? 'active' : '';
    } else {
        return ($segment1 == $controller && $segment2 == $method) ? 'active' : '';
    }
}


?>