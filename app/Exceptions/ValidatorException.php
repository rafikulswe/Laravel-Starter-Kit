<?php

namespace App\Exceptions;

use Exception;

class ValidatorException extends Exception
{
    /**
     * @var $exception
     */
    private $exception;

    public $code = 412;

    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    function render()
    {
        return response()->json($this->exception->errors(), $this->code);
    }
}
