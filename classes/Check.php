<?php

/**
 * Error class
 * 
 * @author Gaëtan SAURA <gaetan.saura@gmail.com>
 * @copyright Gaëtan SAURA
 * @since 25-02-2014
 */
class Error extends Model
{

    public $name = "error";
    static protected $errors = array();

    static public function addError($error)
    {
        self::$errors[md5($error)] = $error;
    }

    static public function deleteError($error)
    {
        if (isset(self::$errors[md5($error)]))
            unset(self::$errors[md5($error)]);
    }

    static public function displayErrors($return = false)
    {
        if ($return)
            return self::$errors;
        echo '<pre>';
        var_dump(self::$errors);
        echo '</pre>';
        return true;
    }

}

?>