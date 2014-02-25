<?php

/**
 * Extensions.inc.php
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
if (!defined('GSF_CONFIG')) {

    define('_GSF_GLOBAL_EXT_', '.php');
    define('_GSF_CLASSES_EXT_', '' . _GSF_GLOBAL_EXT_);
    define('_GSF_CONTROLLERS_EXT_', '' . _GSF_GLOBAL_EXT_);
    define('_GSF_TOOLS_EXT_', '.tool' . _GSF_GLOBAL_EXT_);
    define('_GSF_MODULES_EXT_', '' . _GSF_GLOBAL_EXT_);

    define('_GSF_GLOBAL_TPL_EXT_', '.tpl');
    define('_GSF_TOOL_TPL_EXT_', '.tool' . _GSF_GLOBAL_TPL_EXT_);
    define('_GSF_CONF_TPL_EXT_', '.conf' . _GSF_GLOBAL_TPL_EXT_);
}
