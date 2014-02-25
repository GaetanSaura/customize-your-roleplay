<?php

/**
 * Autoload class
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
class Autoload
{

    private static $ENV_CLASSES_FILE = 'classes.env.php';
    private static $ENV_CONTROLLERS_FILE = 'controllers.env.php';
    private static $ENV_PARAMS = array('Class', 'Controller');
    protected static $instance;
    protected $env = array();

    protected function __construct()
    {
        if (!empty(self::$ENV_PARAMS)) {
            $nbParams = count(self::$ENV_PARAMS);
            for ($i = 0; $i < $nbParams; $i++) {
                $param = strtolower(self::$ENV_PARAMS[$i] . (substr(self::$ENV_PARAMS[$i], -1) == 's' ? 'e' : '' ) . 's');
                $const_file = 'ENV_' . strtoupper($param) . '_FILE';
                if (file_exists(_GSF_ACTUAL_ENV_URI_ . Autoload::$$const_file))
                    $this->env[$param] = include(_GSF_ACTUAL_ENV_URI_ . Autoload::$$const_file);
            }
        }
    }

    public static function getInstance()
    {
        if (!Autoload::$instance)
            Autoload::$instance = new Autoload();

        return Autoload::$instance;
    }

    public function load($classname)
    {
        if (empty($this->env))
            return false;
        if (class_exists($classname, false))
            return true;
        if (class_exists('Memory', false) && isset(Memory::$_obj[$classname]))
            return true;

        $classfile = null;

        foreach ($this->env as $key => $env) {
            $classdirname = $classname;
            $exists = file_exists(_GSF_ROOT_URI_ . $env[$classname] . $classname . constant('_GSF_' . strtoupper($key) . '_EXT_'));

            if (isset($env[$classdirname]) && $exists) {
                $classfile = _GSF_ROOT_URI_ . $env[$classdirname] . $classdirname . constant('_GSF_' . strtoupper($key) . '_EXT_');
                break;
            }
        }

        if (is_null($classfile)) {
            Error::addError('Classe : ' . $classname . ' inaccessible');
            return false;
        }

        $content = file_get_contents($classfile);
        $pattern = '#\W((abstract\s+)?class|interface)\s+(?P<classname>' . $classname . '?)(\s+extends\s+[a-z][a-z0-9_]*)?(\s+implements\s+[a-z][a-z0-9_]*(\s*,\s*[a-z][a-z0-9_]*)*)?\s*\{#i';

        if (preg_match($pattern, $content)) {
            require_once($classfile);
            return true;
        }
    }

    private function rewriteClassName($classname, $sub)
    {
        $classname = str_replace($sub, '', $classname);
        return strtolower($classname);
    }

    static function getEnv()
    {
        return Autoload::getInstance()->env;
    }

}

?>