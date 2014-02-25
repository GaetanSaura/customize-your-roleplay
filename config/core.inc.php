<?php

/**
 * Core.inc.php
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
if (!defined('GSF_CONFIG')) {

    define('_GSF_SSL_PORT_', 443);

    @ini_set('display_errors', (_GSF_DEBUG_MODE_ ? 'on' : 'off'));

    define('_PS_MAGIC_QUOTES_GPC_', get_magic_quotes_gpc());

    define('_GSF_DATE_INSTALL_', '2013-06-04');
    define('_GSF_VERSION_', '0.1');

    define('_GSF_GENECODE_', '$1$hE65z0pV$qULtvuVFF7gscvkqdNter/');
    define('_GSF_SHORTCODE_', md5(_GSF_GENECODE_ . md5(_GSF_DATE_INSTALL_ . 'SHORTCODE')));
    define('_GSF_WSCODE_', md5(_GSF_GENECODE_ . md5(_GSF_DATE_INSTALL_ . 'WSCODE')));
    define('_GSF_INTCODE_', md5(_GSF_GENECODE_ . md5(_GSF_DATE_INSTALL_ . 'INTCODE')));
    define('_GSF_AUTHCODE_', md5(_GSF_GENECODE_ . md5(_GSF_DATE_INSTALL_ . 'AUTHCODE')));
}
