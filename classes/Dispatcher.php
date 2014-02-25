<?php

/**
 * Dispatcher class
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
class Dispatcher extends Model
{

    public $name = 'Dispatcher';

    public function execute()
    {
        $parent = $this->getParent();
        if (!empty($parent->_bloc)) {
            foreach ($parent->_bloc as $bloc) {
                if ($bloc->name !== $parent->name)
                    $bloc->execute();
            }
        }
        if (!empty($parent->_dispatcher)) {
            foreach ($parent->_dispatcher as $dispatcher) {
                if ($dispatcher->name !== $this->name)
                    $dispatcher->execute();
            }
        }
        if (!empty($parent->_controller)) {
            foreach ($parent->_controller as $controller) {
                $controller->execute();
            }
        }
        if (!empty($parent->_template)) {
            foreach ($parent->_template as $template) {
                $template->execute();
            }
        }

        if ($parent->haveChildren('model')) {
            $parent->getE('Model')->execute();
        }
        return true;
    }

}

?>