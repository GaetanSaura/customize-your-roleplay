<?php

/*
 * ©2013 Gaëtan SAURA
 * GreatSmartFramework
 * v0.1
 * Gaëtan SAURA
 */

if (!defined('GSF_CONFIG')) {

    define('_GSF_BASE_DIR_', '/');
    define('_GSF_TOOLS_DIR_', _GSF_BASE_DIR_ . 'tools/');
    define('_GSF_TEMPLATE_DIR_', _GSF_BASE_DIR_ . 'tpl/');

    define('_GSF_ROOT_URI_', dirname(dirname(__FILE__)) . '/');
    define('_GSF_CONFIG_URI_', _GSF_ROOT_URI_ . 'config/');
    define('_GSF_ENV_URI_', _GSF_ROOT_URI_ . 'env/');
    define('_GSF_TOOLS_URI_', _GSF_ROOT_URI_ . 'tools/');
    define('_GSF_TEMPLATE_URI_', _GSF_ROOT_URI_ . 'tpl/');

    define('_GSF_ENV_DEFAULT_', 'default');
    if (!isset($_COOKIE['env'])) {
        define('_GSF_ENV_', _GSF_ENV_DEFAULT_);
    } else {
        define('_GSF_ENV_', $_COOKIE['env']);
    }

    define('_GSF_ACTUAL_ENV_URI_', _GSF_ENV_URI_ . _GSF_ENV_ . '/');

    define('_GSF_DEFAULT_DISPATCHER_', 'Dispatcher');
    define('_GSF_DEFAULT_CONTROLLER_', 'Controller');
    define('_GSF_DEFAULT_TEMPLATE_', 'Template');
    define('_GSF_DEFAULT_MODEL_', 'Bloc');
}
