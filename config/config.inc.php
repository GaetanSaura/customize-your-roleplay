<?php

/**
 * Config.inc.php
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
if (!defined('GSF_CONFIG')) {

    $start_time = microtime(true);
    
    require_once(dirname(__FILE__) . '/switch.inc.php');
    require_once(dirname(__FILE__) . '/defines.inc.php');
    require_once(dirname(__FILE__) . '/core.inc.php');
    require_once(dirname(__FILE__) . '/mysql.inc.php');
    require_once(dirname(__FILE__) . '/extensions.inc.php');
    require_once(dirname(__FILE__) . '/autoload.php');

    define('GSF_CONFIG', 1);

    if (_GSF_DEBUG_MODE_) {
        Debug::setTime($start_time);
    }
    
    $memory = Memory::useMemory();

    if (_GSF_DEBUG_MODE_) {
        Debug::setTime(null, microtime(true));
    }
}
