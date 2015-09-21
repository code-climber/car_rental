<?php

define('ROOT', realpath(dirname(__FILE__) . '/../') . '/');

function autoloadItemsClass($sClassName){
    $sFilePath = ROOT . 'src/'. str_replace('\\','/',$sClassName) . '.class.php';

    if(is_file($sFilePath)){
        
        require_once $sFilePath;
    }
}

spl_autoload_register('autoloadItemsClass');

