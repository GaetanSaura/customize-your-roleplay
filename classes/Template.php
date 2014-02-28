<?php

/**
 * Memory class
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
class Template extends Model
{

    public $href;
    protected $vars;
    protected $models;

    public function __construct($template_dir)
    {
        parent::__construct();
        $this->href = $template_dir;        
    }
    
    public function setVars($vars = array())
    {
        if (!empty($vars)) {
            foreach ($vars as $k => $v) {
                $this->vars[$k] = $v;
            }
        }
        return $this;
    }

    public function createView($dir, $template, $ext = _GSF_GLOBAL_TPL_EXT_)
    {
        if (file_exists($dir . '/' . $template . $ext)) {
            $tpl_parsing = file($dir . '/' . $template . $ext);
            $nbLine = count($tpl_parsing);
            for ($i = 0; $i < $nbLine; $i++)
                $this->applyVars($tpl_parsing[$i]);

            echo implode("\n", $tpl_parsing);
        } else {
            throw new Exception('Le template ' . $dir . '/' . $template . $ext . ' n\'existe pas');
        }
    }

    public function applyVars(&$tpl_line)
    {
        if (preg_match_all('#\{(.[^\}]+)\}#', $tpl_line, $result)) {
            if (isset($result[1]) && !empty($result[1])) {
                $nbResults = count($result[1]);
                for ($i = 0; $i < $nbResults; $i++)
                    if (isset($this->vars[$result[1][$i]]))
                        $tpl_line = str_replace($result[0][$i], $this->vars[$result[1][$i]], $tpl_line);
            }
        }
    }

}

?>