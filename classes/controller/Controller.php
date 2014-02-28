<?php

/**
 * Controller class
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
class Controller extends Model
{

    public $name = 'controller';
    public $display = true;
    public $display_function = false;

    /**
 * postProcess
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
    public function postProcess()
    {
        if (!$this->display_function) {
            $this->display_function = 'displayLayout';
        }
    }

    public function displayLayout()
    {
        
        $template = new Template();
        if (!is_null($template->href)) {
            $template->setVars(array('nom' => 'Gaetan'));
            return $template->createView(_GSF_ROOT_URI_ . dirname($template->href), basename($template->href));
        }
        return false;
    }

    public function execute()
    {
        if($this->initialize()) {
            
        }
        $this->postProcess();

        if ($this->display && $this->display_function)
            $output .= $this->{$this->display_function}();

        return $output;
    }

}
