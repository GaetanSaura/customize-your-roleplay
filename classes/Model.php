<?php

/**
 * Model class
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
class Model
{

    protected static $instance;
    public $_genocode;
    protected $memory;
    public $name = 'Model';
    public $type = 'Model';
    public $class = 'Model';
    public $controller;
    public $_parent;
    protected $_model = array();
    protected $_bloc = array();
    protected $_dispatcher = array();
    protected $_controller = array();
    protected $_template = array();
    protected $_children = array();

    static public function __autoload()
    {
        
    }

    public function __construct()
    {
        //if(!$this->memory) $this->memory = Memory::useMemory();
        if (!$this->_genocode)
            $this->_genocode = Geek::encrypt(get_called_class(), 'R');
        Memory::$_obj[get_called_class()][$this->_genocode] = &$this;
    }

    public static function getInstance()
    {
        $class = get_called_class();
        if (!self::$instance instanceof $class)
            self::$instance = new $class();

        return self::$instance;
    }

    public function addE($class, &$e)
    {
        $class = strtolower($class);
        if (isset($this->{'_' . $class})) {
            if (!isset($this->{'_' . $class}[$e->_genocode])) {
                $e->_parent = $this->_genocode;
                $this->{'_' . $class}[$e->_genocode] = $e;
                //$e->execute();
                return $e->_genocode;
            }
            return false;
        }
        return false;
    }

    public function getE($e, $genocode = false, $default = true)
    {
        if (is_object($e))
            $class = get_class($e);
        elseif (is_string($e))
            $class = strtolower($e);
        else
            return false;

        if (isset($this->{'_' . $class}) && is_array($this->{'_' . $class})) {
            if ($genocode && !isset($this->{'_' . $class}[$genocode])) {
                return $this->{'_' . $class}[$genocode];
            } else {
                $elements = false;
                if (empty($this->{'_' . $class}) && $default === true) {
                    $$class = call_user_func(constant('_GSF_DEFAULT_' . strtoupper($class) . '_') . '::getInstance');
                    $this->addE($class, $$class);
                }

                if (!empty($this->{'_' . $class})) {
                    foreach ($this->{'_' . $class} as $genocode => &$e) {
                        $e->_parent = $this->_genocode;
                        $elements[] = &$e;
                        //$e->execute();
                    }
                    return (count($elements) == 1 ? $elements[0] : $elements);
                }
            }
            return false;
        }
        return false;
    }

    public function getParent($class = null)
    {
        return Memory::getMemoryE($this->_parent, $class);
    }

    public function generateChildren($blocs)
    {
        if (!is_array($blocs) || empty($blocs))
            return false;

        foreach ($blocs as $key => $bloc) {
            if ($key == JSON::ATTRIBUTE_KEY)
                continue;
            elseif (!isset($bloc[JSON::ATTRIBUTE_KEY][JSON::CLASS_KEY]))
                throw new Exception('Classe indisponible : ' . $key);

            $e = call_user_func($bloc[JSON::ATTRIBUTE_KEY][JSON::CLASS_KEY] . '::getInstance');
            foreach ($bloc[JSON::ATTRIBUTE_KEY] as $akey => $attribute) {
                $e->$akey = $attribute;
            }
            $this->_children[] = $this->addE($bloc[JSON::ATTRIBUTE_KEY][JSON::CLASS_KEY], $e);
            if (is_array($bloc))
                $e->generateChildren($bloc);
        }
        return true;
    }

    public function getChildren()
    {
        $children = array(
            'models' => $this->_model,
            'blocs' => $this->_bloc,
            'dispatchers' => $this->_dispatcher,
            'controllers' => $this->_controller,
            'templates' => $this->_template,
        );

        return $children;
    }

    public function getNbChildren()
    {
        return count($this->_children);
    }

    public function haveChildren($type = null)
    {
        if (!isset($this->{'_' . $type}))
            return false;
        return (is_null($type) ? (count($this->_children) > 0) : (count($this->{'_' . $type}) > 0));
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setTagName(string $tag)
    {
        $this->tag = $tag;
    }

    public function execute()
    {
        //var_dump($this->name);
    }

}

?>