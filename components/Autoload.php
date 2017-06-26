<?php
function __autoload($class_name) {
    $array_path = array(
            '/models/',
            '/components/'
            );
            foreach ($array_path as $path) {
                $path = ROOT.$path.$class_name.'.php';
                if (is_file($path)) {
                    include_once $path;
                }
            }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

