<?php

/**
 * Autoload.inc.php
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
if (!defined('GSF_CONFIG')) {

    require_once(dirname(__FILE__) . '/../classes/Autoload.php');
    spl_autoload_register(array(Autoload::getInstance(), 'load'));
    
}
