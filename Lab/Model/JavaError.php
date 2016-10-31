<?php

/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/18/2016
 * Time: 10:20 AM
 */
include_once  "Database.php";

class JavaError
{
    private $error;
    private $hint;

    public function JavaError($error)
    {
        $result = GetError($error);

        if(is_null($result))
        {
            $result = NewError($error, "");
        }

        $this->error = $result['error'];
        $this->hint = $result['hint'];
    }

    public function getError()
    {
        return $this->error;
    }

    public function getHint()
    {
        return $this->hint;
    }
}

function AllErrors()
{
    GetAllErrors();
}