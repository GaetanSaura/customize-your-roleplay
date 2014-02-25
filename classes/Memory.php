<?php

/**
 * Memory class
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
class Memory
{

    static protected $instance;
    static public $_query = array();
    static public $_obj = array();
    static public $_cookie = array();
    static public $_session = array();
    static public $_template = array();
    static public $_env = array();
    public $query;
    public $obj;
    public $cookie;
    public $session;
    public $template;
    public $env;

    static public function useMemory()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Memory();
            self::$instance->query = &self::$_query;
            self::$instance->obj = &self::$_obj;
            self::$instance->cookie = &self::$_cookie;
            self::$instance->session = &self::$_session;

            if (empty(self::$_env))
                self::$_env = Autoload::getEnv();
            self::$instance->env = &self::$_env;

            if (empty(self::$_template))
                self::$_template = new Template();
            self::$instance->template = &self::$_template;
        }
        return self::$instance;
    }

    static public function getMemoryE($genocode, $class = null)
    {
        if (!is_null($class)) {
            if (isset(Memory::$_obj[$class][$genocode]))
                return Memory::$_obj[$class][$genocode];
            return false;
        }
        else {
            if (!empty(Memory::$_obj)) {
                foreach (Memory::$_obj as $obj => $e) {
                    if (isset(Memory::$_obj[$obj][$genocode]))
                        return Memory::$_obj[$obj][$genocode];
                }
                return false;
            }
        }
    }

}

?>